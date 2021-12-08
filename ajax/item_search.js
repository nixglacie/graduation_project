var oflag = 0;
$("#category").change(function () {
    let cid = $("#category").val();
    $.post("ajax/new_advert.php?option=grab_groups", {
        cid: cid
    }, function (response) {
        $("#adv_group").html(response)
    });
    oflag = 0
})


$("#ad_title").keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        let title = $("#ad_title").val();
        let category = $("#category").val();
        let group = $("#group").val();
        $.post("ajax/item_search.php", {
            title: title,
            category: category,
            group: group
        }, function (response) {
            $("#search_output").html(response);
            oflag = +16

            numItems = $('div.item_container').length;
            if(numItems==16){
                $("#load_more").removeClass("none");
            }
        });
    }
})

function loadMore(){
    $(".notification").remove();
    let title = $("#ad_title").val();
    let category = $("#category").val();
    let group = $("#group").val();
    let offset = oflag;
    $.post("ajax/item_search.php", {
        title: title,
        category: category,
        group: group,
        offset: offset
    }, function (response) {
        $("#search_output").append(response);
        oflag += 16;
        numItems = $('div.item_container').length;
        if(numItems>0){
            $("#load_more").removeClass("none");
        }

        if (response == "<p class='none'>no_more</p>") {
            $("#load_more").addClass("none");
        } 
        
        if (response == "<p class='notification ORANGE' style='margin-left: auto; margin-right:auto; margin-top: 50px;'>Please select Category/Group.</p>")
        {
            $("#load_more").addClass("none");
        }
    });
};