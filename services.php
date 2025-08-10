<?php
$page_title = "Bonsai Studio – " . htmlspecialchars($service['title']);
?>
<?php require_once('header.php'); ?>
<?php
$slug = $_GET['slug'];
$stmt = $pdo->prepare("SELECT * FROM services WHERE slug = ?");
$stmt->execute([$slug]);
$service = $stmt->fetch();
if (!$service) {
    echo "Service not found.";
    exit;
}
?>
<?php
// Fetch service metrics for count chart
$stmt = $pdo->prepare("SELECT metric_name, metric_value, unit FROM service_metrics WHERE service_id = ?");
$stmt->execute([$service['id']]);
$metrics = $stmt->fetchAll(PDO::FETCH_ASSOC);

//shorthand to set empty arrays for each chart
$count_labels = $count_values = [];
$score_labels = $score_values = [];
$time_labels = $time_values = [];

foreach ($metrics as $metric) {
    if ($metric['unit'] === 'Percent') {
        $score_labels[] = $metric['metric_name'];
        $score_values[] = $metric['metric_value'];
    } elseif ($metric['unit'] === 'Minutes') {
        $time_labels[] = $metric['metric_name'];
        $time_values[] = $metric['metric_value'];
    } else {
        $count_labels[] = $metric['metric_name'];
        $count_values[] = $metric['metric_value'];
    }
}?>
        <section class="service-listing">
            <div class="service-panel">
                <a href="services-catalog.php">&larr; Back to Services</a>
                <h3>Trusted by Industry Leaders</h3>
                <div class="client-logos">
                    <?php // Fetch and display client logos using the junction table
                    $stmt = $pdo->prepare("
                        SELECT sc.logo_path, sc.client_name
                        FROM service_client_associations AS assoc
                        JOIN service_clients AS sc ON assoc.client_id = sc.id
                        WHERE assoc.service_id = ?
                    ");
                    $stmt->execute([$service['id']]);
                    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($clients as $client): ?>
                        <div class="client-logo">
                            <img src="<?php echo $client['logo_path']; ?>" alt="<?php echo $client['client_name']; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <h3>Our Services Deliver</h3>
                <canvas class="service-listing-chart" id="scoreChart"></canvas>
                <h3>Giving You The Gift Of Time</h3>
                <canvas class="service-listing-chart" id="timeChart"></canvas>
            </div>
            <div class="service-flex">
                <div class="service-header">
                  <img src ="<?php echo $service['icon_path']; ?>" alt="<?php echo $service['title']; ?>" class="service-icon">
                  <h2><?php echo $service['title']; ?></h2>
                </div>
                <div class="service-description">
                  <img src="<?php echo $service['image_path']; ?>" alt="<?php echo $service['title']; ?>" class="service-image">
                  <p><?php echo $service['long_description']; ?></p>
                </div>
                <canvas class="service-listing-chart" id="countChart"></canvas>
            </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx1 = document.getElementById('countChart').getContext('2d');
  const ctx2 = document.getElementById('scoreChart').getContext('2d');
  const ctx3 = document.getElementById('timeChart').getContext('2d');

  const chart1 = new Chart(ctx1, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($count_labels); ?>,
    datasets: [{
      label: 'Performance Metrics',
      data: <?php echo json_encode($count_values); ?>,
      backgroundColor: '#3b82f680',
      borderColor: '#3b82f6ff',
      borderWidth: 1
    }]
  },
  options: {
    indexAxis: 'y'
  }
});

  const chart2 = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($score_labels); ?>,
    datasets: [{
      label: 'Performance Metrics',
      data: <?php echo json_encode($score_values); ?>,
      backgroundColor: '#3b82f680',
      borderColor: '#3b82f6ff',
      borderWidth: 1
    }]
  }
});

  const chart3 = new Chart(ctx3, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($time_labels); ?>,
    datasets: [{
      label: 'Time Saved (Minutes)',
      data: <?php echo json_encode($time_values); ?>,
      backgroundColor: '#3b82f680',
      borderColor: '#3b82f6ff',
      borderWidth: 1
    }]
  },
  options: {
    indexAxis: 'y'
  }
});
</script>
        </section>
    </body>
</html>
