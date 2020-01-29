<?php
require "./validators/Parser.php";

if (isset($_SESSION["marks"])) {
    $GLOBALS["marks"] = $_SESSION["marks"];
}

if (isset($_POST["submit"])) {
    $parser = new Parser($_POST["marks"]);

    if ($parser->parse()) {
        $_SESSION["marks"] = $parser->parsed_str;
        header("Location: /index.php?q=4");
    } else {

        $GLOBALS["error"] = $parser->error;
    }
}

?>

<?php if (isset($marks)) : ?>
    <p>
        Marks uploaded....
    </p>
<?php endif; ?>




<form action="/index.php?q=3" method="POST">
    <div>
        <label>
            Enter your marks (in the format of Subject|Marks)
        </label>
        <textarea name="marks"></textarea>
    </div>
    <div>
        <input type="submit" value="Submit" name="submit">
    </div>
</form>

<br>
<br>

<?php if (isset($error)) : ?>
    <p> <?php echo $error ?> </p>
<?php endif; ?>