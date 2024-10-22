<!DOCTYPE html>
<html>
    <head>
        <title>Laragon</title>
        <style>
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 180px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}
</style>

    </head>
    <body>
        <div class="container">
            <div class="content">





<?php
$arrFiles = array();
$dirPath = "./pictures";

if ($handle = opendir($dirPath)) {
  while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != ".." && is_file($dirPath . '/' . $entry)) {
          DisplayPicture($dirPath . '/' . $entry);
      }
  }
  closedir($handle);
}

function DisplayPicture($path) {

?>
<div class="gallery">
  <a target="_blank" href="<?= $path ?>">
    <img src="<?= $path ?>" alt="<?= $path ?>" width="600" height="400">
  </a>
  <div class="desc">Add a description of the image here</div>
</div>
<?php
}


?>

        </div>
    </body>
</html>