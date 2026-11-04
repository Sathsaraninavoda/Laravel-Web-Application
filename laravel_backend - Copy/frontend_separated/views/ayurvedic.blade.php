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

<div id="ayurvedic" class="category-section ayurvedic active">
    <div class="category-header">
        <h1 class="category-title">Ayurvedic Products</h1>
        <p class="category-subtitle">Embrace natural wellness with our authentic Ayurvedic products, formulated using traditional recipes and pure Sri Lankan herbs.</p>
    </div>

    <div class="products-grid">
        <div class="product-card">
            {{-- The SVG data URL is kept as is, as asset() is not for inline data --}}
            <div class="product-image" style="background-image: linear-gradient(45deg, #9b59b6, #8e44ad), url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2260%22>🌿</text></svg>');"></div>
            <div class="product-badge">Pure</div>
            <div class="product-content">
                <h3 class="product-name">Neem & Turmeric Face Oil</h3>
                <p class="product-description">Natural face oil blended with neem and turmeric, traditionally used for clear and radiant skin complexion.</p>
                <div class="product-features">
                    <span class="feature-tag">Chemical Free</span>
                    <span class="feature-tag">Traditional Recipe</span>
                    <span class="feature-tag">Anti-aging</span>
                </div>
                <div class="product-price">$28.90</div>
                {{-- If this button submits a form or navigates, adjust its action here --}}
                <button class="btn-primary">Add to Cart</button>
            </div>
        </div>

        <div class="product-card">
            {{-- The SVG data URL is kept as is --}}
            <div class="product-image" style="background-image: linear-gradient(45deg, #9b59b6, #8e44ad), url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2260%22>🍵</text></svg>');"></div>
            <div class="product-badge">Wellness</div>
            <div class="product-content">
                <h3 class="product-name">Herbal Detox Tea</h3>
                <p class="product-description">Cleansing herbal blend with gotukola, beli leaves, and other indigenous herbs for natural body detoxification.</p>
                <div class="product-features">
                    <span class="feature-tag">Detoxifying</span>
                    <span class="feature-tag">Caffeine Free</span>
                    <span class="feature-tag">Organic</span>
                </div>
                <div class="product-price">$22.40</div>
                <button class="btn-primary">Add to Cart</button>
            </div>
        </div>

        <div class="product-card">
            {{-- The SVG data URL is kept as is --}}
            <div class="product-image" style="background-image: linear-gradient(45deg, #9b59b6, #8e44ad), url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2260%22>💊</text></svg>');"></div>
            <div class="product-badge">Premium</div>
            <div class="product-content">
                <h3 class="product-name">Ashwagandha Capsules</h3>
                <p class="product-description">Pure ashwagandha root extract capsules for stress relief and enhanced vitality, processed using traditional methods.</p>
                <div class="product-features">
                    <span class="feature-tag">Stress Relief</span>
                    <span class="feature-tag">Natural Extract</span>
                    <span class="feature-tag">Lab Tested</span>
                </div>
                <div class="product-price">$35.75</div>
                <button class="btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

{{-- Link to your custom JavaScript file, located in public/js --}}
<script src="{{ asset('js/catagary.js') }}"></script>

</body>
</html>