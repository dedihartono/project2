<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Jenis_obat extends REST_Controller {


    function __construct($config = 'rest') {
        
        parent::__construct($config);
        
        $this->load->database();
    }

    function index_get() {
        
        $id = $this->get('id');
        
        if ($id == '') {

            $kontak = $this->db->get('tb_jenis_obat')->result();
        
        } else {
            
            $this->db->where('id_jenis_obat', $id);
            
            $kontak = $this->db->get('tb_jenis_obat')->result();
        }

        $this->response($kontak, 200);
    }

    function index_post() {

        $data = array(
                    'id_jenis_obat'	=> $this->post('id_jenis_obat'),
                    'jenis_obat'	=> $this->post('jenis_obat'));

        $insert = $this->db->insert('tb_jenis_obat', $data);
        
        if ($insert) {
        
            $this->response($data, 200);
        
        } else {
          
            $this->response(array('status' => 'fail', 502));
        
        }
    }

    function index_put($id) {

        $id = $this->put('id_jenis_obat');
       
        $data = array(
                    'id_jenis_obat'	=> $this->put('id_jenis_obat'),
                    'jenis_obat'	=> $this->put('jenis_obat'));
		
		$this->db->where('id_jenis_obat', $id);
        
        $update = $this->db->update('tb_jenis_obat', $data);
        
        if ($update) {
          
            $this->response($data, 200);
        
        } else {
           
            $this->response(array('status' => 'fail', 502));
        
        }
    }

    function index_delete($id) {
        
        $id = $this->delete('id_jenis_obat');
        
        $this->db->where('id_jenis_obat', $id);
        
        $delete = $this->db->delete('tb_jenis_obat');
        
        if ($delete) {
        
            $this->response(array('status' => 'success'), 201);
        
        } else {
        
            $this->response(array('status' => 'fail', 502));
        
        }
    }

}
