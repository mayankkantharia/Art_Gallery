$(document).ready(function() {

    // product();

    // function product() {
    //     $.ajax({
    //         url: "action.php",
    //         method: "POST",
    //         data: { getproduct: 1 },
    //         success: function (data) {
    //             $("#get_product").html(data);
    //         }
    //     })
    // }

    $("#signup_button").click(function(event) {
        event.preventDefault();
        $.ajax({
            url: "php/signup.php",
            method: "POST",
            data: $("form").serialize(),
            success: function(data) {
                if (data == "signupsuccess") {
                    window.location.href = "final_board.php";
                }
                $("#signup_msg").html(data);
            }
        })
    })

    $("#upload_image").click(function(event) {
        event.preventDefault();
        $.ajax({
            url: "php/upload_image.php",
            method: "POST",
            data: $("form").serialize(),
            success: function(data) {
                $("#signup_msg").html(data);
            }
        })
    })

    $("#Login").click(function(event) {
        event.preventDefault();
        var email = $("#email").val();
        var pass = $("#password").val();
        $.ajax({
            url: "login.php",
            method: "POST",
            data: { userEmail: email, userPassword: pass },
            success: function(data) {
                if (data == "loginsuccess") {
                    window.location.href = "final_board.php";
                }
                $("#signup_msg").html(data);
            }
        })
    })


    page();

    function page() {
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { page: 1 },
            success: function(data) {
                $("#pageno").html(data);
            }
        })
    }

    $("body").delegate("#page", "click", function() {
        var pn = $(this).attr("page");
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { getproduct: 1, setpage: 1, pageno: pn },
            success: function(data) {
                $("#get_product").html(data);
            }
        })
    })
});


function myFunction() {
    var x = document.getElementById("confirm_password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    myFunction1();

}

function myFunction1() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}