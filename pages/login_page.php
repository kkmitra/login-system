<?php if (isset($_POST["login"]) && isset($failed_msg)) : ?>
    <p class="error-msg">
        <?php echo $failed_msg ?>
    </p>
<?php endif; ?>
<form action="index.php" method="POST" class="login-form">
    <input type="text" placeholder="username" name="username">
    <input type="submit" value="Submit" name="login">
</form>

