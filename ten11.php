<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ten11 | Maison D&G Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fffaf7;
            color: #333;
            line-height: 1.6;
        }

        /* Header */
        header {
            background-color: #ff8c66;
            color: white;
            padding: 20px 0;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2.4rem;
            transition: transform 0.3s ease;
        }

        header h1:hover {
            transform: scale(1.05);
        }

        /* Navigation */
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #222;
        }

        /* Headings */
        #Ten11,
        h2 {
            text-align: center;
            margin-top: 40px;
            font-size: 2rem;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
            padding: 30px;
            max-width: 1200px;
            margin: auto;
        }

        /* Product Card */
        .product-card {
            background-color: white;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .product-card h3 {
            font-size: 1.1rem;
            margin: 12px 0 5px;
        }

        .product-card p {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-code {
            display: block;
            font-size: 0.9em;
            color: #888;
            margin-bottom: 6px;
            letter-spacing: 1px;
        }

        /* Gradient Order Button */
        .order {
            background: linear-gradient(to right, #ff9472, #f2709c);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.4s ease, transform 0.2s;
        }

        .order:hover {
            background: linear-gradient(to right, #f2709c, #ff9472);
            transform: scale(1.05);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 25px;
            background-color: #111;
            color: white;
            margin-top: 50px;
            font-size: 14px;
        }

        footer a {
            color: #ffb395;
            margin: 0 8px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #fff;
        }

        /* Next Page */
        .next-page {
            text-align: center;
            margin: 50px auto;
        }

        .next-page a {
            display: inline-block;
            background: linear-gradient(to right, #f857a6, #ff5858);
            color: white;
            padding: 12px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s;
        }

        .next-page a:hover {
            background: linear-gradient(to right, #ff5858, #f857a6);
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            nav a {
                display: block;
                margin: 8px 0;
            }

            .product-grid {
                padding: 20px;
            }

            header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Maison D&G Store</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="#about">About</a>
            <a href="product.html">Product</a>
            <a href="contact.html">Contact</a>
            <a href="report.html">Report</a>
        </nav>
    </header>

    <div id="Ten11">
        <h1>Ten11</h1>
        <p>Discover the latest fashion trends and shop online at Ten11.</p>

        <h2>Latest Pants</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="pants/pants.png" alt="Black Pants">
                <h3>Black Pants</h3>
                <span class="product-code">Code: ZD009</span>
                <p>$29.99</p>
                <form action="order.php" method="POST">
                    <input type="hidden" name="ProductCode" value="ZD009">
                    <input type="hidden" name="ProName" value="Black Pants">
                    <input type="hidden" name="Price" value="29.99">
                    <button type="submit" class="order">Order</button>
                    <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                </form>
            </div>

            <div class="product-card">
                <img src="pants/pants2.png" alt="Blue Pants">
                <h3>Blue Pants</h3>
                <span class="product-code">Code: ZD010</span>
                <p>$34.99</p>
                <form action="order.php" method="POST">
                    <input type="hidden" name="ProductCode" value="ZD010">
                    <input type="hidden" name="ProName" value="Blue Pants">
                    <input type="hidden" name="Price" value="34.99">
                    <button type="submit" class="order">Order</button>
                    <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                </form>
            </div>

            <div class="product-card">
                <img src="pants/pants3.png" alt="White Pants">
                <h3>White Pants</h3>
                <span class="product-code">Code: ZD011</span>
                <p>$39.99</p>
                <form action="order.php" method="POST">
                    <input type="hidden" name="ProductCode" value="ZD011">
                    <input type="hidden" name="ProName" value="White Pants">
                    <input type="hidden" name="Price" value="39.99">
                    <button type="submit" class="order">Order</button>
                    <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                </form>
            </div>

            <div class="product-card">
                <img src="pants/pants4.png" alt="Gray Pants">
                <h3>Gray Pants</h3>
                <span class="product-code">Code: ZD012</span>
                <p>$24.99</p>
                <form action="order.php" method="POST">
                    <input type="hidden" name="ProductCode" value="ZD012">
                    <input type="hidden" name="ProName" value="Gray Pants">
                    <input type="hidden" name="Price" value="24.99">
                    <button type="submit" class="order">Order</button>
                    <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                </form>
            </div>
        </div>

        <h2>Pants for Girls</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="pants girl/pants.png" alt="Dark Green Pants">
                <h3>Dark Green Pants</h3>
                <span class="product-code">Code: ZD013</span>
                <p>$29.99</p>
                <form action="order.php" method="POST">
                    <input type="hidden" name="ProductCode" value="ZD013">
                    <input type="hidden" name="ProName" value="Dark Green Pants">
                    <input type="hidden" name="Price" value="29.99">
                    <button type="submit" class="order">Order</button>
                    <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                </form>
            </div>

            <div class="product-card">
                <img src="pants girl/pants2.png" alt="Wheat Pants">
                <h3>Wheat Pants</h3>
                <span class="product-code">Code: ZD014</span>
                <p>$24.99</p>
                <form action="order.php" method="POST">
                    <input type="hidden" name="ProductCode" value="ZD014">
                    <input type="hidden" name="ProName" value="Wheat Pants">
                    <input type="hidden" name="Price" value="24.99">
                    <button type="submit" class="order">Order</button>
                    <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                </form>
            </div>

            <div class="product-card">
                <img src="pants girl/pants3.png" alt="Black Pants">
                <h3>Black Pants</h3>
                <span class="product-code">Code: ZD015</span>
                <p>$19.99</p>
                <form action="order.php" method="POST">
                    <input type="hidden" name="ProductCode" value="ZD015">
                    <input type="hidden" name="ProName" value="Black Pants">
                    <input type="hidden" name="Price" value="19.99">
                    <button type="submit" class="order">Order</button>
                    <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                </form>
            </div>

            <div class="product-card">
                <img src="pants girl/pants5.png" alt="White Pants">
                <h3>White Pants</h3>
                <span class="product-code">Code: ZD016</span>
                <p>$34.99</p>
                <form action="order.php" method="POST">
                    <input type="hidden" name="ProductCode" value="ZD016">
                    <input type="hidden" name="ProName" value="White Pants">
                    <input type="hidden" name="Price" value="34.99">
                    <button type="submit" class="order">Order</button>
                    <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                </form>
            </div>
        </div>

        <div class="next-page">
            <a href="routine.php">Routine</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 DG Store. All rights reserved.</p>
        <p>
            <a href="https://web.facebook.com/lypha009" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a> |
            <a href="https://www.tiktok.com/@lyphaa20" target="_blank"><i class="fab fa-tiktok"></i> TikTok</a> |
            <a href="https://www.instagram.com/pha._.phaa" target="_blank"><i class="fab fa-instagram"></i> Instagram</a> |
            <a href="https://t.me/phaaphaaphaa" target="_blank"><i class="fab fa-telegram-plane"></i> Telegram</a>
        </p>
    </footer>
</body>

</html>