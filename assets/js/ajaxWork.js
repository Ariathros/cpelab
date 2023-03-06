function dashboard(){  
    $.ajax({
        url:"../student/student-dashboard.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function student_room(){  
    $.ajax({
        url:"../student/student-room.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function student_equipment(){  
    $.ajax({
        url:"../student/student-equipment.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function reserve(){  
    $.ajax({
        url:"../student/reserve.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}