<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "product";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_code = $_POST['ProductCode'] ?? '';
$product_name = $_POST['ProName'] ?? '';
$product_price = $_POST['Price'] ?? '';

$missing_product_data = !$product_code || !$product_name || !$product_price;

$order_placed = false;
$order_error = "";
$added_to_cart = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart']) && !$missing_product_data) {
    $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 1;

    $cart_item = [
        'code' => $product_code,
        'name' => $product_name,
        'price' => $product_price,
        'qty' => $qty
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['code'] === $product_code) {
            $item['qty'] += $qty;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = $cart_item;
    }

    $added_to_cart = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy']) && !$missing_product_data) {
    $custName = $_POST['custname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'] ?? '';
    $qty = (int)$_POST['qty'];
    $payment_method = $_POST['payment'];
    $total = $qty * $product_price;

    $allowed_payments = ["Credit Card", "Cash on delivery", "Bank Transfer", "QR Code"];
    if ($qty < 1) {
        $order_error = "Quantity must be at least 1.";
    } elseif (!in_array($payment_method, $allowed_payments)) {
        $order_error = "Invalid payment method selected.";
    } else {
        // Insert customer
        $stmt_customer = $conn->prepare("INSERT INTO TbCustomer (CustName, Phone, Email) VALUES (?, ?, ?)");
        $stmt_customer->bind_param("sss", $custName, $phone, $email);
        if (!$stmt_customer->execute()) {
            $order_error = "Error inserting customer: " . $stmt_customer->error;
        }

        // Insert product
        $stmt1 = $conn->prepare("INSERT INTO Tbproduct (ProductCode, ProName, Price, Qty) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("ssdi", $product_code, $product_name, $product_price, $qty);
        if (!$stmt1->execute()) {
            $order_error = "Error inserting product: " . $stmt1->error;
        }

        // Insert sale
        $stmt2 = $conn->prepare("INSERT INTO TbSale (CustName, ProCode, Qty, Total, PaymentMethod) VALUES (?, ?, ?, ?, ?)");
        $stmt2->bind_param("ssiis", $custName, $product_code, $qty, $total, $payment_method);
        if (!$stmt2->execute()) {
            $order_error = "Error inserting sale: " . $stmt2->error;
        }

        // Insert order for admin view
        $stmt = $conn->prepare("INSERT INTO orders (customer_name, product_name, quantity, total_price, order_date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssii", $custName, $product_name, $qty, $total);
        if (!$stmt->execute()) {
            $order_error = "Error inserting order: " . $stmt->error;
        }

        if ($order_error === "") {
            $order_placed = true;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Order Product</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff3ee;
            margin: 0;
        }

        .form-container {
            background: #ffffff;
            max-width: 480px;
            margin: 40px auto;
            padding: 50px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #ff6f3c;
            margin-bottom: 25px;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        input,
        textarea,
        select {
            width: 80%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #ff6f3c;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #e65c28;
        }

        .exit-link {
            background-color: #ff6f3c;
            padding: 10px 25px;
            margin: 20px auto;
            display: inline-block;
            border-radius: 10px;
            color: white;
            text-decoration: none;
        }

        .exit-link:hover {
            background-color: #e65c28;
        }

        .cart-link {
            background-color: #4CAF50;
            margin-left: 10px;
        }

        .invoice {
            max-width: 480px;
            margin: 30px auto;
            padding: 30px 40px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border: 1px solid #f0a57f;
        }

        .invoice h3 {
            text-align: center;
            color: #ff6f3c;
            margin-bottom: 25px;
        }

        .invoice p strong {
            color: #ff6f3c;
        }

        .error-message {
            max-width: 480px;
            margin: 20px auto;
            background-color: #ffe6e6;
            border: 1px solid #ff4c4c;
            color: #b30000;
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
        }

        .success-message {
            max-width: 480px;
            margin: 20px auto;
            background-color: #e6ffe6;
            border: 1px solid #66cc66;
            color: green;
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: 600;
            text-align: center;
        }
    </style>
</head>

<body>

    <div style="text-align:center;">
        <a href="zando.php" class="exit-link">Back to Shopping</a>
        <a href="cart.php" class="exit-link cart-link">View Cart</a>
    </div>

    <?php if ($missing_product_data): ?>
        <h2 style="text-align:center;color:red;">Product not selected. Please return to the store page.</h2>

    <?php elseif ($order_placed): ?>
        <div class="invoice">
            <h3>✅ Order placed successfully!</h3>
            <p><strong>Customer:</strong> <?php echo $custName; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Address:</strong><br><?php echo nl2br($address); ?></p>
            <p><strong>Product:</strong> <?php echo $product_name; ?></p>
            <p><strong>Quantity:</strong> <?php echo $qty; ?></p>
            <p><strong>Total:</strong> $<?php echo number_format($total, 2); ?></p>
            <p><strong>Payment Method:</strong> <?php echo $payment_method; ?></p>
        </div>

        <?php if ($payment_method === "QR Code"): ?>
            <div style="text-align:center; margin-top:20px;">
                <h3>Scan QR to Pay</h3>
                <img src="qrcode.png" alt="QR Code" style="width:200px;height:200px;">
            </div>
        <?php endif; ?>
        <div style="text-align:center; margin-top:25px;">
            <a href="index.php" class="exit-link">⬅ Back to Home</a>
        </div>
    <?php else: ?>
        <?php if ($order_error): ?>
            <div class="error-message"><?php echo $order_error; ?></div>
        <?php elseif ($added_to_cart): ?>
            <div class="success-message">✅ Product added to cart!</div>
        <?php endif; ?>

        <div class="form-container">
            <h2>Order: <?php echo $product_name; ?></h2>
            <p><strong>Price:</strong> $<?php echo number_format($product_price, 2); ?></p>

            <form method="POST" action="">
                <input type="hidden" name="ProductCode" value="<?php echo $product_code; ?>">
                <input type="hidden" name="ProName" value="<?php echo $product_name; ?>">
                <input type="hidden" name="Price" value="<?php echo $product_price; ?>">

                <label for="custname">Customer Name:</label>
                <input type="text" id="custname" name="custname" required>

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3" required></textarea>

                <label for="qty">Quantity:</label>
                <input type="number" id="qty" name="qty" min="1" value="1" required>

                <label for="payment">Payment Method:</label>
                <select id="payment" name="payment" required>
                    <option value="">--Select Payment Method--</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Cash on delivery">Cash on delivery</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="QR Code">QR Code</option>
                </select>

                <button type="submit" name="buy">Buy Now</button>
                <button type="submit" name="add_to_cart" style="background-color:#4CAF50;margin-top:10px;">Add to Cart</button>
            </form>
        </div>
    <?php endif; ?>

</body>

</html>