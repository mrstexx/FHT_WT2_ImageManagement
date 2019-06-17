<?php
include "model/Image.php";
?>
<?php
$sort = false;
$sort_type;
    if(isset($_POST['img_sort'])){
        if(isset($_POST['sort_value'])){
            $sort = true;
            $sort_type = $_POST['sort_value'];
        }
        else{
            echo 'Please choose a sorting criteria first';
        }
    }
?>
<div class="container col-md-12">
<h3 class="mt-5 mb-5 ml-5">List of your images</h5>
<div>
<form class="form" role="" action="" method="POST">
<div class="form-group">
    <label for="exampleFormControlSelect1">Sort images by..</label>
    <select name="sort_value" class="form-control" id="exampleFormControlSelect1">
    <option value="img_date">Date (default)</option>
      <option value="img_name">Name</option>
      <option value="geo_pos">Geo postition</option>
    </select>
</div>
<div class="form-group">
    <input type='submit' value='Sort images' name='img_sort' class='acc_btn btn btn-secondary'/>
</div>
</div>
<form>
<div id="myImages">

    <?php
    if($sort == false || ($sort == true && $sort_type=="img_date")){
        echo "<div class=\"row\">";
    $images = Image::getAllUserImages($_SESSION["user"]);
    for ($i = 0; $i < sizeof($images); $i++) {
        $imageplace = $images[$i]["name"];
        $newimage = explode('.', $imageplace, -1);
        $dirpath = substr($images[$i]["directory"], 3, strlen($images[$i]["directory"]));
		echo "<div class=\"col-md-6 col-lg-3 my-image ml-5 mr-5 mt-2 registration-area\">";
        echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
        echo "<a href=\"" . $dirpath . "\" data-lightbox=\"bild-1\" data-title=\"".$newimage[0]."\">";
        echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\"></a>";
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
		$dirpath = substr($images[$i]["directory"], 3, strlen($images[$i]["directory"]));
		echo "<div class=\"col-md-6 col-lg-3 my-image ml-5 mr-5 mt-2 registration-area\">";
        echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
        echo "<a href=\"" . $dirpath . "\" data-lightbox=\"bild-1\" data-title=\"".$newimage[0]."\">";
        echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\"></a>";
		echo "<p class='text-center'> Das Bild wurde geschossen am " . $images[$i]["aufnahmedatum"] . "</p>";
		echo "</div>";

    }
	echo "</div>";
    echo "</div>";
}
//sort by image name
else if($sort_type == 'img_name'){
    $img_names = array();
    echo "<div class=\"row\">";
    $images = Image::getAllUserImages($_SESSION["user"]);
    for ($i = 0; $i < sizeof($images); $i++) {
        $imageplace = $images[$i]["name"];
        $newimage = explode('.', $imageplace, -1);
        $img_names[] = $newimage[0];
    }
    sort($img_names);
    for ($j = 0; $j < sizeof($img_names); $j++) {
    for ($i = 0; $i < sizeof($images); $i++) {
        $imageplace = $images[$i]["name"];
        $newimage = explode('.', $imageplace, -1);
        if($img_names[$j] == $newimage[0]){
            $dirpath = substr($images[$i]["directory"], 3, strlen($images[$i]["directory"]));
            echo "<div class=\"col-md-6 col-lg-3 my-image ml-5 mr-5 mt-2 registration-area\">";
            echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
            echo "<a href=\"" . $dirpath . "\" data-lightbox=\"bild-1\" data-title=\"".$newimage[0]."\">";
            echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\"></a>";
            echo "<p class='text-center'> Das Bild wurde geschossen am " . $images[$i]["aufnahmedatum"] . "</p>";
            echo "</div>";
        }
    }
}
echo "</div>";?>

<h3 class="mt-5 mb-5 ml-5">List of others images</h5>
<?php
   $img_names = array();
   echo "<div class=\"row\">";
   $images = Image::getAllImages($_SESSION["user"]);
   for ($i = 0; $i < sizeof($images); $i++) {
       $imageplace = $images[$i]["name"];
       $newimage = explode('.', $imageplace, -1);
       $img_names[] = $newimage[0];
   }
   sort($img_names);
   for ($j = 0; $j < sizeof($img_names); $j++) {
   for ($i = 0; $i < sizeof($images); $i++) {
       $imageplace = $images[$i]["name"];
       $newimage = explode('.', $imageplace, -1);
       if($img_names[$j] == $newimage[0]){
        $dirpath = substr($images[$i]["directory"], 3, strlen($images[$i]["directory"]));
        echo "<div class=\"col-md-6 col-lg-3 my-image ml-5 mr-5 mt-2 registration-area\">";
        echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
        echo "<a href=\"" . $dirpath . "\" data-lightbox=\"bild-1\" data-title=\"".$newimage[0]."\">";
        echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\"></a>";
        echo "<p class='text-center'> Das Bild wurde geschossen am " . $images[$i]["aufnahmedatum"] . "</p>";
        echo "</div>";
       }
   }
}
echo "</div>";
}
//sort by recording date
/*
else if($sort_type == 'img_date'){
    $img_names = array();
    echo "<div class=\"row\">";
    $images = Image::getAllUserImages($_SESSION["user"]);
    
    $external = $images[0]["aufnahmedatum"];
   

// HOWEVER WE CAN INJECT THE FORMATTING WHEN WE DECODE THE DATE
$format = "Y-m-d H:i:s";
$dateobj = DateTime::createFromFormat($format, $external);

$iso_datetime = $dateobj->format(Datetime::ATOM);
echo "SUCCESS: $external EQUALS ISO-8601 $iso_datetime";
echo strtotime($external);
    
echo "</div>";?>

<h3 class="mt-5 mb-5 ml-5">List of others images</h5>
<?php
   $img_names = array();
   echo "<div class=\"row\">";
   $images = Image::getAllImages($_SESSION["user"]);
   for ($i = 0; $i < sizeof($images); $i++) {
       $imageplace = $images[$i]["name"];
       $newimage = explode('.', $imageplace, -1);
       $img_names[] = $newimage[0];
   }
   sort($img_names);
   for ($j = 0; $j < sizeof($img_names); $j++) {
   for ($i = 0; $i < sizeof($images); $i++) {
       $imageplace = $images[$i]["name"];
       $newimage = explode('.', $imageplace, -1);
       if($img_names[$j] == $newimage[0]){
       echo "<div class=\"col-md-6 col-lg-3 my-image ml-5 mr-5 mt-2 registration-area\">";
       echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
       echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\">";
       echo "<p class='text-center'> Das Bild wurde geschossen am " . $images[$i]["aufnahmedatum"] . "</p>";
       echo "</div>";
       }
   }
}
echo "</div>";
}
*/
//to implement
else if($sort_type == "geo_pos"){

}
    ?>
</div>
<script src="js/lightbox.js"></script>
<script src="js/lightbox_option.js"></script>