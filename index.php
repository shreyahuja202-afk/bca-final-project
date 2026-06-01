<?php
include 'config.php';

function image_path($filename){
    if(!$filename) return 'images/city.jpg';
        $path= 'images/'.$filename;
        return file_exists($path) ? $path : 'images/city.jpg';
}

$sql="SELECT * FROM destinations";
$result= mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Tourism Website</title>
</head>
<body>
    <h1>Welcome To Our Tourist Website</h1>

    <h2>Our Destinations</h2>
    <?php while($row =mysqli_fetch_assoc($result)){
    ?>
    <div style="border:1px solid #ccc; padding:15px; width:300px; display: inline_block; margin:10px;">
    <h3><?php echo $row['name'];?></h3>
    <p><?php echo $row['description'];?></p>
    <img src="image/<?php echo $row['image']; ?>" width="250" height="150">
    <a href="destinations.php?id=<?php echo $row['id'];?>">
    <button>View Details</button>
    </a>
    </div>
    <?php } ?>
</body>
</html>