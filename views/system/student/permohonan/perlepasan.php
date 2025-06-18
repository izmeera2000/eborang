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
                            <h5 class="modal-title" id="eventModalLabel">Permohonan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id"
                                    value="<?php echo $_SESSION['user_details']['id'] ?>">
                                <input type="hidden" name="permohonan_type" value="2"> <!-- example type -->
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Lecturer</label>
                                    <select class="form-control" name="lecturer_id" required>
                                        <?php


                                        // $lect = [];
                                        $lect = "SELECT * FROM users WHERE role='3'";
                                        $result = mysqli_query($conn, $lect);


                                        if (mysqli_num_rows($result) > 0) {
                                            while ($user = mysqli_fetch_assoc($result)) {
                                                // Do something with $user
                                                ?>
                                                <option value="<?php echo $user['id'] ?>"><?php echo $user['email'] ?></option>
                                                <?php
                                            }
                                        }

                                        ?>

                                    </select>

                                    <label for="exampleFormControlSelect1" class="mt-2">Tempat </label>
                                    <input class="form-control" type="text" name="tempat" required>

                                    <label for="exampleFormControlSelect1" class="mt-2">Tujuan </label>
                                    <input class="form-control" type="text" name="tujuan" required>

                                    <label for="exampleFormControlSelect1" class="mt-2">Bukti </label>
                                    <input class="form-control" type="file" name="bukti" required>

                                </div>
                                <div id="time-container"></div>



                                <button type="submit" class="btn btn-primary" name="permohonan_request">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/footer2.php"); ?>

        </div>
        <?php
        if (!$_SESSION['user_details']['nama']) {


            swal("Error", "Anda tidak mempunyai butiran yang lengkap", "error", "OK", "$basePath2/profile");

            ?>

            <?php
        }
        ?>

    </main>


    <?php include($_SERVER['DOCUMENT_ROOT'] . $basePath2 . "/views/system/template/script.php"); ?>


    <script>

        var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
            contentHeight: 'auto',
            initialView: "dayGridMonth",
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
            selectable: true,
            // eventOverlap: false,
            validRange: {
                start: new Date().toISOString().split('T')[0]
            },
            select: function (info) {
                const existingEvents = calendar.getEvents();
                const selectedStart = info.start;
                const selectedEnd = info.end;

                const overlapping = existingEvents.some(event => {
                    return (
                        selectedStart < event.end &&
                        selectedEnd > event.start
                    );
                });
                var modal = new bootstrap.Modal(document.getElementById('eventModal'));
                $('#time-container').empty();

                let currentDate = new Date(info.start);
                const endDate = new Date(info.end); // exclusive

                // Optional: display selected range
                const startStr = formatDate(currentDate);
                const endStr = formatDate(new Date(endDate.getTime() - 86400000)); // subtract 1 day
                console.log(`Selected: ${startStr} to ${endStr}`);


                if (overlapping) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pertindihan Masa',
                        text: 'Slot yang dipilih bertindih dengan permohonan sedia ada.',
                    });
                    calendar.unselect(); // Clear selection
                    return;
                }

                while (currentDate < endDate) {
                    const dateStr = formatDate(currentDate);

                    let html = `
 <div class="date-block mb-4">
    <h6>Tarikh: ${dateStr}</h6>
    <input type="hidden" name="dates[]" value="${dateStr}">
    <div class="row">
        <div class="col-6">
            <label for="start-${dateStr}" class="form-label">Masa Mula</label>
            <input type="time" class="form-control" name="time_start[]" id="start-${dateStr}" min="08:00" max="17:00" onchange="validateTime(this)">
        </div>
        <div class="col-6">
            <label for="end-${dateStr}" class="form-label">Masa Tamat</label>
            <input type="time" class="form-control" name="time_end[]" id="end-${dateStr}" min="08:00" max="17:00" onchange="validateTime(this)">
        </div>
    </div>
</div>
        `;

                    $('#time-container').append(html);

                    // Go to the next date
                    currentDate.setDate(currentDate.getDate() + 1);
                    modal.show();
                }
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


     function validateTime(input) {
        const minTime = '08:00';
        const maxTime = '17:00';
        const value = input.value;

        if (value < minTime) {
            input.setCustomValidity(`Please select a time after ${minTime}.`);
        } else if (value > maxTime) {
            input.setCustomValidity(`Please select a time before ${maxTime}.`);
        } else {
            input.setCustomValidity('');
        }
    }
     </script>



</body>

</html>