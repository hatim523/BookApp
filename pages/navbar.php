<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Training App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                <?php
                    if (is_user_logged_in()) {
                        echo '<a class="nav-link" href="javascript: void(0)" onclick="logout();">Logout</a>';
                    }
                    else {
                        echo '<a class="nav-link" href="register.php">Register</a>';
                    }
                ?>
            </div>

        </div>
        <?php
            if (isset($_SESSION['login_user'])) {
                echo '<span class="">Welcome ' . $_SESSION['login_user'] . '</span>';
            }
        ?>
    </div>
</nav>

<script>
    function logout() {
        console.log("logout");

        fetch('../forms/logout_form.php?logout=true')
            .then(response => response.json())
            .then((data) => {
                if (data['logout']) {
                    window.location.href = "index.php";
                }
            });
    }
</script>