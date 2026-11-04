<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thambapanni Sobha - Sri Lankan Heritage Products</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('product.css') }}">
</head>
<body>
    
    <div class="floating-elements">
        <i class="fas fa-leaf"></i>
    </div>

    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">
                        <i class="fas fa-gem me-3"></i>
                        Thambapanni Sobha
                    </h1>
                    <p class="lead mb-4">Discover the authentic beauty of Sri Lankan heritage through our curated collection of traditional crafts, spices, tea, and Ayurvedic treasures.</p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-light btn-lg rounded-pill px-4">
                            <i class="fas fa-compass me-2"></i>Explore Collection
                        </button>
                        <button class="btn btn-outline-light btn-lg rounded-pill px-4">
                            <i class="fas fa-heart me-2"></i>Our Heritage
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="stats-card">
                        <h3 class="text-primary fw-bold">500+</h3>
                        <p class="mb-0">Authentic Products</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="heritage-pattern">
        <div class="container">
            <div class="category-filter">
                <h5 class="mb-3 text-center">
                    <i class="fas fa-filter me-2"></i>Browse by Category
                </h5>
                <div class="text-center">
                    <button class="btn filter-btn active">
                        <i class="fas fa-star me-2"></i>All Products
                    </button>
                   <a href="{{ route('spices') }}" class="btn filter-btn">
                        <i class="fas fa-seedling me-2"></i>Spices
                    </a>
                    <a href="{{ route('ayurvedic') }}" class="btn filter-btn">
                        <i class="fas fa-spa me-2"></i>Ayurvedic
                    </a>
                    <a href="{{ route('handicraft') }}" class="btn filter-btn">
                        <i class="fas fa-palette me-2"></i>Handicrafts
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="section-title">Featured Heritage Products</h2>
            
            <!-- Products Grid -->
        <div class="row">
            <!-- Product 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="product-card position-relative">
                    <div class="product-badge">New</div>
                    <img src="{{ asset('assets/ceylonblacktea.jpg') }}" 
                         alt="Ceylon Tea" class="product-image">
                    <div class="product-info">
                        <div class="product-category">
                            <i class="fas fa-leaf me-1"></i>Premium Tea
                        </div>
                        <h3 class="product-title">Ceylon Black Tea Premium</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="ms-2 text-muted">(24 reviews)</span>
                        </div>
                        <div class="product-price">$24.99</div>
                        <p class="product-description">
                            Authentic Ceylon black tea from the highlands of Sri Lanka. Rich, aromatic, and perfectly balanced.
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-fill">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="product-card position-relative">
                    <div class="product-badge">Popular</div>
                    <img src="{{ asset('assets/cinnamon.jpg') }}" 
                         alt="Ceylon Cinnamon" class="product-image">
                    <div class="product-info">
                        <div class="product-category">
                            <i class="fas fa-seedling me-1"></i>Spices
                        </div>
                        <h3 class="product-title">Ceylon Cinnamon Sticks</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="ms-2 text-muted">(31 reviews)</span>
                        </div>
                        <div class="product-price">$18.50</div>
                        <p class="product-description">
                            True Ceylon cinnamon sticks with delicate sweet flavor. Perfect for cooking and baking.
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-fill">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="product-card position-relative">
                    <img src="{{ asset('assets/TraditionalHandwovenBasket.jpg') }}" 
                         alt="Handwoven Basket" class="product-image">
                    <div class="product-info">
                        <div class="product-category">
                            <i class="fas fa-palette me-1"></i>Handicrafts
                        </div>
                        <h3 class="product-title">Traditional Handwoven Basket</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="ms-2 text-muted">(18 reviews)</span>
                        </div>
                        <div class="product-price">$32.00</div>
                        <p class="product-description">
                            Beautifully crafted traditional basket made by local artisans using sustainable materials.
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-fill">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-lg-4 col-md-6">
                <div class="product-card position-relative">
                    <div class="product-badge">Sale</div>
                    <img src="{{ asset('assets/herbaleoil.jpg') }}" 
                         alt="Ayurvedic Oil" class="product-image">
                    <div class="product-info">
                        <div class="product-category">
                            <i class="fas fa-spa me-1"></i>Ayurvedic Products
                        </div>
                        <h3 class="product-title">Herbal Massage Oil</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="ms-2 text-muted">(42 reviews)</span>
                        </div>
                        <div class="product-price">
                            $28.99 <span class="text-muted text-decoration-line-through">$35.99</span>
                        </div>
                        <p class="product-description">
                            Traditional Ayurvedic herbal oil blend for relaxation and therapeutic massage.
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-fill">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 5 -->
            <div class="col-lg-4 col-md-6">
                <div class="product-card position-relative">
                    <img src="{{ asset('assets/CarvedWoodenElephant.jpg') }}" 
                         alt="Wooden Elephant" class="product-image">
                    <div class="product-info">
                        <div class="product-category">
                            <i class="fas fa-palette me-1"></i>Handicrafts
                        </div>
                        <h3 class="product-title">Carved Wooden Elephant</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="ms-2 text-muted">(15 reviews)</span>
                        </div>
                        <div class="product-price">$45.00</div>
                        <p class="product-description">
                            Intricately carved wooden elephant sculpture representing Sri Lankan cultural heritage.
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-fill">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product 6 -->
            <div class="col-lg-4 col-md-6">
                <div class="product-card position-relative">
                    <img src="{{ asset('assets/AuthenticCurrySpiceMix.jpg') }}" 
                         alt="Spice Mix" class="product-image">
                    <div class="product-info">
                        <div class="product-category">
                            <i class="fas fa-seedling me-1"></i>Spices
                        </div>
                        <h3 class="product-title">Authentic Curry Spice Mix</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="ms-2 text-muted">(38 reviews)</span>
                        </div>
                        <div class="product-price">$16.75</div>
                        <p class="product-description">
                            Authentic Sri Lankan curry spice blend with traditional herbs and spices.
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary flex-fill">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/product.js') }}"></script>
</body>
</html>

