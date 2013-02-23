<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/admin/auth.php';

class Home extends Auth
{
    var $tablename;

	function __construct()
	{
		parent::__construct();

        // prevent access if not logged in
        if (!$this->ion_auth->logged_in())
            redirect('admin/auth/login');
	}

    function init()
    {

    }

    function index()
    {
        $data = array();
        Page::factory('admin/home/dashboard', $data)->render();
    }

    function dashboard()
    {
        $data = array();
        Page::factory('admin/'. $this->tablename .'/dashboard', $data)->render();
    }

}

/* End of file home.php */
/* Location: ./application_admin/controllers/home.php */