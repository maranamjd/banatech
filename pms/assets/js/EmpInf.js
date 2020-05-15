
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
    function alertModal(title, msg, duration = 1500, cb){
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
      }, duration);
    }

    //showpass toggle
    $(document).on('click', '#showpasstoggle', function(){
      if ($('#showpass').is(':checked')) {
        $('#showpass').prop('checked', false);
        $('#newpass').attr('type', 'password');
        $('#confirmpass').attr('type', 'password');
      }
      else {
        $('#showpass').prop('checked', true);
        $('#newpass').attr('type', 'text');
        $('#confirmpass').attr('type', 'text');
      }
    });
    $(document).on('click', '#showpass', function(){
      if ($('#showpass').is(':checked')) {
      $('#showpass').prop('checked', true);
      $('#newpass').attr('type', 'text');
      $('#confirmpass').attr('type', 'text');
      }
      else {
        $('#showpass').prop('checked', false);
        $('#newpass').attr('type', 'password');
        $('#confirmpass').attr('type', 'password');
      }
    });

    function showImage(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('modalBody').innerHTML += '<img src="'+ e.target.result +'" alt=" Invalid File" id="modalConfirmImage" width="180" height="180" style="margin: 0 200px"/>';
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    $('#modalConfirm').on('hidden.bs.modal', function () {
        $(this).find('#modalConfirmImage').remove();
    })
//change profile picture
$(document).on('change', '#changeprofile', function(e){
  e.preventDefault();
    var formData = new FormData();
    var input = $(this);
    formData.append('image', $(this)[0].files[0]);
    showImage(this);
     confirmModal('Confirmation', 'Change profile picture?', function(){
       $.ajax({
         url : '../functions/changeimage.php',
         type : 'POST',
         data : formData,
         processData: false,  // tell jQuery not to process the data
         contentType: false,  // tell jQuery not to set contentType
         success : function(data) {
           if(data == 1){
             alertModal('Error!', 'Invalid file.', 1500, '');
           }
           else {
             alertModal('Result', data, 1500, '');
             setTimeout(function(){
               $('#modalConfirm').modal('hide');
               window.location.reload();
             }, 1000);
           }
         }
       });
     });
     input.val('');
});

//reset payroll
$(document).on('click', '#resetpayroll', function(e){
  e.preventDefault();
  confirmModal('Confirmation', 'Are you sure you want to reset payroll?', function(){
      $.ajax({
        url: '../functions/resetpayroll.php',
        type: 'post',
        data: {reset: 'true'},
        success: function(){
          window.location.reload();
        }
      });
  });
});


//logout
$(document).on('click', '#logoutbtn', function(){
  confirmModal('Confirmation', 'Are you sure you want to logout?', function(){
      $.ajax({
        url: '../functions/logout.php',
        type: 'post',
        data: {logout: 'true'},
        success: function(){
          setTimeout(function(){
            window.location.replace('../');
          }, 1000);
        }
      });
  });
});

//change password
$(document).on('submit', '#changePassword', function(e){
  e.preventDefault();
  var newpass = $('#newpass').val();
  var confirmpass = $('#confirmpass').val();
  confirmModal('Confirmation', 'Update Password?', function(){
    $.ajax({
      url: '../functions/changepassword.php',
      type: 'POST',
      data: {newpass: newpass, confirmpass: confirmpass},
      success: function(data){
        alertModal('Result', data, 1500, '');
        $('#newpass').val('');
        $('#confirmpass').val('');
      }
    });
  });
});

//payroll report HR
  $(document).on('click', '#showpayrollreport', function(){
    $('#payrollReport').modal('show');
  });
  $('#sendPayrollreport').click(function(){
    $('#payrollReport').modal('hide');
    confirmModal('Confirmation', 'Send Payroll Report?', function(){
        $.ajax({
          url: '../functions/sendPayrollreport.php',
          type: 'post',
          data: {send: true},
          success: function(data){
            alertModal('Result', data, 1500, '');
          }
        });
    });
  });
  $('#viewPayrollreport').click(function(){
    $.ajax({
      url: '../functions/viewPayrollreport.php',
      type: 'post',
      data: {view: true},
      dataType: 'json',
      success: function(data){
        if (data.data == 0) {
          alertModal('Result', 'Error. File Not Found.', 1500, '');
        }else if(data.data == 1) {
          window.location.replace('../functions/template.php?filename=2&year='+ data.year +'&month='+ data.month +'&batch='+ data.batch);
        }else if (data.data == 2) {
          window.location.replace('../functions/template.php?filename=3&year='+ data.year +'&month='+ data.month +'&batch='+ data.batch);
        }

      }
    });
    $('#payrollReport').modal('hide');
  });


  //payroll report AC
    $(document).on('click', '#showPayrollReport', function(){
      $('#payrollReportac').modal('show');
    });
    $('#approvePayrollreportac').click(function(){
      $('#payrollReportac').modal('hide');
      confirmModal('Confirmation', 'Approve Payroll Report?', function(){
          $.ajax({
            url: '../functions/approvePayrollreport.php',
            type: 'post',
            data: {send: true},
            success: function(data){
              alertModal('Result', data, 1500, '');
            }
          });
      });
    });
    $('#viewPayrollreportac').click(function(){
      $.ajax({
        url: '../functions/viewPayrollreport.php',
        type: 'post',
        data: {view: true},
        dataType: 'json',
        success: function(data){
          if (data.data == 0) {
            alertModal('Result', 'Error. File Not Found.', 1500, '');
          }else if(data.data == 1) {
            window.location.replace('../functions/template.php?filename=2&year='+ data.year +'&month='+ data.month +'&batch='+ data.batch);
          }else if (data.data == 2) {
            window.location.replace('../functions/template.php?filename=3&year='+ data.year +'&month='+ data.month +'&batch='+ data.batch);
          }

        }
      });
      $('#payrollReportac').modal('hide');
    });

//update Profile
$(document).on('submit', '#changeProfile', function(e){
  e.preventDefault();
  confirmModal('Confirmation', 'Update Profile?', function(){
    var firstname = $('#firstName').val();
    var middlename = $('#middleName').val();
    var lastname = $('#lastName').val();
    var email = $('#email').val();
    $.ajax({
      url: '../functions/editprofile.php',
      type: 'POST',
      data: {firstname: firstname, middlename: middlename, lastname: lastname, email: email},
      success: function(data){
        $('#box-body').load(location.href + ' #box-body');
        $('#user-panel').load(location.href + ' #user-panel');
        $('#navbar-custom-menu').load(location.href + ' #navbar-custom-menu');
        alertModal('Result', data, 1500, '');
      }
    });
  });

});
$(document).on('blur', '#email', function(){
  var email = $('#email').val();
  var employeeid = $('#employeeId').val();
  $.ajax({
    url: '../functions/checkEmailId.php',
    type: 'POST',
    data: {email: email, employeeid: employeeid, textfield: 'email1'},
    success: function(data){
      if(data == 1){
        $('.employeeEmail').addClass('has-error');
        document.getElementById("btnSave").disabled = "true";
      }else {
        $('.employeeEmail').removeClass('has-error');
        document.getElementById("btnSave").disabled = "";
      }
    }
  });
});

//check passwords
$(document).on('keyup', '#newpass, #confirmpass', function(){
  var newpass = $('#newpass').val();
  var confirmpass = $('#confirmpass').val();
  if(newpass != confirmpass){
    $('.pass').addClass('has-error');
    $('.confpass').addClass('has-error');
    document.getElementById('btnSave').disabled = 'true';
  }
  else {
    $('.pass').removeClass('has-error');
    $('.confpass').removeClass('has-error');
    document.getElementById('btnSave').disabled = '';
  }
});

//check employee id and email on change
$(document).on('blur', '#EmployeeId', function(){
  var employeeid = $('#EmployeeId').val();
  var email = $('#Email').val();
  $.ajax({
    url: '../functions/checkEmailId.php',
    type: 'POST',
    data: {email: email, employeeid: employeeid, textfield: 'employeeid'},
    success: function(data){
      if(data == 'iney'){
        $('#employeeID').removeClass('has-error');
        $('#employeeEmail').addClass('has-error');
        document.getElementById("btnAdd").disabled = "true";
      }else if(data == 'iyen') {
        $('#employeeID').addClass('has-error');
        $('#employeeEmail').removeClass('has-error');
        document.getElementById("btnAdd").disabled = "true";
      }else if(data == 'iyey') {
        $('#employeeID').addClass('has-error');
          $('#employeeEmail').addClass('has-error');
        document.getElementById("btnAdd").disabled = "true";
      }else {
          $('#employeeID').removeClass('has-error');
          $('#employeeEmail').removeClass('has-error');
          document.getElementById("btnAdd").disabled = "";
      }
    }
  });
});
$(document).on('blur', '#Email', function(){
  var employeeid = $('#EmployeeId').val();
  var email = $('#Email').val();
  $.ajax({
    url: '../functions/checkEmailId.php',
    type: 'POST',
    data: {email: email, employeeid: employeeid, textfield: 'email'},
    success: function(data){
      if(data == 'iney'){
        $('#employeeID').removeClass('has-error');
        $('#employeeEmail').addClass('has-error');
        document.getElementById("btnAdd").disabled = "true";
      }else if(data == 'iyen') {
        $('#employeeID').addClass('has-error');
        $('#employeeEmail').removeClass('has-error');
        document.getElementById("btnAdd").disabled = "true";
      }else if(data == 'iyey') {
        $('#employeeID').addClass('has-error');
          $('#employeeEmail').addClass('has-error');
        document.getElementById("btnAdd").disabled = "true";
      }else {
          $('#employeeID').removeClass('has-error');
          $('#employeeEmail').removeClass('has-error');
          document.getElementById("btnAdd").disabled = "";
      }
    }
  });
});

//view dtr
$(document).on('submit', '#dtr_form', function(e){
  e.preventDefault();
  var date_from = $('#date_from').val();
  var date_to = $('#date_to').val();
  $.ajax({
    url: '../functions/checkdtr.php',
    type: 'post',
    dataType: 'json',
    data: {date_from: date_from, date_to: date_to},
    success: function(data){
      $('#loading').modal('show');
      setTimeout(function(){
        $('#loading').modal('hide');
        var tr = '';
        for (var item in data) {
          tr += '<tr><td>'+ data[item].date_in +'</td><td>'+ data[item].time_in +'</td><td>'+ data[item].time_out +'</td></tr>'
        }
        $('#dtrTb').html(tr);
        document.getElementById('dtrDiv').style.display = 'block';
      }, 1500);
    }
  });
});

//show employee details on modal on view button click
$(document).on('click', '.edit', function(){
  $('#userModal').modal('show');
  $('#EmployeeId').val($(this).find('#employeeid').val());
  $('#hiddenid').val($(this).find('#employeeid').val());
  $('#FirstName').val($(this).find('#firstname').val());
  $('#rtimein').val($(this).find('#timein').val());
  $('#rtimeout').val($(this).find('#timeout').val());
  $('#deminimis').val($(this).find('#demin').val());
  $('#ftallowance').val($(this).find('#ftallow').val());
  $('#incentives').val($(this).find('#incentive').val());
  $('#MiddleName').val($(this).find('#middlename').val());
  $('#LastName').val($(this).find('#lastname').val());
  $('#BusinessUnitID').val($(this).find('#businessunitid').val());
  $('#BasicPay').val($(this).find('#basicpay').val());
  $('#Position').val($(this).find('#position').val());
  $('#Email').val($(this).find('#email').val());
  $('#Usertype').val($(this).find('#usertype').val());
  $('.modal-title').text("Employee Details");
});

//download payslip
$(document).on('click', '#downloadpayslip', function(e){
  e.preventDefault();
  var date = $('#date').val();
  $.ajax({
    url: '../functions/getpayslip.php',
    type: 'post',
    dataType: 'json',
    data: {date: date},
    success: function(data){
      window.open('../assets/files/payslips/'+data, '_blank');
    }
  });
});


// view dtr on file change
$(document).on("click", ".process_dtr", function(e){
  e.preventDefault();
    var id = $(this).attr('data-id');
    var formData = new FormData();
    var input = $(this);
    formData.append('employeeid', id);
    formData.append('date_from', $('#date_from').val());
    formData.append('date_to', $('#date_to').val());
    $.ajax({
       url : '../functions/excelUpload.php',
       type : 'POST',
       data : formData,
       processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
       dataType:"json",
       success : function(data) {
         var divAppend = '';

         $('#loading').modal('show');
         divAppend += '<div id="collapse'+ data.dtrId +'" class="panel-collapse collapse">';
         divAppend +=   '<div class="panel-body">';
         divAppend +=     '<table class="table table-bordered talbe-striped">';
         divAppend +=       '<thead>';
         divAppend +=         '<th>Date</th>';
         divAppend +=         '<th>Time In</th>';
         divAppend +=         '<th>Time Out</th>';
         divAppend +=         '<th>Total Hours</th>';
         divAppend +=         '<th>Total Minutes</th>';
         divAppend +=         '<th>Minutes Late</th>';
         divAppend +=         '<th>Minutes Early</th>';
         divAppend +=         '<th>Minutes Undertime</th>';
         divAppend +=         '<th>Minutes Overtime</th>';
         divAppend +=       '</thead>';
         divAppend +=       '<tbody>';
         //table data
         for (var item in data.dtr) {
           divAppend +=         '<tr>';
           divAppend +=           '<td>'+ data.dtr[item].date +'</td>';
           divAppend +=           '<td>'+ data.dtr[item].in +'</td>';
           divAppend +=           '<td>'+ data.dtr[item].out +'</td>';
           divAppend +=           '<td>'+ data.dtr[item].totalHours +'</td>';
           divAppend +=           '<td>'+ data.dtr[item].totalMinutes +'</td>';
           divAppend +=           '<td>'+ data.dtr[item].late +'</td>';
           divAppend +=           '<td>'+ data.dtr[item].early +'</td>';
           divAppend +=           '<td>'+ data.dtr[item].undertime +'</td>';
           divAppend +=           '<td>'+ data.dtr[item].overtime +'</td>';
           divAppend +=         '</tr>';
         }

         divAppend +=       '</tbody>';
         divAppend +=     '</table>';
         divAppend +=     '<h5 class="text-danger">Please input corresponding data by <strong>hours</strong> if the employee have any</h5>';
         divAppend +=     '<form id="uploadDtr" action="#" name="ascLink" method="post">';
         divAppend +=       '<div class="row">';
         divAppend +=         '<div class="col-md-9">';
         divAppend +=           '<div class="form-group col-md-4">';
         divAppend +=             '<label for="totalhours">Total Hours</label><br>';
         divAppend +=             '<input type="text" id="totalhours" value="'+ data.totals.hours +'" disabled>';
         divAppend +=           '</div>';
         divAppend +=           '<div class="form-group col-md-4">';
         divAppend +=             '<label for="totalminslate">Total Minutes Late</label>';
         divAppend +=             '<input type="text" id="totalminslate" value="'+ data.totals.late +'" disabled>';
         divAppend +=           '</div>';
         divAppend +=           '<div class="form-group col-md-4">';
         divAppend +=             '<label for="totalminsundertime">Total Minutes Undertime</label>';
         divAppend +=             '<input type="text" id="totalminsundertime" value="'+ data.totals.undertime +'" disabled>';
         divAppend +=           '</div>';
         divAppend +=         '</div>';
         divAppend +=         '<div class="col-md-12">';
         divAppend +=           '<div class="form-group col-md-3">';
         divAppend +=             '<label for="absent">Absences</label><br>';
         divAppend +=             '<input type="number" id="absent" value="0">';
         divAppend +=           '</div>';
         divAppend +=           '<div class="form-group col-md-3">';
         divAppend +=             '<label for="regularovertime">Regular Day Overtime</label>';
         divAppend +=             '<input type="number" id="regularovertime" value="0">';
         divAppend +=           '</div>';
         divAppend +=           '<div class="form-group col-md-3">';
         divAppend +=             '<label for="restovertime">Rest Day Overtime</label>';
         divAppend +=             '<input type="number" id="restovertime" value="0">';
         divAppend +=           '</div>';
         divAppend +=           '<div class="form-group col-md-3">';
         divAppend +=             '<label for="nightdiff">Night Differentials</label><br>';
         divAppend +=             '<input type="number" id="nightdiff" value="0">';
         divAppend +=           '</div>';
         divAppend +=           '<div class="form-group col-md-3">';
         divAppend +=             '<label for="regholiday">Regular Holiday Pay</label><br>';
         divAppend +=             '<input type="number" id="regholiday" value="0">';
         divAppend +=           '</div>';
         divAppend +=           '<div class="form-group col-md-3">';
         divAppend +=             '<label for="specialholiday">Special Holiday Pay</label><br>';
         divAppend +=             '<input type="number" id="specialholiday" value="0">';
         divAppend +=           '</div>';
         divAppend +=         '</div>';
         divAppend +=         '<div class="col-md-9">';
         divAppend +=           '<h5 class="text-danger">Please input corresponding amount in <strong>Peso</strong> if the employee have any</h5>';
         divAppend +=           '<div class="form-group col-md-3">';
         divAppend +=             '<label for="salaryadjustments">Salary Adjustments</label><br>';
         divAppend +=             '<input type="number" id="salaryadjustments" value="0">';
         divAppend +=           '</div>';
         divAppend +=         '</div>';
         divAppend +=         '<input type="hidden" id="day" value="'+ data.payroll.day+ '">';
         divAppend +=         '<input type="hidden" id="month" value="'+ data.payroll.month +'">';
         divAppend +=         '<input type="hidden" id="year" value="'+ data.payroll.year +'">';
         divAppend +=         '<input type="hidden" id="id" value="'+ data.dtrId +'">';
         divAppend +=         '<div class="form-group col-md-12">';
         divAppend +=           '<div class="pull-right">';
         divAppend +=           '<input class="btn btn-primary" type="submit" name="upload" id="btnUpload" value="Upload Data">';
         divAppend +=         '</div>';
         divAppend +=       '</div>';
         divAppend +=     '</div>';
         divAppend +=     '</form>';
         divAppend +=   '</div>';
         divAppend += '</div>';

         setTimeout(function(){
           $('#loading').modal('hide');
           // $('#content').load(location.href + ' #content', function(){
           //   $('#collapse'+id).collapse();
           //   $('#'+tab).click();
           // });
           document.getElementById('panel_'+ data.dtrId).innerHTML += divAppend;
           $('#collapse'+id).collapse();
         }, 1500);
       }
    });
});


//upload dtr data
$(document).on('submit', '#uploadDtr', function(e){
  e.preventDefault();
  var tab = $(this).attr('name');
  var absences = $(this).find('#absent').val();
  var tardiness = $(this).find('#totalminslate').val();
  var undertime = $(this).find('#totalminsundertime').val();
  var regot = $(this).find('#regularovertime').val();
  var restot = $(this).find('#restovertime').val();
  var nightdiff = $(this).find('#nightdiff').val();
  var regholiday = $(this).find('#regholiday').val();
  var specialholiday = $(this).find('#specialholiday').val();
  var salaryadjustments = $(this).find('#salaryadjustments').val();
  var day = $(this).find('#day').val();
  var month = $(this).find('#month').val();
  var year = $(this).find('#year').val();
  var id = $(this).find('#id').val();
  if(day >= 1 && day <= 15)
    var batch = 1;
  else
    var batch = 2;
  confirmModal('Confirmation', 'Upload data to '+id+'?', function(){
    $.ajax({
      url: '../functions/uploadDtr.php',
      method: 'post',
      data: {id: id, salaryadjustments: salaryadjustments, absences: absences, tardiness: tardiness, undertime: undertime, regot: regot, restot: restot, nightdiff: nightdiff, regholiday: regholiday, specialholiday: specialholiday, year: year, month: month, batch: batch},
      success: function(data){
        alertModal('Result', data, 1500, function(){
          window.location.reload();
          $('#'+tab).click();
        });
      }
    });
  });

});

//exit modal
        document.onkeydown = function(evt)
        {
            evt = evt || window.event;
            if (evt.keyCode == 27)
            {
                document.getElementById('exitModal').click();
            }
        };


        setInterval(function(){
          getNotif();
        },3000);

        function getNotif(){
          $.ajax({
            url: '../functions/notif.php',
            type: 'post',
            dataType: 'json',
            data: {notif: true},
            success: function(data){
              var notif = '';
              var append = '';
              var unread = 0;
              if (data.length == 0) {
                notif ='<a href="#" class="list-group-item" id="notifitem" onclick="return false;"><h4 class="list-group-item-heading">No Notifications</h4></a>';
              }else {
                for (var item = data.length-1; item >= 0; item--) {
                  if (data[item].Status == 0) {
                    if (data[item].Type == 0) {
                      append = '<a href="#" class="list-group-item" id="notifitem">';
                      append += '<input type="hidden" id="notifid" value="'+ data[item].id +'">';
                      append += '<input type="hidden" id="notiftype" value="'+ data[item].Type +'">';
                      append += '<h4 class="list-group-item-heading">DTR Available</h4>';
                      append += '<p class="list-group-item-text">'+ data[item].NotifTime +'</p></a>';
                      notif += append;
                    }else if (data[item].Type == 1) {
                      append = '<a href="#" class="list-group-item" id="notifitem">';
                      append += '<input type="hidden" id="notifid" value="'+ data[item].id +'">';
                      append += '<input type="hidden" id="notiftype" value="'+ data[item].Type +'">';
                      append += '<h4 class="list-group-item-heading">Payslip Available</h4>';
                      append += '<p class="list-group-item-text">'+ data[item].NotifTime +'</p></a>';
                      notif += append;
                    }else if (data[item].Type == 2) {
                      append = '<a href="#" class="list-group-item" id="notifitem">';
                      append += '<h4 class="list-group-item-heading">Change your password</h4>';
                      append += '<input type="hidden" id="notifid" value="">';
                      append += '<input type="hidden" id="notiftype" value="'+ data[item].Type +'">';
                      append += '<p class="list-group-item-text">Password set to default. click to change..</p>';
                      append += '<p class="list-group-item-text">'+ data[item].NotifTime +'</p></a>';
                      notif += append;
                    }
                    unread++;
                  }else {
                    if (data[item].Type == 0) {
                      append = '<a href="#" class="list-group-item" onclick="return false" style="background-color: #ddd;border-radius: 10px;border: 2px outset #eee">';
                      append += '<input type="hidden" id="notifid" value="'+ data[item].id +'">';
                      append += '<input type="hidden" id="notiftype" value="'+ data[item].Type +'">';
                      append += '<h4 class="list-group-item-heading">DTR Available</h4>';
                      append += '<p class="list-group-item-text">'+ data[item].NotifTime +'</p></a>';
                      notif += append;
                    }else if (data[item].Type == 1) {
                      append = '<a href="#" class="list-group-item" onclick="return false" style="background-color: #ddd;border-radius: 10px;border: 2px outset #eee">';
                      append += '<input type="hidden" id="notifid" value="'+ data[item].id +'">';
                      append += '<input type="hidden" id="notiftype" value="'+ data[item].Type +'">';
                      append += '<h4 class="list-group-item-heading">Payslip Available</h4>';
                      append += '<p class="list-group-item-text">'+ data[item].NotifTime +'</p></a>';
                      notif += append;
                    }else if (data[item].Type == 2) {
                      append = '<a href="#" class="list-group-item" onclick="return false" style="background-color: #ddd;border-radius: 10px;border: 2px outset #eee">';
                      append += '<h4 class="list-group-item-heading">Change your password</h4>';
                      append += '<p class="list-group-item-text">Password set to default. click to change..</p>';
                      append += '<p class="list-group-item-text">'+ data[item].NotifTime +'</p></a>';
                      notif += append;
                    }
                  }
                }
              }
              document.getElementById('notification').innerHTML = notif;
              if ($('#notifnum').attr('name') == 'no' && data.length != 0 && unread != 0) {
                $('#notifnum').html(unread);
              }else {
                $('#notifnum').html('');
              }
            }
          });
        }

          $(document).on('click', '#bell', function(){
            $('#notifnum').html('');
            $('#notifnum').attr('name', 'yes');
          });

//clear notification
$(document).on('click', '#notifitem', function(){
  var notifid = $(this).find('#notifid').val();
  var notiftype = $(this).find('#notiftype').val();
  $.ajax({
     url: '../functions/removenotif.php',
     type: 'post',
     data: {notifid:notifid, accss: true},
     success: function(data){
       getNotif();
       if (data == 0) {
         if(notiftype == 0){
           window.location.replace('../mydtr-hr/');
         }else if (notiftype == 1) {
           window.location.replace('../mypayslip-hr/');
         }else if (notiftype == 2) {
           window.location.replace('../passwordchange-hr/');
         }
       }else if (data == 1) {
         if(notiftype == 0){
           window.location.replace('../mydtr-ac/');
         }else if (notiftype == 1) {
           window.location.replace('../mypayslip-ac/');
         }else if (notiftype == 2) {
           window.location.replace('../passwordchange-ac/');
         }
       }else if (data == 2) {
         if(notiftype == 0){
           window.location.replace('../mydtr/');
         }else if (notiftype == 1) {
           window.location.replace('../mypayslip/');
         }else if (notiftype == 2) {
           window.location.replace('../passwordchange/');
         }
       }
     }
   });
});

//fetch data for Bin
var dataTable = $('#user_bin').DataTable({
    "processing":false,
    "serverSide":true,
    "order":[],
    "ajax":{
        url:"../functions/fetch_bin.php",
        type:"POST",
        data:{fetch: true}
    },
    "columnDefs":[
        {
            "targets":[],
            "orderable":false,
        },
    ],

});

//activate employee
$(document).on('submit', '#user_bin_form', function(e){
  e.preventDefault();
  var id = $('#EmployeeId').val();
  var email = $('#Email').val();
  $('#userModal').modal('hide');
  confirmModal('Confirmation', 'Activate this Account?', function(){
    $.ajax({
      url:"../functions/activate.php",
      method:'POST',
      data:{employeeid: id, email: email},
      success:function(data)
      {
        alertModal('Result', data, 1500, '');
        $('#user_bin_form')[0].reset();
        dataTable.ajax.reload();
        $('#userModal').modal('hide');
      }
    });
  });
});


//add employee
    $(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        var deminimis = $('#deminimis').val();
        var ftallowance = $('#ftallowance').val();
        var incentives = $('#incentives').val();
        var timein = $('#rtimein').val();
        var timeout = $('#rtimeout').val();
        var employeeid = $('#EmployeeId').val();
        var firstname = $('#FirstName').val();
        var middlename = $('#MiddleName').val();
        var lastname  = $('#LastName').val();
        var email = $('#Email').val();
        var businessunitid  = $('#BusinessUnitID').val();
        var usertype = $('#Usertype').val();
        var position = $('#Position').val();
        var basicpay = $("#BasicPay").val();
        if(employeeid != '' && firstname != '' && middlename != '' && lastname != '' && businessunitid != '' && email != '' && usertype != '' && position != '' && basicpay != '')
        {
          confirmModal('Confirmation', 'Add new Employee?', function(){
            $.ajax({
              url:"../functions/insert.php",
              method:'POST',
              data:{employeeid : employeeid, firstname : firstname, middlename :middlename, lastname : lastname, businessunitid : businessunitid, email : email, usertype : usertype, position : position, basicpay : basicpay, timein: timein, timeout: timeout, deminimis: deminimis, ftallowance: ftallowance, incentives: incentives, operation : 'Add'},
              success:function(data)
              {
                alertModal('Result', data, 1500, '');
                $('#user_form')[0].reset();
                dataTable.ajax.reload();
              }
            });
          });
        }
        else
        {
            alertModal('Error', "Fields are Required", 1500, '');
        }
    });








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


    $(document).on('click', '.process', function(e){
      var id = $(this).attr('id');
      var date = newDate();
      $.ajax({
        url: '../functions/processpayroll.php',
        type: 'post',
        data: {id: id, date: date},
        dataType: 'json',
        success: function(data){
          if (data == 0) {
            alertModal('Result', 'DTR file not found.', 1500, '');
          }else {
            document.getElementById('EmployeeId').innerHTML = data.info.id;
            document.getElementById('name').innerHTML = data.info.name;
            document.getElementById('payoutdate').innerHTML = data.dates.payout;
            document.getElementById('basis').innerHTML = data.dates.basis;
            document.getElementById('monthly').innerHTML = data.salaryinfo.monthlyrate.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('daily').innerHTML = data.salaryinfo.dailyrate.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('hourly').innerHTML = data.salaryinfo.hourlyrate.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('netpay').innerHTML = data.salaryinfo.netpay.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('basicpay').innerHTML = data.info.basicpay.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('absences').innerHTML = data.gross.Absences.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('tardiness').innerHTML = data.gross.Tardiness.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('undertime').innerHTML = data.gross.Undertime.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('adjustments').innerHTML = data.gross.SalaryAdjustments.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('grosstaxablepay').innerHTML = data.gross.GrossPay.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('ssscontribution').innerHTML = data.contri.sss.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('philhealthcontribution').innerHTML = data.contri.philhealth.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('hdmfcontribution').innerHTML = data.contri.hdmf.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('totaldeductionsbeforetax').innerHTML = data.contri.totalcontri.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('totaltaxableincome').innerHTML = data.contri.totaltaxableincome.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('withholdingtax').innerHTML = data.tax.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('hdmfloan').innerHTML = data.loans.hdmf.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('sssloan').innerHTML = data.loans.sss.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('otherdeductions').innerHTML = data.loans.other.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('totaldeductions').innerHTML = data.loans.totalloan.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('deminimis').innerHTML = data.add.deminimis.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('allowance').innerHTML = data.add.ftallow.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('incentives').innerHTML = data.add.incentives.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            document.getElementById('total').innerHTML = data.add.totaladd.toLocaleString(undefined,{ minimumFractionDigits: 2 });
            $('#bunitid').val(data.info.bunitid);
            $('#processModal').modal('show');
          }
        }
      });
    });


    $(document).on('submit', '#processform', function(e){
      e.preventDefault();
      var formData = new FormData();
      formData.append('employeeid', $("#EmployeeId").text());
      formData.append('name', $("#name").text());
      formData.append('payoutdate', $("#payoutdate").text());
      formData.append('basis', $("#basis").text());
      formData.append('monthly', $("#monthly").text());
      formData.append('daily', $("#daily").text());
      formData.append('hourly', $("#hourly").text());
      formData.append('netpay', $("#netpay").text());
      formData.append('basicpay', $("#basicpay").text());
      formData.append('absences', $("#absences").text());
      formData.append('tardiness', $("#tardiness").text());
      formData.append('undertime', $("#undertime").text());
      formData.append('adjustments', $("#adjustments").text());
      formData.append('grosstaxablepay', $("#grosstaxablepay").text());
      formData.append('ssscontribution', $("#ssscontribution").text());
      formData.append('philhealthcontribution', $("#philhealthcontribution").text());
      formData.append('hdmfcontribution', $("#hdmfcontribution").text());
      formData.append('totaldeductionsbeforetax', $("#totaldeductionsbeforetax").text());
      formData.append('totaltaxableincome', $("#totaltaxableincome").text());
      formData.append('withholdingtax', $("#withholdingtax").text());
      formData.append('hdmfloan', $("#hdmfloan").text());
      formData.append('sssloan', $("#sssloan").text());
      formData.append('otherdeductions', $("#otherdeductions").text());
      formData.append('totaldeductions', $("#totaldeductions").text());
      formData.append('deminimis', $("#deminimis").text());
      formData.append('allowance', $("#allowance").text());
      formData.append('incentives', $("#incentives").text());
      formData.append('total', $("#total").text());
      formData.append('bunitid', $("#bunitid").val());
      $('#processModal').modal('hide');
      confirmModal('Confirmation', 'Generate Payslip?', function(){
        $.get({
          url: '../functions/generatepayslip.php',
          method: 'post',
          data: formData,
          processData: false,  // tell jQuery not to process the data
          contentType: false,  // tell jQuery not to set contentType
          // beforeSend: function(){
          //   $('#loading').modal('show');
          //   $('body').css('overflow', 'hidden');
          // },
          // complete: function(){
          //   $('#loading').modal('hide');
          // },
          success: function(data){
            alertModal('Result', data, 1500, function(){
              $('#loading').modal('hide');
              window.location.reload();
            });
          }
        });
      });

    });

    //employee upload file
    $(document).on('change', '#uploadfile', function(e){
      e.preventDefault();
      var formData = new FormData();
      formData.append('pass', true);
      formData.append('file', $(this)[0].files[0]);
      confirmModal('Confirmation', 'Upload file data?', function(){
        $.ajax({
          url : '../functions/employeeupload.php',
          type : 'POST',
          data : formData,
          processData: false,  // tell jQuery not to process the data
          contentType: false,  // tell jQuery not to set contentType
          dataType: 'json',
          beforeSend: function(){
            $('#loading').modal('show');
            $('body').css('overflow', 'hidden');
          },
          complete: function(){
            $('#loading').modal('hide');
          },
          success : function(data) {
            if (data.message == 0) {
              alertModal('Result', 'File Invalid. Please download template file by clicking the button on top right corner.', 4000, '');
              $(this).val('');
            }else {
              var success = data.success.length;
              var blank = data.blankerr.toString();
              var dataerr = data.dataerr.toString();
              $('#inserted').text(success);
              $('#blank').text(blank);
              $('#err').text(dataerr);
              alertModal('Result', 'Upload done. Showing upload results..', 1000, '');
              document.getElementById('res').style.display = 'block';
              $(this).val('');
            }
          }
        });
      });
    });

    //loan upload file
    // $(document).on('change', '#uploadloanfile', function(e){
    //   e.preventDefault();
    //   var formData = new FormData();
    //   formData.append('pass', true);
    //   formData.append('file', $(this)[0].files[0]);
    //   confirmModal('Confirmation', 'Upload file data?', function(){
    //     $.ajax({
    //       url : '../functions/loanupload.php',
    //       type : 'POST',
    //       data : formData,
    //       processData: false,  // tell jQuery not to process the data
    //       contentType: false,  // tell jQuery not to set contentType
    //       dataType: 'json',
    //       beforeSend: function(){
    //         $('#loading').modal('show');
    //         $('body').css('overflow', 'hidden');
    //       },
    //       complete: function(){
    //         $('#loading').modal('hide');
    //       },
    //       success : function(data) {
    //         if (data.message == 0) {
    //           alertModal('Result', 'File Invalid. Please download template file by clicking the button on top right corner.', 4000);
    //           $(this).val('');
    //         }else {
    //           var success = data.success.length;
    //           var blank = data.blankerr.toString();
    //           var dataerr = data.dataerr.toString();
    //           $('#inserted').text(success);
    //           $('#blank').text(blank);
    //           $('#err').text(dataerr);
    //           alertModal('Result', 'Upload done. Showing upload results..', 1000, '');
    //           document.getElementById('res').style.display = 'block';
    //           $(this).val('');
    //         }
    //       }
    //     });
    //   });
    // });

    $(document).on('click', '#downloadtemplate', function(){
      window.location.replace('../functions/template.php?filename=0');
    });
    $(document).on('click', '#downloadloantemplate', function(){
      window.location.replace('../functions/template.php?filename=1');
    });



});
