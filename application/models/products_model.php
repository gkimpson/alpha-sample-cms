<?php

class Products_Model extends My_Model
{
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );

	function __construct()
	{
		parent::__construct();
	}

	function get_all()
	{
		$this->db->select('products.*, categories.title AS category');
		$this->db->join('categories', 'categories.id = products.category_id');
		$this->db->where('products.deleted', 0);
		return $this->db->get($this->_table)->result();
	}

	function get_row($id = NULL)
	{
		$this->db->select('products.*, categories.title AS category');
		$this->db->join('categories', 'categories.id = products.category_id', 'inner');
		$this->db->where('products.id', $id);
		$this->db->where('products.deleted', 0);
		return $this->db->get($this->_table)->row();
	}

	function add_hit($id, $current)
	{
		$this->update($id, array( 'hits' => ($current + 1) ));
	}
}

/* End of file products_model.php */
/* Location: ./application/models/products_model.php */