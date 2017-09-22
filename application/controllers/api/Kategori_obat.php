<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Kategori_obat extends REST_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model(['m_kategori_obat']);

    }

    public function index_get()
    {
        $kategori = $this->m_kategori_obat->get();

        if (!is_null($kategori)) {
        
            $this->response([ 'response'=> $kategori], 200);
        
        } else {

            $this->response([ 'error' => 'Tidak Ada Data pada Database' ], 404);
        
        }
    }

    public function find_get($id)
    {
        if (!$id) {

            $this->response(null, 400);
    
        }

        $kategori = $this->m_kategori_obat->get($id);

        if (!is_null($kategori)) {
        
            $this->response([ 'response'=> $kategori], 200);
        
        } else {

            $this->response([ 'error' => 'Tidak Ada Data pada Database' ], 404);
        
        }
    }

    public function index_post()
    {
        if (!$this->post('kategori')) {

            $this->response(null, 400);
    
        }

        $id = $this->m_kategori_obat->save($this->input->post('kategori'));

        if (!is_null($id)) {

           $this->response([ 'response' => $id], 200);
        
        } else {

            $this->response([ 'error' => 'Terjadi Kesalahan pada Server'], 400);

        }


    }

    public function index_put($id)
    {
        if (!$this->post('kategori') || !$id ) {
           
           $this->response(null, 400);
        
        }

        $update = $this->m_kategori_obat->update($id, $this->input->post('kategori'));

        if (!is_null($update)) {
            
            $this->response(['response' => 'Data Berhasil diubah'], 200);
        
        } else {

            $this->response(['error' => 'Terjadi Kesalahan pada Server'], 400);

        }

    }

    public function index_delete($id)
    {
        if (!$id) {

            $this->response(null, 400);
    
        }

        $delete = $this->m_kategori_obat->delete($id);

        if (!is_null($delete)) {
            
            $this->response(['response' => 'Data Berhasil dihapus'], 200);
        
        } else {

            $this->response(['error' => 'Terjadi Kesalahan pada Server'], 400);

        }

    }

}
