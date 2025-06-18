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
        <div class="col-lg-8 col-12 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Permohonan</h6>
                  <p class="text-sm mb-0">
                    <!-- <i class="fa fa-check text-info" aria-hidden="true"></i> -->
                    <!-- <span class="font-weight-bold ms-1">30</span> this month -->
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">

                    <a class="btn btn-adtec" href="<?php echo $rootPath ?>/permohonan/senarai">Lebih Lanjut</a>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tujuan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat
                      </th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Student_name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Lecturer_name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Start</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        End</th>


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

        <?php ?>

        <div class="col-lg-4 col-12">
          <div class="row">
            <div class="col-12 mt-4">
              <div class="card">
                <span class="mask bg-danger opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start ">
                      <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                        <i class="fa fa-check text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                      <h5 id="permohonan-approved" class="text-white font-weight-bolder mb-0 mt-3">0</h5>
                      <span class="text-white text-sm">Approved Permohonan This Month</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 mt-4">
              <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                  <div class="row">
                    <div class="col-8 text-start">
                      <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                        <i class="fa fa-ban text-dark text-gradient text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                      <h5 id="permohonan-pending" class="text-white font-weight-bolder mb-0 mt-3">0</h5>
                      <span class="text-white text-sm">Rejected Permohonan This Month</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
        // stateSave: true, //dashboard doesnt have state save
        responsive: true,
        pageLength: 5,  // Number of entries per page (you can change this to whatever number you want)
        lengthMenu: [5],  // Allow the user to change the number of entries shown per page
        paging: false,         // Disable pagination

        ajax: {
          url: "<?php echo $rootPath ?>/permohonan/senarai",
          "type": "POST",
          "data": function (d) {
            d.senarai_permohonan_list = true;
            d.role = '<?php echo $_SESSION['user_details']['role'] ?>';
            d.user_id = '<?php echo $_SESSION['user_details']['id'] ?>';



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
          { "data": "permohonan_id", class: "text-center", responsivePriority: 4 },
          // { "data": "student_name" },
          // { "data": "lecturer_name" },
          { "data": "purpose", class: " ", responsivePriority: 2 },
          { "data": "place", class: " ", responsivePriority: 3 },
          // { "data": "start" },
          // { "data": "end" },
          {
            "data": "status",
            "class": "justify-content-center text-center",  // Center the text and content
            "render": function (data, type, row, meta) {
              let buttonClass = '';
              let buttonText = '';

              // Assign button class and text based on status value
              switch (data) {
                case '0': // Assuming '1' means "approved"
                  buttonClass = 'btn-danger';
                  buttonText = 'Rejected';
                  break;
                case '3': // Assuming '1' means "approved"
                  buttonClass = 'btn-success';
                  buttonText = 'Approved';
                  break;
                case '1': // Assuming '2' means "pending"
                  buttonClass = 'btn-warning';
                  buttonText = 'Pending';
                  break;
                case '2': // Assuming '3' means "rejected"
                  buttonClass = 'btn-info';
                  buttonText = 'Pending';
                  break;
                default:
                  buttonClass = 'btn-secondary';
                  buttonText = 'Unknown';
                  break;
              }

              // Return the button HTML with dynamic class
              return '<button class="btn ' + buttonClass + ' btn-sm  text-nowrap pe-none">' + buttonText + '</button>';
            },
            responsivePriority: 1

          },

          { "data": "student_name", class: "dtr-hidden ", responsivePriority: 9 },

          { "data": "lecturer_name", class: " dtr-hidden", responsivePriority: 9 },

          { "data": "start", class: "dtr-hidden ", responsivePriority: 9 },
          { "data": "end", class: " dtr-hidden", responsivePriority: 9 },
          {
            "data": null,
            "render": function (data, type, row) {
              // Combine 'file' and 'file_ext' into a single string
              var fileName = data.file;   // File extension

              var fileExt = data.file_ext;   // File extension

              // Display both values in the same column
              return '<a class="btn btn-info mt-2" data-fancybox data-type="' + fileExt + '" data-src="' + fileName + '" href="javascript:;">File</a>';
            },
            "orderable": false,
            "className": "text-center"
          },



        ],
      });
    });


    $(document).ready(function () {


      // Example: Set the start and end date for the current month (can be dynamic)
      const startDate = new Date(new Date().getFullYear(), new Date().getMonth(), 1); // First day of current month
      const endDate = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0); // Last day of current month

      // Format dates to 'Y-m-d' format
      const formattedStartDate = startDate.toISOString().split('T')[0]; // 'YYYY-MM-DD'
      const formattedEndDate = endDate.toISOString().split('T')[0]; // 'YYYY-MM-DD'

      // Send an AJAX request to fetch the permohonan data
      $.ajax({
        url: '<?php echo $rootPath ?>/permohonan/senarai', // Replace with your PHP file
        type: 'POST',
        data: {
          senarai_permohonan_list: true,
          role: '<?php echo $_SESSION['user_details']['role'] ?>',
          user_id: '<?php echo $_SESSION['user_details']['id'] ?>',
          start_date: formattedStartDate, // Send the start date
          end_date: formattedEndDate, // Send the end date
        },
        dataType: 'json',
        success: function (data) {
          // Declare counts for approved and pending
          let approvedCount = 0;
          let pendingCount = 0;

          // Loop through the data and calculate approved (status 3) and pending (status 0) counts
          data.data.forEach(item => {
            const itemDate = new Date(item.start); // Assume 'start' is the date field

            // Check if the permohonan is within the selected date range
            const isWithinRange = itemDate >= startDate && itemDate <= endDate;

            if (isWithinRange) {
              if (item.status == 3) { // Approved (Status 3)
                approvedCount++;
              } else if (item.status == 0) { // Pending (Status 0)
                pendingCount++;
              }
            }
          });

          // Update the HTML elements with the calculated counts
          $('#permohonan-approved').text(approvedCount);
          $('#permohonan-pending').text(pendingCount);
        },
        error: function () {
          console.error('Error fetching permohonan data');
        }
      });


    });



  </script>



</body>

</html>