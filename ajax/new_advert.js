$("#category").change(function () {
    let cid = $("#category").val();
    $.post("ajax/new_advert.php?option=grab_groups", {
        cid: cid
    }, function (response) {
        $("#adv_group").html(response)
    });
})

$(".submit_advert").click(function () {
    $(".submit_advert").attr("disabled", true);
    let title = $("#ad_title").val();
    let price = $("#ad_price").val();
    let category = $("#category").val();
    let group = $("#group").val();
    let state = $('input[name="state"]:checked').val();
    let description = tinymce.get("advert_description").getContent();
    let city = $("#ad_city").val();
    let phone = $("#ad_phone").val();
    $.post("ajax/new_advert.php?option=post_advert", {
        title: title,
        price: price,
        category: category,
        group: group,
        state: state,
        description: description,
        city: city,
        phone: phone
    }, function (response) {
        $("#notification_container").html(response);
        $(".submit_advert").removeAttr("disabled");
        if (response == "<p class='notification GREEN'>Sucesfully posted your advert!<script>setTimeout(hide, 5000);</script></p><br>") {
            window.location.href ="new_advert.php";
        }

    });

});
