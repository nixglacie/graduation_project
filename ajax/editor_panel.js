$(".categorys").click(function(){
    $("#cat_id").val($(this).data("id"));
})

$("#grp_submit").click(function(){
    let cid=$("#cat_id").val();
    let gname=$("#grp_name").val();
    $.post("ajax/editor_panel.php?option=add_grp", {cid:cid,gname:gname}, function(response){
        $("#group_output").html(response)
    });
})


$("#qn_sumbit").click(function () {
    let data = new FormData(document.getElementById('post_form'));
    data.append("qn_text", tinymce.get("qn_text").getContent());
    $.ajax({
        url: "ajax/editor_panel.php?option=qn_post",
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: yes
    })
})

$(".p_edit").click(function () {
    let id = $(this).data("nid");
    $.post("ajax/async_index.php", {id:id}, function(response){
        $("#read_more_wrapper").html(response);
        content = $(".cntent").html();
        tinymce.get("qn_text").setContent(content);
        $("#qn_title").val($(".ttle").text());
        $("#qn_id").val(id); 
    })
});

function yes(response) {
    let r=JSON.parse(response);
    if(r.error){
       $("#notification_container").html(r.error); 
    }
    else if (r.success){
        $("#notification_container").html(r.success);
        console.log("triggered");
        tinymce.get("qn_text").setContent("");
        $("#qn_title").val("");
        $("#qn_id").val(""); 
    }
}

$(".rerpot_data").click(function(){
    let iid = $(this).data("rid");
    $.post("ajax/editor_panel.php?option=report_handle", {iid:iid}, function(response){
        $("#reports_queue").html(response);
    })
})
