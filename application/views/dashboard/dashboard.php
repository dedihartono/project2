<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title ;?>
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="#"><i class="fa fa-dashboard"></i><?php echo $breadcrumb01 ;?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php
    $check  = $this->session->userdata();
		var_dump($check); ?>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
