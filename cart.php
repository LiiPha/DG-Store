<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Remove item
    if (isset($_POST['remove_index'])) {
        $remove_index = (int)$_POST['remove_index'];
        if (isset($_SESSION['cart'][$remove_index])) {
            array_splice($_SESSION['cart'], $remove_index, 1);
        }
    }

    // Update quantity
    if (isset($_POST['update_index']) && isset($_POST['new_qty'])) {
        $update_index = (int)$_POST['update_index'];
        $new_qty = max(1, (int)$_POST['new_qty']);
        if (isset($_SESSION['cart'][$update_index])) {
            $_SESSION['cart'][$update_index]['qty'] = $new_qty;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Your Cart</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #fff3ee;
            padding: 40px 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #ff6f3c;
            margin-bottom: 30px;
        }

        table {
            width: 95%;
            margin: 0 auto 30px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        th,
        td {
            padding: 14px 16px;
            text-align: center;
            border-bottom: 1px solid #f1d1c4;
        }

        th {
            background-color: #ff6f3c;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #fff1e8;
        }

        .total-row td {
            font-weight: bold;
            background-color: #ffe3d4;
        }

        .remove-btn {
            background-color: #f44336;
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .remove-btn:hover {
            background-color: #d32f2f;
        }

        .update-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }

        .update-btn:hover {
            background-color: #388e3c;
        }

        input[type="number"] {
            width: 60px;
            padding: 6px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            text-align: center;
        }

        a {
            background-color: #ff6f3c;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 8px;
            display: inline-block;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        a:hover {
            background-color: #e4571e;
        }

        .action-links {
            text-align: center;
            margin-top: 25px;
        }

        .empty-message {
            text-align: center;
            font-size: 18px;
            margin-bottom: 30px;
            color: #777;
        }

        @media (max-width: 768px) {

            table,
            th,
            td {
                font-size: 14px;
            }

            .remove-btn,
            .update-btn {
                padding: 6px 10px;
                font-size: 12px;
            }

            a {
                font-size: 14px;
                padding: 8px 16px;
                margin: 5px;
            }
        }
    </style>
</head>

<body>

    <h2>🛒 Your Shopping Cart</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Actions</th>
            </tr>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $index => $item):
                $subtotal = $item['price'] * $item['qty'];
                $total += $subtotal;
            ?>
                <tr>
                    <td><?= htmlspecialchars($item['code']) ?></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td>
                        <form method="post" style="display:flex; gap:6px; justify-content:center; align-items:center;">
                            <input type="number" name="new_qty" value="<?= $item['qty'] ?>" min="1">
                            <input type="hidden" name="update_index" value="<?= $index ?>">
                            <button type="submit" class="update-btn">Update</button>
                        </form>
                    </td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>$<?= number_format($subtotal, 2) ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="remove_index" value="<?= $index ?>">
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="4" style="text-align:right;">Total:</td>
                <td colspan="2">$<?= number_format($total, 2) ?></td>
            </tr>
        </table>

        <div class="action-links">
            <a href="zando.php">Continue Shopping</a>
            <a href="checkout.php">Proceed to Checkout</a>
        </div>

    <?php else: ?>
        <p class="empty-message">🧺 Your cart is empty.</p>
        <div class="action-links">
            <a href="product.html">Return to Store</a>
        </div>
    <?php endif; ?>

</body>

</html>