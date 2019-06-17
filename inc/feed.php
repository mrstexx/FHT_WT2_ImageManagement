<?php
include "model/Image.php";
?>
<?php
if(isset($_POST['img_del'])){
    if(isset($_POST['img_selected'])){
        foreach($_POST['img_selected'] as $sel) {
            Image::update_user_access($_SESSION['user'],$sel);
        }
    }

}
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
    </select>
</div>
<div class="row">
<div class="col-md-6 col-lg-12">
    <input type='submit' value='Sort images' name='img_sort' class='btn btn-block btn-secondary'/>
</div>
</div>
<form>

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
    
<div class="row">
<div class="col-md-6 col-lg-12">
    <input type='submit' value="Don't wanna see selected images?" name='img_del' class='btn btn-block btn-secondary'/>
</div>
</div>
	<?php
	echo "<div class=\"row\">";
    $images = Image::getAllImages($_SESSION["user"]);
    for ($i = 0; $i < sizeof($images); $i++) {
        $imageplace = $images[$i]["name"];
		$newimage = explode('.', $imageplace, -1);
		$dirpath = substr($images[$i]["directory"], 3, strlen($images[$i]["directory"]));
        echo "<div class=\"col-md-6 col-lg-3 my-image ml-5 mr-5 mt-2 registration-area\">";
        echo '<form class="form" role="" action="" method="POST">';
        echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
        echo "<a href=\"" . $dirpath . "\" data-lightbox=\"bild-1\" data-title=\"".$newimage[0]."\">";
        echo "<img id=\"" . $images[$i]["pk_bild_id"] . "\" src=\"" . $images[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images[$i]["name"] . "\"></a>";
        echo "<p class='text-center'> Das Bild wurde geschossen am " . $images[$i]["aufnahmedatum"] . "</p>";
        echo '<div class="form-group">';
        echo "<input type='checkbox' value='".$images[$i]["pk_bild_id"]."' name='img_selected[]'>";
        echo "</div>";
        echo "</div>";

    }
	
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
<div class="row">
<div class="col-md-6 col-lg-12">
    <input type='submit' value="Don't wanna selected images?" name='img_del' class='btn btn-block btn-secondary'/>
</div>
</div>
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
        echo '<div class="form-group">';
        echo "<input type='checkbox' value='".$images[$i]["pk_bild_id"]."' name='img_selected[]'>";
        echo "</div>";
        echo "</div>";
       }
   }
}
echo "</form>";
echo "</div>";
}
    ?>
</div>
<script src="js/lightbox.js"></script>
<script src="js/lightbox_option.js"></script>