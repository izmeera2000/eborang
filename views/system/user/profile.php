<!--
=========================================================
* Soft UI Dashboard 3 - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/head.php"); ?>


<body class="g-sidenav-show  bg-gray-100">

  <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/sidenav.php"); ?>


  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/navbar.php"); ?>

    <!-- End Navbar -->
    <div class="container-fluid my-3 py-3">
      <div class="row mb-5">
        <form method="POST" enctype="multipart/form-data">
          <div class="col-12">
            <!-- Card Profile -->
            <div class="card card-body" id="profile">
              <div class="row justify-content-center align-items-center">
                <div class="col-sm-auto col-4">
                  <div class="avatar avatar-xl position-relative">
                    <img src="../../assets/img/bruce-mars.jpg" alt="bruce" class="w-100 border-radius-lg shadow-sm">
                  </div>
                </div>
                <div class="col-sm-auto col-8 my-auto">
                  <div class="h-100">
                    <h5 class="mb-1 font-weight-bolder">
                      <?php echo $_SESSION['user_details']['email'] ?>
                    </h5>
                    <!-- <p class="mb-0 font-weight-bold text-sm">
                    CEO / Co-Founder
                  </p> -->
                  </div>
                </div>
                <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                  <!-- <label class="form-check-label mb-0">
                  <small id="profileVisibility">
                    Switch to invisible
                  </small>
                </label>
                <div class="form-check form-switch ms-2">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked=""
                    onchange="visible()">
                </div> -->
                </div>
              </div>
            </div>
            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
              <div class="card-header">
                <h5>Maklumat Pelajar</h5>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-6">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_details']['id'] ?? ''; ?>">
                    <label class="form-label">Nama</label>
                    <div class="input-group">
                      <input name="nama" class="form-control" type="text" placeholder="Alec" required="required"
                        onfocus="focused(this)" onfocusout="defocused(this)"
                        value="<?php echo $_SESSION['user_details']['nama'] ?? ''; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="form-label">IC</label>
                    <div class="input-group">
                      <input name="ic" class="form-control" type="text" placeholder="2324253351" required="required"
                        onfocus="focused(this)" onfocusout="defocused(this)"
                        value="<?php echo $_SESSION['user_details']['ic'] ?? ''; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="row">
                      <div class="col">
                        <label class="form-label mt-4">Birth Date</label>
                        <div class="input-group">
                          <input class="form-control" type="date" id="example-date-input" name="birth_date"
                            value="<?php echo $_SESSION['user_details']['birth_date'] ?? ''; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label class="form-label mt-4">Email</label>
                    <div class="input-group">
                      <input id="email" name="email" class="form-control" type="email" placeholder="example@email.com"
                        onfocus="focused(this)" onfocusout="defocused(this)"
                        value="<?php echo $_SESSION['user_details']['email'] ?? ''; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="form-label mt-4">Phone Number</label>
                    <div class="input-group">
                      <input id="phone" name="phone" class="form-control" type="number" placeholder="01123482315"
                        onfocus="focused(this)" onfocusout="defocused(this)"
                        value="<?php echo $_SESSION['user_details']['phone'] ?? ''; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card Change Password -->
            <div class="card mt-4">
              <div class="card-header">
                <h5>Maklumat Uni</h5>
              </div>
              <div class="card-body pt-0">

                <div class="row">
                  <div class="col-6">
                    <label class="form-label mt-4">NDP</label>
                    <div class="input-group">
                      <input name="ndp" class="form-control" type="text" onfocus="focused(this)"
                        onfocusout="defocused(this)" value="<?php echo $_SESSION['user_details']['ndp'] ?? ''; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="form-label mt-4">Bengkel</label>
                    <div class="input-group">
                      <input name="bengkel" class="form-control" type="text" onfocus="focused(this)"
                        onfocusout="defocused(this)" value="<?php echo $_SESSION['user_details']['bengkel'] ?? ''; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <label class="form-label mt-4">Kursus</label>
                    <div class="input-group">
                      <input name="kursus" class="form-control" type="text" onfocus="focused(this)"
                        onfocusout="defocused(this)" value="<?php echo $_SESSION['user_details']['kursus'] ?? ''; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="form-label mt-4">Semester</label>
                    <div class="input-group">
                      <input name="semester" class="form-control" type="text" onfocus="focused(this)"
                        onfocusout="defocused(this)" value="<?php echo $_SESSION['user_details']['semester'] ?? ''; ?>">
                    </div>
                  </div>
                </div>



              </div>
            </div>
            <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0" type="submit"
              name="updateprofile">Update</button>
          </div>
        </form>

      </div>
      <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/footer2.php"); ?>

    </div>
  </main>


  <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/script.php"); ?>


  <script>
    var ctx = document.getElementById("chart-bars").getContext("2d");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Sales",
          tension: 0.4,
          borderWidth: 0,
          borderRadius: 4,
          borderSkipped: false,
          backgroundColor: "#fff",
          data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
          maxBarThickness: 6
        },],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 500,
              beginAtZero: true,
              padding: 15,
              font: {
                size: 14,
                family: "Inter",
                style: 'normal',
                lineHeight: 2
              },
              color: "#fff"
            },
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false
            },
            ticks: {
              display: false
            },
          },
        },
      },
    });


    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#cb0c9f",
          borderWidth: 3,
          backgroundColor: gradientStroke1,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        },
        {
          label: "Websites",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#3A416F",
          borderWidth: 3,
          backgroundColor: gradientStroke2,
          fill: true,
          data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
          maxBarThickness: 6
        },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#b2b9bf',
              font: {
                size: 11,
                family: "Inter",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#b2b9bf',
              padding: 20,
              font: {
                size: 11,
                family: "Inter",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>


</body>

</html>