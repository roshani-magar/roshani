<?php
include "header.php";
$insert = false;
include "includes/dbconnection.php";
if(isset($_GET["btndelete"])){


  $id=$_GET['id'];
  $sql="DELETE FROM blogs Where id='".$id."'";
  if($conn->query($sql)==TRUE)
  {
    echo "record delete successfully";
  }
  else{
    echo "Error deleting record: " .$conn->error;
  }
}


if(isset($_POST["service-button"])){
  
  $title = $_POST['service-title'];
  $description = $_POST['service-description'];

  $sql1 = "INSERT INTO `service` (`title`, `description`) VALUES ('$title', '$description')";
  $result1 = mysqli_query($conn,$sql1);
  $insert = true;
}

if($insert){

  echo '<div class="alert alert-success" role="alert">
  Data inserted successfully;
  </div>';
}

?>

<div class="section-space">
  <div class="box dashboard">
  <div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Services</button>
    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Posts</button>
    
    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
  </div>
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
    <div class="section" style="background-color:#f7f7f7;">

<div class="container">
  <h2 class="my-4">Services</h2>
  <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="service-title">
      
      <div class="form-group my-4">
        <label class="mb-2" for="description">Description</label>
        <textarea class="form-control" name="service-description" id="description"
        rows="3"></textarea>
      </div>
      
      
      <button type="submit" class="btn btn-primary" name="service-button">Submit</button>
    </div>
  </form>
</div>
</div>
    </div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
    <?php
include "includes/dbconnection.php";
$id= $title= $Excerpt= $image=""; 
if(isset($_POST["btnadd"])){
    $title=$_POST["title"];
    $Excerpt=($_POST["Excerpt"]);
    if(isset($_FILES['image'])){
        $folder='uploads/';
        $image_file=$_FILES['image']['name'];
        $file=$_FILES['image']['tmp_name'];
        $path=$folder.$image_file;
        $target_file=$folder.basename($image_file);
        
       if( move_uploaded_file($file,$target_file)){
        echo"file uploaded successfully";
        $image=$image_file;
       }
    
    $query="INSERT INTO blogs(title,Excerpt,image)
     VALUES ('$title','$Excerpt','$image')";
    if(mysqli_query($conn,$query))
    { echo "data saved";
    
    }
    else{
        echo "data save failed: " .mysqli_error($conn);
    }
    }else{
        echo "error uploading file";
    }
}else{
        echo "no file chosen for upload";
    }

 
?>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Image
            <input type="file" name="image" class="form" require>
        </label>
        <label>Title
            <input type="text" name="title" class="form">
        </label>
        <label>Excerpt
            <input type="text" name="Excerpt" class="form">
        </label>
        <button name="btnadd">Insert</button>
    </form>
    <div class="fetch">
        <table>
            <tr>
                
                <th>Image</th>
                <th>Title</th>
                <th>Excerpt</th>
                <th>Action</th>
            </tr>
            <?php
            $query=mysqli_query($conn,"SELECT * FROM blogs");
            while($row=mysqli_fetch_assoc($query))
            {
              
                echo' <tr>
                <td><img width="100px" src="uploads/'.$row['image'].'"></td>
                <td>' .$row['title'].'</td>
                <td>' .$row['Excerpt'].'</td>
                <td><a href="edit.php ?id=' .$row['id'].'"><button class="btnedit">Edit</button></a></td>
                <td>
                <form method="GET">
                <input type="hidden" name="id" value="' .$row['id'].'">
             
                <button  type ="submit" class="btndelete" name="btndelete">Delete</button>
                </form>
                </td>
                </tr>';
            }
            ?>
        </table>
    </div>
    </div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">4</div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
<?
include "includes/dbclose.php";
?>