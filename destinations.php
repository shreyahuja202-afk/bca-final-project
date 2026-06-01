<?php
include 'config.php';

// Fetch all destinations BEFORE closing the connection
$sql = "SELECT * FROM destinations";
$all_result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Destinations</title>
    <style>
        body {
            font-family: Arial;
            background-color: #006d6f;
            margin: 0;
        }
        .title-container {
            width: 90%;
            margin: 40px auto 20px auto;
            text-align: center;
        }
        .title-container h1 {
            font-size: 36px;
            color: #fff;
        }
        .search-box {
            display: flex;
            align-items: center;
            flex-wrap: nowrap;
            gap: 10px;
            max-width: 500px;
            margin: 20px auto;
        }
        input {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            flex: 1;
        }
        .btn {
            padding: 8px 14px;
            background: #0077b6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            white-space: nowrap;
            text-decoration: none;
            font-size: 14px;
        }
        .btn:hover { background: #4da6ff; }

        .container {
            width: 60%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .no-result { color: red; margin-top: 20px; }

        /* Grid for all destinations */
        .destination-grid {
            width: 90%;
            margin: 30px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 15px;
            text-align: center;
            transition: 0.3s;
        }
        .card:hover { transform: translateY(-5px); }
        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }
        button {
            background: #0077b6;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover { background: #023e8a; }
    </style>
</head>
<body>

<div class="title-container">
    <h1>Search Destinations</h1>
    <form method="GET" class="search-box">
        <input
            type="text"
            name="query"
            placeholder="Enter place name..."
            value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>"
        >
        <button type="submit" class="btn">Search</button>
    </form>
</div>

<div class="container">
<?php
// BUG FIX 4: moved $conn->close() to end of file so the grid below can still use the connection
if (isset($_GET['query'])) {
    $search = $_GET['query'];
    $stmt = $conn->prepare("SELECT * FROM destinations WHERE name LIKE ?");
    $searchParam = "%$search%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $search_result = $stmt->get_result();

    if ($search_result->num_rows > 0) {
        while ($row = $search_result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
            echo "<img src='image/" . htmlspecialchars($row['image']) . "' alt=''>";
            echo "<p>" . htmlspecialchars($row['description']) . "</p>";
            echo "<a href='view_details.php?id=" . $row['id'] . "' class='btn'>View Details</a>";
            echo "</div>";
        }
    } else {
        echo "<p class='no-result'>No destinations found.</p>";
    }
    $stmt->close();
}
?>
</div>

<div class="destination-grid">
<?php
// BUG FIX 4 continued: $all_result was fetched before search block, connection still open
while ($row = mysqli_fetch_assoc($all_result)) {
?>
    <div class="card">
        <h3><?php echo htmlspecialchars($row['name']); ?></h3>
        <img src="image/<?php echo htmlspecialchars($row['image']); ?>" width="250" height="150">
        <p><?php echo htmlspecialchars($row['description']); ?></p>
        <a href="packages.php?destination_id=<?php echo $row['id']; ?>">
            <button>View Packages</button>
        </a>
    </div>
<?php } ?>
</div>

</body>
</html>
<?php $conn->close(); ?>
