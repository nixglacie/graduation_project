window.addEventListener("load",function() {
    $("#bookmark").click(function(){
    
        let id = window.location.search
        id = id.slice(1, id.length).split("=")[1];
        if(id!="")
        {
            $.post("ajax/bookmarks.php?option=bookmark", {id:id}, function(response){
                $("#notification_container").html(response);
                $("#bookmarked").removeClass("none");
                $("#bookmark").addClass("none");
            })
        }
    });
    
    $("#bookmarked").click(function(){
        
        let id = window.location.search
        id = id.slice(1, id.length).split("=")[1];
        if(id!="")
        {
            $.post("ajax/bookmarks.php?option=remove_bookmark", {id:id}, function(response){
                $("#notification_container").html(response);
                $("#bookmarked").addClass("none");
                $("#bookmark").removeClass("none");
            })
        }
    
    });
    
    $("#bookmarks").click(function(){
        $.get("ajax/bookmarks_async.php", function(response){
            //$("#all_user_bookmarks").innerHTML="";
            $("#all_user_bookmarks").html(response)
        });
    })
});