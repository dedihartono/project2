<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="#"><?php echo $breadcrumb_1 ;?></a></li>
    <li><?php echo $breadcrumb_2 ;?></li>
    <li class="active"><?php echo $breadcrumb_3 ;?></li>
</ul>

<!-- END BREADCRUMB -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="">
                <h3 class="panel-title"><?php echo $panel_title;?></h3>
              </div>
            </div>
            <div class="panel-body">
              <form class="form-horizontal" role="form" action="<?php echo base_url();?>kelola_pengguna/edit_pengguna_proses/<?php echo $this->uri->segment(3);?>" method="post">
                  <div class="form-group">
                      <label class="col-md-2 control-label">Nama Lengkap</label>
                      <div class="col-md-10">
                          <input type="text" value="<?php echo $pengguna->nama_lengkap;?>" class="form-control" name="nama_lengkap" placeholder="kode lokasi"/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-2 control-label">Username</label>
                      <div class="col-md-10">
                          <input type="text" class="form-control" value="<?php echo $pengguna->username;?>" name="username" placeholder="lokasi unit"/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-2 control-label">Password</label>
                      <div class="col-md-10">
                          <input type="password" value="<?php echo $pengguna->password;?>"  class="form-control" name="password" placeholder="lokasi unit"/>
                      </div>
                  </div>
                  <div class="form-group">
                       <label class="col-md-2 control-label">Pilih Hak Akses</label>
                       <div class="col-md-10">
                         <?php
                              $jabatan = [ 1 => "Super Admin", "Admin", "Direktur", "Subag Hublang", "Teknik"];
                          ;?>

                        <select class="form-control" name="hak_akses">
                          <?php foreach ($jabatan as $key => $value) { ?>

                            <option value="<?php echo $key;?>"
                              <?php
                              if ($pengguna->hak_akses == $key) {
                                echo "selected = 'selected'";
                              }
                              ;?>>
                              <?php echo $value;?>
                            </option>

                          <?php } ;?>

                        </select>
                       </div>
                   </div>

                  <div class="form-group">
                      <div class="col-md-10 pull-right" >
                        <button class="btn btn-primary" type="submit">Simpan</button>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
