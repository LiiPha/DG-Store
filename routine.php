    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Routine | Maison D&G Store</title>
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

            #Routine,
            h2 {
                text-align: center;
                margin-top: 40px;
                font-size: 2rem;
            }

            .product-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
                gap: 24px;
                padding: 30px;
                max-width: 1200px;
                margin: auto;
            }

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
                font-size: 0.8em;
                color: #888;
                margin-bottom: 6px;
                letter-spacing: 0;
            }

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

        <div id="Routine">
            <h2>Routine</h2>
            <p>Discover the latest fashion trends and shop online at Routine.</p>

            <h2>Latest Accessories</h2>
            <div class="product-grid">
                <div class="product-card">
                    <img src="braclete/bracelet.png" alt="Bracelet">
                    <h3>Bracelet</h3>
                    <span class="product-code">Code: ZD017</span>
                    <p>$6.99</p>
                    <form action="order.php" method="POST">
                        <input type="hidden" name="ProductCode" value="ZD017">
                        <input type="hidden" name="ProName" value="Bracelet">
                        <input type="hidden" name="Price" value="6.99">
                        <button type="submit" class="order">Order</button>
                        <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                    </form>
                </div>

                <div class="product-card">
                    <img src="braclete/neckless1.png" alt="Neckless">
                    <h3>Neckless</h3>
                    <span class="product-code">Code: ZD018</span>
                    <p>$8.99</p>
                    <form action="order.php" method="POST">
                        <input type="hidden" name="ProductCode" value="ZD018">
                        <input type="hidden" name="ProName" value="Neckless">
                        <input type="hidden" name="Price" value="8.99">
                        <button type="submit" class="order">Order</button>
                        <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                    </form>
                </div>

                <div class="product-card">
                    <img src="braclete/ring bracelet.png" alt="Ring Bracelet">
                    <h3>Ring Bracelet</h3>
                    <span class="product-code">Code: ZD019</span>
                    <p>$12.99</p>
                    <form action="order.php" method="POST">
                        <input type="hidden" name="ProductCode" value="ZD019">
                        <input type="hidden" name="ProName" value="Ring Bracelet">
                        <input type="hidden" name="Price" value="12.99">
                        <button type="submit" class="order">Order</button>
                        <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                    </form>
                </div>

                <div class="product-card">
                    <img src="braclete/siliver bracelet.png" alt="Silver Bracelet">
                    <h3>Silver Bracelet</h3>
                    <span class="product-code">Code: ZD020</span>
                    <p>$19.99</p>
                    <form action="order.php" method="POST">
                        <input type="hidden" name="ProductCode" value="ZD020">
                        <input type="hidden" name="ProName" value="Silver Bracelet">
                        <input type="hidden" name="Price" value="19.99">
                        <button type="submit" class="order">Order</button>
                        <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <h2>Rings</h2>
            <div class="product-grid">
                <div class="product-card">
                    <img src="rings/ring.png" alt="Black Diamond">
                    <h3>Black Diamond</h3>
                    <span class="product-code">Code: ZD021</span>
                    <p>$9.99</p>
                    <form action="order.php" method="POST">
                        <input type="hidden" name="ProductCode" value="ZD021">
                        <input type="hidden" name="ProName" value="Black Diamond">
                        <input type="hidden" name="Price" value="9.99">
                        <button type="submit" class="order">Order</button>
                        <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                    </form>
                </div>

                <div class="product-card">
                    <img src="rings/ring2.png" alt="Silver Ring">
                    <h3>Silver Ring</h3>
                    <span class="product-code">Code: ZD022</span>
                    <p>$6.99</p>
                    <form action="order.php" method="POST">
                        <input type="hidden" name="ProductCode" value="ZD022">
                        <input type="hidden" name="ProName" value="Silver Ring">
                        <input type="hidden" name="Price" value="6.99">
                        <button type="submit" class="order">Order</button>
                        <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                    </form>
                </div>
                <div class="product-card">
                    <img src="rings/ring3.png" alt="Black Ring">
                    <h3>Black Ring</h3>
                    <span class="product-code">Code: ZD023</span>
                    <p>$5.99</p>
                    <form action="order.php" method="POST">
                        <input type="hidden" name="ProductCode" value="ZD023">
                        <input type="hidden" name="ProName" value="Black Ring">
                        <input type="hidden" name="Price" value="5.99">
                        <button type="submit" class="order">Order</button>
                        <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                    </form>
                </div>
                <div class="product-card">
                    <img src="rings/ring4.png" alt="Titanium Black Ring">
                    <h3>Titanium Black Ring</h3>
                    <span class="product-code">Code: ZD024</span>
                    <p>$13.99</p>
                    <form action="order.php" method="POST">
                        <input type="hidden" name="ProductCode" value="ZD024">
                        <input type="hidden" name="ProName" value="Titanium Black Ring">
                        <input type="hidden" name="Price" value="13.99">
                        <button type="submit" class="order">Order</button>
                        <button type="submit" name="add_to_cart" class="order cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="next-page">
            <a href="zando.php">Zando</a>
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