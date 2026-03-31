<?php

/**
 * Info Contoller Class
 * @category  Controller
 */

class ApiController extends BaseController
{

	/**
	 * call model action to retrieve data
	 * @return json data
	 */
    function process_photos($id){
        $db=$this->GetModel();
        $db->where("id",$id);
        $x=$db->getOne("tree_report_matrix","*");
        if(strtotime(date("Y-m-d"))>= strtotime($x['date'])-(10*3600*24) && strtotime(date("Y-m-d"))<= strtotime($x['date'])+(10*3600*24)  ){
            $db->where("rec_id",$id);
            $xx=$db->getOne("tree_matrix_subentry","*");
            if(!isset($xx['id'])){
                $db->where("rec_id",$x['rec_id']);
                $tipp=$db->getOne("tippani_data","*");
                $nos=$tipp['number_of_trees_to_be_planted'];
                for($i=0;$i<$nos;$i++){
                    $db->insert("tree_matrix_subentry",["rec_id"=>$id]);
                }
                
            }
                echo "<script>location.href='".SITE_ADDR."tree_matrix_subentry/?rec_id=$id'</script>";
        }else{
            
                echo "<script>location.href='".SITE_ADDR."tree_matrix_subentry/?rec_id=$id&l=t'</script>";
        }
    }
    function get_report(){
        $db=$this->GetModel();
         
// Fetch data
$rec = $db->rawQuery("
    SELECT
        SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS citizen_count,
        SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS cg_count,
        SUM(CASE WHEN status = 9 THEN 1 ELSE 0 END) AS gs_count,
        SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS gs_tippni_upload,
        SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS dmc_count,
        SUM(CASE WHEN status = 11 THEN 1 ELSE 0 END) AS completed,
        SUM(CASE WHEN status = -2 THEN 1 ELSE 0 END) AS rejected,
        SUM(CASE WHEN status = -3 THEN 1 ELSE 0 END) AS cancelled
    FROM commencement_certificate
")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
@import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300..700&display=swap');

* {
  font-family: "Signika Negative", serif;
  font-optical-sizing: auto;
  font-weight: 400;
  font-style: normal;
}

body {
  background: linear-gradient(135deg, #eef2f3, #dfe9f3);
  color: #212529;
  min-height: 100vh;
}

h2 {
  font-weight: 700;
  text-align: center;
  margin-bottom: 2.5rem;
  color: #212529;
  background: linear-gradient(45deg, #0d6efd, #6610f2);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.card {
    border-radius: 1rem;
    border: none;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.table {
    border-radius: 0.75rem;
    overflow: hidden;
    margin-bottom: 0;
    font-size: 0.95rem;
}
.table th, .table td {
    vertical-align: middle;
    text-align: center;
    padding: 0.65rem 0.75rem;
}
.table tbody tr:hover {
    background: #e0ebff;
    cursor: pointer;
    transition: 0.2s ease;
}

.badge {
    font-size: 0.85rem;
    padding: 0.45em 0.85em;
}

/* Charts Styling */
canvas {
  background: #fff;
  border-radius: 1rem;
  padding: 1.2rem;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

canvas:hover {
  transform: scale(1.04);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

/* Chart animation */
.chartjs-render-monitor {
  animation: fadeIn 1.2s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(25px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Container Spacing */
.container {
  max-width: 1200px;
}
 /* Legend styling */
.chart-legend {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}
.chart-legend span {
    display: flex;
    align-items: center;
    font-size: 14px;
    gap: 6px;
}
.chart-legend span::before {
    content: "";
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: currentColor;
}
.table-hover tbody tr:hover {
      background-color: #f1f5ff;
      transform: scale(1.01);
      transition: 0.2s ease-in-out;
  }
  .badge {
      min-width: 50px;
      padding: 0.6em 1em;
      font-size: 0.95rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  }
  .bg-purple {
      background-color: #6f42c1 !important;
  }
  /* Updated Table Styling */
.status-table {
    width: 100%;
    border-collapse: collapse;
    font-family: "Signika Negative", sans-serif;
    font-size: 14px;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-radius: 10px;
    overflow: hidden;
}

.status-table thead {
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    color: #fff;
    position: sticky;
    top: 0;
    z-index: 2;
}

.status-table th {
    padding: 10px 14px;
    font-weight: 600;
    border-right: 1px solid rgba(255,255,255,0.2);
}

.status-table th:first-child {
    text-align: left;
    background: #005bb5;
}

.status-table td {
    padding: 8px 12px;
    border-bottom: 1px solid #e5e5e5;
    text-align: center;
}

.status-table td:first-child {
    font-weight: 600;
    text-align: left;
    background: #f9fbfd;
}

.status-table tbody tr:nth-child(even) {
    background: #f7f9fc;
}

.status-table tbody tr:hover {
    background: #eef5ff;
    transition: 0.2s;
}

.status-table .badge {
    font-size: 0.85rem;
    padding: 0.45em 0.85em;
    border-radius: 50px;
}
/* Dashboard Title Styling */
.dashboard-title {
    font-family: "Signika Negative", sans-serif;
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    color: #0d6efd;
    margin-bottom: 2rem;
    position: relative;
    display: block; /* ensure block element for proper centering */
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    
    /* Animate entry */
    opacity: 0;
    transform: translateY(-20px);
    animation: titleFadeIn 1s ease forwards;
}

/* Animated underline */
.dashboard-title::after {
    content: '';
    display: block;
    width: 0;
    height: 4px;
    margin: 6px auto 0; /* center with auto margins */
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    border-radius: 2px;
    transition: width 0.5s ease, opacity 0.5s ease;
    opacity: 0.8;
}

/* Hover effect for underline and slight text glow */
.dashboard-title:hover::after {
    width: 50%; /* expands to half of container width on hover */
    opacity: 1;
}

.dashboard-title:hover {
    text-shadow: 0 0 4px rgba(13, 110, 253, 0.3), 0 0 6px rgba(102, 16, 242, 0.25);
    transform: translateY(-2px);
    transition: all 0.4s ease;
}

/* Fade-in animation */
@keyframes titleFadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===== Additional Table Interactions ===== */

/* Table cells hover effect */
.table td {
  transition: all 0.3s ease;
}
.table td:hover {
  background: rgba(79, 70, 229, 0.05); /* subtle highlight */
  color: #4f46e5;
  font-weight: 600;
  transform: scale(1.02);
}

/* Staggered fade-in for table on page load */
.table-responsive {
  opacity: 0;
  transform: translateY(20px);
  animation: tableFadeIn 0.8s ease forwards;
  animation-delay: 0.2s;
}

@keyframes tableFadeIn {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
/* Fade-in + slide-up animation */
.fade-up {
  opacity: 0;
  transform: translateY(25px);
  transition: all 0.8s ease-out;
}

.fade-up.show {
  opacity: 1;
  transform: translateY(0);
}

/* Optional staggered effect for table rows */
.status-table tbody tr {
  opacity: 0;
  transform: translateY(15px);
  animation: fadeInUpRow 0.6s ease forwards;
}

.status-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
.status-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
.status-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
.status-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
.status-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
.status-table tbody tr:nth-child(6) { animation-delay: 0.6s; }
.status-table tbody tr:nth-child(7) { animation-delay: 0.7s; }
.status-table tbody tr:nth-child(8) { animation-delay: 0.8s; }

@keyframes fadeInUpRow {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}


</style>
</head>

<body class="p-4 bg-light">
    <div class="container">
        <h2 class="dashboard-title" >Commencement Certificate Status Report</h2>
        <!-- Table -->
        <div class="card mb-4 shadow-lg border-0 rounded-3 fade-up">
            <div class="card-body p-0">
                <table class="status-table text-center mb-0">
                    <thead>
                        <tr>
                            <th style="width:70%">Currently With</th>
                            <th style="width:30%">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Citizen</td>
                            <td><span class="badge bg-primary"><?= $rec['citizen_count'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Chief Gardener</td>
                            <td><span class="badge bg-purple"><?= $rec['cg_count'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Garden Superintendent</td>
                            <td><span class="badge bg-success"><?= $rec['gs_count'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Garden Superintendent – Tippni Upload Pending</td>
                            <td><span class="badge bg-warning text-dark"><?= $rec['gs_tippni_upload'] ?></span></td>
                        </tr>
                        <tr>
                            <td>DMC</td>
                            <td><span class="badge bg-info text-dark"><?= $rec['dmc_count'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Completed</td>
                            <td><span class="badge bg-success"><?= $rec['completed'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Rejected</td>
                            <td><span class="badge bg-danger"><?= $rec['rejected'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Cancelled</td>
                            <td><span class="badge bg-secondary"><?= $rec['cancelled'] ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Charts -->
        <div class="row fade-up">
            <div class="col-md-6 mb-4">
                <canvas id="pieChart" width="400" height="400"></canvas>
            </div>
            <div class="col-md-6 mb-4">
                <canvas id="barChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <script>
    const baseColors = [
      "#4e79a7", "#f28e2b", "#e15759", "#76b7b2",
      "#59a14f", "#edc948", "#b07aa1", "#ff9da7"
    ];

    const labels = [
        "Citizen",
        "Chief Gardener",
        "Garden Superintendent",
        "GS – Tippni Pending",
        "DMC",
        "Completed",
        "Rejected",
        "Cancelled"
    ];

    const dataValues = [
        <?= $rec['citizen_count'] ?>,
        <?= $rec['cg_count'] ?>,
        <?= $rec['gs_count'] ?>,
        <?= $rec['gs_tippni_upload'] ?>,
        <?= $rec['dmc_count'] ?>,
        <?= $rec['completed'] ?>,
        <?= $rec['rejected'] ?>,
        <?= $rec['cancelled'] ?>
    ];

    // Global font settings
    Chart.defaults.font.family = "'Signika Negative', sans-serif";
    Chart.defaults.font.size = 14;

    // PIE CHART
    const pieCtx = document.getElementById("pieChart").getContext("2d");
    new Chart(pieCtx, {
        type: "pie",
        data: {
            labels: labels,
            datasets: [{
                data: dataValues,
                backgroundColor: baseColors,
                borderWidth: 2,
                borderColor: "#fff"
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "Commencement Certificate – Status Distribution",
                    font: { size: 18, weight: "bold" },
                    padding: { bottom: 20 }
                },
                legend: {
                    position: "bottom",
                    labels: {
                        usePointStyle: true,
                        pointStyle: "circle",
                        padding: 20,
                        font: { size: 13 }
                    }
                },
                tooltip: {
                    backgroundColor: "#000",
                    padding: 10,
                    titleFont: { size: 14, weight: "600" },
                    bodyFont: { size: 13 },
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed}`;
                        }
                    }
                }
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    // BAR CHART
    const barCtx = document.getElementById("barChart").getContext("2d");
    new Chart(barCtx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Applications",
                data: dataValues,
                backgroundColor: baseColors,
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "Commencement Certificate – Status Counts",
                    font: { size: 18, weight: "bold" },
                    padding: { bottom: 20 }
                },
                legend: { display: false },
                tooltip: {
                    backgroundColor: "#000",
                    padding: 10,
                    bodyFont: { size: 13 },
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed.y}`;
                        }
                    }
                }
            },
            interaction: { mode: "index", intersect: false },
            scales: {
                x: {
                    ticks: { font: { size: 13 } }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, font: { size: 13 } },
                    grid: { color: "rgba(0,0,0,0.05)" }
                }
            },
            animation: {
                duration: 1200,
                easing: "easeOutBounce"
            }
        }
    });
</script>
    <!--Fade Up Script-->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          const faders = document.querySelectorAll('.fade-up');
        
          const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
              }
            });
          }, { threshold: 0.2 });
        
          faders.forEach(el => observer.observe(el));
        });
    </script>



</body>
</html>

        <?php 
    }
    
    
    function get_report2(){
        $db=$this->GetModel();
         
// Fetch data
$rec = $db->rawQuery("
    SELECT
        SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS citizen_count,
        SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS cg_count,
        SUM(CASE WHEN status = 9 THEN 1 ELSE 0 END) AS gs_count,
        SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS gs_tippni_upload,
        SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS dmc_count,
        SUM(CASE WHEN status = 11 THEN 1 ELSE 0 END) AS completed,
        SUM(CASE WHEN status = -2 THEN 1 ELSE 0 END) AS rejected,
        SUM(CASE WHEN status = -3 THEN 1 ELSE 0 END) AS cancelled
    FROM occupancy_certificate
")[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
@import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300..700&display=swap');

* {
  font-family: "Signika Negative", serif;
  font-optical-sizing: auto;
  font-weight: 400;
  font-style: normal;
}

body {
  background: linear-gradient(135deg, #eef2f3, #dfe9f3);
  color: #212529;
  min-height: 100vh;
}

h2 {
  font-weight: 700;
  text-align: center;
  margin-bottom: 2.5rem;
  color: #212529;
  background: linear-gradient(45deg, #0d6efd, #6610f2);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.card {
    border-radius: 1rem;
    border: none;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.table {
    border-radius: 0.75rem;
    overflow: hidden;
    margin-bottom: 0;
    font-size: 0.95rem;
}
.table th, .table td {
    vertical-align: middle;
    text-align: center;
    padding: 0.65rem 0.75rem;
}
.table tbody tr:hover {
    background: #e0ebff;
    cursor: pointer;
    transition: 0.2s ease;
}

.badge {
    font-size: 0.85rem;
    padding: 0.45em 0.85em;
}

/* Charts Styling */
canvas {
  background: #fff;
  border-radius: 1rem;
  padding: 1.2rem;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

canvas:hover {
  transform: scale(1.04);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

/* Chart animation */
.chartjs-render-monitor {
  animation: fadeIn 1.2s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(25px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Container Spacing */
.container {
  max-width: 1200px;
}
 /* Legend styling */
.chart-legend {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}
.chart-legend span {
    display: flex;
    align-items: center;
    font-size: 14px;
    gap: 6px;
}
.chart-legend span::before {
    content: "";
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: currentColor;
}
.table-hover tbody tr:hover {
      background-color: #f1f5ff;
      transform: scale(1.01);
      transition: 0.2s ease-in-out;
  }
  .badge {
      min-width: 50px;
      padding: 0.6em 1em;
      font-size: 0.95rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  }
  .bg-purple {
      background-color: #6f42c1 !important;
  }
  /* Updated Table Styling */
.status-table {
    width: 100%;
    border-collapse: collapse;
    font-family: "Signika Negative", sans-serif;
    font-size: 14px;
    background: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border-radius: 10px;
    overflow: hidden;
}

.status-table thead {
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    color: #fff;
    position: sticky;
    top: 0;
    z-index: 2;
}

.status-table th {
    padding: 10px 14px;
    font-weight: 600;
    border-right: 1px solid rgba(255,255,255,0.2);
}

.status-table th:first-child {
    text-align: left;
    background: #005bb5;
}

.status-table td {
    padding: 8px 12px;
    border-bottom: 1px solid #e5e5e5;
    text-align: center;
}

.status-table td:first-child {
    font-weight: 600;
    text-align: left;
    background: #f9fbfd;
}

.status-table tbody tr:nth-child(even) {
    background: #f7f9fc;
}

.status-table tbody tr:hover {
    background: #eef5ff;
    transition: 0.2s;
}

.status-table .badge {
    font-size: 0.85rem;
    padding: 0.45em 0.85em;
    border-radius: 50px;
}
/* Dashboard Title Styling */
.dashboard-title {
    font-family: "Signika Negative", sans-serif;
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    color: #0d6efd;
    margin-bottom: 2rem;
    position: relative;
    display: block; /* ensure block element for proper centering */
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Animated underline */
.dashboard-title::after {
    content: '';
    display: block;
    width: 0;
    height: 4px;
    margin: 6px auto 0; /* center with auto margins */
    background: linear-gradient(90deg, #0d6efd, #6610f2);
    border-radius: 2px;
    transition: width 0.4s ease-in-out;
}

.dashboard-title:hover::after {
    width: 50%; /* expands to half of container width on hover */
}
/* Fade-in + slide-up animation */
.fade-up {
  opacity: 0;
  transform: translateY(25px);
  transition: all 0.8s ease-out;
}

.fade-up.show {
  opacity: 1;
  transform: translateY(0);
}

/* Optional staggered effect for table rows */
.status-table tbody tr {
  opacity: 0;
  transform: translateY(15px);
  animation: fadeInUpRow 0.6s ease forwards;
}

.status-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
.status-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
.status-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
.status-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
.status-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
.status-table tbody tr:nth-child(6) { animation-delay: 0.6s; }
.status-table tbody tr:nth-child(7) { animation-delay: 0.7s; }
.status-table tbody tr:nth-child(8) { animation-delay: 0.8s; }

@keyframes fadeInUpRow {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}


</style>
</head>
<body class="p-4 bg-light">

    <div class="container">
        <h2 class="dashboard-title">Occupancy Certificate Status Report</h2>

        <!-- Table -->
        <div class="card mb-4 shadow-lg border-0 rounded-3 fade-up">
            <div class="card-body p-0">
                <table class="status-table text-center mb-0">
                    <thead>
                        <tr>
                            <th style="width:70%">Currently With</th>
                            <th style="width:30%">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Citizen</td>
                            <td><span class="badge bg-primary"><?= $rec['citizen_count'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Chief Gardener</td>
                            <td><span class="badge bg-purple"><?= $rec['cg_count'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Garden Superintendent</td>
                            <td><span class="badge bg-success"><?= $rec['gs_count'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Garden Superintendent – Tippni Upload Pending</td>
                            <td><span class="badge bg-warning text-dark"><?= $rec['gs_tippni_upload'] ?></span></td>
                        </tr>
                        <tr>
                            <td>DMC</td>
                            <td><span class="badge bg-info text-dark"><?= $rec['dmc_count'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Completed</td>
                            <td><span class="badge bg-success"><?= $rec['completed'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Rejected</td>
                            <td><span class="badge bg-danger"><?= $rec['rejected'] ?></span></td>
                        </tr>
                        <tr>
                            <td>Cancelled</td>
                            <td><span class="badge bg-secondary"><?= $rec['cancelled'] ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Charts -->
        <div class="row fade-up">
            <div class="col-md-6 mb-4">
                <canvas id="pieChart" width="400" height="400"></canvas>
            </div>
            <div class="col-md-6 mb-4">
                <canvas id="barChart" width="400" height="400"></canvas>
            </div>
        </div>
    </div>

    <script>
        const labels = [
            "Citizen",
            "Cheif Gardener",
            "Garden Superintendent",
            "Garden Superintendent – Tippni Upload Pending ",
            "DMC",
            "Completed",
            "Rejected",
            "Cancelled"
        ];
        const dataValues = [
            <?= $rec['citizen_count'] ?>,
            <?= $rec['cg_count'] ?>,
            <?= $rec['gs_count'] ?>,
            <?= $rec['gs_tippni_upload'] ?>,
            <?= $rec['dmc_count'] ?>,
            <?= $rec['completed'] ?>,
            <?= $rec['rejected'] ?>,
            <?= $rec['cancelled'] ?>
        ];
        const colors = [
            "#0d6efd", "#6610f2", "#198754", "#ffc107", 
            "#fd7e14", "#dc3545", "#20c997", "#6f42c1"
        ];
        
        const baseColors = ["#4e79a7", "#f28e2b", "#e15759", "#76b7b2", "#59a14f", "#edc948", "#b07aa1", "#ff9da7"];

        // Global font settings
        Chart.defaults.font.family = "'Signika Negative', sans-serif";
        Chart.defaults.font.size = 14;
    
        // Pie Chart
        new Chart(document.getElementById("pieChart"), {
            type: "pie",
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: baseColors,
                    borderWidth: 2,
                    borderColor: "#fff"
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: "Commencement Certificate – Status Distribution",
                        font: { size: 18, weight: "bold" },
                        padding: { bottom: 20 }
                    },
                    legend: { position: "bottom" }
                },
                animation: { animateScale: true, animateRotate: true }
            }
        });

    // Bar Chart
    new Chart(document.getElementById("barChart"), {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Applications",
                data: dataValues,
                backgroundColor: baseColors,
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: "Commencement Certificate – Status Counts",
                    font: { size: 18, weight: "bold" },
                    padding: { bottom: 20 }
                },
                legend: { display: false }
            },
            interaction: { mode: "index", intersect: false },
            scales: {
                x: { ticks: { font: { size: 13 } } },
                y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 13 } }, grid: { color: "rgba(0,0,0,0.05)" } }
            },
            animation: { duration: 1200, easing: "easeOutBounce" }
        }
    });
        

    </script>
    
    <!-- Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          const faders = document.querySelectorAll('.fade-up');
        
          const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
              }
            });
          }, { threshold: 0.2 });
        
          faders.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>

        <?php 
    }
    
    function final_report(){
        $db=$this->GetModel();
        $rec = $db->rawQuery("
    SELECT
        SUM(citizen_count) AS citizen_count,
        SUM(cg_count) AS cg_count,
        SUM(gs_count) AS gs_count,
        SUM(gs_tippni_upload) AS gs_tippni_upload,
        SUM(dmc_count) AS dmc_count,
        SUM(completed) AS completed,
        SUM(rejected) AS rejected,
        SUM(cancelled) AS cancelled
    FROM (
        SELECT
            SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS citizen_count,
            SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS cg_count,
            SUM(CASE WHEN status = 9 THEN 1 ELSE 0 END) AS gs_count,
            SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS gs_tippni_upload,
            SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS dmc_count,
            SUM(CASE WHEN status = 11 THEN 1 ELSE 0 END) AS completed,
            SUM(CASE WHEN status = -2 THEN 1 ELSE 0 END) AS rejected,
            SUM(CASE WHEN status = -3 THEN 1 ELSE 0 END) AS cancelled
        FROM commencement_certificate

        UNION ALL

        SELECT
            SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS citizen_count,
            SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS cg_count,
            SUM(CASE WHEN status = 9 THEN 1 ELSE 0 END) AS gs_count,
            SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS gs_tippni_upload,
            SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS dmc_count,
            SUM(CASE WHEN status = 11 THEN 1 ELSE 0 END) AS completed,
            SUM(CASE WHEN status = -2 THEN 1 ELSE 0 END) AS rejected,
            SUM(CASE WHEN status = -3 THEN 1 ELSE 0 END) AS cancelled
        FROM occupancy_certificate
    ) AS combined
")[0];


$dailyData = $db->rawQuery("
    SELECT date, COUNT(*) as total
    FROM (
        SELECT DATE(date) AS date FROM commencement_certificate
        UNION ALL
        SELECT DATE(date) AS date FROM occupancy_certificate
    ) AS combined
    GROUP BY date
    ORDER BY date DESC
"); 
$dates = [];
$totals = [];

foreach ($dailyData as $row) {
    $dates[] = $row['date'];
    $totals[] = $row['total'];
}
?>


<script>
    const dailyLabels = <?= json_encode($dates) ?>;
    const dailyCounts = <?= json_encode($totals) ?>;
</script> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KDMC TREE DEPARTMENT REPORT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Chart.js CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
@import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300..700&display=swap');

* {
  font-family: "Signika Negative", serif;
  font-optical-sizing: auto;
  font-weight: 400;
  font-style: normal;
}

body {
  background: linear-gradient(135deg, #eef2f3, #dfe9f3);
  color: #212529;
  min-height: 100vh;
}

h2 {
  font-weight: 700;
  text-align: center;
  margin-bottom: 2.5rem;
  color: #212529;
  background: linear-gradient(45deg, #0d6efd, #6610f2);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.card {
    border-radius: 1rem;
    border: none;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.table {
    border-radius: 0.75rem;
    overflow: hidden;
    margin-bottom: 0;
    font-size: 0.95rem;
}
.table th, .table td {
    vertical-align: middle;
    text-align: center;
    padding: 0.65rem 0.75rem;
}
.table tbody tr:hover {
    background: #e0ebff;
    cursor: pointer;
    transition: 0.2s ease;
}

.badge {
    font-size: 0.85rem;
    padding: 0.45em 0.85em;
}

/* Charts Styling */
canvas {
  background: #fff;
  border-radius: 1rem;
  padding: 1.2rem;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

canvas:hover {
  transform: scale(1.04);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

/* Chart animation */
.chartjs-render-monitor {
  animation: fadeIn 1.2s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(25px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Container Spacing */
.container {
  max-width: 1200px;
}
 /* Legend styling */
.chart-legend {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}
.chart-legend span {
    display: flex;
    align-items: center;
    font-size: 14px;
    gap: 6px;
}
.chart-legend span::before {
    content: "";
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: currentColor;
}
.table-hover tbody tr:hover {
      background-color: #f1f5ff;
      transform: scale(1.01);
      transition: 0.2s ease-in-out;
  }
  .badge {
      min-width: 50px;
      padding: 0.6em 1em;
      font-size: 0.95rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  }
  .bg-purple {
      background-color: #6f42c1 !important;
  }
  /* Updated Table Styling */
    /* Status Table Styling */
.status-table {
    font-family: "Signika Negative", sans-serif;
    font-size: 14px;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border: 2px solid #28a745; /* Green border for table */
}

.status-table thead {
    background: linear-gradient(90deg, #28a745, #218838); /* green gradient header */
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
}

.status-table th, .status-table td {
    padding: 12px 15px;
    border: 1px solid #c8e6c9; /* light green borders */
    transition: all 0.3s ease;
    font-weight: bold;
}

.status-table tbody tr:nth-child(even) {
    background-color: #f3f8f4; /* light green tint */
}

.status-table tbody tr:hover {
    background: #d4edda; /* hover light green */
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.status-table td span.badge {
    display: inline-block;
    min-width: 40px;
    padding: 5px 10px;
    border-radius: 20px;
    color: #fff;
    font-weight: 600;
}

/* Badge colors */
.status-table td span.citizen { background-color: #007bff; }
.status-table td span.cg { background-color: #6f42c1; }
.status-table td span.gs { background-color: #28a745; }
.status-table td span.gs-tippni { background-color: #ffc107; color: #212529; } /* fixed white text issue */
.status-table td span.dmc { background-color: #17a2b8; }
.status-table td span.completed { background-color: #28a745; }
.status-table td span.rejected { background-color: #dc3545; }
.status-table td span.cancelled { background-color: #6c757d; }

/* Dashboard Title Styling - Green Version */
.dashboard-title {
    font-family: "Signika Negative", sans-serif;
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    color: #28a745; /* fallback color */
    margin-bottom: 2rem;
    margin-top: 2px;
    padding-top: 20px;
    position: relative;
    display: block; /* ensure block element for proper centering */
    background: linear-gradient(90deg, #28a745, #218838); /* green gradient */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Animated underline */
.dashboard-title::after {
    content: '';
    display: block;
    width: 0;
    height: 4px;
    margin: 6px auto 0; /* center with auto margins */
    background: linear-gradient(90deg, #28a745, #218838); /* green gradient underline */
    border-radius: 2px;
    transition: width 0.4s ease-in-out;
}

.dashboard-title:hover::after {
    width: 50%; /* expands to half of container width on hover */
}

/* ===== Additional Table Interactions ===== */

/* Table cells hover effect */
.table td {
  transition: all 0.3s ease;
}
.table td:hover {
  background: rgba(79, 70, 229, 0.05); /* subtle highlight */
  color: #4f46e5;
  font-weight: 600;
  transform: scale(1.02);
}

/* Staggered fade-in for table on page load */
.table-responsive {
  opacity: 0;
  transform: translateY(20px);
  animation: tableFadeIn 0.8s ease forwards;
  animation-delay: 0.2s;
}

@keyframes tableFadeIn {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
/* Fade-in + slide-up animation */
.fade-up {
  opacity: 0;
  transform: translateY(25px);
  transition: all 0.8s ease-out;
}

.fade-up.show {
  opacity: 1;
  transform: translateY(0);
}

/* Optional staggered effect for table rows */
.status-table tbody tr {
  opacity: 0;
  transform: translateY(15px);
  animation: fadeInUpRow 0.6s ease forwards;
}

.status-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
.status-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
.status-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
.status-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
.status-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
.status-table tbody tr:nth-child(6) { animation-delay: 0.6s; }
.status-table tbody tr:nth-child(7) { animation-delay: 0.7s; }
.status-table tbody tr:nth-child(8) { animation-delay: 0.8s; }

@keyframes fadeInUpRow {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
</head>
<body>

    <h1 class="dashboard-title">KDMC TREE DEPARTMENT REPORT</h1>

    <!-- Data Table -->
    <div class="container mb-4 fade-up">
        <div class="table-responsive">
            <table class="table status-table text-center align-middle">
                <thead>
                    <tr>
                        <th>Citizen</th>
                        <th>CG</th>
                        <th>GS</th>
                        <th>GS Tippni Upload</th>
                        <th>DMC</th>
                        <th>Completed</th>
                        <th>Rejected</th>
                        <th>Cancelled</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge citizen"><?= $rec['citizen_count'] ?></span></td>
                        <td><span class="badge cg"><?= $rec['cg_count'] ?></span></td>
                        <td><span class="badge gs"><?= $rec['gs_count'] ?></span></td>
                        <td><span class="badge gs-tippni"><?= $rec['gs_tippni_upload'] ?></span></td>
                        <td><span class="badge dmc"><?= $rec['dmc_count'] ?></span></td>
                        <td><span class="badge completed"><?= $rec['completed'] ?></span></td>
                        <td><span class="badge rejected"><?= $rec['rejected'] ?></span></td>
                        <td><span class="badge cancelled"><?= $rec['cancelled'] ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Charts -->
    <div class="container">
        <div class="row fade-up">
            <!-- Bar Chart -->
            <div class="col-md-6 mb-4">
                <div class="chart-container">
                    <canvas id="barChart" width="400" height="400"></canvas>
                </div>
            </div>
    
            <!-- Pie Chart -->
            <div class="col-md-6 mb-4">
                <div class="chart-container">
                    <canvas id="pieChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    
        <!-- Daily Applications Line Chart -->
        <div class="row fade-up">
            <div class="col-12">
                <div class="chart-container">
                    <h4 class="text-center text-success mb-3">Daily Applications Trend</h4>
                    <canvas id="dailyChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        const labels = ['Citizen', 'CG', 'GS', 'GS Tippni Upload', 'DMC', 'Completed', 'Rejected', 'Cancelled'];
        const values = [
            <?= $rec['citizen_count'] ?>,
            <?= $rec['cg_count'] ?>,
            <?= $rec['gs_count'] ?>,
            <?= $rec['gs_tippni_upload'] ?>,
            <?= $rec['dmc_count'] ?>,
            <?= $rec['completed'] ?>,
            <?= $rec['rejected'] ?>,
            <?= $rec['cancelled'] ?>
        ];
        const baseColors = ['#4e79a7', '#f28e2b', '#e15759', '#76b7b2', '#59a14f', '#edc948', '#b07aa1', '#ff9da7'];
        
        // Global font settings
        Chart.defaults.font.family = "'Signika Negative', sans-serif";
        Chart.defaults.font.size = 14;
        
        // -------------------- Pie Chart --------------------
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: baseColors,
                    borderWidth: 2,
                    borderColor: "#fff"
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Commencement Certificate – Status Distribution',
                        font: { size: 18, weight: 'bold' },
                        padding: { bottom: 20 }
                    },
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, pointStyle: 'circle', font: { size: 13 } }
                    },
                    tooltip: {
                        backgroundColor: '#000',
                        padding: 10,
                        titleFont: { size: 14, weight: '600' },
                        bodyFont: { size: 13 },
                        callbacks: { label: ctx => `${ctx.label}: ${ctx.parsed}` }
                    }
                },
                animation: { animateScale: true, animateRotate: true }
            }
        });
        
        // -------------------- Bar Chart --------------------
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Applications',
                    data: values,
                    backgroundColor: baseColors,
                    borderRadius: 8,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Commencement Certificate – Status Counts',
                        font: { size: 18, weight: 'bold' },
                        padding: { bottom: 20 }
                    },
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#000',
                        padding: 10,
                        bodyFont: { size: 13 },
                        callbacks: { label: ctx => `${ctx.label}: ${ctx.parsed.y}` }
                    }
                },
                interaction: { mode: 'index', intersect: false },
                scales: {
                    x: { ticks: { font: { size: 13 } } },
                    y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 13 } }, grid: { color: 'rgba(0,0,0,0.05)' } }
                },
                animation: { duration: 1200, easing: 'easeOutBounce' }
            }
        });
        
        // -------------------- Daily Applications Line Chart --------------------
        new Chart(document.getElementById('dailyChart'), {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: 'Applications per Day',
                    data: dailyCounts,
                    fill: false,
                    borderColor: '#28a745',
                    backgroundColor: '#28a745',
                    tension: 0.3,
                    pointRadius: 4,
                    pointBackgroundColor: '#28a745'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: 'Daily Applications', font: { size: 18 } }
                },
                scales: {
                    x: { title: { display: true, text: 'Date' }, ticks: { maxRotation: 90, minRotation: 45 } },
                    y: { beginAtZero: true, title: { display: true, text: 'Total Applications' } }
                }
            }
        });
        </script>
    <!-- Fade Up Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          const faders = document.querySelectorAll('.fade-up');
        
          const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
              }
            });
          }, { threshold: 0.25 });
        
          faders.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>


<?php

    }
    
    
    function final_report2(){
        $db=$this->GetModel();
        $rec = $db->rawQuery("
    SELECT
        SUM(citizen_count) AS citizen_count,
        SUM(cg_count) AS cg_count,
        SUM(gs_count) AS gs_count,
        SUM(gs_tippni_upload) AS gs_tippni_upload,
        SUM(dmc_count) AS dmc_count,
        SUM(completed) AS completed,
        SUM(rejected) AS rejected,
        SUM(cancelled) AS cancelled
    FROM (
        SELECT
            SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS citizen_count,
            SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS cg_count,
            SUM(CASE WHEN status = 9 THEN 1 ELSE 0 END) AS gs_count,
            SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS gs_tippni_upload,
            SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS dmc_count,
            SUM(CASE WHEN status = 11 THEN 1 ELSE 0 END) AS completed,
            SUM(CASE WHEN status = -2 THEN 1 ELSE 0 END) AS rejected,
            SUM(CASE WHEN status = -3 THEN 1 ELSE 0 END) AS cancelled
        FROM commencement_certificate

        UNION ALL

        SELECT
            SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END) AS citizen_count,
            SUM(CASE WHEN status = 7 THEN 1 ELSE 0 END) AS cg_count,
            SUM(CASE WHEN status = 9 THEN 1 ELSE 0 END) AS gs_count,
            SUM(CASE WHEN status = 13 THEN 1 ELSE 0 END) AS gs_tippni_upload,
            SUM(CASE WHEN status = 10 THEN 1 ELSE 0 END) AS dmc_count,
            SUM(CASE WHEN status = 11 THEN 1 ELSE 0 END) AS completed,
            SUM(CASE WHEN status = -2 THEN 1 ELSE 0 END) AS rejected,
            SUM(CASE WHEN status = -3 THEN 1 ELSE 0 END) AS cancelled
        FROM occupancy_certificate
    ) AS combined
")[0];


$dailyData = $db->rawQuery("
    SELECT date, COUNT(*) as total
    FROM (
        SELECT DATE(date) AS date FROM commencement_certificate
        UNION ALL
        SELECT DATE(date) AS date FROM occupancy_certificate
    ) AS combined
    GROUP BY date
    ORDER BY date DESC
"); 
$dates = [];
$totals = [];

foreach ($dailyData as $row) {
    $dates[] = $row['date'];
    $totals[] = $row['total'];
}
?>


<script>
    const dailyLabels = <?= json_encode($dates) ?>;
    const dailyCounts = <?= json_encode($totals) ?>;
</script> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KDMC TREE DEPARTMENT REPORT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Chart.js CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
@import url('https://fonts.googleapis.com/css2?family=Signika+Negative:wght@300..700&display=swap');

* {
  font-family: "Signika Negative", serif;
  font-optical-sizing: auto;
  font-weight: 400;
  font-style: normal;
}

body {
  background: linear-gradient(135deg, #eef2f3, #dfe9f3);
  color: #212529;
  min-height: 100vh;
}

h2 {
  font-weight: 700;
  text-align: center;
  margin-bottom: 2.5rem;
  color: #212529;
  background: linear-gradient(45deg, #0d6efd, #6610f2);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.card {
    border-radius: 1rem;
    border: none;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.table {
    border-radius: 0.75rem;
    overflow: hidden;
    margin-bottom: 0;
    font-size: 0.95rem;
}
.table th, .table td {
    vertical-align: middle;
    text-align: center;
    padding: 0.65rem 0.75rem;
}
.table tbody tr:hover {
    background: #e0ebff;
    cursor: pointer;
    transition: 0.2s ease;
}

.badge {
    font-size: 0.85rem;
    padding: 0.45em 0.85em;
}

/* Charts Styling */
canvas {
  background: #fff;
  border-radius: 1rem;
  padding: 1.2rem;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

canvas:hover {
  transform: scale(1.04);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

/* Chart animation */
.chartjs-render-monitor {
  animation: fadeIn 1.2s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(25px); }
  to { opacity: 1; transform: translateY(0); }
}

/* Container Spacing */
.container {
  max-width: 1200px;
}
 /* Legend styling */
.chart-legend {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}
.chart-legend span {
    display: flex;
    align-items: center;
    font-size: 14px;
    gap: 6px;
}
.chart-legend span::before {
    content: "";
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: currentColor;
}
.table-hover tbody tr:hover {
      background-color: #f1f5ff;
      transform: scale(1.01);
      transition: 0.2s ease-in-out;
  }
  .badge {
      min-width: 50px;
      padding: 0.6em 1em;
      font-size: 0.95rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  }
  .bg-purple {
      background-color: #6f42c1 !important;
  }
  /* Updated Table Styling */
    /* Status Table Styling */
.status-table {
    font-family: "Signika Negative", sans-serif;
    font-size: 14px;
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border: 2px solid #28a745; /* Green border for table */
}

.status-table thead {
    background: linear-gradient(90deg, #28a745, #218838); /* green gradient header */
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
}

.status-table th, .status-table td {
    padding: 12px 15px;
    border: 1px solid #c8e6c9; /* light green borders */
    transition: all 0.3s ease;
    font-weight: bold;
}

.status-table tbody tr:nth-child(even) {
    background-color: #f3f8f4; /* light green tint */
}

.status-table tbody tr:hover {
    background: #d4edda; /* hover light green */
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.status-table td span.badge {
    display: inline-block;
    min-width: 40px;
    padding: 5px 10px;
    border-radius: 20px;
    color: #fff;
    font-weight: 600;
}

/* Badge colors */
.status-table td span.citizen { background-color: #007bff; }
.status-table td span.cg { background-color: #6f42c1; }
.status-table td span.gs { background-color: #28a745; }
.status-table td span.gs-tippni { background-color: #ffc107; color: #212529; } /* fixed white text issue */
.status-table td span.dmc { background-color: #17a2b8; }
.status-table td span.completed { background-color: #28a745; }
.status-table td span.rejected { background-color: #dc3545; }
.status-table td span.cancelled { background-color: #6c757d; }

/* Dashboard Title Styling - Green Version */
.dashboard-title {
    font-family: "Signika Negative", sans-serif;
    font-size: 2rem;
    font-weight: 700;
    text-align: center;
    color: #28a745; /* fallback color */
    margin-bottom: 2rem;
    margin-top: 2px;
    padding-top: 20px;
    position: relative;
    display: block; /* ensure block element for proper centering */
    background: linear-gradient(90deg, #28a745, #218838); /* green gradient */
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Animated underline */
.dashboard-title::after {
    content: '';
    display: block;
    width: 0;
    height: 4px;
    margin: 6px auto 0; /* center with auto margins */
    background: linear-gradient(90deg, #28a745, #218838); /* green gradient underline */
    border-radius: 2px;
    transition: width 0.4s ease-in-out;
}

.dashboard-title:hover::after {
    width: 50%; /* expands to half of container width on hover */
}
/* ===== Additional Table Interactions ===== */

/* Table cells hover effect */
.table td {
  transition: all 0.3s ease;
}
.table td:hover {
  background: rgba(79, 70, 229, 0.05); /* subtle highlight */
  color: #4f46e5;
  font-weight: 600;
  transform: scale(1.02);
}

/* Staggered fade-in for table on page load */
.table-responsive {
  opacity: 0;
  transform: translateY(20px);
  animation: tableFadeIn 0.8s ease forwards;
  animation-delay: 0.2s;
}

@keyframes tableFadeIn {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
/* Fade-in + slide-up animation */
.fade-up {
  opacity: 0;
  transform: translateY(25px);
  transition: all 0.8s ease-out;
}

.fade-up.show {
  opacity: 1;
  transform: translateY(0);
}

/* Optional staggered effect for table rows */
.status-table tbody tr {
  opacity: 0;
  transform: translateY(15px);
  animation: fadeInUpRow 0.6s ease forwards;
}

.status-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
.status-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
.status-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
.status-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
.status-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
.status-table tbody tr:nth-child(6) { animation-delay: 0.6s; }
.status-table tbody tr:nth-child(7) { animation-delay: 0.7s; }
.status-table tbody tr:nth-child(8) { animation-delay: 0.8s; }

@keyframes fadeInUpRow {
  from { opacity: 0; transform: translateY(15px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
</head>
<body>

    <h1 class="dashboard-title">KDMC TREE DEPARTMENT REPORT</h1>

    <!-- Data Table -->
    <div class="container mb-4 fade-up">
        <div class="table-responsive">
            <table class="table status-table text-center align-middle">
                <thead>
                    <tr>
                        <th>Citizen</th>
                        <th>CG</th>
                        <th>GS</th>
                        <th>GS Tippni Upload</th>
                        <th>DMC</th>
                        <th>Completed</th>
                        <th>Rejected</th>
                        <th>Cancelled</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge citizen"><?= $rec['citizen_count'] ?></span></td>
                        <td><span class="badge cg"><?= $rec['cg_count'] ?></span></td>
                        <td><span class="badge gs"><?= $rec['gs_count'] ?></span></td>
                        <td><span class="badge gs-tippni"><?= $rec['gs_tippni_upload'] ?></span></td>
                        <td><span class="badge dmc"><?= $rec['dmc_count'] ?></span></td>
                        <td><span class="badge completed"><?= $rec['completed'] ?></span></td>
                        <td><span class="badge rejected"><?= $rec['rejected'] ?></span></td>
                        <td><span class="badge cancelled"><?= $rec['cancelled'] ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  
<!-- Fade Up Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          const faders = document.querySelectorAll('.fade-up');
        
          const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target);
              }
            });
          }, { threshold: 0.2 });
        
          faders.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>


<?php

    }
    function cancel_appl($tbl,$id){
        $db=$this->GetModel();
        $db->where("id",$id);
        $db->update($tbl,["status"=>-3]);
        echo "<script>location.href='".SITE_ADDR.$tbl."';</script>";
        
    }
    function get_app_det($id){
        $db=$this->GetModel();
        $db->where("id",$id);
        $x=$db->getOne("application_form","*");
        $ins['date']=date("Y-m-d",strtotime($x['timestamp']));
        render_json($ins);
    }
    function get_app_status($id){
        $id=urldecode($id);
        
        $id=str_replace("undefined","",$id);
        $db=$this->GetModel();
        $db->where("id",$id);
        $db->where("flag_advertisement>0");
        $db->where("status=1");
        $x=$db->getOne("application_form","*");
        if(isset($x['id'])){
        render_json(["all"=>"ok"]);
        }else{
            
        render_json(["all"=>"no"]);
        }
        
    }

	function json($action, $arg1 = null, $arg2 = null)
	{
		$model = new SharedController;
		$args = array($arg1, $arg2);
		$data = call_user_func_array(array($model, $action), $args);
		render_json($data);
	}


    function get_app_form($id){
        $db=$this->GetModel();
        $db->where("id",$id);
        render_json($db->getOne("application_form"));
    }
    
	function online_pay($type,$rec_id,$force){
		$db=$this->GetModel();
		?>
		<h2>PAYMENT GATEWAY</h2>
		<HR>
		<form action="?" method="POST">
			Recieved From : <input required type="text" name="recieved_from" />
			Payment Mode : <select name="payment_mode" id="">
				<option value="<?php echo $force==1?"OFFLINE":"OFFLINE"; ?>"><?php echo $force==1?"OFFLINE":"OFFLINE"; ?></option>
			</select>
			<button type="SUBMIT">SUBMIT</button>
		</form>
		<?php
		if(isset($_POST['recieved_from'])){
			$rf=$_POST['recieved_from'];
			$pm=$_POST['payment_mode'];

			if($type=="application"){
				$db->where("id",$rec_id);
				$rec=$db->getOne("application_form","*");
				
				$data=[["desc"=>"Tree Cut Fees","amt"=>$rec['amount']],["desc"=>"Advertisement Fees","amt"=>$rec['advertisement_fees']]];
				$en=json_encode($data,true);
			$r=$db->insert("payments",[
				"recieved_from"=>$rf,
				"payment_mode"=>$pm,
				"amount"=>($rec['amount']+$rec['advertisement_fees']),
				"text"=>$en
			]);

			$db->where("id",$rec['id']);
			$db->update("application_form",["flag_payment"=>$r,"status"=>1]);

			$pos="";
			}else{
 
				$db->where("id",$rec_id);
				$rec=$db->getOne("objections","*");
				  
				$db->where("id",$rec['rec_id']);
				$db->update("application_form",["flag_objection"=>1]);

			$r=$db->insert("objections_payments",[
				"recieved_from"=>$rf,
				"payment_mode"=>$pm,
				"amount"=>(200)+0, 
			]);

			$db->where("id",$rec_id);
			$db->update("objections",["flag_payment"=>$r ]);
			$pos="objections_";
			}

			

			?>
			<script>
				location.href='<?php echo SITE_ADDR ?><?php echo $pos; ?>payments/view/<?php echo $r ?>';
			</script>
			<?PHP
		}

	}
	function online_pay_confirm($type,$rec_id,$force){
		$db=$this->GetModel();
		?>
	 
		<?php
		if(1){
// 			$rf=$_POST['recieved_from'];
// 			$pm=$_POST['payment_mode'];

			if($type=="application"){ 
			    $db->where("id",$rec_id);
			$db->update("application_form",[ "status"=>0.5]);
        $loc="application_form";
			$pos="";
			}else{ exit(); }

			

			?>
			<script>
				location.href='<?php echo SITE_ADDR ?><?php echo $loc; ?>';
			</script>
			<?PHP
		}

	}
}
