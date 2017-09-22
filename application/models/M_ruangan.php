<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ruangan extends CI_Model {

	public $table = 'tb_ruangan';
	public $column_order = array(null, 'id_ruangan','ruangan', null); //set column field database for datatable orderable
	public $column_search = array('ruangan'); //set column field database for datatable searchable 
	public $order = array('id_ruangan' => 'asc'); // default order
	public $primary_key = 'id_ruangan'; 

	public function __construct() {

		parent::__construct();

			$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);


		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		
		if($_POST['length'] != -1)
		
		$this->db->limit($_POST['length'], $_POST['start']);
		
		$query = $this->db->get();
		
			return $query->result();
	}


	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function create() 
	{

	$data = [ 'ruangan'  => $this->input->post('ruangan'), ];

	       $query = $this->db->insert($this->table, $data);

	       		return $query;
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where($this->primary_key, $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function update($id) 
	{

		$data = [ 'ruangan'  => $this->input->post('ruangan'), ];

		$this->db->where($this->primary_key, $id);

		$query = $this->db->update($this->table, $data);

	  		return $query;

	}

  public function delete($id) 
  {

    $this->db->where($this->primary_key, $id);

    $query = $this->db->delete($this->table);

      return $query;

  }

}
