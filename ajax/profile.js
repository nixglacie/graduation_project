// //////* profile info editing *////////

$("#profile_edit").click(function () {
    $("#profile_edit_form").removeClass("none");
    $("#id03").removeClass("none");
    $("#user_profile_id").val($('#profile_edit').data("id"));
    username_city = $(".u_name ").text().split(" // ");
    $("#u_username").val(username_city[0]);
    $("#u_city").val(username_city[1]);
    description = $(".read").html();
    tinymce.get("user_profile_description").setContent(description);
})


$("#profile-edit-btn").click(function () {
    let data = new FormData(document.getElementById('profile_edit_form'));
    data.append("user_profile_description", tinymce.get("user_profile_description").getContent());
    $.ajax({
        url: "ajax/profile_edit.php",
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: yes
    })
})

function yes(response) {
    $("#notification_container").html(response);
    if (response == "<p class='notification GREEN'>Succesfully updated your profile!<script>setTimeout(hide, 5000);</script></p><br>") {
        setTimeout(() => window.location.href = "profile.php?u=" + $('#profile_edit').data("id"), 1500)
    }
}

// //////* profile buttons *////////
$(".up_down").click(function () {
    $("#profile_comments_container").removeClass("none");
    $(".allposts_pagination,.saleposts_pagination").removeClass("flex");
    $("#all_user_posts,.allposts_pagination,.saleposts_pagination").addClass("none");
    $("#sale_history").addClass("none");
    $("#purchase_history").addClass("none");
    $(".purchaseposts_pagination").addClass("none").removeClass("flex");
})

$(".all_posts").click(function () {
    $("#profile_comments_container").addClass("none");
    $(".allposts_pagination").addClass("flex");
    $("#all_user_posts,.allposts_pagination").removeClass("none");
    $("#sale_history").addClass("none");
    $("#purchase_history").addClass("none");
    $(".saleposts_pagination").removeClass("flex");
    $(".saleposts_pagination").addClass("none");
    $(".purchaseposts_pagination").addClass("none").removeClass("flex");
})

$(".sale_history").click(function(){
    $("#profile_comments_container,#all_user_posts,.allposts_pagination,#purchase_history,.purchaseposts_pagination").addClass("none");
    $(".allposts_pagination,.purchaseposts_pagination").removeClass("flex");
    $("#sale_history,.saleposts_pagination").removeClass("none");
    $(".saleposts_pagination").addClass("flex");
});

$(".purchase_history").click(function(){
    $("#profile_comments_container,#all_user_posts,.allposts_pagination,#sale_history,.saleposts_pagination").addClass("none");
    $(".allposts_pagination,.saleposts_pagination").removeClass("flex");
    $("#purchase_history").removeClass("none");
    $(".purchaseposts_pagination").removeClass("none");
    $(".purchaseposts_pagination").addClass("flex");
});



function rateThis(x) {
    $("#rating_form").removeClass("none");
    $("#id03").removeClass("none");
    $("#advert_title").text($(x).data("atitle"));
};

$("#rate-btn").click(function(){
    let adv_title=$("#advert_title").text();
    let rcomment = tinymce.get("rate_comment").getContent();
    let adc = $('input[name="adc"]:checked').val();
    let cww = $('input[name="cww"]:checked').val();
    let ra = $('input[name="ra"]:checked').val();
    let gb = $('input[name="gb"]:checked').val();
    $.post("ajax/rating_comment.php", {
        adv_title: adv_title,
        rcomment: rcomment,
        adc: adc,
        cww: cww,
        ra: ra,
        gb: gb
    }, function (response) {
        $("#notification_container").html(response);
        if (response == "<p class='notification GREEN'>Succsefully submited your rating for this advert!<script>setTimeout(hide, 5000);</script></p><br>") {
            setTimeout(() => window.location.href = "profile.php?ph=1&u=" + $('#profile_edit').data("id"), 1500)
        }
    });
});

/* url changing on button press */
/* refert to main.js */
$(".all_posts").click(function () {
    parameters = getObject(location.search);
    parameters.ap = 1;
    parameters.ph = 0;
    paramstring = getURLParametersString(parameters);
    history.replaceState(null, null, paramstring);
})

$(".up_down").click(function () {
    parameters = getObject(location.search);
    parameters.ap = 0;
    parameters.ph = 0;
    paramstring = getURLParametersString(parameters);
    history.replaceState(null, null, paramstring);
})

$(".purchase_history ").click(function () {
    parameters = getObject(location.search);
    parameters.ap = 0;
    parameters.ph = 1;
    paramstring = getURLParametersString(parameters);
    history.replaceState(null, null, paramstring);
})


$(".ap_pagination,.all_posts").click(function () {
    let offset = $(this).data("o");
    parameters = getObject(location.search);
    let uid = parameters.u;
    $.post("ajax/all_user_adverts.php?option=all_posts_pagination", {
        offset: offset,
        uid:uid
    }, function (response) {
        $("#all_user_posts").html(response);
    });
})

$(".sh_pagination,.sale_history").click(function () {
    let offset = $(this).data("o");
    $.post("ajax/all_user_adverts.php?option=sale_history_pagination", {
        offset: offset
    }, function (response) {
        $("#sale_history").html(response);
    });
})

$(".ph_pagination,.purchase_history ").click(function () {
    let offset = $(this).data("o");
    $.post("ajax/all_user_adverts.php?option=purchase_history_pagination", {
        offset: offset
    }, function (response) {
        $("#purchase_history").html(response);
    });
})