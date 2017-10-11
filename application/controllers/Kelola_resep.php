<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_resep extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//load model and add alias
		//check session logged_in
			$this->load->model(['m_resep', 'm_pengguna', 'm_pasien', 'm_obat']);
			$this->m_pengguna->check_session();

	}

	public function tampil()
	{
		$data = [
			'title' 		    => 'Kelola Resep',
			'titlebox' 		  => 'Data Resep',
			'breadcrumb01' 	=> 'Kelola Resep',
			'breadcrumb02' 	=> 	anchor('resep', 'Tampil Resep'),
      'pasien'        => $this->m_pasien->get_pasien(),
      'obat'          => $this->m_obat->get_obat(),
      'status'        => $this->m_resep->get_status(),
			'konten'        => 'resep/resep',
		];

		$this->load->view('template_admin', $data);
	}

	public function get_obat($data)
	{
		$data = $this->m_obat->get_obat_name($data);
		$this->output->set_content_type('application/json')->set_output(json_encode(array('value'=>$data)));
	}

	public function tampil_resep()
	{

		$list = $this->m_resep->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $resep) {

			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $resep->id_resep_dokter;
			$row[] = $resep->tanggal;
			$row[] = $resep->nama_pasien;
      $row[] = $resep->nama_dokter;
			$row[] = $resep->nama_obat;
      $row[] = $resep->status;

			$row[] =
					'<a class="btn btn-sm btn-success" href="javascript:void(0)"
						title="Ubah" onclick="edit('."'".$resep->id_resep_dokter."'".')">
						<i class="glyphicon glyphicon-pencil"></i>
					</a>

				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)"
				  		title="Hapus" onclick="hapus('."'".$resep->id_resep_dokter."'".')">
				  		<i class="glyphicon glyphicon-trash"></i>
				  	</a>';

			$data[] = $row;
		}

			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->m_resep->count_all(),
							"recordsFiltered" => $this->m_resep->count_filtered(),
							"data" => $data,
					);
			//output to json format
			echo json_encode($output);
	}

	public function tambah_save()
	{

	    if (!$this->input->is_ajax_request()) {

	        show_404();

	    } else {
	        //kita validasi inputnya dulu
					$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
					$this->form_validation->set_rules('id_pasien', 'Pasien', 'trim|required');
					$this->form_validation->set_rules('id_obat', 'Obat', 'trim|required');

	        if ($this->form_validation->run()==FALSE) {

	          $status = 'error';
	          $msg = validation_errors();


	        } else {

	            if ($this->m_resep->create()) {
	                $status = 'success';
	                $msg = "Data jalan berhasil disimpan";
	            } else {
	                $status = 'error';
	                $msg = "Terjadi kesalahan saat menyimpan data kontak";
	            }
	        }

	      $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));

      	}
	}


	public function edit_resep($id)
	{
		$data = $this->m_resep->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function edit_save()
	{
	  if (!$this->input->is_ajax_request()) {

	      show_404();

	  } else {
	    //kita validasi inputnya dulu
			$this->form_validation->set_rules('nama_resep', 'Nama Resep', 'trim|required');
			$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
			$this->form_validation->set_rules('id_gol_darah', 'ID Golongan Darah', 'trim|required');

	      if ($this->form_validation->run()==false) {

	        $status = 'error';
	        $msg = validation_errors();

	      } else {
	          $id = $this->input->post('id_resep');

	          if ($this->m_resep->update($id)) {
	              $status = 'success';
	              $msg = "Data kontak berhasil diupdate";
	          } else {
	              $status = 'error';
	              $msg = "terjadi kesalahan saat mengupdate data kontak";
	          }
	      }

	      $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));

	    }
	}

	public function hapus($id)
	{
		$this->m_resep->delete($id);
		echo json_encode(array("status" => TRUE));
	}

}
