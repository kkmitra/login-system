<?php

require "./validators/UsernameValidator.php";

$first_name = $_SESSION['first_name'] ?? '';
$last_name = $_SESSION['last_name'] ?? '';
$full_name = $_SESSION['full_name'] ?? '';

if (isset($_POST["submit"])) {
  $userNameValidator = new UsernameValidator($_POST);

  if ($userNameValidator->validate()) {
    $_SESSION['first_name'] = $_POST["firstName"];
    $_SESSION['last_name'] = $_POST["lastName"];
    $_SESSION['full_name'] = $userNameValidator->getFullName();
    header("Location: /index.php?q=2");
  } else {
    $GLOBALS['error'] = $userNameValidator->errors;
  }
}

?>

<?php if (isset($_POST["submit"]) && isset($error)) : ?>
  <p class="error-msg">
    <?php echo $error ?>
  </p>
<?php endif; ?>

<form action="/index.php?q=1" method="POST">
  <div>
    <label for="firstName">First Name</label>
    <input value="<?php echo $first_name ?>" type="text" id="firstName" placeholder="enter your firstname" name="firstName">
  </div>
  <div>
    <label for="lastName">Last Name</label>
    <input value="<?php echo $last_name ?>" type="text" id="lastName" placeholder="enter your lastname" name="lastName">
  </div>
  <div>
    <label for="fullName">Full Name</label>
    <input type="text" id="fullName" disabled value="<?php echo $full_name ?>">
  </div>
  <div>
    <input type="submit" value="Submit" name="submit">
  </div>
</form>

<script>
    document.getElementById("firstName").addEventListener("keyup", function(e) {
      document.getElementById("fullName").value =
        document.getElementById("firstName").value + " " +
        document.getElementById("lastName").value
    })
    document.getElementById("lastName").addEventListener("keyup", function(e) {
      document.getElementById("fullName").value =
        document.getElementById("firstName").value + " " +
        document.getElementById("lastName").value
    })
  </script>