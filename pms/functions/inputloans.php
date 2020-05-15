<?php

include 'db.php';
include 'function.php';
/** Include PHPExcel */
require_once '../classes/PHPExcel.php';
require_once '../classes/PHPExcel/IOFactory.php';
function hourlyRate($hour, $basicpay){
  return ((($basicpay * 12) / 261) / 8) * $hour;
}
function minuteRate($min, $basicpay){
  return (((($basicpay * 12) / 261) / 8) / 60) * $min;
}
if (isset($_POST['id'])) {

  try {
    $id = $_POST['id'];
    $payrolldate = $_POST['payrolldate'];
    $hdmfloan = $_POST['hdmfamount'];
    $sssloan = $_POST['sssamount'];
    $OtherDeduction = $_POST['otheramount'];
    $total = $hdmfloan + $sssloan + $OtherDeduction;
    $date = explode('-', $payrolldate);
    $month = ltrim($date[1], '0');
    $year = $date[0];
    if($date[2] >= 1 && $date[2] <= 15)
      $batch = 1;
    else
      $batch = 2;

    $statement = $connection->prepare('
    START TRANSACTION;
    INSERT INTO loans (id, EmployeeId, Month, Year, Batch, HDMF, SSS, OtherDeduction, TotalLoan)
    VALUES (NULL, :EmployeeId, :Month, :Year, :Batch,  :HDMF, :SSS, :OtherDeduction, :TotalLoan);
    UPDATE users SET hasLoans = 1 WHERE EmployeeId = :EmployeeId;
    COMMIT;');

    $result = $statement->execute(array(
      ':EmployeeId' => $id,
      ':Month' => $month,
      ':Year' => $year,
      ':Batch' => $batch,
      ':HDMF' => $hdmfloan,
      ':SSS' => $sssloan,
      ':OtherDeduction' => $OtherDeduction,
      ':TotalLoan' => $total
    ));

    //// payroll report start


    $statement = $connection->prepare('SELECT a.BasicPay, a.FirstName, a.MiddleName, a.LastName, b.DeMinimis, b.FoodTravelAllowance, b.Incentives, c.SSS, c.Philhealth, c.HDMF FROM employees a inner join additionals b on a.EmployeeId = b.EmployeeId inner join contributions c on b.EmployeeId = c.EmployeeId WHERE a.EmployeeId = :id');
    $result = $statement->execute(array(':id' => $id));
    $result = $statement->fetchAll();
    $ssscontri = $result[0]['SSS'];
    $philhealthcontri = $result[0]['Philhealth'];
    $hdmfcontri = $result[0]['HDMF'];
    $allowances = $result[0]['FoodTravelAllowance'] + $result[0]['Incentives'];
    $name = $result[0]['FirstName'].' '.$result[0]['MiddleName'].' '.$result[0]['LastName'];
    $basicpay = $result[0]['BasicPay'];
    $deminimis = $result[0]['DeMinimis'];

    $result = $mysqli->query("SELECT BasicPay, Absences, Tardiness, UnderTime, RegOT, RestOT, NightDifferentials, RegHoliday, SpecialHoliday, SalaryAdjustments, GrossPay FROM grosspay WHERE EmployeeId = '$id' AND Month = '$month' AND Year = '$year' AND Batch = '$batch'");
    if ($result->num_rows != 0) {
      $row = $result->fetch_assoc();
      $grosspay = $row['GrossPay'];
      $absencesrate = hourlyRate($row['Absences'], $basicpay);
      $tardinessrate = minuteRate($row['Tardiness'], $basicpay);
      $undertimerate = minuteRate($row['UnderTime'], $basicpay);
      $regotrate = hourlyRate($row['RegOT'], $basicpay) * 1.25;
      $restotrate = hourlyRate($row['RestOT'], $basicpay) * 1.30;
      $nightdiffrate = hourlyRate($row['NightDifferentials'], $basicpay) * 0.1;
      $regholidayrate = hourlyRate($row['RegHoliday'], $basicpay);
      $specialholidayrate = hourlyRate($row['SpecialHoliday'], $basicpay);
      $salaryadjustments = $row['SalaryAdjustments'];
      $basicpay = $row['BasicPay'];
      $taxable = $grosspay-$deminimis-$ssscontri-$philhealthcontri-$hdmfcontri;
      $totaldeduction = $ssscontri+$philhealthcontri+$hdmfcontri+$hdmfloan+$sssloan+$OtherDeduction+withholdingtax($taxable);
      if ($batch == 2) {
        $cutoff = '1ST CUT-OFF';
        if ($month == 2) {
          $day = 28;
        }else {
          $day = 30;
        }
        $basis = date( 'F', strtotime($year.'-'.$month.'-'.$day));
        $datebasis = $basis. ' 15-'.$day.', '.$year;
        $day = 15;
        $month++;
        $batch = 1;
      }else {
        $cutoff = '2ND CUT-OFF';
        $day = 15;
        $basis = date( 'F', strtotime($year.'-'.$month.'-'.$day));
        $datebasis = $basis. ' 1-'.$day.', '.$year;
        if ($month == 2) {
          $day = 28;
        }else {
          $day = 30;
        }
        $batch = 2;
      }
      $payoutdate = $year.'-'.$month.'-'.$day;
      $payrollperiod = date( 'F d, Y', strtotime($payoutdate));
      $dir = '../assets/files/payrollreports/';

      if (file_exists($dir."Payroll-Report".$year."-".$month."-".$batch.".xlsx")) {
        $objPHPExcel = PHPExcel_IOFactory::load($dir."Payroll-Report".$year."-".$month."-".$batch.".xlsx");
        $objPHPExcel->setActiveSheetIndex(1);
        $row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'DRAKE PERSONNEL (PHILS) INC.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, number_format($basicpay, 2, '.', ','));//monthly salaray
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $name);//fullname
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, number_format($basicpay/2, 2, '.', ','));//semi monthly salary
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, number_format($absencesrate, 2, '.', ','));//absences
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, number_format($tardinessrate, 2, '.', ','));//tardiness
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, number_format($undertimerate, 2, '.', ','));//undertime
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, number_format($regotrate, 2, '.', ','));//regular ot
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row, number_format($restotrate, 2, '.', ','));//rest day ot
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, number_format(0, 2, '.', ','));//Rest Day OT in x's of 8 hrs
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, number_format($nightdiffrate, 2, '.', ','));// night differentials
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, number_format(0, 2, '.', ','));//retro add
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, number_format(0, 2, '.', ','));//retro deduct
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row, number_format($regholidayrate, 2, '.', ','));//regular holiday pay
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row, number_format(0, 2, '.', ','));//Regular Holiday Pay in x's of 8 hours
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row, number_format($specialholidayrate, 2, '.', ','));//special holiday pay
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row, number_format(0, 2, '.', ','));//Special Holiday Pay in x's of 8 hours
        $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row, number_format($deminimis, 2, '.', ','));//deminimis
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row, number_format($grosspay, 2, '.', ','));//grosspay
        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row, number_format(0, 2, '.', ','));//sss employer
        $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row, number_format($ssscontri, 2, '.', ','));//sss employee
        $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row, number_format(0, 2, '.', ','));//sss ec
        $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row, number_format($philhealthcontri, 2, '.', ','));//philhealth employee
        $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row, number_format(0, 2, '.', ','));//philhealth employer
        $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row, number_format($hdmfcontri, 2, '.', ','));//hdmf employee
        $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row, number_format(0, 2, '.', ','));//hdmf employer
        $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row, number_format($hdmfloan, 2, '.', ','));//hdmf loan
        $objPHPExcel->getActiveSheet()->getStyle('AB'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92D050');
        $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row, number_format($sssloan, 2, '.', ','));//sss salary loan
        $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$row, number_format($hdmfloan+$sssloan, 2, '.', ','));//total loans
        $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row, number_format($OtherDeduction, 2, '.', ','));//other deduction
        $objPHPExcel->getActiveSheet()->getStyle('AE'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
        $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$row, number_format(withholdingtax($taxable), 2, '.', ','));//withholding tax
        $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$row, number_format($totaldeduction, 2, '.', ','));//total deduction
        $objPHPExcel->getActiveSheet()->SetCellValue('AG'.$row, number_format($grosspay-$totaldeduction, 2, '.', ','));//net pay
        $objPHPExcel->getActiveSheet()->SetCellValue('AH'.$row, '');//unknown 's'
        $objPHPExcel->getActiveSheet()->SetCellValue('AI'.$row, number_format($taxable, 2, '.', ','));//taxable
        $objPHPExcel->getActiveSheet()->SetCellValue('AJ'.$row, number_format(0, 2, '.', ','));//tax payable
        $objPHPExcel->getActiveSheet()->SetCellValue('AK'.$row, number_format(withholdingtax($taxable), 2, '.', ','));//tax computation
        $objPHPExcel->getActiveSheet()->SetCellValue('AL'.$row, '');//unknown 'wrong'
        $objPHPExcel->getActiveSheet()->SetCellValue('AM'.$row, number_format($salaryadjustments, 2, '.', ','));//salary adjustments
        $objPHPExcel->getActiveSheet()->SetCellValue('AN'.$row, number_format($allowances, 2, '.', ','));//allowances
        $objPHPExcel->getActiveSheet()->getStyle('AO'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92D050');
        $objPHPExcel->getActiveSheet()->SetCellValue('AO'.$row, number_format($grosspay-$totaldeduction, 2, '.', ','));//total
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($dir."Payroll-Report".$year."-".$month."-".$batch."-.xlsx");
        unlink($dir."Payroll-Report".$year."-".$month."-".$batch.".xlsx");
      }
      else if(file_exists($dir."Payroll-Report".$year."-".$month."-".$batch."-.xlsx")){
        $objPHPExcel = PHPExcel_IOFactory::load($dir."Payroll-Report".$year."-".$month."-".$batch."-.xlsx");
        $objPHPExcel->setActiveSheetIndex(1);
        $row = $objPHPExcel->getActiveSheet()->getHighestRow()+1;

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'DRAKE PERSONNEL (PHILS) INC.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, number_format($basicpay, 2, '.', ','));//monthly salaray
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $name);//fullname
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, number_format($basicpay/2, 2, '.', ','));//semi monthly salary
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, number_format($absencesrate, 2, '.', ','));//absences
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, number_format($tardinessrate, 2, '.', ','));//tardiness
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, number_format($undertimerate, 2, '.', ','));//undertime
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, number_format($regotrate, 2, '.', ','));//regular ot
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row, number_format($restotrate, 2, '.', ','));//rest day ot
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, number_format(0, 2, '.', ','));//Rest Day OT in x's of 8 hrs
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, number_format($nightdiffrate, 2, '.', ','));// night differentials
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, number_format(0, 2, '.', ','));//retro add
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, number_format(0, 2, '.', ','));//retro deduct
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row, number_format($regholidayrate, 2, '.', ','));//regular holiday pay
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row, number_format(0, 2, '.', ','));//Regular Holiday Pay in x's of 8 hours
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row, number_format($specialholidayrate, 2, '.', ','));//special holiday pay
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row, number_format(0, 2, '.', ','));//Special Holiday Pay in x's of 8 hours
        $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row, number_format($deminimis, 2, '.', ','));//deminimis
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row, number_format($grosspay, 2, '.', ','));//grosspay
        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row, number_format(0, 2, '.', ','));//sss employer
        $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row, number_format($ssscontri, 2, '.', ','));//sss employee
        $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row, number_format(0, 2, '.', ','));//sss ec
        $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row, number_format($philhealthcontri, 2, '.', ','));//philhealth employee
        $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row, number_format(0, 2, '.', ','));//philhealth employer
        $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row, number_format($hdmfcontri, 2, '.', ','));//hdmf employee
        $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row, number_format(0, 2, '.', ','));//hdmf employer
        $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row, number_format($hdmfloan, 2, '.', ','));//hdmf loan
        $objPHPExcel->getActiveSheet()->getStyle('AB'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92D050');
        $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row, number_format($sssloan, 2, '.', ','));//sss salary loan
        $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$row, number_format($hdmfloan+$sssloan, 2, '.', ','));//total loans
        $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row, number_format($OtherDeduction, 2, '.', ','));//other deduction
        $objPHPExcel->getActiveSheet()->getStyle('AE'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
        $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$row, number_format(withholdingtax($taxable), 2, '.', ','));//withholding tax
        $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$row, number_format($totaldeduction, 2, '.', ','));//total deduction
        $objPHPExcel->getActiveSheet()->SetCellValue('AG'.$row, number_format($grosspay-$totaldeduction, 2, '.', ','));//net pay
        $objPHPExcel->getActiveSheet()->SetCellValue('AH'.$row, '');//unknown 's'
        $objPHPExcel->getActiveSheet()->SetCellValue('AI'.$row, number_format($taxable, 2, '.', ','));//taxable
        $objPHPExcel->getActiveSheet()->SetCellValue('AJ'.$row, number_format(0, 2, '.', ','));//tax payable
        $objPHPExcel->getActiveSheet()->SetCellValue('AK'.$row, number_format(withholdingtax($taxable), 2, '.', ','));//tax computation
        $objPHPExcel->getActiveSheet()->SetCellValue('AL'.$row, '');//unknown 'wrong'
        $objPHPExcel->getActiveSheet()->SetCellValue('AM'.$row, number_format($salaryadjustments, 2, '.', ','));//salary adjustments
        $objPHPExcel->getActiveSheet()->SetCellValue('AN'.$row, number_format($allowances, 2, '.', ','));//allowances
        $objPHPExcel->getActiveSheet()->getStyle('AO'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92D050');
        $objPHPExcel->getActiveSheet()->SetCellValue('AO'.$row, number_format($grosspay-$totaldeduction, 2, '.', ','));//total
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($dir."Payroll-Report".$year."-".$month."-".$batch.".xlsx");
        unlink($dir."Payroll-Report".$year."-".$month."-".$batch."-.xlsx");
      }else {
        $objPHPExcel = PHPExcel_IOFactory::load("../assets/files/payrollReportTemplate.xlsx");
        $objPHPExcel->setActiveSheetIndex(1);
        $row = $objPHPExcel->getActiveSheet()->getHighestRow();

        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Payroll Period:'.$payrollperiod.'('.$datebasis.')');
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', $cutoff);

        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, 'DRAKE PERSONNEL (PHILS) INC.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, number_format($basicpay, 2, '.', ','));//monthly salaray
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $name);//fullname
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, number_format($basicpay/2, 2, '.', ','));//semi monthly salary
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, number_format($absencesrate, 2, '.', ','));//absences
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, number_format($tardinessrate, 2, '.', ','));//tardiness
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, number_format($undertimerate, 2, '.', ','));//undertime
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, number_format($regotrate, 2, '.', ','));//regular ot
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row, number_format($restotrate, 2, '.', ','));//rest day ot
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, number_format(0, 2, '.', ','));//Rest Day OT in x's of 8 hrs
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, number_format($nightdiffrate, 2, '.', ','));// night differentials
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, number_format(0, 2, '.', ','));//retro add
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, number_format(0, 2, '.', ','));//retro deduct
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row, number_format($regholidayrate, 2, '.', ','));//regular holiday pay
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row, number_format(0, 2, '.', ','));//Regular Holiday Pay in x's of 8 hours
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row, number_format($specialholidayrate, 2, '.', ','));//special holiday pay
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row, number_format(0, 2, '.', ','));//Special Holiday Pay in x's of 8 hours
        $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row, number_format($deminimis, 2, '.', ','));//deminimis
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row, number_format($grosspay, 2, '.', ','));//grosspay
        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row, number_format(0, 2, '.', ','));//sss employer
        $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row, number_format($ssscontri, 2, '.', ','));//sss employee
        $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row, number_format(0, 2, '.', ','));//sss ec
        $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row, number_format($philhealthcontri, 2, '.', ','));//philhealth employee
        $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row, number_format(0, 2, '.', ','));//philhealth employer
        $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row, number_format($hdmfcontri, 2, '.', ','));//hdmf employee
        $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row, number_format(0, 2, '.', ','));//hdmf employer
        $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row, number_format($hdmfloan, 2, '.', ','));//hdmf loan
        $objPHPExcel->getActiveSheet()->getStyle('AB'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92D050');
        $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row, number_format($sssloan, 2, '.', ','));//sss salary loan
        $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$row, number_format($hdmfloan+$sssloan, 2, '.', ','));//total loans
        $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row, number_format($OtherDeduction, 2, '.', ','));//other deduction
        $objPHPExcel->getActiveSheet()->getStyle('AE'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
        $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$row, number_format(withholdingtax($taxable), 2, '.', ','));//withholding tax
        $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$row, number_format($totaldeduction, 2, '.', ','));//total deduction
        $objPHPExcel->getActiveSheet()->SetCellValue('AG'.$row, number_format($grosspay-$totaldeduction, 2, '.', ','));//net pay
        $objPHPExcel->getActiveSheet()->SetCellValue('AH'.$row, '');//unknown 's'
        $objPHPExcel->getActiveSheet()->SetCellValue('AI'.$row, number_format($taxable, 2, '.', ','));//taxable
        $objPHPExcel->getActiveSheet()->SetCellValue('AJ'.$row, number_format(0, 2, '.', ','));//tax payable
        $objPHPExcel->getActiveSheet()->SetCellValue('AK'.$row, number_format(withholdingtax($taxable), 2, '.', ','));//tax computation
        $objPHPExcel->getActiveSheet()->SetCellValue('AL'.$row, '');//unknown 'wrong'
        $objPHPExcel->getActiveSheet()->SetCellValue('AM'.$row, number_format($salaryadjustments, 2, '.', ','));//salary adjustments
        $objPHPExcel->getActiveSheet()->SetCellValue('AN'.$row, number_format($allowances, 2, '.', ','));//allowances
        $objPHPExcel->getActiveSheet()->getStyle('AO'.$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('92D050');
        $objPHPExcel->getActiveSheet()->SetCellValue('AO'.$row, number_format($grosspay-$totaldeduction, 2, '.', ','));//total
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($dir."Payroll-Report".$year."-".$month."-".$batch.".xlsx");
      }

      echo 'Data Successfuly inserted!';
    }else {
      echo 'Data Successfuly inserted!';
    }
  } catch (PDOException $e) {
    echo 'failed to insert data. '.$e;
  }
}
else {
  header('Location: ../');
}
