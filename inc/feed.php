<?php
include "model/Image.php";
?>

<h2 class="registration-area">Feed</h2>

<h5>List of your images</h5>
<div id="myImages">
    <?php
    echo "<div class=\"row\">";
    $images = Image::getAllUserImages($_SESSION["user"]);
    for ($i = 0; $i < sizeof($images); $i++) {
        echo "<div class=\"col-md-6 col-lg-3 my-image\">";
        echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\">";
        $imageplace = $images[$i]["name"];
		$newimage = explode('.', $imageplace, -1);
		echo "<h6 class='text-center'>" . $newimage[0] . "</h6>";
        echo "<div class=\"img-options\">";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>"
    ?>
	<h5>List of others images</h5>
	<?php
    echo "<div class=\"row\">";
    $images = Image::getAllImages($_SESSION["user"]);
    for ($i = 0; $i < sizeof($images); $i++) {
        echo "<div class=\"col-md-6 col-lg-3 my-image\">";
        echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\">";
        $imageplace = $images[$i]["name"];
		$newimage = explode('.', $imageplace, -1);
		echo "<h6 class='text-center'>" . $newimage[0] . "</h6>";
        echo "<div class=\"img-options\">";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>"
    ?>

<h2>Feed</h2>
