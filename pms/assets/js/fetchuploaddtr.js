$(document).ready(function(){


  $.ajax({
    url: '../functions/fetchuploaddata.php',
    type: 'post',
    dataType: 'json',
    data:{fetch: true},
    success: function(data){
      let divAppend = '';
      for (var x in data) {
        divAppend += '<div class="tab-pane fade in active">';
        divAppend +=  '<div class="panel-group" id="accordion">';
        divAppend +=    '<div class="panel panel-default col-sm-12" id="panel_'+ data[x].EmployeeId +'">';
        divAppend +=      '<div class="panel-heading">';
        divAppend +=        '<h4 class="panel-title">';
        divAppend +=        '<img src="../assets/upload/'+ data[x].Image +'" />';
        divAppend +=        '<a data-toggle="collapse" id="show" data-parent="#accordion" href="#collapse'+ data[x].EmployeeId +'"> '+ data[x].EmployeeId +' | '+ data[x].LastName + ', ' + data[x].FirstName + '</a>';
        divAppend +=        '<div class="pull-right col-sm-6 col-md-1" style="padding: 0 0;">';
        divAppend +=          '<button name="'+ data[x].EmployeeId +'_submit" class="btn btn-primary process_dtr" data-id='+ data[x].EmployeeId +'>Process</button>';
        divAppend +=          '</label>';
        divAppend +=        '</div>';
        divAppend +=        '</h4>';
        divAppend +=      '</div>';
        divAppend +=    '</div>';
        divAppend += '</div>';
        divAppend += '</div>';
      }
      $('#tab-content').html(divAppend);
    }
  });


});
