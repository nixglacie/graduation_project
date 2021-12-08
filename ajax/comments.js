getCommentsDOWN(addClickEvent);
function addClickEvent(){
    $(".edit").click(function(){
        tinymce.get("cmnt_cont").setContent(decodeURIComponent($(this).data("content")));
        $("#cmnt_cont").val($(this).data("content"));
        $("#cmnt_id").val($(this).data("id"));

        $("#edit_form").removeClass("none");
        $("#id03").removeClass("none");

        $("#replay_form").addClass("none");
        $("#delete_form").addClass("none");
        $("#profile_edit_form").addClass("none");
    })    
    
    $(".replay").click(function(){
        $("#newcmnt_cont").val($(this).data("content"));
        $("#newcmnt_id").val($(this).data("id"));

        $("#edit_form").addClass("none");

        $("#id03").removeClass("none");
        $("#replay_form").removeClass("none");

        $("#delete_form").addClass("none");
        $("#profile_edit_form").addClass("none");
    })

    $(".delete").click(function(){
        $("#delcmnt_id").val($(this).data("id"));
        $("#edit_form").addClass("none");
        $("#replay_form").addClass("none");
        $("#profile_edit_form").addClass("none");

        $("#id03").removeClass("none");
        $("#delete_form").removeClass("none");
    })

    $(".no-btn").click(function(){
        $("#delete_form").addClass("none");
        $("#replay_form").addClass("none");
        $("#edit_form").addClass("none");
        $("#profile_edit_form").addClass("none");
        $("#id03").addClass("none");
    })

}

$("#edit-btn").click(function(){
    
    let content = tinymce.get("cmnt_cont").getContent();//.replaceAll('"','\\\"');
    let id=$("#cmnt_id").val();
    if(id!="")
    {
        $.post("ajax/comments.php?option=update", {id:id,content:content}, function(response){
            $("#notification_container").html(response);
            getCommentsDOWN(addClickEvent);
            //location.reload();
            $("#edit_form").addClass("none");
            $("#id03").addClass("none");
        })
    }

})



$("#replay-btn").click(function(){

    let content = tinymce.get("newcmnt_cont").getContent();
    let id=$("#newcmnt_id").val();
    if(id!="")
    {
        $.post("ajax/comments.php?option=insert", {id:id,content:content}, function(response){
            $("#notification_container").html(response);
            getCommentsDOWN(addClickEvent);
            //location.reload();
            $("#replay_form").addClass("none");
            $("#id03").addClass("none");
            tinymce.get("newcmnt_cont").setContent("");
        })
    }

})


$("#delete-btn").click(function(){
    let id=$("#delcmnt_id").val();
    if(id!="")
    {
        $.post("ajax/comments.php?option=delete", {id:id}, function(response){
            $("#notification_container").html(response);
            getCommentsDOWN(addClickEvent);
            //location.reload();
            $("#delete_form").addClass("none");
            $("#id03").addClass("none");
        })
    }

})

function getCommentsDOWN(callback){
    let s = window.location.search
    s = s.slice(1, s.length).split("=")[1];
    $.get("ajax/commentsDOWN.php?u="+s, function(response){
        $("#u_commentDOWN")[0].innerHTML="";
        $("#u_commentDOWN")[0].innerHTML=response;
        callback();
    });
    $.get("ajax/commentsUP.php?u="+s, function(response){
        $("#u_commentUP")[0].innerHTML="";
        $("#u_commentUP")[0].innerHTML=response;
        callback();
    });
}
