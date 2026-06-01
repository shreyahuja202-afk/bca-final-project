<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us - Explore Tourism</title>

<style>

body{
font-family: Arial, sans-serif;
margin:0;
background:#f4f9ff;
}

header{
background:linear-gradient(to right,#0077b6,#00b4d8);
color:white;
text-align:center;
padding:40px;
}

.contact-container{
display:flex;
justify-content:center;
gap:40px;
padding:40px;
flex-wrap:wrap;
}

.contact-form{
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.1);
width:350px;
}

.contact-form h2{
text-align:center;
margin-bottom:20px;
}

.contact-form input,
.contact-form textarea{
width:100%;
padding:10px;
margin:10px 0;
border-radius:5px;
border:1px solid #ccc;
}

.contact-form button{
width:100%;
padding:12px;
background:#0077b6;
color:white;
border:none;
border-radius:5px;
font-size:16px;
cursor:pointer;
}

.contact-form button:hover{
background:#023e8a;
}

.contact-info{
max-width:300px;
}

.contact-info h3{
color:#0077b6;
}

.contact-info p{
margin:10px 0;
}

.map{
margin:40px;
text-align:center;
}

footer{
background:#0077b6;
color:white;
text-align:center;
padding:15px;
}

</style>
</head>

<body>

<header>
<h1>Contact Us</h1>
<p>We would love to hear from you! Plan your next trip with us.</p>
</header>

<section class="contact-container">

<div class="contact-form">
<h2>Send Message</h2>

<form>
<input type="text" placeholder="Your Name" required>
<input type="email" placeholder="Your Email" required>
<input type="text" placeholder="Subject">
<textarea rows="5" placeholder="Your Message"></textarea>
<button type="submit">Send Message</button>
</form>

</div>

<div class="contact-info">
<h3>Get in Touch</h3>
<p>📍 Karimpur, Punjab, India</p>
<p>📞 +91 98765 43210</p>
<p>✉ tourism@email.com</p>

<h3>Follow Us</h3>
<p>🌐 Facebook</p>
<p>📸 Instagram</p>
<p>🐦 Twitter</p>
</div>

</section>

<div class="map">
<iframe src="https://www.google.com/maps?q=punjab&output=embed"
width="80%" height="300" style="border:0;"></iframe>
</div>

<footer>
<p>© 2026 Explore Tourism | All Rights Reserved</p>
</footer>

</body>
</html>



