<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $description=$_POST['description'];
    $image=$_FILES['image']['name'];
    $temp_name=$_FILES['image']['tmp_name'];

    move_uploaded_file($temp_name, "images/".$image);

    $query="INSERT INTO destinations(name,description,image)VALUES('$name','$description','$image')";

    if(mysqli_query($conn,$query)){
        echo "Destination Added Successfully!";
    }else{
        echo"Error!";
    }
}
?>

<h2> Add Destination </h2>

<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br><br>
    Description: <textarea name="description" required></textarea><br><br>
    Image: <input type="file" name="image" required><br><br>
    <button type="submit" name="submit">Add Destination</button> 
</form>
<a href="dashboard.php">Back to Dashboard</a>