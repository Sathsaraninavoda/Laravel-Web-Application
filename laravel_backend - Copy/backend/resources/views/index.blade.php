<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thambapanni Sobha | Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }
    .hero {
      background-image: url('{{ asset('assets/slide1_yaka.jpg') }}');
      background-size: cover;
      background-position: center;
      height: 60vh;
     
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .hero h1 {
      font-size: 48px;
      font-weight: bold;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
    }
    .category-card {
      transition: transform 0.3s ease;
    }
    .category-card:hover {
      transform: scale(1.03);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    footer {
      background-color: #212529;
      color: white;
      padding: 20px 0;
    }
  </style>
</head>
<body>

<!-- Navbar  -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(to right, #0d6efd, #198754);">
  <div class="container">
    <!-- Brand Logo + Name -->
    <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
      
      Thambapanni Sobha
    </a>

    <!-- Mobile Menu Toggle Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHome">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarHome">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link text-white" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('products') }}">Products</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('contact') }}">Contact</a></li>
         <li class="nav-item"><a class="nav-link text-white" href="{{ route('cart') }}">Cart</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Login</a></li>
      </ul>
    </div>
  </div>
</nav>


<!-- Hero Section with Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <img src="{{ asset('assets/yaka2.jpg') }}"   class="d-block w-100" alt="Heritage Products" style="height: 90vh; object-fit: cover;">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="text-shadow">Welcome to Thambapanni Sobha</h1>
        <p>Discover the beauty of Sri Lankan culture and heritage products</p>
        <a href="{{ route('products') }}" class="btn btn-primary mt-3">Shop Now</a>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <img src="{{ asset('assets/culturalart.JPG') }}"   class="d-block w-100" alt="Cultural Crafts" style="height: 90vh; object-fit: cover;">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="text-shadow">Support Local Artisans</h1>
        <p>Explore handmade crafts, tea, spices, and more</p>
        <a href="{{ route('products') }}" class="btn btn-primary mt-3">Browse Products</a>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <img src="{{ asset('assets/ayurvedic.jpg') }}" class="d-block w-100" alt="Ayurvedic" style="height: 90vh; object-fit: cover;">
      <div class="carousel-caption d-none d-md-block">
        <h1 class="text-shadow">Natural & Authentic</h1>
        <p>Pure Ayurvedic and eco-friendly Sri Lankan products</p>
        <a href="{{ route('products') }}" class="btn btn-primary mt-3">Learn More</a>
      </div>
    </div>

  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>


<!-- Categories -->
<section class="py-5">
  <div class="container">
    <h2 class="mb-4 text-center">Categories</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card category-card">
          <img src="{{ asset('assets/Ceylon Spices.jpg') }}" class="card-img-top" style="height: 200px;object-fit: cover;" class="card-img-top" alt="Spices">
          <div class="card-body text-center">
            <h5 class="card-title">Ceylon Spices</h5>
            <a href="{{ route('spices') }}" class="btn btn-outline-primary btn-sm">Explore</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card category-card">
          <img src="{{ asset('assets/Handicrafts.jpg') }}" class="card-img-top" style="height: 200px;object-fit: cover;" class="card-img-top" alt="Handicrafts">
          <div class="card-body text-center">
            <h5 class="card-title">Handicrafts</h5>
            <a href="{{ route('handicraft') }}" class="btn btn-outline-primary btn-sm">Explore</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card category-card">
          <img src="{{ asset('assets/Ayurvedic Products.jpg') }}" class="card-img-top" style="height: 200px;object-fit: cover;"  class="card-img-top" alt="Ayurveda">
          <div class="card-body text-center">
            <h5 class="card-title">Ayurvedic Products</h5>
            <a href="{{ route('ayurvedic') }}" class="btn btn-outline-primary btn-sm">Explore</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


      <!-- Featured Products Section -->
<section class="py-5 bg-light" id="featured-products">
  <div class="container">
    <h2 class="mb-4 text-center">Featured Products</h2>
    <div class="row g-4">

      <!-- Product 1 -->
      <div class="col-md-3">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('assets/Ceylon Spices_f.jpg') }}" class="card-img-top" style="height: 200px;object-fit: cover;" class="card-img-top" alt="Spices">
          <div class="card-body">
            <h5 class="card-title">Ceylon Spices</h5>
            <p class="card-text">Authentic Sri Lankan spices sourced from local farms.</p>
            <a href="{{ route('products') }}" class="btn btn-primary w-100">Buy Now</a>
          </div>
        </div>
      </div>

      <!-- Product 2 -->
      <div class="col-md-3">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('assets/belimaltea.jpg') }}" class="card-img-top" style="height: 200px;object-fit: cover;" class="card-img-top" alt="Ceylon Tea">
          <div class="card-body">
            <h5 class="card-title">Belimal Tea</h5>
            <p class="card-text">World-famous Ceylon tea with rich aroma and taste.</p>
            <a href="{{ route('products') }}" class="btn btn-primary w-100">Buy Now</a>
          </div>
        </div>
      </div>

      <!-- Product 3 -->
      <div class="col-md-3">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('assets/Wooden Handicrafts.jpg') }}" class="card-img-top" style="height: 200px;object-fit: cover;"  class="card-img-top" alt="Handicraft">
          <div class="card-body">
            <h5 class="card-title">Wooden Handicrafts</h5>
            <p class="card-text">Handcrafted wooden items from Sri Lankan artisans.</p>
            <a href="{{ route('products') }}" class="btn btn-primary w-100">Buy Now</a>
          </div>
        </div>
      </div>

      <!-- Product 4 -->
      <div class="col-md-3">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('assets/Ayurvedic Oils.jpg') }}" class="card-img-top" style="height: 200px;object-fit: cover;"  class="card-img-top" alt="Ayurvedic Product">
          <div class="card-body">
            <h5 class="card-title">Ayurvedic Oils</h5>
            <p class="card-text">Traditional herbal oils for wellness and healing.</p>
            <a href="{{ route('products') }}" class="btn btn-primary w-100">Buy Now</a>
          </div>
        </div>
      </div>

      <!-- Product 5 -->
      <div class="col-md-3">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('assets/Batik Wear.jpg') }}" class="card-img-top" style="height: 200px;object-fit: cover;" class="card-img-top" alt="Batik">
          <div class="card-body">
            <h5 class="card-title">Batik Wear</h5>
            <p class="card-text">Colorful batik clothing handcrafted in Sri Lanka.</p>
            <a href="{{ route('products') }}" class="btn btn-primary w-100">Buy Now</a>
          </div>
        </div>
      </div>

      <!-- Product 6 -->
      <div class="col-md-3">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('assets/Traditional Jewelry.jpg') }}" class="card-img-top" style="height: 200px;object-fit: cover;"  class="card-img-top" alt="Jewelry">
          <div class="card-body">
            <h5 class="card-title">Traditional Jewelry</h5>
            <p class="card-text">Ethnic jewelry inspired by Sri Lankan heritage.</p>
            <a href="{{ route('products') }}" class="btn btn-primary w-100">Buy Now</a>
          </div>
        </div>
      </div>
 <!-- Add more products here -->
    </div>
  </div>
</section>

<!-- About Us Section -->
<section class="py-5" id="about">
  <div class="container">
    <h2 class="mb-4 text-center">About Us</h2>
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="{{ asset('assets/aboutus1.jpg') }}" alt="About Thambapanni Sobha" class="img-fluid rounded shadow">
      </div>
      <div class="col-md-6 mt-4 mt-md-0">
        <p>
          <strong>Thambapanni Sobha</strong> is a digital marketplace designed to promote and empower Sri Lanka's rich cultural heritage.
          Our platform helps local artisans, spice growers, and traditional product vendors connect with a wider audience both locally and globally.
        </p>
        <p>
          From handcrafted goods to Ayurvedic products, we provide a space where tradition meets technology. We aim to preserve culture,
          support small businesses, and bring authentic Sri Lankan craftsmanship into the spotlight through an accessible and secure web-based platform.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-outline-primary mt-3">Contact Us</a>
         
      </div>
    </div>
  </div>
</section>


<!-- Footer -->
<footer class="text-center">
  <div class="container">
    <p>© 2025 Thambapanni Sobha. All rights reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

