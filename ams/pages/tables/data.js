$(document).ready(function(){

    done();
    
    });
    
    
    function done(){
    
    setTimeout(function(){
    updates();
    done();        
    }, 200);
    }
    
    
    function updates(){
    
    $.getJSON('dat.php', function(data){
    
        $('thead').empty();
    
        $('thead').append("<th>Employee Number</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Time In</th><th>Date In</th><th>Time OUT</th><th>DATE OUT</th>");
    $.each(data.result, function(){
    
        $('tr').append("<td>"+this['emp_id']+"</td><td>"+this['fname']+"</td><td>"+this['mname']+"</td><td>"+this['lname']+"</td><td>"+this['time_in']+"</td><td>"+this['date_in']+"</td><td>"+this['time_out']+"</td><td>"+this['date_out']+"</td>");
    
    
    });
    
    });
    
    }