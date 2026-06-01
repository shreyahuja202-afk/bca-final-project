<?php
include 'db_connect.php';

// Get destination_id
$destination_id = isset($_GET['destination_id']) ? intval($_GET['destination_id']) : 0;

// Get destination name
if ($destination_id > 0) {
    $dest_query = "SELECT name FROM destinations WHERE id = $destination_id LIMIT 1";
    $dest_result = mysqli_query($conn, $dest_query);
    $destination_name = "All";

    if ($dest_result && mysqli_num_rows($dest_result) > 0) {
        $row = mysqli_fetch_assoc($dest_result);
        $destination_name = $row['name'];
    }

    $query = "SELECT * FROM packages WHERE destination_id = $destination_id";
} else {
    $destination_name = "All";
    $query = "SELECT * FROM packages";
}

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo htmlspecialchars($destination_name); ?> Packages</title>

<style>

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
   body {
  background: linear-gradient(to bottom, #dff6ff 0%, #bfe9ff 60%, #9cd8f7 100%);
  background-repeat: no-repeat;
  background-size: cover;
}
}

/* HERO */
.hero {
    height: 220px;
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url('image/bg.jpg') center/cover no-repeat;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: white;
}

.hero h1 {
    font-size: 36px;
}

.hero p {
    font-size: 16px;
}

/* CONTAINER */
.container {
    width: 85%;
    max-width: 1100px;
    margin: 30px auto;
}

/* CARD */
.package-card {
    display: flex;
    align-items: center;
    gap: 15px;
    background: white;
    border-radius: 12px;
    padding: 25px 30px;
    margin-bottom: 20px;
    box-shadow: 0 10px 20px rgba(0, 128, 170, 0.15);
    transition:  transform 0.3s ease, box-shadow 0.3s ease;
    min-height: 140px;
}

.package-card:hover {
    transform: translateY(-8px);
    box-shadow:  0 15px 30px rgba(0, 128, 170, 0.3);;
}

/* IMAGE */
.package-card img {
    width: 180px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
    flex-shrink: 0;
}

/* CONTENT */
.package-info {
    flex: 1;
}

.package-info h3 {
    margin-bottom: 8px;
}

.duration {
    color: #666;
    margin-bottom: 6px;
}

.price {
    color: #00a8cc;;
    font-weight: bold;
    font-size: 18px;
}

/* BUTTONS */
.actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.btn {
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    text-align: center;
}

.btn-details {
    background: #3498db;
    color: white;
}

.btn-book {
    background: linear-gradient(45deg, #ff7e00, #ff3d00);
    color: white;
}

/* MOBILE */
@media (max-width: 768px) {
    .package-card {
        flex-direction: column;
        text-align: center;
    }

    .package-card img {
        width: 100%;
        height: 180px;
    }

    .actions {
        flex-direction: row;
        justify-content: center;
    }
}


</style>
</head>

<body>

<div class="hero">
    <h1><?php echo htmlspecialchars($destination_name); ?> Packages</h1>
    <p>Select your perfect trip</p>
</div>

<div class="container">

<?php
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $image_path = 'image/' . $row['image'];
?>

    <div class="package-card">
        <img src="<?php echo htmlspecialchars($image_path); ?>" alt="">

        <div class="package-info">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <p><span style="font-size:18px;">⏱️</span> <?php echo htmlspecialchars($row['duration']); ?></p>
            <p class="price">₹<?php echo number_format($row['price']); ?></p>
        </div>

        <div class="actions">
           <a href="view_details.php?id=<?php echo $row['id']; ?>" class="btn btn-details">view details</a>
            <a href="bookings.php?id=<?php echo $row['id']; ?>" class="btn btn-book">Book Now</a>
        </div>
    </div>

<?php
    }
} else {
    echo "<p style='padding:20px;'>No packages found.</p>";
}
?>

</div>
<footer style="text-align:center; padding: 15px; font-size: 14px; color: #555; margin-top: 40px;">
  © 2026 Your Travel Company. All rights reserved.
</footer>

</body>
</html>