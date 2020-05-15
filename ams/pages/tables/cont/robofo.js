
    
    var empimage = document.getElementById('emp_img');
    var btnimg = document.getElementById('btnimg');
    var caption_up = document.getElementById('caption_up');

    btnimg.addEventListener("click", function(){
        empimage.click();
    });

    empimage.addEventListener("change", function(){
        if(empimage.value){
            caption_up.innerHTML = " " + empimage.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        }else{
            caption_up.innerHTML = "Upload Image";
        }
    });




    var ed_empimage = document.getElementById('ed_emp_img');
    var ed_btnimg = document.getElementById('ed_btnimg');
    var ed_caption_up = document.getElementById('ed_caption_up');

    ed_btnimg.addEventListener("click", function(){
        ed_empimage.click();
    });

    ed_empimage.addEventListener("change", function(){
        if(ed_empimage.value){
            ed_caption_up.innerHTML = " " + ed_empimage.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        }else{
            ed_caption_up.innerHTML = "Upload Image";
        }
    });









    $(document).ready(function(){


        $(document).on('click', '.close', function(){
                $('#delete_form')[0].reset();
        });

        $(document).on('click', '.closer', function(){
                $('#delete_form')[0].reset();
        });

    $(document).on('click', '.edit-data', function(){
        var ids = $(this).attr("id");
    
        $.ajax({
            url:"./func/fetch.php",
            method:"POST",
            data:{ids:ids},
            dataType:'json',
            success:function(data)
            {
                $('#id').val(data.id);
                $('#ed_emp_id').val(data.emp_id);
                $('#ed_fname').val(data.fname); 
                $('#ed_mname').val(data.mname);
                $('#ed_lname').val(data.lname);
                $('#edit_emp').modal('show');
    
                

            }
        });
    });


 $('#update_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"./func/edit_emp.php",
            method:"POST",
            data:$('#update_form').serialize(),
          
            success:function(data)
            {
                $('#update_form')[0].reset();
                $('#edit_emp').modal('hide');
                alert("Employee's info was successfully updated");
                location.reload();
            } 
        });
    });

     // admin


    $(document).on('click', '.edit-admin', function(){
        var id_ad = $(this).attr("id");
    
        $.ajax({
            url:"./func/fetch.php",
            method:"POST",
            data:{id_ad:id_ad},
            dataType:'json',
            success:function(data)
            {
                $('#ad_id').val(data.id);
                $('#ed_ad_uname').val(data.emp_id);
                $('#ed_ad_email').val(data.email); 
              
                $('#edit_admin').modal('show');
    
                

            }
        });
    });

   

 $('#update_admin').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"./func/edit_ad.php",
            method:"POST",
            data:$('#update_admin').serialize(),
          
            success:function(data)
            {
                $('#update_admin')[0].reset();
                $('#edit_admin').modal('hide');
                alert("Admin's info was successfully updated");
                location.reload();
            } 
        });
    });





     $(document).on('click', '.delete-data', function(){
        var delete_data = $(this).attr("id");
      
        $.ajax({
            url:"./func/fetch.php",
            method:"POST",
            data:{delete_data:delete_data},
            dataType:'json',
            success:function(data)
            {
               
                $('#del_id').val(data.id);
                // $('#del_emp_img_id').val(data.img);
                $('#del_emp_id').html(data.emp_id);
                $('#del_fname').html(data.fname);
                $('#del_mname').html(data.mname);
                $('#del_lname').html(data.lname);
                $('#delete_emp').modal('show');
    
            }
        });
     
    });




       $('#delete_form').on('submit', function(event){
        event.preventDefault();
        var pass = document.getElementById('pass');
        if(pass.value == 'wow'){
        $.ajax({
            url:"./func/del.php",
            method:"GET",
            data:$('#delete_form').serialize(),
            success:function(data)
            {
                $('#delete_form')[0].reset();
                $('#delete_emp').modal('hide');
                alert('Employee was successfully deleted');
                location.reload();
            } 
        });
    }   

        else if(pass.value == ''){
        alert('Ask the head for password');
         }
    else{
        alert('Wrong password. You need the permission of the head on your company for providing a password');
    }
    });


  $(document).on('click', '.changes-img', function(){
        var imgs_id = $(this).attr("id");
    
        $.ajax({
            url:"./func/fetch.php",
            method:"POST",
            data:{imgs_id:imgs_id},
            dataType:'json',
            success:function(data)
            {
                $('#changes_id').val(data.id);
                
                $('#edit_img').modal('show');
    
            }
        });
    });

    
 $('#image_form').submit(function(event){
        event.preventDefault();
        var image = $('#ed_emp_img').val();
        var extention = $('#ed_emp_img').val().split('.').pop().toLowerCase();
        if(jQuery.inArray(extention, ['gif', 'png', 'jpg', 'jpeg']) == -1){
            
        
            $.ajax({
            url:"./func/changeimg.php",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            processData:false,
           
            success:function(data)
            {
                $('#image_form')[0].reset();
                $('#edit_img').modal('hide');
                alert("Employee's image was successfully changed");
                location.reload();
            } 
        });
        }else{

        $.ajax({
            url:"./func/changeimg.php",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            processData:false,
           
            success:function(data)
            {
                $('#image_form')[0].reset();
                $('#edit_img').modal('hide');
                alert("Employee's image was successfully changed");
                location.reload();
            } 
        });
    }
    });





 
    $('#add').click(function(){
        $('#add_emp').modal('show');
     
        $('#insert_form')[0].reset();
        $('#emp_img_id').val('');
   
        alert('Please fillup the Name of Employee before you proceed to Employee ID');
        
       
    });

    
    $('#insert_form').submit(function(event){
        event.preventDefault();
     
        var image = $('#emp_img').val();
       var emp_id = $('#emp_id').val();
        var fname = $('#fname').val();
        var mname = $('#mname').val();
        var lname = $('#lname').val();
        var extention = $('#emp_img').val().split('.').pop().toLowerCase();
        var empd = document.getElementById('emp_id');
        
        if(empd.value == ''){
            alert('Employee ID is required');
        }
        else{

            
          
        if(jQuery.inArray(extention, ['gif', 'png', 'jpg', 'jpeg']) == -1){
            
          
            $.ajax({
            url:"./func/ins.php",
            method:"POST",
           
            data:new FormData(this),
            contentType:false,
            processData:false,

            
                
            success:function(data)
            {
                
                if(!data){
                   
                }else{
          
                 $('#insert_form')[0].reset();
                $('#add_emp').modal('hide');
                alert(" the list of employees if the new employee was successfully inserted. If it's not inserted please try it again or you need to provide another ID");
                location.reload();

                }
           
        
    }
});
        
        }
    
        else{



        $.ajax({
            url:"./func/ins.php",
            method:"POST",
            data:new FormData(this),
            contentType:false,
            processData:false,
          
           
            success:function(data)
            {

             

                        
                        $('#insert_form')[0].reset();
                        $('#add_emp').modal('hide');
                        alert(" the list of employees if the new employee was successfully inserted. If it's not inserted please try it again or you need to provide another ID '"+emp+"'");
                        location.reload();
                 
               
                }
             
        });

        
   
    }
}
        


    });
});


