<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_ruangan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//load model and add alias
		//check session logged_in
			$this->load->model(['m_ruangan', 'm_pengguna']);
			$this->m_pengguna->check_session();

	}

	public function tampil()
	{
		$data = [
			'title' 		=> 'Kelola Ruangan',
			'titlebox' 		=> 'Data Ruangan',
			'breadcrumb01' 	=> 'Kelola Ruangan',
			'breadcrumb02' 	=> 	anchor('ruangan', 'Tampil Ruangan'),

			'konten'		=> 'ruangan/ruangan',
		];

		$this->load->view('template_admin', $data);
	}

	public function tampil_ruangan()
	{
		
		$list = $this->m_ruangan->get_datatables();
		
		$data = array();
		
		$no = $_POST['start'];
		
		foreach ($list as $ruangan) {
			
			$no++;
			
			$row = array();
			$row[] = $no;
			$row[] = $ruangan->id_ruangan;
			$row[] = $ruangan->ruangan;

			$row[] = 
					'<a class="btn btn-sm btn-primary" href="javascript:void(0)" 
						title="Ubah" onclick="edit('."'".$ruangan->id_ruangan."'".')">
						<i class="glyphicon glyphicon-pencil"></i>
					</a>

				  	<a class="btn btn-sm btn-danger" href="javascript:void(0)" 
				  		title="Hapus" onclick="hapus('."'".$ruangan->id_ruangan."'".')">
				  		<i class="glyphicon glyphicon-trash"></i>
				  	</a>';
			
			$data[] = $row;
		}

			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->m_ruangan->count_all(),
							"recordsFiltered" => $this->m_ruangan->count_filtered(),
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
	        $this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required');
	        
	        if ($this->form_validation->run()==FALSE) {
	            
	          $status = 'error';
	          $msg = validation_errors();
	         

	        } else {
	            
	            if ($this->m_ruangan->create()) {
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


	public function edit_ruangan($id)
	{
		$data = $this->m_ruangan->get_by_id($id);
		//$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function edit_save() 
	{
	  if (!$this->input->is_ajax_request()) {

	      show_404();
	      
	  } else {
	    //kita validasi inputnya dulu
	    $this->form_validation->set_rules('ruangan', 'Ruangan', 'trim|required');
	    
	      if ($this->form_validation->run()==false) {
	          
	        $status = 'error';
	        $msg = validation_errors();

	      } else {
	          $id = $this->input->post('id_ruangan');
	          
	          if ($this->m_ruangan->update($id)) {
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
		$this->m_ruangan->delete($id);
		echo json_encode(array("status" => TRUE));
	}


}
