<?php

session_start();

if (isset($_POST["login"])) {
    include "classes/Login.php";
    $ln = new Login();

    if($ln->validate($_POST["username"], $_POST["password"]))  {
        $_SESSION["username"] = $_POST["username"];
    } else {
        $GLOBALS["failed_msg"] = "Incorrect username...";
    }
    
    // $username = "@";
    // if ($_POST["username"] == $username) {
        
    //     $_SESSION["username"] = $_POST["username"];
    // } else {
    //     $GLOBALS["failed_msg"] = "Incorrect username...";
    // }
}

?>

<title>Login System</title>

<link rel="stylesheet" href="main.css">

<?php if (isset($_SESSION["username"])) : ?>
    <nav>
        <a href="/index.php">
            <h1>Problem 7</h1>
        </a>
        <div class="links">
            <a href="userInfo.php" class="info-btn">Details...</a>
            <?php include "logout.php"; ?>
        </div>
    </nav>
    <?php


    $question_no = $_GET["q"] ?? 4;

    $questions = array(
        "pages/1.php",
        "pages/2.php",
        "pages/3.php",
        "pages/4.php",
        "pages/5.php"
    );
    ?>
    <div>
        <!-- <form action="userInfo.php" method="POST" class="info-form">
            <input type="submit" value="Get Your Info" class="info-btn">
        </form> -->

    </div>
    <div class="container display-flex flex-center direction-column">
        <?php
        if ($question_no >= 1  && $question_no <= 5) {
            include $questions[$question_no - 1];
        } else {
            echo "Invalid question number...";
        }
        ?>
    </div>
    <div class="header">
        <ul class="pager">
            <?php foreach ($questions as $key => $_) : ?>
                <li class="<?php echo (($key + 1) == $question_no) ? "active" : "" ?>">
                    <a href="<?php echo '/index.php?q=' . ($key + 1) ?>">
                        <?php echo ($key + 1) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php else : ?>
    <nav>
        <h1>Problem 7</h1>
    </nav>
    <div class="container display-flex flex-center direction-column">
        <?php if (isset($_POST["login"]) && isset($failed_msg)) : ?>
            <p class="error-msg">
                <?php echo $failed_msg ?>
            </p>
        <?php endif; ?>
        <form action="index.php" method="POST" class="login-form">
            <input type="text" placeholder="username" name="username">
            <input type="text" placeholder="username" name="password">
            <input type="submit" value="Submit" name="login">
        </form>
        <a href="/register.php">Register...</a>
    </div>
<?php endif; ?>