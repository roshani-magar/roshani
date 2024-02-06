<?php
include "includes/dbconnection.php";

$id= $title= $Excerpt= $image=""; 
$id=$_GET['id']; 
if(isset($_POST["btnedit"])){
    $title=$_POST["title"];
    $Excerpt=($_POST["Excerpt"]);
    if(isset($_FILES['image'])){
        $folder='uploads/';
        $image_file=$_FILES['image']['name'];
        $file=$_FILES['image']['tmp_name'];
        $path=$folder.$image_file;
        $target_file=$folder.basename($image_file);
        if($file!=''){
            $query=mysqli_query($conn,"SELECT *FROM blogs where id=$id");
            if($row=mysqli_fetch_array($query)){
                $delimage=$row['image'];
            }
        
        unlink($folder.$delimage);
        move_uploaded_file($file,$target_file);
        $query=mysqli_query($conn,"UPDATE blogs SET image='$image_file', title='$title' ,Excerpt='$Excerpt' WHERE id='$id'");
        }else{
            $query=mysqli_query($conn,"UPDATE blogs SET  title='$title' ,Excerpt='$Excerpt' WHERE id='$id'");
        }
        if($query)
        {
            header("location:dashboard.php");
        }
    }
}
    

        
    


//     $query="INSERT INTO blogs(title,Excerpt,image)
//      VALUES ('$title','$Excerpt','$image')";
//     if(mysqli_query($conn,$query))
//     { echo "data saved";
    
//     }
//     else{
//         echo "data save failed: " .mysqli_error($conn);
//     }
//     else{
//         echo "error uploading file";
//     }
// else{
//         echo "no file chosen for upload";
//     }

// }
//     }
// }
        
 
?>
<?php
            $query=mysqli_query($conn,"SELECT * FROM blogs where id=$id");
            if($row=mysqli_fetch_array($query))
            {
                $image=$row['image'];
                $title=$row['title'];
                $Excerpt=$row['Excerpt'];
                
              
            }
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Image Preview</label>
            <img src="uploads/<?php echo $image; ?>" height="100">
            <input type="file" name="image" class="form" require>
        <label>Title
            <input type="text" name="title" class="form" value="<?php echo $title;?>">
        </label>
        <label>Excerpt
            <input type="text" name="Excerpt" class="form" value="<?php echo $Excerpt?>">
        </label>
        <button name="btnedit">Edit</button>
    </form>
    <div class="fetch">
        <!-- <table>
            <tr>
                
                <th>Image</th>
                <th>Title</th>
                <th>Excerpt</th>
            </tr> -->
            
        </table>
    </div> 
    
</body>
</html>