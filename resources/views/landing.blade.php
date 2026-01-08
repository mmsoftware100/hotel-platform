<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Hotel Platform</title>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      background: #f8f9fa;
    }
    .landing-container {
      height: 100vh;
    }
  </style>
</head>
<body>
  <div class="container-fluid d-flex justify-content-center align-items-center landing-container">
    <div class="text-center">
      <h1 class="display-4 fw-bold">Welcome to HotelEase</h1>
      <p class="lead text-muted mb-4">Book the best hotels at unbeatable prices.</p>
      <a href="#" class="btn btn-primary btn-lg me-2">Get Started</a>
      <a href="#" class="btn btn-outline-secondary btn-lg">Learn More</a>
    </div>
  </div>

  <!-- Minimal JS (no external CDN) -->
  <script>/* lightweight placeholder for landing interactions */</script>
</body>
</html>
