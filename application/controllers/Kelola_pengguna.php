<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//load model and add alias
		//check session logged_in
			$this->load->model('m_pengguna');
			$this->m_pengguna->check_session();

	}


	public function tampil_pengguna() {
		$data = array(
			'breadcrumb_1' 	=> 'Kelola Pengguna',
			'breadcrumb_2' 	=> anchor('kelola_lokasi_unit/lokasi_unit', 'Pengguna'),
			'panel_title' 	=> 'Tampil Data Pengguna',
		);
		$data['pengguna'] = $this->m_pengguna->lihat_data_pengguna();
		$data['konten'] = 'pengguna/v_pengguna';
		$this->load->view('template_admin', $data);

	}

	public function tambah_pengguna()
	{
		$data = array(
			'breadcrumb_1' 	=> 'Kelola Pengguna',
			'breadcrumb_2' 	=> anchor('kelola_pengguna/tampil_pengguna', 'Tampil Pengguna'),
			'breadcrumb_3' 	=> anchor('kelola_pengguna/tambah_pengguna', 'Tambah Pengguna'),
			'panel_title' 	=> 'Tambah Data Pengguna',
		);
		$data['konten'] = 'pengguna/v_tambah_pengguna';
		$this->load->view('template_admin', $data);
	}

	public function tambah_pengguna_proses()
	{
		$data = array(
			"nama_lengkap"	=> $this->input->post('nama_lengkap'),
			"username" 			=> $this->input->post('username'),
			"password" 			=> md5($this->input->post('username')),
			"hak_akses" 		=> $this->input->post('hak_akses'),
		);
		$this->m_pengguna->tambah_data_pengguna($data);
		$alert	= "<script>alert('Data berhasil disimpan')</script>";
		$this->session->set_flashdata("pesan", $alert);
		redirect('kelola_pengguna/tampil_pengguna');
	}

	public function edit_pengguna($id)
	{
		$data = array(
			'breadcrumb_1' 	=> 'Kelola Pengguna',
			'breadcrumb_2' 	=> anchor('kelola_pengguna/tampil_pengguna', 'Pengguna'),
			'breadcrumb_3' 	=> anchor('kelola_pengguna/edit_pengguna/'.$id, 'Edit Pengguna'),
			'panel_title' 	=> 'Tambah Data Pengguna',
		);
		$id = $this->uri->segment(3);
		$data['pengguna'] 	= $this->m_pengguna->lihat_data_by($id);
		$data['konten'] 	= 'pengguna/v_edit_pengguna';
		$this->load->view('template_admin', $data);
	}

	public function edit_pengguna_proses($id)
	{
		$id = $this->uri->segment(3);
		$data = array(
			"nama_lengkap"	=> $this->input->post('nama_lengkap'),
			"username" 			=> $this->input->post('username'),
			"password" 			=> md5($this->input->post('username')),
			"hak_akses" 		=> $this->input->post('hak_akses'),
		);

		$this->m_pengguna->edit_data_pengguna($data, $id);
		$alert	= "<script>alert('Data berhasil diubah')</script>";
		$this->session->set_flashdata("pesan", $alert);
		redirect('kelola_pengguna/tampil_pengguna');
	}

	public function hapus_pengguna($id)
	{
		$id = $this->uri->segment(3);
		$this->m_pengguna->hapus_data_pengguna($id);
		$alert	= "<script>alert('Data berhasil dihapus')</script>";
		$this->session->set_flashdata("pesan", $alert);
		redirect('kelola_pengguna/tampil_pengguna');
	}

}
