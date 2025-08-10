<?php
$page_title = "Bonsai Studio – Full Service AI Agency";
?>
<?php require_once('header.php'); ?>
<?php
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
  <section class="hero glass-gradient">
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
            video.playbackRate = 1.3;
          });
          video.addEventListener('pause', function() {
            var logo = document.querySelector('.logo-image');
            var bonsaiImg = document.querySelector('.hero-bonsai-image');
            // Temporarily show logo for position calculation
            logo.style.visibility = 'visible';
            logo.style.opacity = '1';
            var videoRect = video.getBoundingClientRect();
            var logoRect = logo.getBoundingClientRect();
            var offsetX = logoRect.left + logoRect.width/2 - (videoRect.left + videoRect.width/2);
            var offsetY = logoRect.top + logoRect.height/2 - (videoRect.top + videoRect.height/2);

            video.style.setProperty('--logo-x', offsetX - 1000 +'px');
            video.style.setProperty('--logo-y', offsetY - 400 + 'px');
            video.classList.add('shrink-fade-to-logo');
            setTimeout(function() {
              header.classList.add('slide-up');
              logo.classList.remove('hide');
              video.classList.add('hide');
              document.querySelector('.hero-text').classList.remove('hide');
            }, 200); // 200ms to match animation duration
          });
          video.addEventListener('timeupdate', function() {
            if (video.duration && video.currentTime >= video.duration - 1.5) {
              video.pause();
            }
          });
        });
      </script>
      <div class="hero-text hide frosted-glass" style="height: 400px">
        <h2>Homegrown AI Solutions Shaped For You</h2>
        <h3>On-demand, flexible and deeply customized AI solutions that deliver results - fast</h3>
        <p>Bonsai Studio is a full service AI agency that crafts AI solutions to deliver meaningful outcomes for you and your business. 
        Grow with purpose toward your goals and prune the distraction. We are a full-service AI consultancy that designs and deploys bespoke
        AI workflows and agents to solve your business challenges. We don’t use templates. We create tailored solutions that understand 
        your goals, adapt to your data, and get the job done. No tech jargon. No guesswork. Just results.</p>
      </div>
    </section>
    <section class="services glass">
      <h2>Featured AI Services</h2>
      <div class="card-container">
        <?php foreach ($selected as $service): ?>
          <div class="service-card glass">
            <h3><?= htmlspecialchars($service['title']) ?></h3>
            <span class="service-category filter-buttons">
             <a href="services-catalog.php?category=<?= urlencode($service['category']) ?>"><?= htmlspecialchars($service['category']) ?> <i class="fas fa-tag"></i></a>
            </span>
            <p class="services"><?= htmlspecialchars($service['short_description']) ?></p>
            <a href="services.php?slug=<?= urlencode($service['slug']) ?>" class="cta-button" style="margin-top:1rem;display:inline-block;">View Service</a>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
    
  <section class="benefits glass">
    <div class="container">
      <h2>Why Choose Us?</h2>
      <div class="benefit-carousel">
        <div class="benefit">
          <span class="material-symbols-outlined">handshake</span>
          <h4>We Meet You Where You Are</h4>
          <p>Whether you're brand new to the world of AI Solutions or looking to optimize your existing workflows, we build strong foundations from existing infrastructure. Bring your own models, agents and let us shape them for you. Compatible with tools like N8N, LangChain, LangGraph, Autogen, and many more agent setups. Define multi-agent flows with clarity and control. Seamlessly integrate your existing AI models into our workflows. We support a wide range of model types and configurations, ensuring you can leverage your preferred tools and technologies.</p>
        </div>
        <div class="benefit">
          <span class="material-symbols-outlined">acute</span>
          <h4>Fast Turnaround</h4>
          <p>Get your AI solutions up and running quickly without sacrificing quality. Our streamlined processes ensure rapid deployment and iteration.</p>
        </div>
        <div class="benefit">
          <span class="material-symbols-outlined">concierge</span>
          <h4>Custom Logic, Every Time</h4>
          <p>We understand that every business is unique. That's why we build custom logic into every solution, ensuring it fits your specific needs and 
            workflows. Each output is grounded in your needs and data. Not some generic prompt. You decide what goes in and what comes out.</p>
        </div>
        <div class="benefit">
          <span class="material-symbols-outlined">host</span>
          <h4>Cloud or Local</h4>
          <p>Choose the deployment option that best fits your needs. Whether you prefer cloud-based solutions to leverage the latest frontier models, opt for local installations such as containerized environments to ensure the utmost privacy and security or get the best of both worlds in one seamless package.</p>
        </div>
      </div>
    </div>
    <a href="services-catalog.php" class="cta-button">Browse Ready-To-Launch AI Services</a>
  </section>
<?php require_once('footer.php'); ?>