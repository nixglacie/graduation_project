function close_modal() {
    $("#id01").addClass("none");
    $("#id01").removeClass("flex");
    $("#id03").addClass("none");
    $("#id03").removeClass("flex");
}

function prettyIMGupload() { /* file upload big brain time */
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");

        dropZoneElement.addEventListener("click", (e) => {
            inputElement.click();
        });

        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(dropZoneElement, inputElement.files[0]);
                localStorage.imgfile = inputElement.files[0];
            }
        });

        dropZoneElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZoneElement.classList.add("drop-zone--over");
        });

        ["dragleave", "dragend"].forEach((type) => {
            dropZoneElement.addEventListener(type, (e) => {
                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        dropZoneElement.addEventListener("drop", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
            }
            for (i = 0; i < inputElement.files.length; i ++) {
                file = inputElement.files[i];
                let url = window.location.href;
                if (url.includes("advert_page.php")) { // upload on selection instantly
                    formData = new FormData();
                    formData.append("selected_img", file);
                    let id = window.location.search
                    id = id.slice(1, id.length).split("=")[1];
                    formData.append("id", id);

                    $.ajax({
                        url: 'ajax/item_post_images.php',
                        type: 'POST',
                        data: formData, // The form with the file inputs.
                        processData: false,
                        contentType: false // Using FormData, no need to process data.
                    }).done(function (response) {
                        $("#form_images_cont").html(response);
                    }).fail(function () {
                        $("#form_images_cont").html(response);
                    });
                }
            }

            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    /**
       * Updates the thumbnail on a drop zone element.
       *
       * @param {HTMLElement} dropZoneElement
       * @param {File} file
       */
    function updateThumbnail(dropZoneElement, file) {
        let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

        // First time - remove the prompt
        if (dropZoneElement.querySelector(".drop-zone__prompt")) {
            dropZoneElement.querySelector(".drop-zone__prompt").remove();
        }

        // First time - there is no thumbnail element, so lets create it
        if (! thumbnailElement) {
            thumbnailElement = document.createElement("div");
            thumbnailElement.classList.add("drop-zone__thumb");
            dropZoneElement.appendChild(thumbnailElement);
        }

        thumbnailElement.dataset.label = file.name;

        // Show thumbnail for image files
        if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            let url = window.location.href;
            if (url.includes("advert_page.php")) { // upload on selection instantly
                formData = new FormData();
                formData.append("selected_img", file);
                let id = window.location.search
                id = id.slice(1, id.length).split("=")[1];
                formData.append("id", id);

                $.ajax({
                    url: 'ajax/item_post_images.php',
                    type: 'POST',
                    data: formData, // The form with the file inputs.
                    processData: false,
                    contentType: false // Using FormData, no need to process data.
                }).done(function (response) {
                    $("#form_images_cont").html(response);
                }).fail(function () {
                    $("#form_images_cont").html(response);
                });
            }


            reader.readAsDataURL(file);
            reader.onload = () => {
                thumbnailElement.style.backgroundImage = `url('${
                    reader.result
                }')`;
            };
        } else {
            thumbnailElement.style.backgroundImage = null;
        }
    }
}

window.addEventListener("load", function () {

    
    prettyIMGupload();

    /* hides object after X seconds */
    function hide() {
        $(".notification").remove();
    }

    // prevents default form submision for every form with class .from2
    $(".form2").submit(function (e) {
        e.preventDefault();
    });


    // ///////////////////////////////////////

    $("#post_form").submit(function () {
        localStorage.qn_title = $("#qn_title").val();
        localStorage.qn_text = $("#qn_text").val();
    })

    // header //
    $("#bookmarks").click(function () {
        $("#id01").removeClass("none");
        $("#id01").addClass("flex");
    })

    // puts all parametars in array from the link
    getObject = (s) => {
        s = s.slice(1); // getting rid of '?'
        arr = s.split('&');
        let result = {};

        for (let i = 0; i < arr.length; i++) {
            let name = arr[i].split('=')[0];
            let value = arr[i].split('=')[1];
            result[name] = value;
        }
        return result;
    }
    
    getURLParametersString = (paramsObj) => {
        let s = "";
        let keys = Object.keys(paramsObj);
        let first = true;

        for (const key of keys) {
            if (first) {
                first = false;
                s = "?";
            } else 
                s += "&";
             s += key + "=" + paramsObj[key];
        }

        return s;
    }
});
