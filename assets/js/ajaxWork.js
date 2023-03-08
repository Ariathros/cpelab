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

function logs(){  
    $.ajax({
        url:"/cpelab/admin/admin_logs/admin-logs.php'",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

function accounts(){  
    $.ajax({
        url:"/cpelab/admin/admin_accounts/admin-accounts.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}