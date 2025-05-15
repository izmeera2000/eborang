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

        <div class="  col-12   mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Perlepasan</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-calendar-o text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1"></span> this month
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end">
                  <div class="dropdown float-lg-end pe-4">

                    <a class="btn btn-adtec" href="<?php echo $rootPath ?>/perlepasan/senarai">Lebih Lanjut</a>
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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Student_name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tujuan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempat
                      </th>


                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Lecturer_name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        Start</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                        End</th>


                    </tr>

                  </thead>
                  <tbody>


                  </tbody>
                </table>
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
      const today = new Date().toISOString().split('T')[0]; // Format as YYYY-MM-DD


      $('#eventsTable').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true, //dashboard doesnt have state save
        responsive: true,
        pageLength: 100,  // Number of entries per page (you can change this to whatever number you want)
        // lengthMenu: [5],  // Allow the user to change the number of entries shown per page
        paging: false,         // Disable pagination

        ajax: {
          url: "<?php echo $rootPath ?>/permohonan/senarai",
          "type": "POST",
          "data": function (d) {
            d.senarai_permohonan_list = true;
            d.role = '<?php echo $_SESSION['user_details']['role'] ?>';
            d.user_id = '<?php echo $_SESSION['user_details']['id'] ?>';
            d.user_id = '<?php echo $_SESSION['user_details']['id'] ?>';
            d.start_date = today,
              d.end_date = today,


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
          {
            "data": null,
            "render": function (data, type, row) {
              return `
      <div class="row justify-content-center align-items-center">
        <div class="col-sm-auto col-4">
          <div class="avatar avatar-lg position-relative">
            <img src="<?php echo $rootPath ?>/assets/img/user/${row.student_id}/${row.image}" alt="${row.student_name}" class="w-100 border-radius-lg shadow-sm">
          </div>
        </div>
        <div class="col-sm-auto col-8 my-auto">
          <div class="h-100">
            <h5 class="mb-1 font-weight-bolder">
              ${row.student_name}
            </h5>
            <p class="mb-0 font-weight-bold text-sm">
              ${row.ndp}
            </p>
          </div>
        </div>
        
      </div>
    `;
            },
            "class": "",
            "responsivePriority": 1
          },


          { "data": "purpose", class: "dtr-hidden ", responsivePriority: 3 },
          { "data": "place", class: " dtr-hidden", responsivePriority: 3 },
          // { "data": "start" },
          // { "data": "end" },
          // {
          //   "data": "status",
          //   "class": "justify-content-center text-center",  // Center the text and content
          //   "render": function (data, type, row, meta) {
          //     let buttonClass = '';
          //     let buttonText = '';

          //     // Assign button class and text based on status value
          //     switch (data) {
          //       case '0': // Assuming '1' means "approved"
          //         buttonClass = 'btn-danger';
          //         buttonText = 'Rejected';
          //         break;
          //       case '3': // Assuming '1' means "approved"
          //         buttonClass = 'btn-success';
          //         buttonText = 'Approved';
          //         break;
          //       case '1': // Assuming '2' means "pending"
          //         buttonClass = 'btn-warning';
          //         buttonText = 'Pending';
          //         break;
          //       case '2': // Assuming '3' means "rejected"
          //         buttonClass = 'btn-info';
          //         buttonText = 'Pending';
          //         break;
          //       default:
          //         buttonClass = 'btn-secondary';
          //         buttonText = 'Unknown';
          //         break;
          //     }

          //     // Return the button HTML with dynamic class
          //     return '<button class="btn ' + buttonClass + ' btn-sm  text-nowrap pe-none">' + buttonText + '</button>';
          //   },
          //   responsivePriority: 1

          // },


          // { "data": "lecturer_name", class: " dtr-hidden", responsivePriority: 9 },

          {
            "data": null,
            "render": function (data, type, row) {
              return `
                <div class="row justify-content-center align-items-center">
          
                  <div class="col-sm-auto col-12 mt-sm-1">
                    <div class="h-100">
                      <h5 class="mb-1 font-weight-bolder">
                        ${row.lecturer_name}
                      </h5>
                      <p class="mb-0 font-weight-bold text-sm">
                        ${row.lecturer_phone}
                      </p>
                    </div>
                  </div>
                  
                </div>
              `;
            },
            "class": "dtr-hidden",
            "responsivePriority": 2
          },

          { "data": "start", class: "dtr-hidden ", responsivePriority: 3 },
          { "data": "end", class: " dtr-hidden", responsivePriority: 3 },
          // {
          //   "data": null,
          //   "render": function (data, type, row) {
          //     // Combine 'file' and 'file_ext' into a single string
          //     var fileName = data.file;   // File extension

          //     var fileExt = data.file_ext;   // File extension

          //     // Display both values in the same column
          //     return '<a class="btn btn-info mt-2" data-fancybox data-type="' + fileExt + '" data-src="' + fileName + '" href="javascript:;">File</a>';
          //   },
          //   "orderable": false,
          //   "className": "text-center"
          // },



        ],
      });
    });
  </script>

</body>

</html>