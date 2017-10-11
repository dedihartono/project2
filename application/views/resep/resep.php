<!--LOAD LIBRARY FOR THIS PAGE-->
<!--DataTables-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/datatables/extensions/ColVis/css/dataTables.colVis.min.css')?>">

<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<script src="<?php echo base_url('assets/plugins/datatables/extensions/ColVis/js/dataTables.colVis.min.js')?>"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    	<?php echo $title ;?>
    </h1>
    <ol class="breadcrumb pull-left">
      <li class=""><a href="#"><i class="fa fa-building"></i><?php echo $breadcrumb01 ;?></a></li>
      <li class="active"><?php echo $breadcrumb02 ;?></li>
    </ol>
  </section><br>

  <!-- Main content -->
  <section class="content">
    <div class="box">
	    <div class="box-header">
	      <h3 class="box-title"><?php echo $titlebox ;?></h3>
	    </div>
   	<div class="box-body">
		   <div class="row">
		    	<div class="col-md-12">
		    		<div id="colvis"></div>
		            <div>
			            <button class="btn btn-primary" title="tambah data" onclick="tambah()">
			                <i class="fa fa-plus"></i> Tambah Data
			            </button>
			            <button class="btn btn-default" title="tambah data" onclick="reload_table()">
			                <i class="fa fa-refresh"></i> Refresh
			            </button>
		            </div>
		        </div>
		    </div><br>

			<div class="row">
		    	<div class="col-md-12">
			       <table id="table" class="table table-bordered" cellspacing="0" width="100%">
			            <thead>
			                <tr>
			                    <th width="3%">NO</th>
			                    <th width="3%">ID</th>
                          <th width="10%">TANGGAL</th>
			                    <th width="">NAMA PASIEN</th>
                          <th width="">NAMA DOKTER</th>
                          <th width="">OBAT</th>
                          <th width="12%">STATUS</th>
                          <th width="9%">AKSI</th>
			                </tr>
			            </thead>
			            <tbody>
			            </tbody>
			            <tfoot>
			                <tr>
                        <th width="3%">NO</th>
                        <th width="3%">ID</th>
                        <th width="">TANGGAL</th>
                        <th width="">NAMA PASIEN</th>
                        <th width="">NAMA DOKTER</th>
                        <th width="">OBAT</th>
                        <th width="">STATUS</th>
                        <th width="">AKSI</th>
			                </tr>
			            </tfoot>
			        </table>
			    </div>
			</div>
    	</div>
	</div>
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">

	var table;

	$(document).ready(function() {

	    //datatables
	    table = $('#table').DataTable({


	        "language": {
	                "url": "<?php echo base_url('assets/plugins/datatables/lang/indonesia_lang.json')?>"

	        },

	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": "<?php echo site_url('Kelola_resep/tampil_resep')?>",
	            "type": "POST"
	        },

	        //Set column definition initialisation properties.
	        "columnDefs": [
		        {

		            "targets": [ 0 ], //first and four column / numbering column
		            "orderable": false, //set not orderable
		        },
		        {

		            "orderable": true,
		        },
		        {

		            "targets": [ 1, 4 ], //two column / numbering column
		            "visible": false, //set visible
		        },
	        ],
	    });

    var colvis = new $.fn.dataTable.ColVis(table); //initial colvis
    $('#colvis').html(colvis.button()); //add colvis button to div with id="colvis"

});

	function tambah()
	{
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
    $('#status').hide();
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Tambah resep'); // Set Title to Bootstrap modal title
	}

	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax
	}

	function edit(id_resep)
	{
	    save_method = 'update';
	    $('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
      $('#status').show();

	    //Ajax Load data from ajax
	    $.ajax({
	        url : "<?php echo site_url('kelola_resep/edit_resep')?>/" + id_resep,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data)
	        {

	            $('[name="id_resep"]').val(data.id_resep);
              $('[name="nama_resep"]').val(data.nama_resep);
              $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
              $('[name="alamat"]').val(data.alamat);
              $('[name="tgl_lahir"]').val(data.tgl_lahir);
              $('[name="id_gol_darah"]').val(data.id_gol_darah);
	            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	            $('.modal-title').text('Edit resep'); // Set title to Bootstrap modal title

	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
	    });
	}


	function save()
	{
	    $('#btnSave').text('saving...'); //change button text
	    $('#btnSave').attr('disabled',true); //set button disable
	    var url;

	    if(save_method == 'add') {
	        url = "<?php echo site_url('kelola_resep/tambah_save')?>";
	    } else {
	        url = "<?php echo site_url('kelola_resep/edit_save')?>";
	    }

	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#form').serialize(),
	        dataType: "JSON",
	        success: function(data, status)
	        {

	            if(data.status!='error') //if success close modal and reload ajax table
	            {
	                $('#modal_form').modal('hide');
	                alert(data.msg);
	                reload_table();
	            }
	            else
	            {

	                alert(data.msg);

	               /* for (var i = 0; i < data.msg.length; i++)
                	{
	                    $('[name="pelanggan"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="pelanggan"]').next().text(data.msg[i]); //select span help-block class set text error string
                	}

                	*/
	            }

	            $('#btnSave').text('Simpan'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('Simpan'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable

	        }
	    });
	}

	function hapus(id_resep)
	{
	    if(confirm('Anda Yakin Menghapus Data Ini?'))
	    {
	        // ajax delete data to database
	        $.ajax({
	            url : "<?php echo site_url('kelola_resep/hapus')?>/"+id_resep,
	            type: "POST",
	            dataType: "JSON",
	            success: function(data)
	            {
	                //if success reload ajax table
	                $('#modal_form').modal('hide');
	                alert('Data Berhasil dihapus!');
	                reload_table();
	            },
	            error: function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }
	        });

	    }
	}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content col-md-10">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_resep"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-4">Tanggal</label>
                            <div class="col-md-3">
                                <input name="tanggal" placeholder="" class="form-control datepicker" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Pasien</label>
                            <div class="col-md-6">
                              <select class="form-control" name="id_pasien">
                                <?php foreach ($pasien as $row): ?>
                                  <option value="<?php echo $row->id_pasien;?>"><?php echo $row->nama_pasien;?></option>
                                <?php endforeach; ?>
                              </select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Obat</label>
                            <div class="col-md-6">
                              <select class="form-control" name="id_obat">
                                <?php foreach ($obat as $row): ?>
                                  <option value="<?php echo $row->id_obat;?>"><?php echo $row->nama_obat;?></option>
                                <?php endforeach; ?>
                              </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="status">
                            <label class="control-label col-md-4">Status</label>
                            <div class="col-md-6">
                                <select class="form-control" name="id_status">
                                  <?php foreach ($status as $row): ?>
                                    <option value="<?php echo $row->id_status;?>"><?php echo $row->status;?></option>
                                  <?php endforeach; ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
