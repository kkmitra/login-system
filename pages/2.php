<?php

require "./validators/FileUploader.php";

if (isset($_POST["submit"])) {

  $file_uploader = new FileUploader($_FILES["profile-pic"]);

  // TODO: file upload functionality...
  if ($file_uploader->upload()) {
    $_SESSION["image_path"] =  $file_uploader->image_path;
    header("Location: /index.php?q=3");
  } else {
    $GLOBALS["error"] = $file_uploader->errors;
  }
}

?>

<?php if (isset($error)) : ?>
  <h1><?php echo $error ?></h1>
<?php endif; ?>
<?php if (isset($_SESSION["image_path"])) : ?>
  <p>File Uploaded</p>
<?php endif  ?>

<form action="/index.php?q=2" method="POST" enctype="multipart/form-data">
  <div>
    <label for="profile-pic">Upload your profile pic: </label>
    <input type="file" name="profile-pic" id="profilePic">
  </div>
  <div>
    <input type="submit" value="Submit" name="submit">
  </div>
</form>