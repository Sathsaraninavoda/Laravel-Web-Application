<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thambapanni Sobha - Sri Lankan Heritage Products</title>
    {{-- Link to your custom CSS file, located in public/css --}}
    <link rel="stylesheet" href="{{ asset('catagary.css') }}">
</head>
<body>
    <header class="header">
        <div class="header-content">
            {{-- Link to your home page using a named route 'home' --}}
            <div class="logo"><a href="{{ route('home') }}" style="text-decoration: none; color: inherit;">🏛️ Thambapanni Sobha</a></div>
            <div class="nav-buttons">
                {{-- Optional: Add other navigation buttons here if they link to Laravel routes --}}
                {{-- Example: <a href="{{ route('cart') }}" class="btn">View Cart</a> --}}
            </div>
        </div>
    </header>

    <div id="spices" class="category-section spices active">
        <div class="category-header">
            <h1 class="category-title">Sri Lankan Spices</h1>
            <p class="category-subtitle">Discover the authentic flavors of Ceylon with our premium collection of traditional spices, sourced directly from local farmers and spice gardens.</p>
        </div>

        <div class="products-grid">
            <div class="product-card">
                {{-- Background image path using asset() helper --}}
                <div class="product-image" style="background-image: linear-gradient(45deg, rgba(255, 53, 255, 0.3), rgba(241, 239, 236, 0.3)), url('{{ asset('images/cinnamon-sticks.jpg') }}');"></div>
                <div class="product-badge">Organic</div>
                <div class="product-content">
                    <h3 class="product-name">Ceylon Cinnamon Sticks</h3>
                    <p class="product-description">Authentic Ceylon cinnamon with its distinctive sweet and delicate flavor, harvested from the hills of Kandy.</p>
                    <div class="product-features">
                        <span class="feature-tag">100% Natural</span>
                        <span class="feature-tag">Premium Grade</span>
                        <span class="feature-tag">Fair Trade</span>
                    </div>
                    <div class="product-price">$24.99</div>
                    {{-- If this button submits a form or navigates, adjust its action here --}}
                    <button class="btn-primary">Add to Cart</button>
                </div>
            </div>

            <div class="product-card">
                {{-- Background image path using asset() helper --}}
                <div class="product-image" style="background-image: linear-gradient(45deg, rgba(255, 53, 255, 0.3), rgba(241, 239, 236, 0.3)), url('{{ asset('images/blackpepper.jpg') }}');"></div>
                <div class="product-badge">Best Seller</div>
                <div class="product-content">
                    <h3 class="product-name">Ceylon Black Pepper</h3>
                    <p class="product-description">Hand-picked peppercorns from the Western Province, known for their intense aroma and bold flavor profile.</p>
                    <div class="product-features">
                        <span class="feature-tag">Whole Peppercorns</span>
                        <span class="feature-tag">High Piperine</span>
                        <span class="feature-tag">Export Quality</span>
                    </div>
                    <div class="product-price">$18.50</div>
                    <button class="btn-primary">Add to Cart</button>
                </div>
            </div>

            <div class="product-card">
                {{-- IMPORTANT: Changed the local file path to use asset() helper.
                    You MUST place 'cardamom.jpg' in your public/images/ directory. --}}
                <div class="product-image" style="background-image: linear-gradient(45deg, rgba(255, 53, 255, 0.3), rgba(241, 239, 236, 0.3)), url('{{ asset('images/cardamom.jpg') }}');"></div>
                <div class="product-badge">Rare</div>
                <div class="product-content">
                    <h3 class="product-name">Ceylon Cardamom Pods</h3>
                    <p class="product-description">Green cardamom pods from the cool highlands, prized for their intense fragrance and medicinal properties.</p>
                    <div class="product-features">
                        <span class="feature-tag">Highland Grown</span>
                        <span class="feature-tag">Premium Size</span>
                        <span class="feature-tag">Aromatic</span>
                    </div>
                    <div class="product-price">$32.75</div>
                    <button class="btn-primary">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Link to your custom JavaScript file, located in public/js --}}
    <script src="{{ asset('js/catagary.js') }}"></script>
</body>
</html>