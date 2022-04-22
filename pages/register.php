<?php
include "../utils.php";

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Register</title>
</head>
<body>

<?php include "navbar.php" ?>

<div class="container">
    <div class="row">
        <div class="col">
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" name="pass" id="pass">
                </div>
                <div class="mb-3">
                    <div class="alert alert-danger" id="register_alert" style="display: none">

                    </div>
                </div>
                <button type="button" name="submit" id="register_submit" class="btn btn-primary" onclick="register_user()">Register</button>

            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="requests.js"></script>
<script>
    let button = document.getElementById("register_submit");
    let msg_alert = document.getElementById("register_alert");
    let username_element = document.getElementById("username");
    let firstname_element = document.getElementById("first_name");
    let lastname_element = document.getElementById("last_name");
    let pass_element = document.getElementById("pass");
    function register_user() {
        msg_alert.style.display = "none";

        if (username_element.value.length < 3) {
            show_alert_msg("Username should be atleast 3 characters long.");
            return;
        }

        if (pass_element.value.length < 8) {
            show_alert_msg("Password should be atleast 8 characters long.");
            return;
        }

        button.innerHTML = `<span class="fa fa-spinner fa-spin"></span> Registering`;

        let formData = new FormData();
        formData.append("username", username_element.value);
        formData.append("password", pass_element.value);
        formData.append("first_name", firstname_element.value);
        formData.append("last_name", lastname_element.value);

        post_request(
            "../forms/register_form.php",
            formData,
            (resp) => {
                console.log(resp);
                button.innerHTML = `<span class="fa fa-spinner fa-spin"></span> Redirecting`;
                window.location.href = "home.php";
            },
            (resp) => {
                show_alert_msg(resp['msg']);
            }
        )

    }

    function show_alert_msg(msg) {
        msg_alert.innerText = msg;
        msg_alert.style.display = "block";
        button.innerHTML = "Register"
    }
</script>
</body>
</html>