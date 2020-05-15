$(document).ready(function(){


  function confirmModal(title, msg, yescb){
    $('#modalConfirmTitle').text(title);
    $('#modalConfirmText').text(msg);
    $('body').css('overflow','hidden')
    $('#modalConfirm').modal('show');
    $('#modalConfirmBtnNo').click(function(){
      $('#modalConfirm').modal('hide');
      $('body').css('overflow','scroll');
    });
    $('#modalConfirmBtnYes').click(function(){
      yescb();
      $('#modalConfirm').modal('hide');
      $('body').css('overflow','scroll');
    });
  }
  function alertModal(title, msg, cb){
    $('#modalAlertTitle').text(title);
    $('#modalAlertText').text(msg);
    $('body').css('overflow','hidden')
    $('#modalAlert').modal('show');
    setTimeout(function () {
      $('#modalAlert').modal('hide');
      $('body').css('overflow','scroll');
      if (cb != '') {
        cb();
      }
    }, 1500);
  }

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

//fetch data for employee profile table
    var dataTable = $('#empinformation').DataTable({
        "processing":false,
        "serverSide":true,
        "order":[],
        "ajax":{
            url:"../functions/accfetchinfo.php",
            type:"POST",
            data:{fetch: true}
        },
        "columnDefs":[
            {
                "targets":[0, 2, 3],
                "orderable":false,
            },
        ],

    });
    function loadData(){
      $.ajax({
        url: '../functions/accfetchinfo_2.php',
        type: 'POST',
        dataType: 'json',
        data : {
          data_id : 1
        },
        success: function(data){
          for (var item in data) {
            var loan_id = '#loan'+data[item].EmployeeId;
            var name_id = '#name'+data[item].EmployeeId;
            var img_id = '#img'+data[item].EmployeeId;
            var empid_id = '#empid'+data[item].EmployeeId;
            var btn_id = '#btn'+data[item].EmployeeId;

            var hasLoans = data[item].hasLoans;
            var newname = data[item].LastName + ', ' + data[item].FirstName + ' ' + data[item].MiddleName.charAt(0).toUpperCase() + '.';
            var newid = data[item].EmployeeId;
            var newimg = '<img src="../assets/upload/'+data[item].image+'" />';

            if (hasLoans == 1) {
              var loanappend = '<i class="fa fa-check" style="color:#76EE00"></i>';
              var haserr = 1;
            }else {
              var loanappend = '<i class="fa fa-times" style="color:#B22222"></i>';
              var haserr = 0;
            }
            $('#empinformation').find(loan_id).html(loanappend);
            $('#empinformation').find(name_id).html(newname);
            $('#empinformation').find(img_id).html(newimg);
            $('#empinformation').find(empid_id).html(newid);
            if (haserr == 0) {
              $('#empinformation').find(btn_id).html('<button type="button" name="upload" id="'+data[item].EmployeeId+'" class="btn btn-primary btn-sm upload"><input type="hidden" id="employeeid" value="'+data[item].EmployeeId+'"><input type="hidden" id="name" value="'+ data[item].LastName + ', ' + data[item].FirstName + ' ' + data[item].MiddleName.charAt(0) + '.' +'"><i class="fa fa-list"></i></button>');
            }else {
              $('#empinformation').find(btn_id).html('<button type="button" name="upload" id="'+data[item].EmployeeId+'" class="btn btn-primary btn-sm upload" disabled><input type="hidden" id="employeeid" value="'+data[item].EmployeeId+'"><input type="hidden" id="name" value="'+ data[item].LastName + ', ' + data[item].FirstName + ' ' + data[item].MiddleName.charAt(0) + '.' +'"><i class="fa fa-list"></i></button>');
            }
          }
        }
      });
    }

  setInterval(function(){
    loadData();
    $('#payrollbtns').load(location.href + ' #payrollbtns');
  }, 3000);





//insert loan data
$(document).on('click', '#btnupid', function(e){
        e.preventDefault();
        var id     = $("#empid").val();
        var payrolldate = $("#payrolldateid").val();
        var hdmfamount  = $("#hdmfamountid").val();
        var sssamount   = $("#sssamountid").val();
        var otheramount = $("#otheramountid").val();
        $("#inputloansmodal").modal("hide");
        confirmModal('Confirmation', 'Insert data to '+id+'?', function(){
          $.ajax({
            url:"../functions/inputloans.php",
            method:"POST",
            data: {id: id, payrolldate: payrolldate, hdmfamount: hdmfamount, sssamount: sssamount, otheramount: otheramount},
            success:function(data)
            {
              alertModal('Result', data, function(){
                window.location.reload();
              });
              // dataTable.ajax.reload();
              // $('#loanform')[0].reset();
            }
          });
        });
    });







//show modal for loan input
    $(document).on('click', '.upload', function(){
      $('body').css('overflow','hidden')
      $("#inputloansmodal").modal("show");
      $('#nameid').val($(this).find('#name').val());
      $('#empid').val($(this).find('#employeeid').val());
      document.getElementById("payrolldateid").value = newDate();
      // $('#payrolldateid').val(newDate());
      $('.modal-title').text("Input Loans");
    });

    //exitmodal
document.onkeydown = function(evt)
        {
            evt = evt || window.event;
            if (evt.keyCode == 27)
            {
                document.getElementById('exitModal').click();
            }
        };


});
