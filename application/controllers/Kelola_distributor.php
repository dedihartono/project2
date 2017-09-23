<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_distributor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//load model and add alias
		//check session logged_in
			$this->load->model(['m_distributor', 'm_pengguna']);
			$this->m_pengguna->check_session();

	}

	public function tampil()
	{
		$data = [
			'title' 		=> 'Kelola Distributor',
			'titlebox' 		=> 'Data Distributor',
			'breadcrumb01' 	=> 'Kelola Distributor',
			'breadcrumb02' 	=> 	anchor('distributor', 'Tampil Distributor'),

			'konten'		=> 'distributor/distributor',
		];

		$this->load->view('template_admin', $data);
	}

	public function tampil_distributor()
	{

		$list = $this->m_distributor->get_datatables();

		$data = array();

		$no = $_POST['start'];

		foreach ($list as $distributor) {

			$no++;

			$row = array();
			$row[] = $no;
			$row[] = $distributor->id_distributor;
			$row[] = $distributor->nama_distributor;
			$row[] = $distributor->kontak;
			$row[] = $distributor->alamat;

			$row[] =
					'<a class="btn btn-sm btn-success" href="javascript:void(0)"
						title="Ubah" onclick="edit('."'".$distributor->id_distributor."'".')">
						<i class="glyphicon glyphicon-pencil"></i>
					</a>

				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)"
				  		title="Hapus" onclick="hapus('."'".$distributor->id_distributor."'".')">
				  		<i class="glyphicon glyphicon-trash"></i>
				  	</a>';

			$data[] = $row;
		}

			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->m_distributor->count_all(),
							"recordsFiltered" => $this->m_distributor->count_filtered(),
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
	        $this->form_validation->set_rules('nama_distributor', 'Distributor', 'trim|required');
					$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
					$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');

	        if ($this->form_validation->run()==FALSE) {

	          $status = 'error';
	          $msg = validation_errors();


	        } else {

	            if ($this->m_distributor->create()) {
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


	public function edit_distributor($id)
	{
		$data = $this->m_distributor->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function edit_save()
	{
	  if (!$this->input->is_ajax_request()) {

	      show_404();

	  } else {
	    //kita validasi inputnya dulu
			$this->form_validation->set_rules('nama_distributor', 'Distributor', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');

	      if ($this->form_validation->run()==false) {

	        $status = 'error';
	        $msg = validation_errors();

	      } else {
	          $id = $this->input->post('id_distributor');

	          if ($this->m_distributor->update($id)) {
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
		$this->m_distributor->delete($id);
		echo json_encode(array("status" => TRUE));
	}


}