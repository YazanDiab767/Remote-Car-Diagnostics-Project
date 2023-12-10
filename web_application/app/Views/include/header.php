<nav class="navbar navbar-expand-lg header" dir="rtl">

  <a class="navbar-brand" href="#" class="username">
    اسم المستخدم :
    <?php
      echo $_SESSION['user_data']['username'];
    ?>
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars" style="color: white;"></i>
  </button>

  
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav" style="margin-right: 70px;">
      <a class="nav-item nav-link" href="main"><i class="fas fa-home"></i> الرئيسية  </a>
      <a class="nav-item nav-link" href="question/user/<?php echo $_SESSION['user_data']['user_id']; ?>"> <i class="fas fa-question-circle"></i> اسئلتي </a>
      <?php
        if (basename($_SERVER['PHP_SELF']) == "main.php")
          echo '<a class="nav-item nav-link" id="show_create_post" href="#"><i class="fas fa-plus-square"></i> انشاء سؤال جديد  </a>';
      ?>
      <a class="nav-item nav-link" href="faculties"><i class="fas fa-building"></i> الكليات  </a>
      <?php
        if ($_SESSION['user_data']['type'] != "user")
          echo '<a class="nav-item nav-link" href="control_panel.php"><i class="fas fa-keyboard"></i> لوحة التحكم </a>';
      ?>
      <a class="nav-item nav-link" href="settings"><i class="fas fa-cogs"></i> اعدادات الحساب  </a>
      <a class="nav-item nav-link" href="user/logout"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج  </a>
    </div>
  </div>

</nav>