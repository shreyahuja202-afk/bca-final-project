<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Travel Buddy</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:Arial,sans-serif; }

body { background-color:#0f3057; min-height:100vh; }

/* TOP BAR */
.topbar {
    display:flex; justify-content:space-between; align-items:center;
    background:rgba(10,25,35,0.8); padding:14px 30px;
    border-bottom:1px solid rgba(255,255,255,0.1);
}
.topbar h1 { color:#aee6ff; font-size:20px; }
.topbar .user { color:#d0e7f0; font-size:14px; }
.logout-btn {
    background:rgba(255,80,80,0.2); border:1px solid #ff6060;
    color:#ffaaaa; padding:8px 18px; border-radius:20px;
    text-decoration:none; font-size:14px; transition:0.2s;
}
.logout-btn:hover { background:rgba(255,80,80,0.4); }

/* WELCOME */
.welcome {
    text-align:center; padding:50px 20px 30px;
    color:white;
}
.welcome h2 { font-size:30px; color:#aee6ff; margin-bottom:8px; }
.welcome p  { font-size:14px; color:#7ab3cc; }

/* CARDS GRID */
.cards-grid {
    display:flex; flex-wrap:wrap; gap:20px;
    justify-content:center; padding:10px 30px 50px;
}

.dash-card {
    background:rgba(255,255,255,0.07);
    border:1px solid rgba(255,255,255,0.12);
    border-radius:14px; padding:30px 25px;
    width:200px; text-align:center;
    text-decoration:none; color:white;
    transition:0.3s;
    box-shadow:0 4px 15px rgba(0,0,0,0.3);
}
.dash-card:hover {
    transform:translateY(-6px);
    background:rgba(0,188,212,0.15);
    border-color:#00bcd4;
}
.dash-card .icon { font-size:38px; margin-bottom:12px; }
.dash-card h3   { font-size:15px; color:#aee6ff; margin-bottom:6px; }
.dash-card p    { font-size:12px; color:#7ab3cc; }

footer { text-align:center; padding:16px; background:#020617; color:#aaa; font-size:13px; }
</style>
</head>
<body>

<div class="topbar">
    <h1>&#9992;&#65039; Travel Buddy — Admin</h1>
    <span class="user">Logged in as: <strong><?php echo $_SESSION['user']; ?></strong></span>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="welcome">
    <h2>Welcome to Dashboard</h2>
    <p>Manage your tourism website from here</p>
</div>

<div class="cards-grid">
    <a href="add_destination.php" class="dash-card">
        <div class="icon">&#128506;&#65039;</div>
        <h3>Add Destination</h3>
        <p>Add a new travel destination</p>
    </a>
    <a href="view_destination.php" class="dash-card">
        <div class="icon">&#128203;</div>
        <h3>View Destinations</h3>
        <p>See all existing destinations</p>
    </a>
    <a href="home.php" class="dash-card">
        <div class="icon">&#127968;</div>
        <h3>View Website</h3>
        <p>Go to the public homepage</p>
    </a>
</div>

<footer><p>&copy; 2026 Travel Buddy | All Rights Reserved</p></footer>
</body>
</html>
