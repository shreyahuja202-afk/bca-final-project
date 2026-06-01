<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

// BUG FIX 1: was mysqli_query($conn, $result) — $result doesn't exist yet, should be $query
$query = "SELECT * FROM destinations";
$result = mysqli_query($conn, $query);
?>

<h2>All Destinations</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
    </tr>
    <?php
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['description'] . "</td>
                <td><img src='image/" . $row['image'] . "' width='100'></td>
              </tr>";
        // BUG FIX 2: was missing closing quote after image filename and missing >
    }
    ?>
</table>
<a href="dashboard.php">Back to Dashboard</a>
