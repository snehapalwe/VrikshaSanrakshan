<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>KDMC Department Reports</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    iframe {
      width: 100%;
      height: 80vh;
      border: none;
    }
    .nav-link {
      cursor: pointer;
    }
  </style>
</head>
<body>

<div class="container-fluid my-4">
  <h2 class="text-center text-success mb-4">KDMC Department Reports</h2>

  <!-- Nav Tabs -->
  <ul class="nav nav-tabs mb-3" id="reportTabs" role="tablist">
    <!--<li class="nav-item" role="presentation">-->
    <!--  <button class="nav-link active" id="combined-tab" data-bs-toggle="tab" data-bs-target="#combined" type="button" role="tab">Combined Report</button>-->
    <!--</li>-->
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="tree-tab" data-bs-toggle="tab" data-bs-target="#tree" type="button" role="tab">Tree Department</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="fire-tab" data-bs-toggle="tab" data-bs-target="#fire" type="button" role="tab">Fire Department</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="comm-tab" data-bs-toggle="tab" data-bs-target="#comm" type="button" role="tab">Commencement Certificate</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="occ-tab" data-bs-toggle="tab" data-bs-target="#occ" type="button" role="tab">Occupancy Certificate</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="prov-tab" data-bs-toggle="tab" data-bs-target="#prov" type="button" role="tab">Provisional Fire NOC</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="final-tab" data-bs-toggle="tab" data-bs-target="#final" type="button" role="tab">Final Fire NOC</button>
    </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content" id="reportTabsContent">
    <!--<div class="tab-pane fade show active" id="combined" role="tabpanel">-->
      <!--<iframe src="https://singlewindowsystemkdmc.in/tree/api/final_report2" height="100px"></iframe>-->
      <!--<iframe src="https://singlewindowsystemkdmc.in/fire/api/final_report2"></iframe>-->
    <!--</div>-->
    <div class="tab-pane fade show active" id="tree" role="tabpanel">
      <iframe src="https://singlewindowsystemkdmc.in/tree/api/final_report"></iframe>
    </div>
    <div class="tab-pane fade" id="fire" role="tabpanel">
      <iframe src="https://singlewindowsystemkdmc.in/fire/api/final_report"></iframe>
    </div>
    <div class="tab-pane fade" id="comm" role="tabpanel">
      <iframe src="https://singlewindowsystemkdmc.in/tree/api/get_report"></iframe>
    </div>
    <div class="tab-pane fade" id="occ" role="tabpanel">
      <iframe src="https://singlewindowsystemkdmc.in/tree/api/get_report2"></iframe>
    </div>
    <div class="tab-pane fade" id="prov" role="tabpanel">
      <iframe src="https://singlewindowsystemkdmc.in/fire/api/get_report"></iframe>
    </div>
    <div class="tab-pane fade" id="final" role="tabpanel">
      <iframe src="https://singlewindowsystemkdmc.in/fire/api/get_report2"></iframe>
    </div>
  </div>
</div>

<!-- Bootstrap Bundle (JS + Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
