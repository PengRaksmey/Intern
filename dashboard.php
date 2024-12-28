<?php
include('database.php'); // Ensure database connection file is included
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style5.css"> <!-- Include the external CSS file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>
<body>

    <div class="container mt-4">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row">
            <?php
            // Fetch total counts from the database
            $total_schools = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM school"));
            $total_staff = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM staff"));
            $total_students = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM student"));

            // Data for the cards
            $cards = [
                "Total Schools" => ["count" => $total_schools, "link" => "displayschool.php"],
                "Total Staff" => ["count" => $total_staff, "link" => "displayStaff.php"],
                "Total Students" => ["count" => $total_students, "link" => "displayStudent.php"],
            ];

            // Generate cards dynamically
            foreach ($cards as $title => $data) {
                $count = $data['count'];
                $link = $data['link'];
                echo "
                <div class='col-md-6 mb-4'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <h4 class='mb-3'>$count</h4>
                        </div>
                        <div class='card-footer d-flex align-items-center justify-content-between'>
                            <a class='small text-black stretched-link' href='$link'>View Details</a>
                            <div class='small text-white'><i class='fas fa-angle-right'></i></div>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>
  <!-- Chart Container -->
  <div class="chart-container" style="width: 80%; margin: 50px auto;">
        <!-- Horizontal Bar Chart -->
        <div class="chart" style="width: 50%; margin-bottom: 50px;">
            <canvas id="horizontalBarChart"></canvas>
        </div>

        <!-- Vertical Bar Chart -->
        <div class="chart" style="width: 50%; margin-bottom: 50px; heigth: 10px;">
            <canvas id="barChart"></canvas>
        </div>

        <!-- Pie Chart -->
        <div class="chart" style="width: 50%;">
            <canvas id="pieChart"></canvas>
        </div>
    </div>

    <script>
        // Horizontal Bar Chart
        var ctxHorizontal = document.getElementById('horizontalBarChart').getContext('2d');
        var horizontalBarChart = new Chart(ctxHorizontal, {
            type: 'horizontalBar', // Horizontal Bar Chart
            data: {
                labels: ['Schools', 'Staff', 'Students'],
                datasets: [{
                    label: 'Total Count',
                    data: [<?php echo $total_schools; ?>, <?php echo $total_staff; ?>, <?php echo $total_students; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        // Vertical Bar Chart
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar', // Regular Bar Chart
            data: {
                labels: ['Schools', 'Staff', 'Students'],
                datasets: [{
                    label: 'Total Count',
                    data: [<?php echo $total_schools; ?>, <?php echo $total_staff; ?>, <?php echo $total_students; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Pie Chart
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie', // Pie Chart
            data: {
                labels: ['Schools', 'Staff', 'Students'],
                datasets: [{
                    label: 'Total Count',
                    data: [<?php echo $total_schools; ?>, <?php echo $total_staff; ?>, <?php echo $total_students; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script src="https://kit.fontawesome.com/2aebc1b0e1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <div class="button-container" style="margin-top: 80px;">
  <a href="student.php">Go to students </a>
  <a href="staff.php">Go to staffs </a>
  <a href="school.php">Go to schools </a>
</div>
</body>
</html>
