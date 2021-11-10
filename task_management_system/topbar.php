<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-success navbar-dark ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <?php if(isset($_SESSION['login_id'])): ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
      </li>
    <?php endif; ?>
      <li>
        <a class="nav-link text-white"  href="./" role="button"> <large><b><?php echo $_SESSION['system']['name'] ?></b></large></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link"  data-toggle="dropdown" aria-expanded="true" id="notification">
            <span>
              <div class="d-felx badge-pill">
                <i class="fa fa-envelope"></i>
                <span><b>Thông báo</b></span>
                <span class="badge badge-danger" style="position: absolute;top: 0; right: 0;"></span>
                <span class="fa fa-angle-down"></span>
              </div>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;" id="notification_detail"></div>
     <li class="nav-item dropdown">
            <a class="nav-link"  data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
              <span>
                <div class="d-felx badge-pill">
                  <span class="fa fa-user"></span>
                  <span><b><?php echo ucwords($_SESSION['login_firstname']) ?></b></span>
                  <span class="fa fa-angle-down"></span>
                </div>
              </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;" id="account_settings">
              <a class="dropdown-item" href="javascript:void(0)" id="manage_account"><i class="fa fa-cog"></i> Quản lý tài khoản</a>
              <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Đăng xuất</a>
            </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <script>
     $('#manage_account').click(function(){
        uni_modal('Quản lý tài khoản','manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
      })
     $(document).ready(function() {
         function load_unseen_notification(view = '') {
             $.ajax({
                 url: "notification.php",
                 method: "POST",
                 data: {view: view},
                 dataType: "json",
                 success: function (data) {
                     $('#notification_detail').html(data.notification);
                     if (data.unseen_notification > 0) {
                         $('.badge-danger').html(data.unseen_notification);
                     }
                 }
             });
         }

         load_unseen_notification();
         $(document).on('click', '#notification', function () {
             $('.badge-danger').html('');
             load_unseen_notification('yes');
         });

         setInterval(function () {
             load_unseen_notification();;}, 5000);
     })

  </script>
