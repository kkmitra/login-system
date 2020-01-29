<?php


if (isset($_POST["register"])) {
    include "classes/Register.php";

    if ($_POST["pass_1"] != $_POST["pass_2"]) {
        echo "Password should match with confirm password...";
    } else {
        $r = new Register();
        if ($r->addUser($_POST["uname"], $_POST["pass_1"])) {
            // echo "You are welcome....";
            header("Location: index.php");
        } else {
            $GLOBALS["failed_msg"] = $r->error_msg;
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login System | Register</title>

    <link rel="stylesheet" href="main.css">
</head>

<body>
    <nav>
        <h1>
            Create your account...
        </h1>
    </nav>
    <div class="container  display-flex flex-center direction-column">
        <?php if (isset($_POST["register"]) && isset($failed_msg)) : ?>
            <p class="error-msg">
                <?php echo $failed_msg; ?>
            </p>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <div>
                <input type="text" placeholder="Username" name="uname">
            </div>
            <div>
                <input type="passoword" placeholder="password" name="pass_1">
            </div>
            <div>
                <input type="passoword" placeholder="confirm password" name="pass_2">
            </div>
            <div>
                <input type="submit" name="register">
            </div>
        </form>
        <a href="/index.php">Already have an account...</a>
    </div>
</body>

</html>