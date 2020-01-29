<?php

if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if(isset($_POST["logout"])) {
    session_unset();
    session_destroy();
}

?>

<?php if (isset($_SESSION["username"])): ?>
    <form action="logout.php" method="POST">
        <input type="submit" value="Logout" name="logout"  class="logout-btn">
    </form>   
<?php else: ?>
    <?php header("Location: index.php"); ?>
<?php endif; ?>