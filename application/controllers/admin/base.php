<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/admin/page.php';
require_once APPPATH . 'third_party/debugging/krumo/class.krumo.php';
require_once APPPATH . 'third_party/debugging/dBug.php';

class Base extends CI_Controller
{

    function __construct()
	{
		parent::__construct();
	}

	function display_statistics($box, $title, $value)
	{
		$this->statistics->{$box}->title = $title;
		$this->statistics->{$box}->value = $value;
	}

}

/* End of file base.php */
/* Location: ./application_admin/controllers/base.php */