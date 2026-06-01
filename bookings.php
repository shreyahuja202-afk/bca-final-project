<?php
include 'config.php';

// ── Coupon definitions ──────────────────────────────────────────────
$coupons = [
    'TRAVEL10'  => ['discount' => 10, 'label' => '10% Off'],
    'WELCOME20' => ['discount' => 20, 'label' => '20% Off for New Users'],
    'SUMMER15'  => ['discount' => 15, 'label' => '15% Summer Special'],
    'BUDDY50'   => ['discount' => 50, 'label' => '50% Mega Deal'],
];

// ── Base price per person per destination ───────────────────────────
$dest_prices = [
    'Goa'       => 8500,  'Jaipur'    => 6000,  'Manali'    => 9000,
    'Jaisalmer' => 7500,  'Agra'      => 5000,  'Darjeeling'=> 10000,
    'Amritsar'  => 4500,  'Jodhpur'   => 6500,  'Mount Abu' => 7000,
    'Mysore'    => 7200,  'Udaipur'   => 8000,  'Varanasi'  => 5500,
    'Mumbai'    => 9500,
];

$booking_success = false;
$error_msg = '';

if (isset($_POST['submit'])) {
    $name         = $_POST['name'];
    $email        = $_POST['email'];
    $phone        = $_POST['phone'];
    $destination  = $_POST['destination'];
    $booking_date = $_POST['booking_date'];
    $persons      = intval($_POST['persons']);
    $payment      = $_POST['payment_method'];
    $coupon_code  = strtoupper(trim($_POST['coupon'] ?? ''));

    $base_price   = ($dest_prices[$destination] ?? 5000) * $persons;
    $discount_pct = 0;
    $coupon_msg   = '';

    if ($coupon_code !== '' && isset($coupons[$coupon_code])) {
        $discount_pct = $coupons[$coupon_code]['discount'];
        $coupon_msg   = $coupons[$coupon_code]['label'];
    }

    $discount_amt = round($base_price * $discount_pct / 100);
    $final_price  = $base_price - $discount_amt;

    $sql = "INSERT INTO bookings 
              (destination, name, email, phone, persons, booking_date, payment_method, coupon_code, discount_pct, total_price)
            VALUES 
              ('$destination','$name','$email','$phone','$persons','$booking_date','$payment','$coupon_code','$discount_pct','$final_price')";

    if (mysqli_query($conn, $sql)) {
        $booking_success = true;
    } else {
        // Fallback: try without new columns (in case DB not yet updated)
        $sql2 = "INSERT INTO bookings (destination, name, email, phone, persons, booking_date)
                 VALUES ('$destination','$name','$email','$phone','$persons','$booking_date')";
        mysqli_query($conn, $sql2);
        $booking_success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Your Tour – Travel Buddy</title>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family: Arial, Helvetica, sans-serif; }

body {
    background: linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)), url("image/background.jpg");
    background-size: cover; background-position: center;
    min-height: 100vh; display: flex; flex-direction: column;
    align-items: center; justify-content: flex-start; padding: 30px 15px;
}

h2 { text-align:center; font-size:26px; margin-bottom:20px; color:#fff; letter-spacing:1px; }

/* ── MAIN CARD ── */
.card {
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 16px;
    padding: 30px 35px;
    width: 100%; max-width: 560px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.4);
    color: #fff;
}

