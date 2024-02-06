<?php
include "includes/dbconnection.php";
$id=$title=$category=$excerpt=$image="";
$id=$_GET['id'];
if(isset($_POST["btndesedit"])){
    $title=$_POST['destination_title'];
    $category=$_POST['destinaton_category'];
    $excerpt=$_POST['destination_excerpt'];
    if(isset($_FILES['image'])){
        $folder='test/';
        $image_file_name=$_FILES['image']['name'];
        $file=$_FILES['image']['tmp_name'];
        $path=$folder.$image_file_name;
        $target_file=$folder.basename($image_file_name);
        if($file!=''){
            $query=mysqli_query($conn,"SELECT * FROM destination where id=$id");
            if($row=mysqli_fetch_assoc($query)){
                $delimage=$row['image'];
            }
            unlink($folder.$delimage);
            move_uploaded_file($file,$target_file);
            $query=mysqli_query($conn,"UPDATE destination SET image='$image_file_name' , excerpt='$excerpt', category='$category',title='$title'WHERE id='$id'");
        }else{
            $query=mysqli_query($conn,"UPDATE destination SET title='$title',excerpt='$excerpt', category='$category' WHERE id='$id'");
        }
        if($query){
            header("location:dashboard.php");
        }


        }
    }
