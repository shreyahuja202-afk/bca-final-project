<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism website</title>
    <link href="https://font.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://font.googleapis.com/css2?family=Poppins&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
    <style>
    
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* ===== BODY ===== */
body {
    background-color:#0f3057;
    
}

/* ===== HEADER ===== */
header  {
    text-align: center;
    padding: 15px;
    font-size: 26px;
    font-weight: 600;
    color:#aee6ff;
    margin-top: 60px;
}
.header h1{
    color:#e6f7ff;
    font-family: 'Playfair Display',serif;
    font-size: 48px;
    text-shadow: 0 0 12px rgba(0,188,212,0.5);
}

/* ===== NAVBAR ===== */
.navbar {
    display: flex;
    width: fit-content;
    background: rgba(10,25,35,0.7);
    padding: 6px 18px;
    backdrop-filter: blur(10px);
    margin: 20px auto;
    font-family: 'poppins',sans-serif;
    gap:25px;
    border-radius: 40px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.4);
    justify-content: center;
    font-size: 16px;
    font-weight: 500;
    color:cfefff;
}

.navbar a {
    flex: 1;
    text-align: center;
    padding: 0px 40px;
    text-decoration: none;
    color: #d0e7f0;
    transition: all 0.3s ease;
    border-right: 1px solid rgba(255,255,255,0.1);
    font-size: 18px;
    font-weight: 500;
    position: relative;
}

.navbar a:last-child {
    border-right: none;
}
.navbar a::after{
    content:"";
    position: absolute;
    width: 0%;
    height: 2px;
    background: #00bcd4;
    left: 0;
    bottom: -4px;
    transition: 0.3s ease;
    transform: translateX(-50%);
}

.navbar a:hover ::after{
   width: 100%;
   background: rgba(0,188,212,0.2);
}
.navbar a:hover{
    color:#ffffff;
}

/* ===== HERO SECTION ===== */
.hero {
    height: 90vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding: 80px;

    background: 
        linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.5)),
        url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e');

    background-size: cover;
    background-position: center;
}

/* HERO TEXT */
.hero h1 {
    font-family: 'Playfair Display',sans-serif;
    font-size: 48px;
    margin-bottom: 15px;
    color:#e2e8f0;
    font-weight: 600;
}

.hero p {
    font-size: 18px;
    max-width: 500px;
    margin-bottom: 25px;
    color: #e2e8f0;
}

/* ===== BUTTON ===== */
.btn {
    display: inline-block;
    background: linear-gradient(45deg, #ffcc00, #ff9900);
    color: #000;
    padding: 12px 28px;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
}

.btn:hover {
    transform: translateY(-3px);
}

/* ===== SECTION TITLE ===== */
h2 {
    padding: 30px 50px 10px;
}

/* ===== CARDS ===== */

.destinations .card{
            padding: 15px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
            transition: 0.3s;
            overflow: hidden;
            width: 40%;
            flex: 1;
            max-width: 300px;



        }

      .destinations  .card:hover{
          
          transform: translateY(-6px);
        }
       .destinations .image-row{
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-direction: row;
            flex-wrap: nowrap;;
            padding: 0 20px;
            width: 100%;
        }
      .destinations  .card img{
            width: 100%;
            border-radius: 10px;
            height: 200px;
            object-fit: cover;
            background: #eee;
            margin: 15px 0;
            transition: 0.4s;
            display: block;
        }
        .card:hover img{
            transform: scale(1.05);
        }
        .card-body{
            padding:15px;
            text-align: center;
        }



.card h3 {
    padding: 10px;
}

.card p {
    padding: 0 10px 15px;
    color: #020617;
}

/* ===== FOOTER ===== */
footer {
    text-align: center;
    padding: 20px;
    background: #020617;
    margin-top: 30px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .hero {
        height: 70vh;
        padding: 40px;
        align-items: center;
        text-align: center;
    }

    .hero h1 {
        font-size: 30px;
    }

    .navbar {
        flex-direction: column;
    }

    .navbar a {
        border-right: none;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
}
</style>
</head>
<body>
    
        <div class="navbar">
        <a href="home.php">Home</a>
       <a href="destinations.php">Destinations</a>
       <a href="packages.php">View Packages</a>
        <a href="bookings.php">Book Now</a>
        <a href="contact.php">Contact</a>
</div>
<div class="header">
   <h1><center>Travel Buddy</center></h1></div>
    <div class="hero">
        <h1>Explore The World With Us</h1>
        <p>Discover amazing places,beautiful hotels and unforgetable travel experiences.</p>
        <button onclick="window.location.href='destinations.php'"class="btn">Get Started</button>
    </div>
    <div class="section">
        <h2>Popular Destinations</h2>
        <div class="destinations">
            <div class="image-row">
            <div class="card">
                <img src="image/beach.jpg" alt="">
                <div class="card-content">
                <h3>Beach Paradise</h3>
                <p>Relax on beautiful sandy beaches and enjoy the ocean breeze.</p>
            </div>
        </div>
        <div class="card">
            <img src="image/mountain.jpg" alt="">
            <div class="card-content">
                <h3>Mountain Adventure</h3>
                <p>Experience thrilling mountain views and hiking trails.</p>
            </div>
        </div>
        <div class="card">
            <img src="image/city.jpg" alt="">
            <div class="card-content">
                <h3>City Tours</h3>
                <p>Explore foamous citiesand their cultural heritage.</p>
            </div>
        </div>
 </div>
  </div>
    </div>
  <footer>
    <p>2026 Tourism Website</p>
  </footer>
</body>
</html>