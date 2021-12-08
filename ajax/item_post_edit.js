/* image fetch/delete/upload*/
$("#edit_post").click(function () {
    $("#id03").removeClass("none");
    $("#item_post_edit_form").removeClass("none");
    let id = window.location.search
    id = id.slice(1, id.length).split("=")[1];
    if (id != "") {
        $.post("ajax/item_post_images.php", {
            id: id
        }, function (response) {
            $("#form_images_cont").html(response);
        })
    }
    $("#ad_title").val($(".item_name").text());
    let price = $((".price_content")).text().split(',');

    $("#ad_price").val(price[0]);
    description = $("#item_desc_txt").html();
    tinymce.get("advert_description").setContent(description);

    $("#ad_city").val($("#advert_city").text());
    $("#ad_phone").val($("#advert_phone_number").text());


    $("#category").val($("#item_desc_txt").data("category_value"));

    let state = $('#advert_state').data("state_value");
    $('input[name="state"]')[state - 1].checked = true
});


function clickIMAGE(x) {
    x = x.src;
    imgname = x.split('/');
    imgname = imgname[imgname.length - 1];

    let id = window.location.search
    id = id.slice(1, id.length).split("=")[1];
    let iiname = imgname;
    $.post("ajax/item_post_images.php?option=delete", {
        id: id,
        iiname: iiname
    }, function (response) {
        $("#form_images_cont").html(response);
    });
}


$("#contact,#cntact").click(function () {
    $("#item_post_phone_num").removeClass("none");
    $("#id03").removeClass("none");
})


$(".no-btn").click(function () {
    $("#item_post_edit_form").addClass("none");
    $("#item_post_delete_form").addClass("none");
    $("#item_post_phone_num").addClass("none");
    $("#id03").addClass("none");
});

$("#delete_post").click(function () {
    $("#id03").removeClass("none");
    $("#item_post_edit_form").addClass("none");
    $("#item_post_delete_form").removeClass("none");
});


$("#ip_delete-btn").click(function () {
    let uid = $("#profile_cont").data("id");
    let id = window.location.search
    id = id.slice(1, id.length).split("=")[1];
    $.post("ajax/item_post_edit.php?option=delete", {
        id: id
    }, function (response) {
        $("#notification_container").html(response);
        if (response == "<p class='notification GREEN'>Succsefully deleted your post! You will be redirected shortly!</p><br>") {
            setTimeout(() => window.location.href = "profile.php?u=" + uid + "&ap=1", 3000)
        }
    })
});

$("#category").change(function () {
    let cid = $("#category").val();
    $.post("ajax/new_advert.php?option=grab_groups", {
        cid: cid
    }, function (response) {
        $("#adv_group").html(response)
    });
})


$("#advert_edit_sumit").click(function () {
    $(".submit_advert").attr("disabled", true);
    let title = $("#ad_title").val();
    let price = $("#ad_price").val();
    let city = $("#ad_city").val();
    let phone = $("#ad_phone").val();
    let category = $("#category").val();
    let group = $("#group").val();
    let state = $('input[name="state"]:checked').val();
    let description = tinymce.get("advert_description").getContent();
    let id = window.location.search
    id = id.slice(1, id.length).split("=")[1];
    $.post("ajax/item_post_edit.php?option=update", {
        title: title,
        price: price,
        category: category,
        group: group,
        state: state,
        description: description,
        city: city,
        phone: phone,
        id: id
    }, function (response) {
        $("#notification_container").html(response);
        $(".submit_advert").removeAttr("disabled");
        if (response == "<p class='notification GREEN'>Sucesfully edited your advert!<script>setTimeout(hide, 5000);</script></p><br>") {
            setTimeout(() => location.reload(true), 1500);
        }

    });

});


$("#user_search").keyup(function () {
    username = $("#user_search").val();
    parameters = getObject(location.search);
    let id = parameters.iid;
    $.post("ajax/item_post_edit.php?option=user_search", {
        username: username,
        id: id
    }, function (response) {
        $("#user_search_output").html(response);
    });
})

function choseUser(x) {
    $("#id03,#sell_to_form").removeClass("none");
    let username = $(x).data("username");
    let uid = $(x).data("uid")
    $("#uid").val(uid);
    $("#choseUserOutput").html("Are you sure that you want to sell this product to <b>" + username + "</b>?")
}

$("#sell_to-btn").click(function () {
    let user_id = $("#profile_cont").data("id");
    let uid=$("#uid").val();
    parameters = getObject(location.search);
    let id = parameters.iid;
    $.post("ajax/item_post_edit.php?option=sell", {
        uid: uid,
        id: id
    }, function (response) {
        $("#notification_container").html(response);
        $("#id03,#sell_to_form").addClass("none");
        if (response == "<p class='notification GREEN'>Succesfully sold this product!<script>setTimeout(hide, 5000);</script></p><br>") {
            setTimeout(() => window.location.href = "profile.php?u=" + user_id + "&ap=1", 1500)
        }
    });
});

$("#report_ad").click(function(){
    $("#report_form,#id03").removeClass("none")
})

$("#report-btn").click(function(){
    let report_type = $('input[name="state"]:checked').val();
    parameters = getObject(location.search);
    let id = parameters.iid;
    $.post("ajax/item_post_edit.php?option=report", {
        report_type: report_type,
        id: id
    }, function (response) {
        $("#id03,#sell_to_form").addClass("none");
        $("#notification_container").html(response);
    });
})


