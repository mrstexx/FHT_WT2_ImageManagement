<?php
include "model/Image.php";
?>
<div class="container col-md-12">
<h3 class="mt-5 mb-5 ml-5">List of your images</h5>

<div id="myImages">
    <?php
	echo "<div class=\"row\">";
    $images = Image::getAllUserImages($_SESSION["user"]);
    for ($i = 0; $i < sizeof($images); $i++) {
        $imageplace = $images[$i]["name"];
		$newimage = explode('.', $imageplace, -1);
		echo "<div class=\"col-md-6 col-lg-3 my-image ml-5 mr-5 mt-2 registration-area\">";
		echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
        echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\">";
		echo "<p class='text-center'> Das Bild wurde geschossen am " . $images[$i]["aufnahmedatum"] . "</p>";
		echo "</div>";
    }
    echo "</div>"
    ?>
	<h3 class="mt-5 mb-5 ml-5">List of others images</h5>
	<?php
	echo "<div class=\"row\">";
    $images = Image::getAllImages($_SESSION["user"]);
    for ($i = 0; $i < sizeof($images); $i++) {
        $imageplace = $images[$i]["name"];
		$newimage = explode('.', $imageplace, -1);
		echo "<div class=\"col-md-6 col-lg-3 my-image ml-4 mr-4 mt-2 mb-3 registration-area\">";
        echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
		echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\">";
		echo "<p class='text-center'> Das Bild wurde geschossen am " . $images[$i]["aufnahmedatum"] . "</p>";
        echo "<div class=\"img-options\">";
        echo "</div>";

    }
	echo "</div>";
    echo "</div>";
    ?>
</div>
</div>