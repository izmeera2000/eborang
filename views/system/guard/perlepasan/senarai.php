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
            <div class="row">

                <div class="col-12">
                    <div class="card card-calendar">
                        <div class="card-body p-3">
                            <div class="calendar fc fc-media-screen fc-direction-ltr fc-theme-standard"
                                data-bs-toggle="calendar" id="calendar">

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            

            <!-- //modal -->
            <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eventModalLabel">Pelepasan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <input type="hidden" name="role"
                                        value="<?php echo $_SESSION['user_details']['role']; ?>">
                                    <input type="hidden" name="bengkel"
                                        value="<?php echo $_SESSION['user_details']['bengkel']; ?>">
                                    <input type="hidden" id="permohonan_id" name="permohonan_id">

                                    <label for="exampleFormControlSelect1" class="mt-2">Student </label>
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex align-items-center px-0">
                                            <div class="avatar me-3">
                                                <img id="student_image" class="border-radius-lg shadow">
                                            </div>
                                            <div class="d-flex align-items-start flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm" id="student_name">Name</h6>
                                                <p class="mb-0 text-xs" id="ndp">NDP</p>
                                            </div>
                                        </li>
                                    </ul>

                                    <label for="exampleFormControlSelect1" class="mt-2">Jenis Permohonan </label>
                                    <input class="form-control" type="text" id="permohonan_type">

                                    <label for="exampleFormControlSelect1" class="mt-2">Tempat </label>
                                    <input class="form-control" type="text" id="lecturer_id">

                                    <label for="exampleFormControlSelect1" class="mt-2">Tempat </label>
                                    <input class="form-control" type="text" id="tempat">

                                    <label for="exampleFormControlSelect1" class="mt-2">Tujuan </label>
                                    <input class="form-control" type="text" id="tujuan">

                                    <!-- <label for="exampleFormControlSelect1" class="mt-2">Bukti </label>
                                    <input class="form-control" type="file" id="bukti" required> -->



                                    <a class="btn btn-info mt-2" data-fancybox href="javascript:;" id="file_preview">
                                        File
                                    </a>

                                </div>
                                <div id="auth_button">


                                    <button type="submit" class="btn btn-danger"
                                        name="permohonan_auth_decline">Decline</button>
                                    <button type="submit" class="btn btn-primary"
                                        name="permohonan_auth_accept">Confirm</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/footer2.php"); ?>

        </div>


    </main>


    <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/script.php"); ?>

    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

    <script>

        var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
            contentHeight: 'auto',
            initialView: "listDay",
            headerToolbar: {
                start: 'title', // will normally be on the left. if RTL, will be on the right
                center: '',
                end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
            },
            hiddenDays: [0, 6],
            slotMinTime: "08:00:00",
            slotMaxTime: "18:00:00",
            views: {
                month: {
                    titleFormat: {
                        month: "long",
                        year: "numeric"
                    }
                },
                agendaWeek: {
                    titleFormat: {
                        month: "long",
                        year: "numeric",
                        day: "numeric"
                    }
                },
                agendaDay: {
                    titleFormat: {
                        month: "short",
                        year: "numeric",
                        day: "numeric"
                    }
                }
            },
            events: function (fetchInfo, successCallback, failureCallback) {
                console.log("Sending request to fetch events..."); // Debug log

                $.ajax({
                    url: "<?php echo $rootPath; ?>/permohonan/senarai_calendar",
                    type: "POST",
                    dataType: "json",
                    data: {
                        senarai_permohonan_calendar: true,
                        start: fetchInfo.startStr,
                        end: fetchInfo.endStr,
                        role: "<?php echo $_SESSION['user_details']['role']; ?>",
                        user_id: "<?php echo $_SESSION['user_details']['id']; ?>",
                        bengkel: "",

                    }, // Secure POST request
                    success: function (response) {
                        console.log("Response received:", response); // Debug log
                        successCallback(response);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching events:", status, error);
                        failureCallback([]);
                    }
                });
            },
            // selectable: true,
            // eventOverlap: false,

            eventClick: function (info) {
                const existingEvents = calendar.getEvents();
                const selectedStart = info.event.start;
                const selectedEnd = info.event.end;

                var modal = new bootstrap.Modal(document.getElementById('eventModal'));
                $('#time-container').empty();


                console.log(`Selected: ${selectedStart} to ${selectedEnd}`);


                document.getElementById('permohonan_id').value = info.event.extendedProps.permohonan_id || '';
                document.getElementById('permohonan_type').value = info.event.extendedProps.permohonan_type || '';
                document.getElementById('lecturer_id').value = info.event.extendedProps.lecturer_id || '';
                document.getElementById('tempat').value = info.event.extendedProps.place || '';
                document.getElementById('tujuan').value = info.event.extendedProps.purpose || '';

                document.getElementById('student_name').innerText = info.event.extendedProps.student_name || '';
                document.getElementById('ndp').innerText = info.event.extendedProps.ndp || '';
                document.getElementById('student_image').src = info.event.extendedProps.student_image || '';

                const filePreview = document.getElementById('file_preview');
                filePreview.removeAttribute('data-src');
                filePreview.removeAttribute('data-type');
                filePreview.removeAttribute('href');
                
                filePreview.setAttribute('href', info.event.extendedProps.file);
                filePreview.setAttribute('data-type', info.event.extendedProps.file_type);  


                if (info.event.extendedProps.status != '2') {
                    $('#auth_button').addClass('d-none'); // Hide the buttons
                } else {
                    $('#auth_button').removeClass('d-none'); // Show the buttons
                }


                // while (currentDate < endDate) {

                //             let html = `
                // <div class="date-block mb-4">
                //     <h6>Tarikh: ${dateStr}</h6>
                //     <input type="hidden" name="dates[]" value="${dateStr}">
                //     <div class="row">
                //         <div class="col-6">
                //             <label for="start-${dateStr}" class="form-label">Masa Mula</label>
                //             <input type="time" class="form-control" name="time_start[]" id="start-${dateStr}" min="08:00" max="18:00">
                //         </div>
                //         <div class="col-6">
                //             <label for="end-${dateStr}" class="form-label">Masa Tamat</label>
                //             <input type="time" class="form-control" name="time_end[]" id="end-${dateStr}" min="08:00" max="18:00">
                //         </div>
                //     </div>
                // </div>
                // `;

                // $('#time-container').append(html);

                // Go to the next date
                // currentDate.setDate(currentDate.getDate() + 1);
                modal.show();
                // }
            },



        });

        calendar.render();
        // Helper function to format date in 'YYYY-MM-DD' format using local time
        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // month is 0-based
            const day = String(date.getDate()).padStart(2, '0'); // ensure two digits
            return `${year}-${month}-${day}`;
        }




        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('11e3f5950448ddf8e399', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('guard');
        channel.bind('pelepasan', function (data) {
            calendar.refetchEvents();
        });

    </script>



</body>

</html>