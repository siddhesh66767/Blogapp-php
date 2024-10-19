<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="path/to/favicon.png"> <!-- Add your favicon here -->
    <title>About Us</title>
</head>
<body>

<!-- Include Navbar -->
<?php include 'nav.php'; ?>

<!-- About Us Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="display-4">About Us</h1>
            <p class="lead">Welcome to <strong>My Blog</strong>, your go-to destination for insightful articles and the latest news on technology, lifestyle, health, and more!</p>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-lg-6">
            <h3>Our Mission</h3>
            <p>At My Blog, we strive to provide readers with informative, engaging, and well-researched content. Whether you're a tech enthusiast, food-conscious individual, or just someone who enjoys reading about various places/tours, we've got something for everyone about sports too.</p>
        </div>
        <div class="col-lg-6">
            <h3>What We Offer</h3>
            <ul>
                <li>Latest news and trends in technology.</li>
                <li>Health tips for food and lifestyle advice to help you lead a better life.</li>
                <li>Thought-provoking articles on a wide range of tours and travel.</li>
                <li>A platform for readers to interact through comments and discussions for the sports.</li>
            </ul>
        </div>
    </div>

    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .category-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .team-card img {
      border-radius: 50%;
      height: 100px;
      width: 100px;
      object-fit: cover;
    }

    .team-card {
      text-align: center;
      padding: 20px;
      margin-bottom: 20px;
    }

    .team-card h5 {
      margin-top: 10px;
      font-size: 18px;
    }

    .category-title {
      font-size: 24px;
      margin-bottom: 15px;
      text-align: center;
    }

    .about-header {
      background-color: #f8f9fa;
      padding: 40px 0;
      text-align: center;
    }
  </style>
</head>
<body>



<!-- Categories Section -->
<section class="container mt-5">
  <h2 class="category-title">Our Blog Categories</h2>
  <div class="row">
    <div class="col-md-3">
      <div class="card category-card">
        <img src="uploads/anti-aging-foods-stay-young-with-food.webp" alt="Food">
        <div class="card-body">
          <h5 class="card-title">Food</h5>
          <p class="card-text">Discover delicious recipes, tips, and food culture from around the world.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card category-card">
        <img src="uploads/images.jpeg" alt="Sports">
        <div class="card-body">
          <h5 class="card-title">Sports</h5>
          <p class="card-text">Stay updated with the latest sports news, analysis, and features.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card category-card">
        <img src="uploads/honey2-350x200.jpg" alt="Travel">
        <div class="card-body">
          <h5 class="card-title">Travel</h5>
          <p class="card-text">Explore travel guides, tips, and stunning destinations worldwide.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card category-card">
        <img src="uploads/steve-johnson-_0iV9LmPDn0-unsplash-1-scaled.webp" alt="Technology">
        <div class="card-body">
          <h5 class="card-title">Technology</h5>
          <p class="card-text">Get the latest updates on tech trends, gadgets, and innovations.</p>
        </div>
      </div>
    </div>
  </div>
</section>

    <div class="row mt-4">
        <div class="col-lg-12">
            
            
<section class="container mt-5">
  <h2 class="category-title">Meet Our Team</h2>
  <div class="row">
    <div class="col-md-3">
      <div class="card team-card">
        <img src="uploads/Screenshot 2024-10-14 211528.png" alt="Team Member">
        <h5>Siddhesh Panchal</h5>
        <p>Editor-in-Chief</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card team-card">
        <img src="uploads/Screenshot 2024-10-14 211628.png" alt="Team Member">
        <h5>Ravi Singh</h5>
        <p>Lead Writer</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card team-card">
        <img src="uploads/Screenshot 2024-10-14 211617.png" alt="Team Member">
        <h5>Nakul Gotad</h5>
        <p>Content Strategist</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card team-card">
        <img src="uploads/Screenshot 2024-10-14 211703.png" alt="Team Member">
        <h5>Santoshi Pale</h5>
        <p>Photographer</p>
      </div>
    </div>
  </div>
</section>
            <p>Our team consists of passionate writers and contributors who bring their unique perspectives to every article. We are dedicated to delivering quality content that resonates with our readers and keeps them coming back for more.</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <h3>Contact Us</h3>
            <p>We value your feedback and are always open to suggestions. If you have any questions, comments, or would like to contribute to our blog, feel free to <a href="contact.php">contact us</a>.</p>
        </div>
    </div>
</div>

<!-- Include Footer -->
<?php include 'foot.php'; ?>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

