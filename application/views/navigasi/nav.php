<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url();?>assets/dist/img/<?php echo $this->session->userdata('gambar');?>" class="img-circle"
        alt="<?php echo $this->session->userdata('nama_lengkap');?>">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('nama_lengkap');?></p>
        <a href="#"><i class="fa fa-circle text-success"></i>
          <?php if ($this->session->userdata('logged_in') == TRUE ){
              echo "Online";
            } ; ?>
          </a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
  <?php
  $jabatan = [ 1 => "Admin", ];
  $hak_akses = $this->session->userdata('jabatan');
  if($hak_akses == $jabatan[1]) { ;?>

  <li class="treeview">
    <a href="<?php echo base_url();?>dashboard">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>
  <li class="treeview">
    <a href="#">
      <i class="fa fa-table"></i> <span>Master</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo base_url();?>ruangan"><i class="fa fa-circle-o"></i> Kelola Ruangan</a></li>
      <li><a href="<?php echo base_url();?>obat"><i class="fa fa-circle-o"></i> Kelola Obat</a></li>
      <li><a href="<?php echo base_url();?>dokter"><i class="fa fa-circle-o"></i> Kelola Dokter</a></li>
      <li><a href="<?php echo base_url();?>pasien"><i class="fa fa-circle-o"></i> Kelola Pasien</a></li>
      <li><a href="<?php echo base_url();?>distributor"><i class="fa fa-circle-o"></i> Kelola Distributor</a></li>
    </ul>
  </li>
<?php } ; ?>
</ul>

  </section>
  <!-- /.sidebar -->
</aside>
