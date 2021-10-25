$(document).ready(function() {

    $("#signup_button").click(function(event) {
        event.preventDefault();
        $.ajax({
            url: "signup.php",
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

    $("button[name='delete_image']").click(function(e) {
        e.preventDefault();
        var id = $(this).val();
        $.ajax({
            url: "php/action.php",
            method: "POST",
            data: {
                rid: id
            },
            success: function(data) {
                $("#card_" + id).remove();
                // alert('deleted');
            }
        });
    });

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
    });

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
    });
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