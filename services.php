<?php
include('db.php');
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
// Fetch service metrics for the chart
$stmt = $pdo->prepare("SELECT metric_name, metric_value FROM service_metrics WHERE service_id = ?");
$stmt->execute([$service['id']]);
$metrics = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labels = array_column($metrics, 'metric_name');
$values = array_column($metrics, 'metric_value');

?>
<?php require('header.php'); ?>

        <section class="service-listing">
            <div class="service-flex">
                <img src="<?php echo $service['image_path']; ?>" alt="<?php echo $service['title']; ?>" class="service-image">
                <canvas class="service-listing-chart" id="myChart"></canvas>
            </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementsByClassName('service-listing-chart')[0].getContext('2d');

  const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
      label: 'Performance Metrics',
      data: <?php echo json_encode($values); ?>,
      backgroundColor: 'rgba(59, 130, 246, 0.5)',
      borderColor: 'rgba(59, 130, 246, 1)',
      borderWidth: 1
    }]
  },
  options: {
    indexAxis: 'y'
  }
});
</script>
            <img src ="<?php echo $service['icon_path']; ?>" alt="<?php echo $service['title']; ?>" class="service-icon">
            <h2><?php echo $service['title']; ?></h2>
            <p><?php echo $service['long_description']; ?></p>
        </section>
    </body>
</html>
