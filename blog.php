<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include "header.php";
    include "includes/dbconnection.php";
    ?>
    <div class="section-banner flex ">

<div class="box container-banner flex align-item justify-content gradient-overlay">
  <div class="banner-title flex flex-direction justify-content align-items row-gap-10">
    <h2 class="banner-h2 flex justify-content">Blog</h2>
    <h3 class="banner-h3"> <a style="color:white;text-decoration:none;" href="index.php"> Home</a> / Blog</h3>
  </div>
</div>
</div>
   
<div class="section-space">
    <div class="box grid-container">
    <?php
$sql= "SELECT * FROM `blogs`";
$result=mysqli_query($conn,$sql);
while($row =mysqli_fetch_assoc($result)){
$imgsrc='uploads/'. $row['image'];
  $title=$row['title'];
  $Excerpt=$row['Excerpt'];
?> 
        <div class="card">
          <img src="<?php echo $imgsrc;?>" class="card-img-top" alt="..." width="100%" style="object-fit:cover;height:220px;">
          <div class="card-body">
            <h5 class="card-title"><?php echo $title?></h5>
            <p class="card-text"><?php echo $Excerpt?></p>
            <button class="mt-3 mb-2">Learn More</button>
          </div>
        </div>
<?php
}
?>
    </div>
</div>

<?php

?>
<?php
include "footer.php";
?>
</body>
</html>