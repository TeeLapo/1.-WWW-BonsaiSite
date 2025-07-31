<?php
include('db.php');
// Get all featured services
$stmt = $pdo->prepare("SELECT * FROM services");
$stmt->execute();
$services = $stmt->fetchAll();
// Randomly select 3
if (count($services) > 3) {
    $keys = array_rand($services, 3);
    $selected = [
        $services[$keys[0]],
        $services[$keys[1]],
        $services[$keys[2]]
    ];
} else {
    $selected = $services;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Bonsai App helps you create and explore branching AI prompt workflows, called prompt trees, for tasks like job searching, writing, research, and more." />
  <meta name="keywords" content="Bonsai App, Prompt Trees, AI Workflows, Job Search, Agentic AI, LangGraph, LLM, Orchestration" />
  <meta name="author" content="Taylor Laporte" />
  <title>BonsAI Studio – Full Service AI Agency</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" href="assets/images/favicon.png" />
</head>
<body>

  <header class="header hide" id="mainHeader">
    <div class="container">
      <img src="assets/bonsai.png" alt="Bonsai Studio Logo" class="logo-image">
      <h1 class="logo">Bonsai Studio</h1>
      <nav>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="services-catalog.php">Services</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero">
    <div class="container">
      <video autoplay muted class="hero-video" id="heroVideo">
        <source src="assets/BonsaiStudio Animation.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var video = document.getElementById('heroVideo');
          var header = document.getElementById('mainHeader');
          video.addEventListener('animationend', function() {
            video.style.opacity = 1;
          });
          video.addEventListener('pause', function() {
  video.classList.add('shrink-fade-out');
  setTimeout(function() {
    video.classList.add('hide');
    header.classList.remove('hide');
    header.classList.add('slide-up');
  }, 700); // match animation duration
});
          video.addEventListener('timeupdate', function() {
            if (video.duration && video.currentTime >= video.duration - 1) {
              video.pause();
            }
          });
        });
      </script>
      <h2>Homegrown AI Solutions Shaped For You</h2>
      <h3>On-demand, flexible and deeply customized AI solutions that deliver results - fast</h3>
      <p>Bonsai Studio is a full service AI agency that crafts AI solutions to deliver meaningful outcomes for you and your business. 
        Grow with purpose toward your goals and prune the distraction. We are a full-service AI consultancy that designs and deploys bespoke
        AI workflows and agents to solve your business challenges. We don’t use templates. We create tailored solutions that understand 
        your goals, adapt to your data, and get the job done. No tech jargon. No guesswork. Just results.</p>
      </div>
    </section>
    <section id="featured-services">
      <h2>Featured AI Services</h2>
      <div class="card-container">
        <?php foreach ($selected as $service): ?>
          <div class="service-card">
            <h3><?= htmlspecialchars($service['title']) ?></h3>
            <span class="service-category-pill">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#2d572c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:6px;"><path d="M20.59 13.41a2 2 0 0 0 0-2.82l-7.18-7.18a2 2 0 0 0-2.82 0l-5.18 5.18a2 2 0 0 0 0 2.82l7.18 7.18a2 2 0 0 0 2.82 0z"></path><path d="M7 7l3-3"></path></svg>
              <?= htmlspecialchars($service['category']) ?>
            </span>
            <p><?= htmlspecialchars($service['short_description']) ?></p>
            <a href="service.php?slug=<?= urlencode($service['slug']) ?>" class="cta-button" style="margin-top:1rem;display:inline-block;">View Service</a>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
    
  <section class="benefits">
    <div class="container">
      <h3>Key Benefits</h3>
      <div class="benefit-carousel">
        <div class="benefit">
          <h4>We Meet You Where You Are</h4>
          <p>Whether you're brand new to the world of AI Solutions or looking to optimize your existing workflows, we build strong foundations from existing infrastructure. Bring your own models, agents and let us shape them for you. Compatible with tools like N8n, LangChain, LangGraph, Autogen, and many more agent setups. Define multi-agent flows with clarity and control. Seamlessly integrate your existing AI models into our workflows. We support a wide range of model types and configurations, ensuring you can leverage your preferred tools and technologies.</p>
        </div>
        <div class="benefit">
          <h4>Fast Turnaround</h4>
          <p>Get your AI solutions up and running quickly without sacrificing quality. Our streamlined processes ensure rapid deployment and iteration.</p>
        </div>
        <div class="benefit">
          <h4>Custom Logic, Every Time</h4>
          <p>We understand that every business is unique. That's why we build custom logic into every solution, ensuring it fits your specific needs and 
            workflows. Each output is grounded in your needs and data. Not some generic prompt. You decide what goes in and what comes out.</p>
        </div>
        <div class="benefit">
          <h4>Cloud or Local</h4>
          <p>Choose the deployment option that best fits your needs. Whether you prefer cloud-based solutions to leverage the latest frontier models, opt for local installations such as containerized environments to ensure the utmost privacy and security or get the best of both worlds in one seamless package.</p>
        </div>
      </div>
    </div>
    <a href="services-catalog.php" class="cta-button">Browse Ready-To-Launch AI Services</a>
  </section>



  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 Bonsai App | Built for academic and educational use</p>
    </div>
  </footer>

</body>
</html>
