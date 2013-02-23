<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/admin/page.php';
require_once APPPATH . 'third_party/debugging/krumo/class.krumo.php';
require_once APPPATH . 'third_party/debugging/dBug.php';

class Base extends CI_Controller
{

    function __construct()
	{
		parent::__construct();

		$this->site = $this->site_settings_model->get_all_settings();
	}

	function display_statistics($box, $title, $value, $icon = 'icol32-layout')
	{
		$this->statistics->{$box}->title = $title;
		$this->statistics->{$box}->value = $value;
		$this->statistics->{$box}->icon = $icon;
	}

}

/* End of file base.php */
/* Location: ./application_admin/controllers/base.php */