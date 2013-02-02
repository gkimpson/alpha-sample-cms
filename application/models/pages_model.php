<?php

class Pages_Model extends My_Model
{
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );

	function __construct()
	{
		parent::__construct();
	}

}

/* End of file pages_model.php */
/* Location: ./application/models/pages_model.php */