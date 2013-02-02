<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'controllers/base.php';

class Pages extends Base
{

	function __construct()
	{
		parent::__construct();
        $this->tablename = strtolower(get_class());

        $config = array(
            'field' => 'slug',
            'title' => 'Slug',
            'table' => 'pages',
            'id' => 'id',
        );

        $this->load->library('slug', $config);
	}

    function index($slug = NULL)
    {
        $this->_get_page($slug);
    }
}