<!--   Core JS Files   -->
<script src="<?php echo $rootPath; ?>/assets/js/core/popper.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/chartjs.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/fullcalendar.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/jquery-3.7.1.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/datatables.js"></script>

<!-- Kanban scripts -->
<script src="<?php echo $rootPath; ?>/assets/js/plugins/dragula/dragula.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/jkanban/jkanban.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/sweetalert.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/jquery.fancybox.js"></script>


<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo $rootPath; ?>/assets/js/soft-ui-dashboard.min.js"></script>
<script src="https://js.pusher.com/beams/2.1.0/push-notifications-cdn.js"></script>

<script>


  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('<?php echo $rootPath; ?>/service-worker.js') // your custom path
        .then(registration => {
          console.log("Service Worker registered:", registration);

          const beamsClient = new PusherPushNotifications.Client({
            instanceId: 'fdd92782-8efa-4d4a-b49d-d59a098a894d',
            serviceWorkerRegistration: registration  // 🔑 THIS is required
          });


          beamsClient.start()
            .then(() => {
              // Subscribe the device to the correct interest
              beamsClient.addDeviceInterest('<?php echo $_SESSION['user_details']['id'] ?>')
                .then(() => {
                  console.log('Successfully subscribed to <?php echo $_SESSION['user_details']['id'] ?>');
                })
                .catch(err => {
                  console.error('Error subscribing to interest', err);
                });
            })
            .catch((err) => {
              console.error('Error initializing PusherBeams:', err);
            });
        })
        .catch((err) => {
          console.error('Error registering service worker:', err);
        });

    });
  }

</script>