<!doctype html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  
  <title>Flammekueche.Alsace - Un site dédié à la tarte flambée</title>
  <meta name="description" content="Responsive Image Gallery">
  <meta name="author" content="Tim Wells">
  <link rel="icon" type="image/x-icon" href="favicon.jpg">
  <link rel="stylesheet" href="styles.css?v=1.0">
  <style type="text/css">
    #gallery {
    line-height:0;
    -webkit-column-count:5; /* split it into 5 columns */
    -webkit-column-gap:5px; /* give it a 5px gap between columns */
    -moz-column-count:5;
    -moz-column-gap:5px;
    column-count:5;
    column-gap:5px;
 }

 #gallery img {
    width: 100% !important;
    height: auto !important;
    margin-bottom:5px; /* to match column gap */

    filter: none;
    /* transition: filter 2s; */
 }

 @media (max-width: 1200px) {
    #gallery {
     -moz-column-count:    4;
     -webkit-column-count: 4;
     column-count:         4;
    }
 }

 @media (max-width: 1000px) {
    #gallery {
     -moz-column-count:    3;
     -webkit-column-count: 3;
     column-count:         3;
    }
 }

 @media (max-width: 800px) {
    #gallery {
     -moz-column-count:    2;
     -webkit-column-count: 2;
     column-count:         2;
    }
 }

 @media (max-width: 400px) {
    #gallery {
     -moz-column-count:    1;
     -webkit-column-count: 1;
     column-count:         1;
    }
 }

 #gallery img:hover {
    filter: grayscale(20%);
 }


 #darkbox { width:1280px; height:720px; position:absolute; top:0; left:0; background-color:#e9e9e9; overflow: hidden; text-align:center;}
.darkboximg { padding:5%; max-width: 1216px; max-height: 684px; }




    </style>
</head>
<body>
<div>
<h1>Flammekueche.Alsace</h1>
<p>Un site dédié à la tarte flambée</p>
<p>Partager des photos et éventuellement des avis sur les tartes flambées…</p>
<p>Vous pouvez également me rejoindre dans cette quête 🙂 Contactez-moi</p>
</div>
<div id="gallery">

<?php
function resize($newWidth, $targetFile, $originalFile) {

  $info = getimagesize($originalFile);
  $mime = $info['mime'];

  switch ($mime) {
          case 'image/jpeg':
                  $image_create_func = 'imagecreatefromjpeg';
                  $image_save_func = 'imagejpeg';
                  $new_image_ext = 'jpg';
                  break;

          case 'image/png':
                  $image_create_func = 'imagecreatefrompng';
                  $image_save_func = 'imagepng';
                  $new_image_ext = 'png';
                  break;

          case 'image/gif':
                  $image_create_func = 'imagecreatefromgif';
                  $image_save_func = 'imagegif';
                  $new_image_ext = 'gif';
                  break;

          default: 
                  throw new Exception('Unknown image type.');
  }

  $img = $image_create_func($originalFile);
  list($width, $height) = getimagesize($originalFile);

  $newHeight = ($height / $width) * $newWidth;
  $tmp = imagecreatetruecolor($newWidth, $newHeight);
  imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

  if (file_exists($targetFile)) {
          unlink($targetFile);
  }
  $image_save_func($tmp, "$targetFile.$new_image_ext");
}


$arrFiles = array();
$dirPath = "./pictures";

if ($handle = opendir($dirPath)) {
  while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != ".." && is_file($dirPath . '/' . $entry) && !str_ends_with($entry, 'htm') && !str_ends_with($entry, '.resized.jpg') ) {
        if (!file_exists($dirPath . '/' . $entry . ".resized.jpg")) {
          resize(500, $dirPath . '/' . $entry . ".resized", $dirPath . '/' . $entry);
        }

        DisplayPicture($dirPath . '/' . $entry . ".resized.jpg", $entry);
      }
  }
  closedir($handle);
}

function DisplayPicture($path, $fileName) {

?>
        <img src="<?= $path ?>" title="<?= $fileName ?>">

<?php
}


?>

        </div>
        
		<script>
		let darkBoxVisible = false;

    
    function httpGet(theUrl)
    {
      var xmlHttp = null;

      xmlHttp = new XMLHttpRequest();
      xmlHttp.open( "GET", theUrl, false );
      xmlHttp.send( null );
      return xmlHttp.responseText;
    }

		window.addEventListener('load', (event) => {
			let images = document.querySelectorAll("img");
			if(images !== null && images !== undefined && images.length > 0) {
				images.forEach(function(img) {
					img.addEventListener('click', (evt) => {
						showDarkbox(img.src + '.htm');
					});
				});
			}
		});

		function showDarkbox(url) {
			if(!darkBoxVisible) {
				let x = (window.innerWidth - 1280) / 2;
				let y = window.scrollY + 50;

				// Create the darkBox
				var div = document.createElement("div");
				div.id = "darkbox";
				div.innerHTML = httpGet(url);
				document.body.appendChild(div);
				let box = document.getElementById("darkbox");
				box.style.left = x.toString()+"px";
				box.style.top = y.toString()+"px";
				box.style.height = 'auto';
				box.addEventListener('click', (event) => {
					// Remove it
					let element = document.getElementById("darkbox");
					element.parentNode.removeChild(element);

					darkBoxVisible = false;
				})

				darkBoxVisible = true;

			} else {
				// Remove it
				let element = document.getElementById("darkbox");
				element.parentNode.removeChild(element);

				darkBoxVisible = false;
			}
		}
		</script>
    
    </body>
</html>
