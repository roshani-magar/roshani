<?php
include "includes/dbconnection.php";
$id=$_GET['id'];
$sql="DELETE FROM blogs Where id='".$id."'";
if($conn->query($sql)==TRUE)
{
    echo "record delete successfully";
}
else{
    echo "Error deleting record: " .$conn->error;
}
include "includes/dbclose.php";