
<?php
require "includes/dbconnection.php";
if(isset($_GET["btndesdelete"])){


    $id=$_GET['id'];
    $sql="DELETE FROM destination Where id='".$id."'";
    if($conn->query($sql)==TRUE)
    {
      echo "record delete successfully";
    }
    else{
      echo "Error deleting record: " .$conn->error;
    }
  }
$id=$title=$excerpt=$image="";
if(isset($_POST["destination_button"])) {
    $title=$_POST['destination_title'];
    $cat_name= $_POST['select-category'];
    if($cat_name=="ktm"){
        $cat_id =  2;
    }
    $excerpt=isset($_POST['destination_excerpt'])?$_POST['destination_excerpt']:'';
    if(isset($_FILES ['image'])){
        $folder='test/';
        $image_file_name=$_FILES['image']['name'];
        $image_file_tmp=$_FILES['image']['tmp_name'];
        $path=$folder.$image_file_name;
        $target_file=$folder.basename(($image_file_name));
        if(move_uploaded_file($image_file_tmp,$target_file)){
            echo "file uploaded successfully";
            $image=$image_file_name;
        }
    }
    $query="INSERT INTO destination(title,excerpt,des_cat_id,image) VALUES ('$title' ,'$excerpt','$cat_id' ,'$image')";
    if(mysqli_query($conn,$query)){

        echo "data saved";
    }
}
else{
    echo "data save failed: " .mysqli_error($conn);
}

?>
<?php
if(isset($_POST['category-button'])){
    $category_name= $_POST['category-name'];
    $query="INSERT INTO category(category_title) VALUES ('$category_name')";
    if(mysqli_query($conn,$query)){

        echo "data saved";
    }
}
else{
    echo "data save failed: " .mysqli_error($conn);

}


?>
<form method= "POST" style="margin-bottom:100px;">
<label>Category name</label><br>
<input type="text" name="category-name"><br>
<input type="submit" name="category-button" value="submit">
</form>

<form method="POST" enctype="multipart/form-data">
    <label>Title:
        <input type="text" name="destination_title">
    </label>
    <label>
        Excerpt:
        <input type="text" name="destination_excerpt">
    </label>
    <label>
        Category:
        <select name="select-category">
            <option value="" name="ktm">ktm</option>
            <option value="" name="pkr">pkr</option>
    <label>
        image:
        <input type="file" name="image">
    </label>

    <button name="destination_button">Insert</button>
</form>
<div class="fetch">
    <table>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Category</th>
            <th>Excerpt</th>
            <th>Action</th>
        </tr>
        <?php
        $query=mysqli_query($conn,"SELECT * FROM destination");
        while($row=mysqli_fetch_assoc($query))
        {
            echo '<tr>
            <td><img src="test/' . $row['image'] . '"></td>
            <td>' .$row['title'].'</td>
            <td>' .$row['des_cat_id'].'</td>
            <td> '.$row['excerpt'].'</td>
            <td> <a href="editdes.php ?id=' .$row['id'].'"<button class="btndesedit">EDIT</button>
            <td>
            <form method="GET">
            <input type="hidden" name="id" value="'.$row['id'].'">
            <button type="submit" class="btndelete" name="btndesdelete">Delete</button>
            </form>
            </td>
            </tr> ';
        }
        ?>
    </table>
</div>
<?php
include "includes/dbclose.php"
?>
