<?php
include "model/Image.php";
?>
<?php
$tag_filter = false;
$filter_tags = array();
if(isset($_POST['filter_tags'])){
    if(isset($_POST['tag_selected'])){
        $tag_filter = true;
        foreach($_POST['tag_selected'] as $tag) {
        $filter_tags [] = $tag;
    }
    }
    else{
        echo "please select tags first";
    }
}
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
<div id="table_div" style="overflow-x:auto;">
<form class="form" role="" action="" method="POST"> 
<div id="heading_table">
<h3>Filter by tags </h3>
	<input type='submit' value='Filter' name='filter_tags' class='acc_btn btn btn-secondary'/>
</div>
<table id="tag_table" class="table_tags col-sm-12 col-md-6 col-lg-6">
    <tr>
        <th id>#</th>
		<th> Select Tag </th>
    </tr>
<?php
    $tags = Image::get_all_tags();
    foreach($tags as $tag){
        echo '<tr>';
        echo '<td>'.$tag.'</td>';
        echo "<td><input type='checkbox' value='".$tag."' name='tag_selected[]'></td>";
        echo '</tr>';
    }
?>
</table>
</form>
</div>
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
</form>

    <?php
    if($tag_filter == false){
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
    }
    //get all images by filtered tags
    else{
        echo "<div class=\"row\">";
        $images_unique = array();
        $images_with_tag = Image::user_images_with_tag($_SESSION["user"]);
        for ($i = 0; $i < sizeof($images_with_tag); $i++) {
            
            if(in_array($images_with_tag[$i]["tag"],$filter_tags)){
                if(!in_array($images_with_tag[$i]["pk_bild_id"], $images_unique)){
            $images_unique[] = $images_with_tag[$i]["pk_bild_id"];
            $imageplace = $images_with_tag[$i]["name"];
            $newimage = explode('.', $imageplace, -1);
            $dirpath = substr($images_with_tag[$i]["directory"], 3, strlen($images_with_tag[$i]["directory"]));
            echo "<div class=\"col-md-6 col-lg-3 my-image ml-5 mr-5 mt-2 registration-area\">";
            echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
            echo "<a href=\"" . $dirpath . "\" data-lightbox=\"bild-1\" data-title=\"".$newimage[0]."\">";
            echo "<img id=\"" . $images_with_tag[$i]["pk_bild_id"] . "\" src=\"" . $images_with_tag[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images_with_tag[$i]["name"] . "\"></a>";
            echo "<p class='text-center'> Das Bild wurde geschossen am " . $images_with_tag[$i]["aufnahmedatum"] . "</p>";
            echo "<p class='text-center'>#".$images_with_tag[$i]["tag"]. "</p>";
            echo "</div>";
            }
        }
        }
        echo "</div>"; 
        echo "<h3 class=\"mt-5 mb-5 ml-5\">List of others images</h5>";
        echo "<div class=\"row\">";
        $images_unique = array();
        $images_with_tag = Image::user_shared_images_with_tag($_SESSION["user"]);
        for ($i = 0; $i < sizeof($images_with_tag); $i++) {
            
            if(in_array($images_with_tag[$i]["tag"],$filter_tags)){
                if(!in_array($images_with_tag[$i]["pk_bild_id"], $images_unique)){
            $images_unique[] = $images_with_tag[$i]["pk_bild_id"];
            $imageplace = $images_with_tag[$i]["name"];
            $newimage = explode('.', $imageplace, -1);
            $dirpath = substr($images_with_tag[$i]["directory"], 3, strlen($images_with_tag[$i]["directory"]));
            echo "<div class=\"col-md-6 col-lg-3 my-image ml-5 mr-5 mt-2 registration-area\">";
            echo "<h6 class='text-center'> Name: " . $newimage[0] . "</h6><a href=\"#\" class=\"btn btn-primary mb-3\">Show on Map</a>";
            echo "<a href=\"" . $dirpath . "\" data-lightbox=\"bild-1\" data-title=\"".$newimage[0]."\">";
            echo "<img id=\"" . $images_with_tag[$i]["pk_bild_id"] . "\" src=\"" . $images_with_tag[$i]["thumbnail_directory"] . "\" class=\"img-fluid\" alt=\"" . $images_with_tag[$i]["name"] . "\"></a>";
            echo "<p class='text-center'> Das Bild wurde geschossen am " . $images_with_tag[$i]["aufnahmedatum"] . "</p>";
            echo "<p class='text-center'>#".$images_with_tag[$i]["tag"]. "</p>";
            echo "</div>";
            }
        }
        }
     }
    
    ?>
</div>
<script src="js/lightbox.js"></script>
<script src="js/lightbox_option.js"></script>