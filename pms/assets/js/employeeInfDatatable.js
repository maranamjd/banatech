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


  //fetch data for employee profile table
  var dataTable = $('#user_data').DataTable({
    "processing":false,
    'responsive': true,
    'liveAjax': true,
    "serverSide":true,
    "order": [2, 'ASC'],
    "ajax":{
      url:"../functions/fetch.php",
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

  function loadData(){
    $.ajax({
      url: '../functions/fetch_2.php',
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

          var newname = data[item].LastName + ', ' + data[item].FirstName + ' ' + data[item].MiddleName.charAt(0).toUpperCase() + '.';
          var newid = data[item].EmployeeId;
          var newimg = '<img src="../assets/upload/'+data[item].image+'" />';


          $('#user_data').find(name_id).html(newname);
          $('#user_data').find(img_id).html(newimg);
          $('#user_data').find(empid_id).html(newid);
          var new_btn = '<button type="button" name="upload" id="'+ data[item].EmployeeId +'" class="btn btn-primary btn-sm edit" title="view data">';
          new_btn += '<input type="hidden" id="employeeid" value="'+ data[item].EmployeeId +'">';
          new_btn += '<input type="hidden" id="firstname" value="'+ data[item].FirstName +'">';
          new_btn += '<input type="hidden" id="middlename" value="'+ data[item].MiddleName +'">';
          new_btn += '<input type="hidden" id="lastname" value="'+ data[item].LastName +'">';
          new_btn += '<input type="hidden" id="email" value="'+ data[item].Email +'">';
          new_btn += '<input type="hidden" id="businessunitid" value="'+ convert_id_to_bunit(data[item].BusinessUnitID) +'">';
          new_btn += '<input type="hidden" id="position" value="'+ data[item].Position +'">';
          new_btn += '<input type="hidden" id="usertype" value="'+ convert_id_to_usertype(data[item].UserType) +'">';
          new_btn += '<input type="hidden" id="timein" value="'+ data[item].TimeIn +'">';
          new_btn += '<input type="hidden" id="timeout" value="'+ data[item].TimeOut +'">';
          new_btn += '<input type="hidden" id="demin" value="'+ data[item].DeMinimis +'">';
          new_btn += '<input type="hidden" id="ftallow" value="'+ data[item].FoodTravelAllowance +'">';
          new_btn += '<input type="hidden" id="incentive" value="'+ data[item].Incentives +'">';
          new_btn += '<input type="hidden" id="basicpay" value="'+ data[item].BasicPay +'">';
          new_btn += '<i class="fa fa-list-alt"></i>';
          new_btn += '</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="'+ data[item].EmployeeId +'" class="btn btn-danger btn-sm delete" title="deactivate user"><i class=" fa fa-trash-o" ></i></button>';
          $('#user_data').find(btn_id).html(new_btn);
        }
      }
    });
  }
  function convert_id_to_bunit(bunit)
  {
    var value = "ASC CEBU";
    if (bunit == 2)
    value = "ASC MNL";
    else if (bunit == 3)
    value = "ATS CEBU";
    else if (bunit == 4)
    value = "ATS MNL";
    else if (bunit == 5)
    value = "DBT";
    else if (bunit == 6)
    value = "DPP";
    else if (bunit == 7)
    value = "KRYTERION";
    else if (bunit == 8)
    value = "LUNDGREENS";
    else if (bunit == 9)
    value = "SRT";
    else if (bunit == 10)
    value = "SUPPORT";
    return value;
  }

  function convert_id_to_usertype(usertype)
  {
    var value = "User-Employee";
    if (usertype == 0)
    value = "Admin-HR";
    else if (usertype == 1)
    value = "Admin-Accounting";
    return value;
  }

  setInterval(function(){
    loadData();
  }, 3000);


  //delete employee
  $(document).on('click', '.delete', function(){
    var user_id = $(this).attr("id");
    confirmModal('Confirmation', 'Deactivate this account?', function(){
      $.ajax({
        url:"../functions/delete.php",
        method:"POST",
        data:{user_id:user_id},
        success:function(data)
        {
          alertModal('Result', data, 1500, '');
          dataTable.ajax.reload();
        }
      });
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
  //update employee
  $(document).on('click', '#update', function(event){
    event.preventDefault();
    var employeeid = $('#hiddenid').val();
    var deminimis = $('#deminimis').val();
    var ftallowance = $('#ftallowance').val();
    var incentives = $('#incentives').val();
    var timein = $('#rtimein').val();
    var timeout = $('#rtimeout').val();
    var newid = $('#EmployeeId').val();
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
      $('#userModal').modal('hide');
      confirmModal('Confirmation', 'Update Employee Details?', function(){
        $.ajax({
          url:"../functions/insert.php",
          method:'POST',
          dataType: 'json',
          data:{newid: newid, employeeid : employeeid, firstname : firstname, middlename :middlename, lastname : lastname, businessunitid : businessunitid, email : email, usertype : usertype, position : position, basicpay : basicpay, timein: timein, timeout: timeout, deminimis: deminimis, ftallowance: ftallowance, incentives: incentives, operation : 'Edit'},
          success:function(data)
          {
            if (data.message == 1) {
              alertModal('Result', 'Data Updated.', 1500, '');
            }else if (data.message == 2) {
              alertModal('Result', 'Data Update Failed.', 1500, '');
            }
            if (data.rel == 1) {
              window.location.reload();
            }
            $('#user_form')[0].reset();
            dataTable.ajax.reload();
            $('#userModal').modal('hide');
          }
        });
      });
    }
    else
    {
      alert("Fields are Required");
    }
  });
});
