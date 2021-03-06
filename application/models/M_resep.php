<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_resep extends CI_Model {

  public $table  = 'tb_resep_dokter';
	public $table2 = 'tb_pasien';
	public $table3 = 'tb_dokter';
	public $table4 = 'tb_ruangan';
	public $table5 = 'tb_obat';
	public $table6 = 'tb_status';

	public $column_order = array(null, 'id_resep_dokter', 'tanggal','id_pasien','id_dokter', 'id_ruangan', 'id_obat', 'id_status', null); //set column field database for datatable orderable
	public $column_search = array('tanggal','id_pasien','id_dokter', 'id_ruangan', 'id_obat', 'id_status'); //set column field database for datatable searchable
	public $order = array('tanggal' => 'asc'); // default order
	public $primary_key = 'id_pasien';

	public function __construct() {

		parent::__construct();

			$this->load->database();
	}

	private function _get_datatables_query()
	{

    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->join($this->table2, 'tb_resep_dokter.`id_pasien` = tb_pasien.`id_pasien`', 'LEFT');
    $this->db->join($this->table3, 'tb_pasien.`id_dokter` = tb_dokter.`id_dokter`', 'LEFT');
    $this->db->join($this->table5, 'tb_resep_dokter.`id_obat` = tb_obat.`id_obat`', 'LEFT');
    $this->db->join($this->table6, 'tb_resep_dokter.`id_status` = tb_status.`id_status`', 'LEFT');
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

	$data = [
		'tanggal'     => $this->input->post('tanggal'),
    'id_pasien'   => $this->input->post('id_pasien'),
		'id_obat'     => $this->input->post('id_obat'),
	];

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

		$data = [
			'nama_pasien'  => $this->input->post('nama_pasien'),
			'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
			'alamat'  => $this->input->post('alamat'),
			'tgl_lahir'  => $this->input->post('tgl_lahir'),
			'id_gol_darah'  => $this->input->post('id_gol_darah'),
		 ];

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

	public function get_gol_darah()
	{
		$query = $this->db->get($this->table2);

			return $query->result();
	}

  public function get_status()
	{
		$query = $this->db->get($this->table6);

			return $query->result();
	}

}
