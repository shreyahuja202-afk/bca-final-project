<?php
session_start();
if(isset($_SESSION['user'])){
    header("Location: dashboard.php");
    exit();
}

$conn = mysqli_connect("localhost","root","","tourism_db");
$error = "";

if(isset($_POST['login'])){
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $sql      = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result   = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $_SESSION['user'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Email or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Travel Buddy</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:Arial,sans-serif; }

body { background-color:#0f3057; min-height:100vh; display:flex; flex-direction:column; }

.navbar {
    display:flex; width:fit-content;
    background:rgba(10,25,35,0.7);
    padding:6px 18px; margin:20px auto;
    gap:25px; border-radius:40px;
    box-shadow:0 8px 20px rgba(0,0,0,0.4);
    justify-content:center;
}
.navbar a {
    padding:8px 30px; text-decoration:none;
    color:#d0e7f0; font-size:16px; font-weight:500;
    border-right:1px solid rgba(255,255,255,0.1);
}
.navbar a:last-child { border-right:none; }
.navbar a:hover { color:#ffffff; }

.login-wrapper {
    flex:1; display:flex;
    justify-content:center; align-items:center; padding:40px 20px;
}

.login-box {
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.15);
    border-radius:16px; padding:40px 35px;
    width:100%; max-width:400px;
    box-shadow:0 8px 30px rgba(0,0,0,0.4);
    color:white; text-align:center;
}

.login-box h2 { font-size:26px; margin-bottom:8px; color:#aee6ff; }
.login-box p  { font-size:13px; color:#7ab3cc; margin-bottom:24px; }

.error-msg {
    background:rgba(255,80,80,0.2); border:1px solid #ff6060;
    color:#ffaaaa; padding:10px; border-radius:8px;
    margin-bottom:16px; font-size:14px;
}

label { display:block; text-align:left; font-size:13px; color:#aee6ff; margin:14px 0 5px; font-weight:bold; }

input[type="email"], input[type="password"] {
    width:100%; padding:10px 14px; border-radius:8px;
    border:1px solid rgba(255,255,255,0.2);
    background:rgba(255,255,255,0.1); color:white; font-size:14px; outline:none;
}
input[type="email"]:focus, input[type="password"]:focus {
    border-color:#00bcd4; background:rgba(255,255,255,0.15);
}
input::placeholder { color:rgba(255,255,255,0.4); }

.login-btn {
    margin-top:22px; width:100%; padding:12px;
    background:linear-gradient(45deg,#ffcc00,#ff9900);
    color:#000; border:none; border-radius:30px;
    font-size:16px; font-weight:700; cursor:pointer; transition:0.3s;
}
.login-btn:hover { transform:translateY(-2px); }

.register-link { margin-top:18px; font-size:13px; color:#7ab3cc; }
.register-link a { color:#ffcc00; text-decoration:none; font-weight:bold; }
.register-link a:hover { text-decoration:underline; }

footer { text-align:center; padding:16px; background:#020617; color:#aaa; font-size:13px; }
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

<div class="login-wrapper">
    <div class="login-box">
        <h2>&#128274; Welcome Back</h2>
        <p>Login to your Travel Buddy account</p>

        <?php if($error != ""): ?>
        <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit" name="login" class="login-btn">Login</button>
        </form>

        <div class="register-link">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </div>
</div>

<footer><p>&copy; 2026 Travel Buddy | All Rights Reserved</p></footer>
</body>
</html>
