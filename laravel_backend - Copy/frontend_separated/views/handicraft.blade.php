<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Thambapanni Sobha - Sri Lankan Heritage Products</title>
    {{-- Link to your custom CSS file, located in public/css --}}
    <link rel="stylesheet" href="{{ asset('catagary.css') }}" />
</head>
<body>

<header class="header">
    <div class="header-content">
        {{-- Link to your home page using a named route 'home' --}}
        <div class="logo"><a href="{{ route('home') }}" style="text-decoration: none; color: inherit;">🏛️ Thambapanni Sobha</a></div>
        <div class="nav-buttons">
            {{-- Optional: Add other navigation buttons here if they link to Laravel routes --}}
            {{-- Example: <a href="{{ route('cart') }}" class="btn">View Cart</a> --}}
            {{-- Example: <a href="{{ route('products.all') }}" class="btn">All Products</a> --}}
        </div>
    </div>
</header>

<div id="handicrafts" class="category-section handicrafts active">
    <div class="category-header">
        <h1 class="category-title">Traditional Handicrafts</h1>
        <p class="category-subtitle">Celebrate Sri Lankan artistry with our handcrafted treasures, each piece telling a story of centuries-old traditions and skilled craftsmanship.</p>
    </div>

    <div class="products-grid">
        <div class="product-card">
            {{-- Background image path using asset() helper --}}
            <div class="product-image" style="background-image: linear-gradient(45deg, #2ecc71, #27ae60), url('{{ asset('images/yakwishlist.jpg') }}');"></div>
            <div class="product-badge">Handmade</div>
            <div class="product-content">
                <h3 class="product-name">Traditional Devil Mask</h3>
                <p class="product-description">Authentic Kolam mask carved from kaduru wood, representing the rich tradition of Sri Lankan dance and theater.</p>
                <div class="product-features">
                    <span class="feature-tag">Kaduru Wood</span>
                    <span class="feature-tag">Hand Painted</span>
                    <span class="feature-tag">Cultural Heritage</span>
                </div>
                <div class="product-price">$85.00</div>
                {{-- If this button submits a form or navigates, adjust its action here --}}
                <button class="btn-primary">Add to Cart</button>
            </div>
        </div>

        <div class="product-card">
            {{-- Background image path using asset() helper --}}
            <div class="product-image" style="background-image: linear-gradient(45deg, #2ecc71, #27ae60), url('{{ asset('images/oil_lamp.jpg') }}');"></div>
            <div class="product-badge">Artisan Made</div>
            <div class="product-content">
                <h3 class="product-name">Brass Oil Lamp</h3>
                <p class="product-description">Traditional brass oil lamp (pahana) with intricate engravings, perfect for ceremonies and home decoration.</p>
                <div class="product-features">
                    <span class="feature-tag">Pure Brass</span>
                    <span class="feature-tag">Engraved</span>
                    <span class="feature-tag">Ceremonial</span>
                </div>
                <div class="product-price">$45.25</div>
                <button class="btn-primary">Add to Cart</button>
            </div>
        </div>

        <div class="product-card">
            {{-- Background image path using asset() helper --}}
            <div class="product-image" style="background-image: linear-gradient(45deg, #2ecc71, #27ae60), url('{{ asset('images/bathik.jpg') }}');"></div>
            <div class="product-badge">Original</div>
            <div class="product-content">
                <h3 class="product-name">Batik Wall Hanging</h3>
                <p class="product-description">Vibrant batik artwork depicting traditional Sri Lankan elephants, created using authentic wax-resist dyeing techniques.</p>
                <div class="product-features">
                    <span class="feature-tag">Hand Dyed</span>
                    <span class="feature-tag">Natural Dyes</span>
                    <span class="feature-tag">Unique Design</span>
                </div>
                <div class="product-price">$65.50</div>
                <button class="btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

{{-- Link to your custom JavaScript file, located in public/js --}}
<script src="{{ asset('js/catagary.js') }}"></script>
</body>
</html>