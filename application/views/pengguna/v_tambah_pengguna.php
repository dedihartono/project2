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
              <form class="form-horizontal" role="form" action="<?php echo base_url();?>kelola_pengguna/tambah_pengguna_proses" method="post">
                  <div class="form-group">
                      <label class="col-md-2 control-label">Nama Lengkap</label>
                      <div class="col-md-10">
                          <input type="text" class="form-control" name="nama_lengkap" placeholder="nama lengkap"/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-2 control-label">Username</label>
                      <div class="col-md-10">
                          <input type="text" class="form-control" name="username" placeholder="username"/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-2 control-label">Password</label>
                      <div class="col-md-10">
                          <input type="text" class="form-control" name="password" placeholder="password"/>
                      </div>
                  </div>
                  <div class="form-group">
                       <label class="col-md-2 control-label">Pilih Hak Akses</label>
                       <div class="col-md-10">
                           <select class="form-control" name="hak_akses">
                               <option value="1">Super Admin</option>
                               <option value="2">Admin</option>
                               <option value="3">Direktur</option>
                               <option value="4">Hubungan Lapangan</option>
                               <option value="5">Teknik</option>
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
