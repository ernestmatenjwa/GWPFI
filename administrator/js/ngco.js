var form = document.getElementById("reg_form")
form.addEventListener('submit', function(event){
    event.preventDefault();
        $(document).ready(function(){
            $.ajax({
                url:'register.php',
                type:'post',
                data:{names:$('#names').val(), 
                      surname:$('#surname').val(), 
                      phone:$('#phone').val(), 
                      email:$('#email').val(), 
                      key:$('#key').val(), 
                      position:$('#position').val(), 
                      password:$('#password').val(),
                      password2:$('#password2').val(),
                      gender:$('#gender').val()
                    },
                success:function(response){
                    $('#ad_member_ad').html(response);
                    alert("iyafika")
                    //window.location.href = "/login.php";
                }
            });
    });
})

function create_announcement(){
    alert("working")
    $(document).ready(function(){
        $.ajax({
            url:'create-announcement.php',
            type:'post',
            data:{
                title:$('#title').val(), 
                announcement:$('#announcement').val()
                },
            success:function(response){
                $('#ad_member_ad').html(response);
                alert("iyafika")
                //window.location.href = "/login.php";
            }
        });
});
}

function getAnnDetails(update_id){
  $('#hiddendata').val(update_id);

  $.post("edit.php", {update_id: update_id}, function(data,
    status){
        var userid=JSON.parse(data);
        $('#update_title').val(userid.an_title);
        $('#update_an').val(userid.an_Announcement)
    });
    $('#updateModal').modal("show");
}

function update_announcement(){
    
    var update_title = $('#update_title').val();
    var update_an = $('#update_an').val();

    //hidden input field
    var hiddendata = $('#hiddendata').val();

    $.post("edit.php", {
        update_title: update_title,
        update_an: update_an,
        hiddendata: hiddendata
    }, function(data, status){
        $('#updateModal').modal("hide");
    })

}