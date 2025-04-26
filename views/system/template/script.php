<!--   Core JS Files   -->
<script src="<?php echo $rootPath; ?>/assets/js/core/popper.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/core/bootstrap.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/chartjs.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/fullcalendar.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/jquery-3.7.1.js"></script>

<!-- Kanban scripts -->
<script src="<?php echo $rootPath; ?>/assets/js/plugins/dragula/dragula.min.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/jkanban/jkanban.js"></script>
<script src="<?php echo $rootPath; ?>/assets/js/plugins/chartjs.min.js"></script>
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