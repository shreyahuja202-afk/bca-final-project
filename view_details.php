<?php
$conn = mysqli_connect("localhost", "root", "", "tourism_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_GET['id'])) {
    echo "No package selected.";
    exit();
}

$id = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM packages WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Package not found.";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row['name']; ?></title>

    <style>
       /* ===== RESET ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* ===== BODY ===== */
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(to right, #fdfcfb, #e2d1c3);
  color: #333;
  line-height: 1.6;
  overflow-x: hidden;
}

/* ===== CONTAINER ===== */
.container {
  width: 90%;
  max-width: 1100px;
  margin: 30px auto;
}

/* ===== HERO SECTION ===== */
.hero {
  width: 100%;
  height: 400px; /* reduce from 80vh */
  background: url('taj.jpg') center center / cover no-repeat;
  border-radius: 15px;
  position: relative;
  overflow: hidden; /* IMPORTANT */
}

.hero-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,0.45);
  padding: 40px;
  border-radius: 12px;
  text-align: center;
  color: #fff;
}

.hero h1 {
  font-size: 48px;
  margin-bottom: 10px;
}

.hero p {
  font-size: 18px;
  margin-bottom: 20px;
}
/* Single-line text styling */
.content {
  font-family: 'Poppins', sans-serif;
  font-size: 24px;           /* larger, prominent text */
  font-weight: 700;           /* bold */
  color: #007bff;             /* bright blue for tourism vibe */
  text-align: left;
  text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2); /* subtle shadow for depth */
  letter-spacing: 1px;        /* slightly spaced out letters */
  margin: 20px 0;
  transition: color 0.3s, transform 0.3s;
}

/* ===== BUTTON ===== */
/* Main button styling */
.book-now {
  background: linear-gradient(135deg, #007bff, #00c6ff); /* vibrant blue gradient */
  color: white;
  font-size: 20px;
  display: inline-block;
  font-weight: 700;
  padding: 10px 20px;
  width:fit-content;
  min-width: 120px;
  border: none;
  border-radius: 25px;            /* pill-shaped button */
  cursor: pointer;
  box-shadow: 0 8px 20px rgba(0, 123, 255, 0.4);
  transition: all 0.3s ease;
  text-transform: uppercase;
  text-decoration: none;
}

/* Hover effect */
.book-now:hover {
    text-decoration: none;
  transform: translateY(-2px) scale(1.05); /* slight lift and zoom */
  box-shadow: 0 10px 25px rgba(0, 123, 255, 0.6);
  background: linear-gradient(135deg, #0056b3, #00aaff); /* slightly darker gradient on hover */
}

/* ===== SECTION HEADINGS ===== */
h2 {
  margin: 40px 0 20px;
  color: #0056b3;  ;
  text-align: center;
  font-size: 40px;
}

/* ===== CARDS SECTION ===== */
.cards {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  justify-content: center;
}

.card {
  background: #fff;
  width: 300px;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 5px 20px rgba(0,0,0,0.1);
  transition: 0.3s;
}

.card:hover {
  transform: translateY(-10px);
}

.card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.card h3 {
  padding: 12px;
  color: #444;
}

.card p {
  padding: 0 12px 15px;
  font-size: 14px;
  color: #666;
}

/* ===== INFO SECTION ===== */
.info-wrapper {
  position: relative;
  width: 100%;
  display: flex;
  justify-content: center; /* center the inner info box */
  margin: 50px 0;
}

.info-wrapper::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to right, rgba(0,123,255,0.2), rgba(0,123,255,0.05), rgba(0,123,255,0.2));
  border-radius: 20px;
  z-index: 1;
  filter: blur(40px); /* soft glow effect */
}

/* Full-width container with blue glow border */
.info {
  width: 100%;
  background: #ffffff;           /* clean white background */
  padding: 20px 30px;
  position: relative;
  box-sizing: border-box;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  border-radius: 15px;
  border: 2px solid #007bff;    /* solid blue border */
  box-shadow: 0 0 30px rgba(0, 123, 255, 0.5); /* bluish glow effect */
}

.info h2 {
  position: absolute;
  top: -40px;
  left: 50%;
  transform: translateX(-50%);
  color: #007bff;               /* heading in blue */
  font-size: 35px;
  font-weight: 700;
}

.info > div {
  width: 48%;
  text-align: center;
  margin-bottom: 20px;
  position: relative;
}

.info p {
  margin: 12px 0;
  font-weight: 700;             /* bold text */
  color: #000000;               /* black text */
  font-size: 18px;
}

.info p span {
  color: #007bff;               /* blue accent for labels */
}

/* Responsive for mobile */
@media (max-width: 768px) {
  .info {
    flex-direction: column;
    text-align: center;
  }

  .info > div {
    width: 100%;
  }

  .info h2 {
    top: -30px;
    font-size: 24px;
  }
}
/* ===== HEADER TITLE BAR ===== */
.page-title {
  background: #0072ff;       /* vibrant blue */
  color: white;              /* white text */
  text-align: center;
  padding: 20px;
  font-size: 28px;
  font-weight: 600;
  border-radius: 12px 12px 0 0;
  margin-bottom: 20px;
  box-shadow: 0 4px 10px rgba(0, 114, 255, 0.5);
}
/* ===== IMAGE (MAIN TAJ IMAGE IF USED) ===== */
img {
  max-width: 100%;
  height: auto;
  display: block;
}
.image-wrapper {
  background: white;
  padding: 10px;
  border-radius: 15px;
  width: 80%;
  margin: 20px auto;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.main-image {
  width: 70%;
  height: 250px;
  object-fit: cover; /* KEY FIX */
  border-radius: 12px;
}

/* ===== ANIMATIONS ===== */
body {
  animation: fadeIn 0.8s ease-in;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1200px) {
  .hero {
    height: 450px;
  }

  .hero h1 {
    font-size: 32px;
  }

  .cards {
    flex-direction: column;
    align-items: center;
  }
  
}
.map iframe{
    width:100%;
    height: 300px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
}
    </style>
</head>

<body>

<div class="container">

    <div class="page-title">
        <h1><?php echo $row['name']; ?></h1>
    </div>

    <div class="image-wrapper">
        <div class="image-section">
        <img src="image/<?php echo $row['image']; ?>" alt="Image">
</div>
    </div>

    <div class="content">
        <p><?php echo $row['description']; ?></p></div>

        <div class="info-wrapper">
        <div class="info">
            <div class="duration">
              <h2>  <strong>Duration:</strong></h2><br><br>
              <p>  <?php echo $row['duration']; ?></p>
            </div>
            

            <div class="price">
              <h2>  <strong>Price:</strong><br></h2><br><br>
              <span class="price"><p>₹ <?php echo $row['price']; ?></p></span>           
            </div>
        </div>
        </div>
        <div class="book-now">
        <a href="bookings.php">Book Now</a>
    </div>
   
       <h2>Location</h2>
       <div class="map">
        <iframe src="https://www.google.com/maps?q=<?php echo urlencode($row['name']); ?>&output=embed"></iframe>
    </div>
</div>


</body>
</html>