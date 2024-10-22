<!DOCTYPE html>
<html>
    <head>
        <title>Laragon</title>
        <style>
body {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  font-family: sans-serif;
}
h1 {
  color: coral;
}
.grid-container {
  columns: 5 200px;
  column-gap: 1.5rem;
  width: 90%;
  margin: 0 auto;
  div {
    width: 150px;
    margin: 0 1.5rem 1.5rem 0;
    display: inline-block;
    width: 100%;
    border: solid 2px black;
    padding: 5px;
    box-shadow: 5px 5px 5px rgba(0,0,0,0.5);
    border-radius: 5px;
    transition: all .25s ease-in-out;
    &:hover img {
      filter: grayscale(0);
    }
    &:hover {
      border-color: coral;
    }
    img {
      width: 100%;
      filter: grayscale(100%);
      border-radius: 5px;
      transition: all .25s ease-in-out;
    }
    p {
      margin: 5px 0;
      padding: 0;
      text-align: center;
      font-style: italic;
    }
  }
}









</style>

    </head>
    <body>
    <div class="grid-container">





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
  <div>
    <img class='grid-item grid-item-7' src='<?= $path ?>' alt=''>
    <p>"A rose for mommy!"</p>
  </div>

<?php
}


?>

        </div>
    </body>
</html>

<!--
  2. CSS Masonry Photo Gallery
CSS Galleries - CSS Masonry Photo Gallery
A masonry style photo gallery.
Author: Russ Perry (rperry1886)
Links: Source Code / Demo
Created on: January 21, 2020
Made with: HTML, SCSS
Tags: cpc-photo-gallery, codepenchallenge

https://devsnap.me/css-gallery

-->