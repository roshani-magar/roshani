<?php
include "includes/dbconnection.php";
$id= $title=$category=$excerpt=$image="";
if(isset($_POST["destination_button"])){
  $title=$_POST['destination_title'];
  $category=$_POST['destination_category'];
  $excerpt=isset($_POST['excerpt'])?$_POST['excerpt']:'';
  if(isset($_FILES['image'])){
  $folder='up/';
  $image_file=$_FILES['image']['name'];
 
  $images_file=$_FILES['image']['tmp_name'];
  $path=$folder.$images_file;
  $target_file=$folder.basename($images_file);
  if( move_uploaded_file($file,$target_file)){
    echo"file uploadede successfully";
    $images=$image_file;
  }
}
$query="INSERT INTO destination(title, category,Excerpt,image)
VALUES ('$title','$category',$excerpt','$image')";
    echo "data saved";
  }
else{
  echo "data save failed: " .mysqli_error($conn);
}




?>
<form action="" method="POST" enctype="multipart/form-data">
  <lable>Title:
    <input type="text" name="destination_title">
  </lable>
  <lable>Category
    <input type="text" name="destination_category">
  </lable>
  <lable>Excerpt
    <input type="text" name="excerpt">
  </lable>
  <lable>Image
    <input type="file" name="destination_image">
  </lable>
  <button name="destination_button">Insert</button>
</form>
</div>
<div class="fetch">
  <table>
    <tr>
      <th>Image</th>
      <th>Title</th>
      <th>Excerpt</th>
      <th>Category</th>
    </tr>
    <?php
    $query=mysqli_query($conn,"SELECT * FROM destination");
    while($row=mysqli_fetch_assoc($query))
    {
      echo'<tr>
      <td><img src="up/' .$row['image'].'"></td>
      <td>' .$row['title'].'</td>
      <td>' .$row['excerpt'].'</td>
      <td>' .$row['category']. '</td>
      <td><a href="edit1.php id=' .$row['id'].'"><button class="destination_button">edit</button>
<form methos="GET">
<input type="hidden" name="id" value="'.$row['id'].'">
<button type="submit" class="btndelete" name="btndelete">Delete</button>
</form>
</td>
</tr>';
    }
    ?> 
  </table>
</div>