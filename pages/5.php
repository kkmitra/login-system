<?php

require "./validators/EmailVerifier.php";

$email = $_SESSION["email"] ?? '';

if(isset($_POST["submit"])) {

    $emailValidator = new EmailVerifier($_POST["email"]);

    if($emailValidator->verify()) {
        $_SESSION["email"] = $emailValidator->getEmail();
        header("Location: /index.php?q=1");
    } else {
        $GLOBALS["error"] = $emailValidator->errors;
    }




}

?>



<?php if (isset($error)): ?>
    <p class="error-msg"> <?php echo $error ?> </p>
<?php endif; ?>


<form action="/index.php?q=5" method="POST">
    <div>
        <label for="email">Email: </label>
        <input id="email" name="email" type="text"  value="<?php echo $email?>">
    </div>
    <div>
        <input type="submit" value="Submit" name="submit">
    </div>
    </div>
</form>