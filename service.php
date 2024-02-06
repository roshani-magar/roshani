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
                <h2 class="banner-h2 flex justify-content">Services</h2>
                <h3 class="banner-h3"> <a style="color:white;text-decoration:none;" href="index.php"> Home</a> /
                    Services</h3>
            </div>
        </div>
    </div>
    <div class="section-space">
        <div class="box grid-container">
<?php
        $sql = "SELECT * FROM `service`";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    
    $title = $row['title'];
    $description = $row['description'];
         
?>





            <div class="flex column-gap-20" style="    border: 1px solid #DDE0E5;
                 padding: 20px;">
                <div><img src="images/2.png" alt=""></div>
                <div class="flex flex-direction row-gap-10">
                    <h3 class="black"><?php echo $title ?></h3>
                    <p><?php echo $description ?></p>
                </div>
            </div>

               
            <?php
             }
            ?>
        </div>
    </div>
    <?php
include "footer.php";
?>
</body>

</html>