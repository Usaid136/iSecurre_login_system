<?php
//connecting database
include "partials/_config.php";

//define the variable before usage
$showAlert = false;
$showErr = false;

//inserting record
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    // $exists = false;

    //Check whether username exists
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
        // $exists = true;
        $showErr = "Username already exists.";
    } else {
        // $exists = false;

        if (($password == $cpassword)) {
            //Storing Password in hash form
            $hash = password_hash($password,PASSWORD_DEFAULT);

            $sql = "INSERT INTO `users` (`username`, `password`, `date`) VALUES ('$username','$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            }

        } else {
            $showErr = "Passwords do not matched.";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iSecure | Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    //inluding navbar file
    require 'partials/_nav.php';
    ?>

    <!-- bs5 alert -->
    <?php
    if ($showAlert) {
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>Success!</strong> Your account is now created & you can login.
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <a href="Login.php">
        <button class="btn ms-3 btn-primary">Login</button></a>
        ';
    }
    if ($showErr) {
        echo '
         <div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
               <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
             </svg>
             <div>
               <strong>Error!</strong> ' . $showErr . '
             </div>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
        ';
    }
    ?>
    <!-- Container -->
    <div class="container my-4">
        <!-- Heading -->
        <h1 class="text-center">
            Signup to our website
        </h1>
        <!-- //SignUp form -->
        <form action="/iSecure_Login_System/SignUp.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="11" placeholder="Enter Username (Maximum 11 Characters)" required
                    class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="15" required placeholder="Enter Your Password (Maximum 15 Characters)"
                    class="form-control" name="password" id="password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="15" required placeholder="Confirm Your Password" class="form-control"
                    name="cpassword" id="cpassword">
                <div id="emailHelp" class="form-text">Make sure to type same password.</div>

            </div>
            <button type="submit" class="btn btn-primary col-md-6">Signup</button>
            <a href="Login.php" style="text-decoration: none;" class="my-3">Already have an account? Login</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK"
        crossorigin="anonymous"></script>
</body>

</html>