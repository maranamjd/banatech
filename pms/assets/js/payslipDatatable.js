$(document).ready(function(){
  var dataTable = $('#paysliptable').DataTable({
    "processing":false,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"../functions/payslipfetch.php",
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
      url: '../functions/payslipfetch_2.php',
      type: 'POST',
      dataType: 'json',
      data : {
        data_id : 1
      },
      success: function(data){
        for (var item in data) {
          var name_id = '#name'+data[item].EmployeeId;
          var img_id = '#img'+data[item].EmployeeId;
          var empid_id = '#empid'+data[item].EmployeeId;
          var btn_id = '#btn'+data[item].EmployeeId;

          var hasPayslip = data[item].hasPayslip;
          var newname = data[item].LastName + ', ' + data[item].FirstName + ' ' + data[item].MiddleName.charAt(0).toUpperCase() + '.';
          var newid = data[item].EmployeeId;
          var newimg = '<img src="../assets/upload/'+data[item].image+'" />';

          $('#paysliptable').find(name_id).html(newname);
          $('#paysliptable').find(img_id).html(newimg);
          $('#paysliptable').find(empid_id).html(newid);
          if (hasPayslip == 0) {
            $('#paysliptable').find(btn_id).html('<button type="button" name="view" id="'+data[item].EmployeeId+'" class="btn btn-primary btn-sm viewpayslip" title="view data" disabled><input type="hidden" id="employeeid" value="'+data[item].EmployeeId+'"><i class="fa fa-newspaper-o"></i></button>');
          }else {
            $('#paysliptable').find(btn_id).html('<button type="button" name="view" id="'+data[item].EmployeeId+'" class="btn btn-primary btn-sm viewpayslip" title="view data"><input type="hidden" id="employeeid" value="'+data[item].EmployeeId+'"><i class="fa fa-newspaper-o"></i></button>');
          }
        }
      }
    });
  }

setInterval(function(){
  loadData();
}, 3000);

  function leapYear(year)
  {
    return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0);
  }

  function newDate(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd>=1 && dd <=15) {
        dd = 15;
    }else {
      if(leapYear(yyyy)){
        if (mm == 2) {
          dd = 29;
        }
      }else {
        if (mm == 2) {
          dd = 28;
        }else {
          dd = 30;
        }
      }
    }
    if(mm<10) {
        mm = '0'+mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    return today;
  }
$(document).on('click', '.viewpayslip', function(){
  var date = newDate();
  var id = $(this).find('#employeeid').val();
  $.ajax({
    url: '../functions/getpayslipview.php',
    type: 'post',
    dataType: 'json',
    data: {id: id, date: date},
    success: function(data){
      window.open('../assets/files/payslips/'+data, '_blank');
    }
  });
});

});
