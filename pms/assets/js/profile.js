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
      $('body').css('overflow','hidden');
      $('#modalAlert').modal('show');
      setTimeout(function () {
        $('#modalAlert').modal('hide');
        if (cb != '') {
          cb();
        }
      }, 2500);
    }

setTimeout(function () {
  $('#alert').hide('400', 'linear');
}, 3500);

//showpass toggle
$(document).on('click', '#showpasstoggle', function(){
  if ($('#showpass').is(':checked')) {
    $('#showpass').prop('checked', false);
    $('#password').attr('type', 'password');
  }
  else {
    $('#showpass').prop('checked', true);
    $('#password').attr('type', 'text');
  }
});
$(document).on('click', '#showpass', function(){
  if ($('#showpass').is(':checked')) {
  $('#showpass').prop('checked', true);
  $('#password').attr('type', 'text');
  }
  else {
    $('#showpass').prop('checked', false);
    $('#password').attr('type', 'password');
  }
});


//modal check empid jquery
    $(document).on("keyup change", "#empid", function(){
      var empid = $("#empid").val();
      if (empid == "")
        document.getElementById("notifid").style.display = "none";
      else
        $.ajax({
             data: {empid:empid},
             type: "post",
             dataType: 'json',
             url: "functions/forgotpass.php",
             cache: false,
             success: function(data){
                  if( data[0] == "Not Found" ) {
                    document.getElementById("notifid").style.display = "block";
                    document.getElementById("btnforgotid").disabled = "true";
                  }
                  else{
                    document.getElementById("notifid").style.display = "none";
                    document.getElementById("btnforgotid").disabled = "";
                    $('#hash').val(data[1]);
                  }
             }
        });
    });


$(document).on('submit', '#reset', function(e){
  e.preventDefault();
  var id = $('#id').val();
  var newpass = $('#newpass').val();
  var confirmpass = $('#confirmpass').val();
  confirmModal('Confirmation', 'Reset Password?', function(){
    $.ajax({
      url: '../../../functions/reset.php',
      type: 'post',
      data: {id: id, newpass: newpass, confirmpass: confirmpass},
      success: function(data){
        if (data == 1) {
          alertModal('Error', 'Passwords do not match');
        }
        else if (data == 2) {
          alertModal('Result', 'Password reset Successful', '');
          setTimeout(function(){
            location.reload();
          },1000);
        }
        else {
          alertModal('Result', 'Failed to Reset Password. Please contact administrator.', '');
        }
      }
    });
  });
});


    //send email forgot password
    $(document).on("click", "#btnforgotid", function(e){
        e.preventDefault();
        $("#forgotpasswordmodal").modal('hide');
        confirmModal('Confirmation', 'Your new password will be sent to the email address on the system. Continue?', function(){
          var empid = $("#empid").val();
          var hash = $("#hash").val();
          $("#forgotpasswordmodal").modal('hide');
          $.ajax({
            data: {empid: empid, hash: hash},
            type: "post",
            url: "functions/forgotpassemail.php",
            beforeSend: function(){
              $('#loading').modal('show');
              $('body').css('overflow', 'hidden');
            },
            complete: function(){
              $('#loading').modal('hide');
            },
            success: function(data){
              alertModal('Result', data, '');
            }
          });
        });
    });



//index modal popup
    $(document).on('click', "#forgotpassid", function(){
      $("#forgotpasswordmodal").modal('show');
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

// //document ready --end
  });
