$("#login").click(function () {
    let mail = $("#mail").val();
    let pass = $("#pass").val();
    if (mail != "" || pass != "") {
        $.post("ajax/login_register.php?option=login", {
            mail: mail,
            pass: pass
        }, function (response) {
            $("#notification_container").html(response);
            // location.reload();
            if (response == "<p class='notification GREEN'>Succsefully logged in! You will be redirected shortly!</p><br>") {
                setTimeout(() => window.location.href = "index.php", 1500)
            }
        })
    }
})

$("#register").click(function () {
    let username = $("#username").val();
    let mail = $("#email").val();
    let rmail = $("#r_email").val();
    let pass = $("#pass").val();
    let rpass = $("#r_pass").val();
    let city = $("#u_city").val();
    let phone = $("#u_phone").val();

    $.post("ajax/login_register.php?option=register", {
        username: username,
        mail: mail,
        rmail: rmail,
        pass: pass,
        rpass: rpass,
        city: city,
        phone: phone
    }, function (response) {
        $("#notification_container").html(response);
        // location.reload();
        if (response == "<p class='notification GREEN'>Succsefully Registered! You will be redirected to login page!</p><br>") {
            setTimeout(() => window.location.href = "login.php", 1500)
        }
    })

})
