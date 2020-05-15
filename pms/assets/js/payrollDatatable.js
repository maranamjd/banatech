//fetch data for employee payroll

  var dataTable = $('#userpayroll').DataTable({
    "processing":false,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"../functions/payrollfetch.php",
      type:"POST",
      data:{fetch: true}
    },
    "columnDefs":[
      {
        "targets":[],
        "orderable":false,
      },
    ]
  });

  function loadData(){
    $.ajax({
      url: '../functions/payrollfetch_2.php',
      type: 'POST',
      dataType: 'json',
      data : {
        data_id : 1
      },
      success: function(data){
        for (var item in data) {
          var reset = data[item].reset;
          var report = data[item].report;
          var dtr_id = '#dtr'+data[item].EmployeeId;
          var loan_id = '#loan'+data[item].EmployeeId;
          var name_id = '#name'+data[item].EmployeeId;
          var img_id = '#img'+data[item].EmployeeId;
          var empid_id = '#empid'+data[item].EmployeeId;
          var btn_id = '#btn'+data[item].EmployeeId;
          var payslip_id = '#payslip'+data[item].EmployeeId;

          var hasDTR = data[item].hasDTR;
          var hasPayslip = data[item].hasPayslip;
          var hasLoans = data[item].hasLoans;
          var newname = data[item].LastName + ', ' + data[item].FirstName + ' ' + data[item].MiddleName.charAt(0).toUpperCase() + '.';
          var newid = data[item].EmployeeId;
          var newimg = '<img src="../assets/upload/'+data[item].image+'" />';
          if (hasDTR == 1) {
            var dtrappend = '<i class="fa fa-check" style="color:#76EE00"></i>';
          }else {
            var dtrappend = '<i class="fa fa-times" style="color:#B22222"></i>';
          }
          if (hasPayslip == 1) {
            var payslipappend = '<i class="fa fa-check" style="color:#76EE00"></i>';
          }else {
            var payslipappend = '<i class="fa fa-times" style="color:#B22222"></i>';
          }
          if (hasLoans == 1) {
            var loanappend = '<i class="fa fa-check" style="color:#76EE00"></i>';
          }else {
            var loanappend = '<i class="fa fa-times" style="color:#B22222"></i>';
          }
          $('#userpayroll').find(dtr_id).html(dtrappend);
          $('#userpayroll').find(loan_id).html(loanappend);
          $('#userpayroll').find(name_id).html(newname);
          $('#userpayroll').find(img_id).html(newimg);
          $('#userpayroll').find(empid_id).html(newid);
          $('#userpayroll').find(payslip_id).html(payslipappend);
          if (data[item].isApproved == 1 && hasPayslip == 1 || data[item].isApproved == 0 && hasPayslip == 1 || data[item].isApproved == 0 && hasPayslip == 0) {
            $('#userpayroll').find(btn_id).html('<button type="button" name="upload" id="'+data[item].EmployeeId+'" class="btn btn-primary btn-sm process" title="view data" disabled><input type="hidden" id="employeeid" value="'+data[item].EmployeeId+'"><i class="fa fa-calculator"></i>');
          }else if(data[item].isApproved == 1 && hasPayslip == 0){
            $('#userpayroll').find(btn_id).html('<button type="button" name="upload" id="'+data[item].EmployeeId+'" class="btn btn-primary btn-sm process" title="view data"><input type="hidden" id="employeeid" value="'+data[item].EmployeeId+'"><i class="fa fa-calculator"></i>');
          }
        }
        if (reset == 1 && report == 1) {
          var btns = '<div class="pull-right"><button class="btn btn-primary" id="resetpayroll" type="button" name="button"><span class="fa fa-undo"></span> Reset Payroll</button></div><br /><br /><br /><div class="pull-right"><button class="btn btn-primary" id="showpayrollreport" type="button" name="button">Payroll Report Available</button></div>';
        }else if (reset == 0 && report == 1) {
          var btns = '<div class="pull-right"><button class="btn btn-primary" id="showpayrollreport" type="button" name="button">Payroll Report Available</button></div>';
        }else if (reset == 1 && report == 0) {
          var btns = '<div class="pull-right"><button class="btn btn-primary" id="resetpayroll" type="button" name="button"><span class="fa fa-undo"></span> Reset Payroll</button></div><br /><br /><br />';
        }else {
          var btns = '';
        }
        document.getElementById('payrollbtns').innerHTML = btns;
      }
    });
  }

setInterval(function(){
  loadData();
}, 3000);
