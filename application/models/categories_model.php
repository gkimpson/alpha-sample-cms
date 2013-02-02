<?php

class Categories_Model extends My_Model
{
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );

	function __construct()
	{
		parent::__construct();
	}

}

/* End of file categories_model.php */
/* Location: ./application/models/categories_model.php */