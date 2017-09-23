<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_dokter extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//load model and add alias
		//check session logged_in
			$this->load->model(['m_dokter', 'm_pengguna']);
			$this->m_pengguna->check_session();

	}

	public function tampil()
	{
		$data = [
			'title' 		=> 'Kelola Dokter',
			'titlebox' 		=> 'Data Dokter',
			'breadcrumb01' 	=> 'Kelola Dokter',
			'breadcrumb02' 	=> 	anchor('dokter', 'Tampil Dokter'),

			'konten'		=> 'dokter/dokter',
		];

		$this->load->view('template_admin', $data);
	}

	public function tampil_dokter()
	{

		$list = $this->m_dokter->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $dokter) {

			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $dokter->id_dokter;
			$row[] = $dokter->nama_dokter;
			$row[] = $dokter->kontak;
			$row[] = $dokter->alamat;

			$row[] =
					'<a class="btn btn-sm btn-success" href="javascript:void(0)"
						title="Ubah" onclick="edit('."'".$dokter->id_dokter."'".')">
						<i class="glyphicon glyphicon-pencil"></i>
					</a>

				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)"
				  		title="Hapus" onclick="hapus('."'".$dokter->id_dokter."'".')">
				  		<i class="glyphicon glyphicon-trash"></i>
				  	</a>';

			$data[] = $row;
		}

			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->m_dokter->count_all(),
							"recordsFiltered" => $this->m_dokter->count_filtered(),
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
	        $this->form_validation->set_rules('nama_dokter', 'dokter', 'trim|required');
					$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');
					$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

	        if ($this->form_validation->run()==FALSE) {

	          $status = 'error';
	          $msg = validation_errors();


	        } else {

	            if ($this->m_dokter->create()) {
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


	public function edit_dokter($id)
	{
		$data = $this->m_dokter->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function edit_save()
	{
	  if (!$this->input->is_ajax_request()) {

	      show_404();

	  } else {
	    //kita validasi inputnya dulu
			$this->form_validation->set_rules('nama_dokter', 'dokter', 'trim|required');
			$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

	      if ($this->form_validation->run()==false) {

	        $status = 'error';
	        $msg = validation_errors();

	      } else {
	          $id = $this->input->post('id_dokter');

	          if ($this->m_dokter->update($id)) {
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
		$this->m_dokter->delete($id);
		echo json_encode(array("status" => TRUE));
	}


}
