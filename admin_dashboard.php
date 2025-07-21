<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db = "product";
$conn = new mysqli($host, $user, $pass, $db);

// Search and filter
$filter = $_GET['filter'] ?? '';
$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM orders WHERE 1";

// Apply filters
if ($filter === 'Paid' || $filter === 'Unpaid') {
    $sql .= " AND pay = '$filter'";
}
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $sql .= " AND (customer_name LIKE '%$search%' OR product_name LIKE '%$search%')";
}
$sql .= " ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Orders</title>
    <style>
        body {
            background-color: #fff3ed;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            color: #333;
            transition: background 0.3s, color 0.3s;
        }

        h2 {
            text-align: center;
            color: #ff6f3c;
            margin-bottom: 20px;
        }

        form.filters {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        form input[type="text"],
        select {
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        thead th {
            background-color: #ffb385;
            color: white;
            padding: 12px;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #f0c9b8;
        }

        tr:hover {
            background-color: #fff0e6;
        }

        tr.paid {
            background-color: #eaffea;
        }

        tr.unpaid {
            background-color: #ffeaea;
        }

        .dark {
            background-color: #1e1e1e;
            color: #eee;
        }

        .dark table {
            background: #2c2c2c;
        }

        .dark thead th {
            background-color: #444;
        }

        .dark tr:hover {
            background-color: #333;
        }

        .dark tr.paid {
            background-color: #2d4f2d;
        }

        .dark tr.unpaid {
            background-color: #4f2d2d;
        }

        .btn {
            display: inline-block;
            background-color: #ff6f3c;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #e4571e;
        }

        .logout {
            text-align: center;
            margin-top: 20px;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .status-unpaid {
            color: red;
            font-weight: bold;
        }

        @media (max-width: 768px) {

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead {
                display: none;
            }

            td {
                position: relative;
                padding-left: 50%;
                text-align: left;
            }

            td::before {
                position: absolute;
                top: 12px;
                left: 12px;
                font-weight: bold;
                content: attr(data-label);
            }
        }
    </style>
</head>

<body>

    <h2>Welcome Admin - Order History</h2>

    <form method="get" class="filters">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search customer/product">
        <select name="filter">
            <option value="">All</option>
            <option value="Paid" <?= $filter === 'Paid' ? 'selected' : '' ?>>Paid</option>
            <option value="Unpaid" <?= $filter === 'Unpaid' ? 'selected' : '' ?>>Unpaid</option>
        </select>
        <button type="submit" class="btn">Apply</button>
        <button type="button" class="btn" onclick="toggleDarkMode()">🌙 Toggle Dark</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Total ($)</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) {
                $isPaid = $row['pay'] === 'Paid';
            ?>
                <tr class="<?= $isPaid ? 'paid' : 'unpaid' ?>">
                    <td data-label="ID"><?= htmlspecialchars($row['id']) ?></td>
                    <td data-label="Customer"><?= htmlspecialchars($row['customer_name']) ?></td>
                    <td data-label="Product"><?= htmlspecialchars($row['product_name']) ?></td>
                    <td data-label="Qty"><?= htmlspecialchars($row['quantity']) ?></td>
                    <td data-label="Total"><?= htmlspecialchars($row['total_price']) ?></td>
                    <td data-label="Date"><?= htmlspecialchars($row['order_date']) ?></td>
                    <td data-label="Status" class="<?= $isPaid ? 'status-paid' : 'status-unpaid' ?>">
                        <?= htmlspecialchars($row['pay']) ?>
                    </td>
                    <td data-label="Action">
                        <?php if (!$isPaid) { ?>
                            <form method="post" action="update_payment_status.php" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                                <input type="submit" name="mark_paid" value="Mark as Paid"
                                    onclick="return confirm('Confirm marking this order as Paid?');"
                                    class="btn" style="background-color: green;">
                            </form>
                        <?php } else { ?>
                            <span style="color:gray;">✔ Paid</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="logout">
        <a href="logout.php" class="btn">Logout</a>
    </div>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle("dark");
            localStorage.setItem("darkMode", document.body.classList.contains("dark"));
        }

        if (localStorage.getItem("darkMode") === "true") {
            document.body.classList.add("dark");
        }
    </script>
</body>

</html>