/* ── FORM FIELDS ── */
label { display:block; font-size:13px; font-weight:600; margin: 14px 0 5px; color:#d0eaff; }
input, select {
    width:100%; padding:10px 12px; border-radius:8px;
    border: 1.5px solid rgba(255,255,255,0.25);
    background: rgba(255,255,255,0.15); color:#fff;
    font-size:14px; outline:none; transition:0.2s;
}
input::placeholder { color: rgba(255,255,255,0.5); }
input:focus, select:focus { border-color:#00c6ff; background:rgba(255,255,255,0.22); }
select option { background:#1a2a3a; color:#fff; }

/* ── TWO COLUMN ROW ── */
.row2 { display:grid; grid-template-columns:1fr 1fr; gap:14px; }

/* ── PAYMENT METHODS ── */
.payment-grid {
    display: grid; grid-template-columns: repeat(3,1fr); gap:10px; margin-top:6px;
}
.pay-option { display:none; }
.pay-label {
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    gap:5px; padding:12px 6px; border-radius:10px; cursor:pointer;
    border: 2px solid rgba(255,255,255,0.2);
    background: rgba(255,255,255,0.08);
    font-size:12px; font-weight:600; color:#cde;
    transition: 0.2s; text-align:center;
}
.pay-label:hover { border-color:#00c6ff; background:rgba(0,198,255,0.1); }
.pay-option:checked + .pay-label {
    border-color:#00c6ff; background:rgba(0,198,255,0.2); color:#fff;
    box-shadow: 0 0 10px rgba(0,198,255,0.4);
}
.pay-icon { font-size:24px; }

/* ── COUPON SECTION ── */
.coupon-row { display:flex; gap:10px; margin-top:6px; }
.coupon-row input { flex:1; }
.coupon-btn {
    padding:10px 16px; border-radius:8px; border:none;
    background:linear-gradient(135deg,#00c6ff,#0072ff);
    color:#fff; font-size:13px; font-weight:700; cursor:pointer;
    white-space:nowrap; transition:0.2s;
}
.coupon-btn:hover { transform:scale(1.04); }

/* ── PROMO TAGS ── */
.promo-tags { display:flex; flex-wrap:wrap; gap:8px; margin-top:10px; }
.tag {
    background: rgba(255,200,0,0.18); border:1px solid rgba(255,200,0,0.5);
    color:#ffd700; font-size:11px; font-weight:700; padding:4px 10px;
    border-radius:20px; cursor:pointer; transition:0.2s;
}
.tag:hover { background:rgba(255,200,0,0.35); }

/* ── PRICE SUMMARY BOX ── */
.summary {
    background: rgba(0,0,0,0.35); border-radius:10px;
    padding:14px 18px; margin-top:16px;
    border: 1px solid rgba(255,255,255,0.15);
    font-size:14px; line-height:2;
}
.summary .row { display:flex; justify-content:space-between; }
.summary .row.total { font-size:18px; font-weight:700; color:#00e5ff; border-top:1px solid rgba(255,255,255,0.2); padding-top:8px; margin-top:4px; }
.summary .discount-row { color:#7dff9a; }
.coupon-ok  { color:#7dff9a; font-size:12px; margin-top:4px; }
.coupon-err { color:#ff7070; font-size:12px; margin-top:4px; }

/* ── SUBMIT BTN ── */
.submit-btn {
    margin-top:22px; width:100%; padding:13px;
    background: linear-gradient(45deg,#ff7b00,#ff3d00);
    color:#fff; border:none; border-radius:10px;
    font-size:17px; font-weight:700; cursor:pointer;
    transition:0.3s; letter-spacing:0.5px;
}
.submit-btn:hover { background:linear-gradient(45deg,#e66a00,#cc2200); transform:scale(1.02); }

/* ── SUCCESS POPUP ── */
.success-overlay {
    position:fixed; inset:0; background:rgba(0,0,0,0.75);
    display:flex; align-items:center; justify-content:center; z-index:999;
}
.success-box {
    background:#fff; border-radius:16px; padding:40px 35px;
    text-align:center; max-width:400px; width:90%;
    animation: popIn 0.4s ease;
}
@keyframes popIn { from{transform:scale(0.7);opacity:0} to{transform:scale(1);opacity:1} }
.success-box .check { font-size:60px; }
.success-box h3 { color:#00a86b; font-size:24px; margin:10px 0; }
.success-box p  { color:#444; font-size:14px; margin:4px 0; }
.success-box .final-amt { font-size:22px; color:#0072ff; font-weight:700; margin:12px 0; }
.success-box a {
    display:inline-block; margin-top:16px; padding:10px 24px;
    background:linear-gradient(45deg,#ff7b00,#ff3d00); color:#fff;
    border-radius:8px; text-decoration:none; font-weight:700;
}

/* ── OFFER BANNER ── */
.offer-banner {
    width:100%; max-width:560px; margin-bottom:18px;
    background:linear-gradient(135deg,#ff6b00,#ffcc00);
    border-radius:12px; padding:10px 18px;
    display:flex; align-items:center; gap:12px; color:#000;
    font-size:13px; font-weight:700; box-shadow:0 4px 15px rgba(255,107,0,0.4);
}
.offer-banner span { font-size:22px; }
</style>
</head>
<body>

<?php if($booking_success): ?>
<!-- ── SUCCESS POPUP ── -->
<div class="success-overlay">
  <div class="success-box">
    <div class="check">✅</div>
    <h3>Booking Confirmed!</h3>
    <p><strong><?php echo htmlspecialchars($name); ?></strong>, your trip to</p>
    <p><strong><?php echo htmlspecialchars($destination); ?></strong> is booked!</p>
    <p>📅 <?php echo htmlspecialchars($booking_date); ?> &nbsp;|&nbsp; 👥 <?php echo $persons; ?> person(s)</p>
    <p>💳 Payment via: <strong><?php echo htmlspecialchars(ucwords(str_replace('_',' ',$payment))); ?></strong></p>
    <?php if($discount_pct > 0): ?>
    <p>🎟️ Coupon <strong><?php echo $coupon_code; ?></strong> — <?php echo $coupon_msg; ?></p>
    <?php endif; ?>
    <div class="final-amt">Total: ₹<?php echo number_format($final_price); ?></div>
    <a href="home.php">🏠 Back to Home</a>
  </div>
</div>
<?php endif; ?>

<!-- ── OFFER BANNER ── -->
<div class="offer-banner">
  <span>🎉</span>
  <div>Use code <strong>BUDDY50</strong> for 50% OFF &nbsp;|&nbsp; <strong>WELCOME20</strong> for new users &nbsp;|&nbsp; <strong>SUMMER15</strong> for seasonal deal!</div>
</div>

<div class="card">
  <h2>✈️ Book Your Tour</h2>
  <form method="POST" id="bookForm">

    <!-- Personal Info -->
    <label>Full Name</label>
    <input type="text" name="name" placeholder="Enter your name" required>

    <div class="row2">
      <div>
        <label>Email</label>
        <input type="email" name="email" placeholder="your@email.com" required>
      </div>
      <div>
        <label>Phone</label>
        <input type="text" name="phone" placeholder="+91 XXXXX XXXXX" required>
      </div>
    </div>

    <!-- Destination & Date -->
    <div class="row2">
      <div>
        <label>Destination</label>
        <select name="destination" id="destSelect" onchange="calcPrice()">
          <?php foreach($dest_prices as $d => $p): ?>
          <option value="<?php echo $d; ?>"><?php echo $d; ?> — ₹<?php echo number_format($p); ?>/person</option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label>Persons</label>
        <input type="number" name="persons" id="personsInput" value="1" min="1" max="20" onchange="calcPrice()" required>
      </div>
    </div>

    <label>Booking Date</label>
    <input type="date" name="booking_date" required>

    <!-- Payment Methods -->
    <label>Payment Method</label>
    <div class="payment-grid">

      <input type="radio" name="payment_method" id="pm_upi"    value="upi"         class="pay-option" checked>
      <label for="pm_upi"    class="pay-label"><span class="pay-icon">📱</span>UPI</label>

      <input type="radio" name="payment_method" id="pm_card"   value="credit_card"  class="pay-option">
      <label for="pm_card"   class="pay-label"><span class="pay-icon">💳</span>Credit/Debit Card</label>

      <input type="radio" name="payment_method" id="pm_nb"     value="net_banking"  class="pay-option">
      <label for="pm_nb"     class="pay-label"><span class="pay-icon">🏦</span>Net Banking</label>

      <input type="radio" name="payment_method" id="pm_wallet" value="wallet"       class="pay-option">
      <label for="pm_wallet" class="pay-label"><span class="pay-icon">👜</span>Wallet</label>

      <input type="radio" name="payment_method" id="pm_emi"    value="emi"          class="pay-option">
      <label for="pm_emi"    class="pay-label"><span class="pay-icon">📅</span>EMI</label>

      <input type="radio" name="payment_method" id="pm_cod"    value="pay_at_hotel" class="pay-option">
      <label for="pm_cod"    class="pay-label"><span class="pay-icon">🏨</span>Pay at Hotel</label>
    </div>

    <!-- Coupon -->
    <label>Discount Coupon</label>
    <div class="coupon-row">
      <input type="text" name="coupon" id="couponInput" placeholder="Enter coupon code" oninput="this.value=this.value.toUpperCase()">
      <button type="button" class="coupon-btn" onclick="applyCoupon()">Apply</button>
    </div>
    <div id="couponMsg"></div>

    <!-- Quick coupon tags -->
    <div class="promo-tags">
      <span class="tag" onclick="fillCoupon('TRAVEL10')">🏷️ TRAVEL10 – 10%</span>
      <span class="tag" onclick="fillCoupon('WELCOME20')">🏷️ WELCOME20 – 20%</span>
      <span class="tag" onclick="fillCoupon('SUMMER15')">🌞 SUMMER15 – 15%</span>
      <span class="tag" onclick="fillCoupon('BUDDY50')">🔥 BUDDY50 – 50%</span>
    </div>

    <!-- Price Summary -->
    <div class="summary" id="priceSummary">
      <div class="row"><span>Base Price</span><span id="baseAmt">₹0</span></div>
      <div class="row discount-row" id="discountRow" style="display:none">
        <span>Discount (<span id="discPct">0</span>%)</span>
        <span id="discAmt">-₹0</span>
      </div>
      <div class="row total"><span>💰 Total</span><span id="totalAmt">₹0</span></div>
    </div>

    <button type="submit" name="submit" class="submit-btn">🚀 Confirm Booking</button>
  </form>
</div>

<script>
// Prices mirror PHP array
const prices = {
  'Goa':8500,'Jaipur':6000,'Manali':9000,'Jaisalmer':7500,'Agra':5000,
  'Darjeeling':10000,'Amritsar':4500,'Jodhpur':6500,'Mount Abu':7000,
  'Mysore':7200,'Udaipur':8000,'Varanasi':5500,'Mumbai':9500
};

const coupons = {
  'TRAVEL10':10,'WELCOME20':20,'SUMMER15':15,'BUDDY50':50
};

let activeDiscount = 0;

function fmt(n){ return '₹' + n.toLocaleString('en-IN'); }

function calcPrice(){
  const dest    = document.getElementById('destSelect').value;
  const persons = parseInt(document.getElementById('personsInput').value) || 1;
  const base    = (prices[dest] || 5000) * persons;
  const disc    = Math.round(base * activeDiscount / 100);
  const total   = base - disc;

  document.getElementById('baseAmt').textContent  = fmt(base);
  document.getElementById('totalAmt').textContent = fmt(total);

  if(activeDiscount > 0){
    document.getElementById('discountRow').style.display = 'flex';
    document.getElementById('discPct').textContent = activeDiscount;
    document.getElementById('discAmt').textContent = '-' + fmt(disc);
  } else {
    document.getElementById('discountRow').style.display = 'none';
  }
}

function applyCoupon(){
  const code = document.getElementById('couponInput').value.trim().toUpperCase();
  const msg  = document.getElementById('couponMsg');
  if(coupons[code]){
    activeDiscount = coupons[code];
    msg.className = 'coupon-ok';
    msg.textContent = '✅ Coupon applied! ' + activeDiscount + '% discount added.';
  } else if(code === ''){
    msg.className = 'coupon-err';
    msg.textContent = '⚠️ Please enter a coupon code.';
  } else {
    activeDiscount = 0;
    msg.className = 'coupon-err';
    msg.textContent = '❌ Invalid coupon code.';
  }
  calcPrice();
}

function fillCoupon(code){
  document.getElementById('couponInput').value = code;
  applyCoupon();
}

// Init price on load
calcPrice();
</script>
</body>
</html>
