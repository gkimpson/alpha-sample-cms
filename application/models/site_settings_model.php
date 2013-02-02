<?php

class Site_Settings_Model extends My_Model
{
    public $before_create = array( 'created_at', 'updated_at' );
    public $before_update = array( 'updated_at' );

	function __construct()
	{
		parent::__construct();
	}

	function get_all_settings()
	{
		$obj = new StdClass();
		$result = $this->db->get($this->_table)->result();

		foreach ($result as $value)
		{
			$obj->{$value->config_key} = $value->config_value;
		}

		return $obj;
	}
}

/* End of file site_settings_model.php */
/* Location: ./application/models/site_settings_model.php */