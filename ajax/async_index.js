$(".read_more").click(function(){
    $("#id03").removeClass("none");
    let id = $(this).data("nid");
    $.post("ajax/async_index.php", {id:id}, function(response){
        $("#read_more_wrapper").html(response); 
    })
});