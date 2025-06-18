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

          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_details']['id'] ?? ''; ?>">

          <div class="col-12">
            <div class="row">

              <!-- Card Profile -->
              <div class="card card-body" id="profile">
                <div class="row justify-content-center align-items-center">
                  <div class="col-sm-auto col-4">
                    <div class="avatar avatar-xl position-relative">

                      <?php

                      // Check if the image path is valid and not empty
                      if (isset($_SESSION['user_details']['image']) && !empty($_SESSION['user_details']['image'])) {
                        $imagePath = $_SESSION['user_details']['image'];

                        $imageSrc = $rootPath . '/assets/img/user/' . $_SESSION['user_details']['id'] . '/' . $imagePath;
                      } else {

                        // If image is null or empty, you can set a default image or leave it blank
                        $imageSrc = $rootPath . '/assets/img/user/default.jpg'; // Default avatar
                      }
                      ?>
                      <img src="<?php echo $imageSrc ?>" class="w-100 border-radius-lg shadow-sm">
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
            </div>
            <div class="row">

              <!-- Card Basic Info -->
              <div class="card mt-4" id="basic-info">
                <div class="card-header">
                  <h5>Maklumat Pelajar</h5>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-6">
                      <label class="form-label">Nama</label>
                      <div class="input-group">
                        <input name="nama" class="form-control" type="text" placeholder="Alec" required="required"
                          onfocus="focused(this)" onfocusout="defocused(this)"
                          value="<?php echo $_SESSION['user_details']['nama'] ?? ''; ?>" required>
                      </div>
                    </div>
                    <div class="col-6">
                      <label class="form-label">IC <span>gunakan format </span></label>
                      <div class="input-group">
                        <input name="ic" class="form-control" type="text" placeholder="YYMMDD-14-2312"
                          required="required" onfocus="focused(this)" onfocusout="defocused(this)"
                          value="<?php echo $_SESSION['user_details']['ic'] ?? ''; ?>" required
                          oninput="formatIC(this)">
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
                              value="<?php echo isset($_SESSION['user_details']['birth_date']) ? date('Y-m-d', strtotime($_SESSION['user_details']['birth_date'])) : ''; ?>"
                              required>

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
                          value="<?php echo $_SESSION['user_details']['email'] ?? ''; ?>" required>
                      </div>
                    </div>
                    <div class="col-6">
                      <label class="form-label mt-4">Phone Number</label>
                      <div class="input-group">
                        <input id="phone" name="phone" class="form-control" type="number" placeholder="01123482315"
                          onfocus="focused(this)" onfocusout="defocused(this)"
                          value="<?php echo $_SESSION['user_details']['phone'] ?? ''; ?>" required>
                      </div>
                    </div>
                  </div>



                  <?php if ($role != 'bppl' && $role != 'guard') { ?>



                    <!-- Card Change Password -->




                    <div class="row">
                      <?php if ($role != 'lecturer' && $role != 'kb') { ?>

                        <div class="col-6">
                          <label class="form-label mt-4">NDP</label>
                          <div class="input-group">
                            <input name="ndp" class="form-control" type="text" onfocus="focused(this)"
                              onfocusout="defocused(this)" value="<?php echo $_SESSION['user_details']['ndp'] ?? ''; ?>"
                              required>
                          </div>
                        </div>

                      <?php } ?>


                      <div class="col-6">
                        <label class="form-label mt-4">Bengkel</label>
                        <div class="input-group">
                          <select name="bengkel" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)"
                            required>
                            <option value="" disabled selected>Select Bengkel</option>
                            <option value="komputer" <?php echo ($_SESSION['user_details']['bengkel'] ?? '') == 'komputer' ? 'selected' : ''; ?>>Komputer</option>
                            <option value="mekatronik" <?php echo ($_SESSION['user_details']['bengkel'] ?? '') == 'mekatronik' ? 'selected' : ''; ?>>Mekatronik</option>
                            <option value="mikroelektronik" <?php echo ($_SESSION['user_details']['bengkel'] ?? '') == 'mikroelektronik' ? 'selected' : ''; ?>>Mikroelektronik</option>
                            <option value="polimer" <?php echo ($_SESSION['user_details']['bengkel'] ?? '') == 'polimer' ? 'selected' : ''; ?>>Polimer</option>
                            <option value="mekanikal bahan" <?php echo ($_SESSION['user_details']['bengkel'] ?? '') == 'mekanikal bahan' ? 'selected' : ''; ?>>Mekanikal Bahan</option>
                            <option value="jaminan kualiti" <?php echo ($_SESSION['user_details']['bengkel'] ?? '') == 'jaminan kualiti' ? 'selected' : ''; ?>>Jaminan Kualiti</option>
                            <option value="komposit" <?php echo ($_SESSION['user_details']['bengkel'] ?? '') == 'komposit' ? 'selected' : ''; ?>>Komposit</option>
                          </select>
                        </div>
                      </div>

                    </div>
                    <?php if ($role != 'lecturer' && $role != 'kb') { ?>

                      <div class="row">
                        <div class="col-6">
                          <label class="form-label mt-4">Kursus</label>
                          <div class="input-group">
                            <input name="kursus" class="form-control" type="text" onfocus="focused(this)"
                              onfocusout="defocused(this)" value="<?php echo $_SESSION['user_details']['kursus'] ?? ''; ?>"
                              required>
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="form-label mt-4">Semester</label>
                          <div class="input-group">
                            <input name="semester" class="form-control" type="text" onfocus="focused(this)"
                              onfocusout="defocused(this)"
                              value="<?php echo $_SESSION['user_details']['semester'] ?? ''; ?>" required>
                          </div>
                        </div>
                      </div>
                    <?php } ?>






                  <?php } ?>



                </div>
              </div>
            </div>



            <div class="row">

              <div class="card mt-4">
                <div class="card-header">
                  <h5>Gambar</h5>
                </div>
                <div class="card-body pt-0">


                  <div class="col-12">
                    <label class="form-label">Profile Picture</label>
                    <div class="input-group">
                      <input type="file" name="profile_picture" class="form-control">
                    </div>
                  </div>



                </div>
              </div>
            </div>



            <div class="row justify-content-end">
              <div class="col-2  ">

                <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0" type="submit"
                  name="updateprofile">Update</button>
              </div>

            </div>

        </form>

        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_details']['id'] ?? ''; ?>">

          <div class="row">

            <div class="card mt-4">
              <div class="card-header">
                <h5>Change Password</h5>
              </div>
              <div class="card-body pt-0">
                <label class="form-label">Current password</label>
                <div class="form-group">
                  <input class="form-control" type="password" placeholder="Current password" name="current_password"
                    onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
                <label class="form-label">New password</label>
                <div class="form-group">
                  <input class="form-control" type="password" placeholder="New password" name="new_password"
                    onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
                <label class="form-label">Confirm new password</label>
                <div class="form-group">
                  <input class="form-control" type="password" placeholder="Confirm password" name="confirm_password"
                    onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
                <h5 class="mt-5">Password requirements</h5>
                <p class="text-muted mb-2">
                  Please follow this guide for a strong password:
                </p>
                <ul class="text-muted ps-4 mb-0 float-start">
                  <li>
                    <span class="text-sm">One special characters</span>
                  </li>
                  <li>
                    <span class="text-sm">Min 6 characters</span>
                  </li>
                  <li>
                    <span class="text-sm">One number (2 are recommended)</span>
                  </li>
                  <!-- <li>
                    <span class="text-sm">Change it often</span>
                  </li> -->
                </ul>
                <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0" type="submit"
                  name="updatepassword">Update password</button>
              </div>
            </div>
          </div>
        </form>


      </div>

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

  <script>
    function formatIC(input) {
      let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
      if (value.length <= 6) {
        value = value.replace(/(\d{2})(\d{2})(\d{2})/, '$1$2$3-14-');
      } else if (value.length <= 10) {
        value = value.replace(/(\d{2})(\d{2})(\d{2})-14-(\d{0,4})/, '$1$2$3-14-$4');
      } else {
        value = value.slice(0, 12); // Limit the length to 12 digits
      }
      input.value = value;
    }
  </script>
</body>

</html>