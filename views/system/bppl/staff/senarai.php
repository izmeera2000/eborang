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
    <div class="container-fluid py-4">


      <div class="row my-4">
        <div class=" col-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Staff</h6>
                  <p class="text-sm mb-0">
                    <!-- <i class="fa fa-check text-info" aria-hidden="true"></i> -->
                    <!-- <span class="font-weight-bold ms-1">30</span> this month -->
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">
                    <?php if ($_SESSION['user_details']['role'] == '1') { ?>

                      <a class="btn btn-adtec" href="<?php echo $rootPath ?>/staff/tambah">Tambah</a>
                    <?php } ?>


                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0" id="eventsTable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder  text-center opacity-7">ID
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder  text-center opacity-7">Staff
                      </th>

                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder  text-center opacity-7">role
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder  text-center opacity-7">
                        bengkel
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder  text-center opacity-7">
                        contact
                      </th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder  text-center opacity-7">
                        birth_date
                      </th>
                    </tr>

                  </thead>
                  <tbody>

                    <!-- <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="<?php echo $rootPath; ?>/assets/img/small-logos/logo-invision.svg"
                              class="avatar avatar-sm me-3" alt="invision">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Redesign New Online Shop</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Ryan Tompson">
                            <img src="<?php echo $rootPath; ?>/assets/img/team-1.jpg" alt="user6">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                            data-bs-placement="bottom" title="Jessica Doe">
                            <img src="<?php echo $rootPath; ?>/assets/img/team-4.jpg" alt="user7">
                          </a>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> $2,000 </span>
                      </td>
                      <td class="align-middle">
                        <div class="progress-wrapper w-75 mx-auto">
                          <div class="progress-info">
                            <div class="progress-percentage">
                              <span class="text-xs font-weight-bold">40%</span>
                            </div>
                          </div>
                          <div class="progress">
                            <div class="progress-bar bg-gradient-info w-40" role="progressbar" aria-valuenow="40"
                              aria-valuemin="0" aria-valuemax="40"></div>
                          </div>
                        </div>
                      </td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>




        <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/footer2.php"); ?>

      </div>



      <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/footer2.php"); ?>

    </div>
  </main>


  <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/script.php"); ?>


  <script>
    $(document).ready(function () {
      $('#eventsTable').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true, //dashboard doesnt have state save
        responsive: true,
        pageLength: 5,  // Number of entries per page (you can change this to whatever number you want)
        lengthMenu: [5,10,20],  // Allow the user to change the number of entries shown per page
        paging: true,         // Disable pagination

        ajax: {
          url: "<?php echo $rootPath ?>/staff/senarai_db",
          "type": "POST",
          "data": function (d) {
            d.senarai_staff_list = true;
            d.role = '<?php echo $_SESSION['user_details']['role'] ?>';
            d.user_id = '<?php echo $_SESSION['user_details']['id'] ?>';
            d.bengkel = '<?php echo $_SESSION['user_details']['bengkel'] ?>';



            console.log('Request Data:', d);
          },

          "error": function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
          },
          "dataSrc": function (json) {
            console.log('dataSrc received data:', json);  // Log response here
            return json.data || [];
          },
        },

        columns: [
          { "data": "user_id", class: "text-center", responsivePriority: 4 },

          {
            "data": null,
            "render": function (data, type, row) {
              return `
                <div class="row justify-content-start align-items-start">
                  <div class="col-sm-auto col-4">
                    <div class="avatar avatar-lg position-relative">
                      <img src="${row.user_image}" 
                          alt="${row.Lecturer_name}" 
                          class="w-100 border-radius-lg shadow-sm">
                    </div>
                  </div>
                  <div class="col-sm-auto col-8 my-auto">
                    <div class="h-100">
                      <h5 class="mb-1 font-weight-bolder text-wrap">
                        ${row.user_name}
                      </h5>
                      <p class="mb-0 font-weight-bold text-sm text-wrap">
                        ${row.ic}
                      </p>
                    </div>
                  </div>
                </div>
              `;
            },
            "class": "",
            "responsivePriority": 1
          },
          { "data": "role", class: "text-center", responsivePriority: 3 },
          { "data": "bengkel", class: "text-center", responsivePriority: 3 },
          {
            "data": null,
            "render": function (data, type, row) {
              return `
                <div class="row justify-content-start align-items-start ">
          
                  <div class="col-sm-auto col-12 mt-sm-1">
                    <div class="h-100">
                      <h5 class="mb-1 font-weight-bolder text-wrap">
                        ${row.email}
                      </h5>
                      <p class="mb-0 font-weight-bold text-sm text-wrap">
                        ${row.phone}
                      </p>
                    </div>
                  </div>
                  
                </div>
              `;
            },
            "class": "dtr-hidden",
            "responsivePriority": 2
          },
          { "data": "birth_date", class: "text-center", responsivePriority: 4 },

          // { "data": "student_name" },
          // { "data": "lecturer_name" },




        ],
      });
    });




  </script>

</body>

</html>