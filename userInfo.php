<nav>
    <a href="index.php">
        <h1>Login System</h1>
    </a>
    <div class="links">
        <a href="userInfo.php" class="info-btn">Details...</a>
        <?php include "logout.php"; ?>
    </div>
</nav>

<?php

// include "logout.php";

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$greet_msg = "Welcome " . $_SESSION["full_name"] ?? '';
$full_name = $_SESSION["full_name"] ?? '';
$imagePath = $_SESSION["image_path"] ?? '';
$marks = $_SESSION["marks"] ?? '';
$phone_no = $_SESSION["phone_no"] ?? 'contact no: xxx xxx xxxx';
$email = $_SESSION["email"] ?? 'email: xxx@xxx.com';

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Info</title>

    <link rel="stylesheet" href="main.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
</head>

<body>
    <div class="container">
        <div class="greet-msg display-flex flex-center">
            <?php if ($imagePath != '') : ?>
                <div class="profile-pic">
                    <img src="<?php echo $imagePath ?>" alt="">
                </div>
            <?php endif; ?>
            <div class="msg-body">
                <?php if ($full_name != '') : ?>
                    <h1>Welcome</h1>
                    <p class="big"><?php echo $full_name ?></p>
                    <p class="small"><?php echo $phone_no ?></p>
                    <p class="small"><?php echo $email ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($marks != '') : ?>
            <div class="marks-section">
                <h2>Marks...</h2>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($marks as $key => $value) : ?>
                            <tr>
                                <th><?php echo ($key + 1); ?></th>
                                <td><?php echo $value["subject"]; ?></td>
                                <td><?php echo $value["marks"]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <p class="container display-flex flex-center ">Nothing to show...</p>
        <?php endif; ?>
    </div>

</body>

</html>