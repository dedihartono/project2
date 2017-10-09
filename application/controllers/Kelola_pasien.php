<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_pasien extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//load model and add alias
		//check session logged_in
			$this->load->model(['m_pasien', 'm_pengguna']);
			$this->m_pengguna->check_session();

	}

	public function tampil()
	{
		$data = [
			'title' 		=> 'Kelola Pasien',
			'titlebox' 		=> 'Data Pasien',
			'breadcrumb01' 	=> 'Kelola Pasien',
			'breadcrumb02' 	=> 	anchor('pasien', 'Tampil Pasien'),
			'gol_darah' => $this->m_pasien->get_gol_darah(),
			'konten'		=> 'pasien/pasien',
		];

		$this->load->view('template_admin', $data);
	}

	public function tampil_pasien()
	{

		$list = $this->m_pasien->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $pasien) {

			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $pasien->id_pasien;
			$row[] = $pasien->nama_pasien;
			$row[] = $pasien->jenis_kelamin;
			$row[] = $pasien->alamat;
			$row[] = $pasien->tgl_lahir;
			$row[] = $pasien->golongan_darah;

			$row[] =
					'<a class="btn btn-sm btn-success" href="javascript:void(0)"
						title="Ubah" onclick="edit('."'".$pasien->id_pasien."'".')">
						<i class="glyphicon glyphicon-pencil"></i>
					</a>

				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)"
				  		title="Hapus" onclick="hapus('."'".$pasien->id_pasien."'".')">
				  		<i class="glyphicon glyphicon-trash"></i>
				  	</a>';

			$data[] = $row;
		}

			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->m_pasien->count_all(),
							"recordsFiltered" => $this->m_pasien->count_filtered(),
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
					$this->form_validation->set_rules('nama_pasien', 'Nama pasien', 'trim|required');
					$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
					$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
					$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
					$this->form_validation->set_rules('id_gol_darah', 'ID Golongan Darah', 'trim|required');

	        if ($this->form_validation->run()==FALSE) {

	          $status = 'error';
	          $msg = validation_errors();


	        } else {

	            if ($this->m_pasien->create()) {
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


	public function edit_pasien($id)
	{
		$data = $this->m_pasien->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function edit_save()
	{
	  if (!$this->input->is_ajax_request()) {

	      show_404();

	  } else {
	    //kita validasi inputnya dulu
			$this->form_validation->set_rules('nama_pasien', 'Nama pasien', 'trim|required');
			$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');
			$this->form_validation->set_rules('id_gol_darah', 'ID Golongan Darah', 'trim|required');

	      if ($this->form_validation->run()==false) {

	        $status = 'error';
	        $msg = validation_errors();

	      } else {
	          $id = $this->input->post('id_pasien');

	          if ($this->m_pasien->update($id)) {
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
		$this->m_pasien->delete($id);
		echo json_encode(array("status" => TRUE));
	}

}
