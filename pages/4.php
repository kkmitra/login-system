<?php
include "./validators/PhoneNumberValidator.php";

$p_n = $_SESSION["phone_no"] ?? '+91';

if(isset($_POST["submit"])) {

    $ph_validator = new PHValidator($_POST);

    if($ph_validator->validate()) {
        $_SESSION["phone_no"] = $ph_validator->getPhoneNumber();
        header("Location: /index.php?q=5");
    } else {
        $GLOBALS["error"] = $ph_validator->errors;
    }
}

?>

<?php if (isset($error)): ?>
    <p class="error-msg"> <?php echo $error ?> </p>
<?php endif; ?>

<form action="/index.php?q=4" method="POST">
    <div>
        <label for="phoneNumber">Phone No.: </label>
        <input id="phoneNumber" name="phone_no" type="text"  value="<?php echo $p_n ?>">
    </div>

    <div>
        <input type="submit" value="Submit" name="submit">
    </div>
</form>