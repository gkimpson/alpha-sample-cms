<?php
/**
 * Page class
 *
 * An easy way of displaying pages, along with templates (simple header/ footer)
 * Replaces $this->load->view completely
 *
 * @author Sean Drumm
 */

class Page {

	var $details;
	var $ci;
	var $header = false;
	var $footer = false;
	var $content;

	/**
	 * Loads the template if set, and view file
	 * Passes data both template and view
	 *
	 * @param string view filename
	 * @param array view data
	 * @param bool template option
	 * @return void;
	 */
	function __construct($file, $data = array(), $templating = true)
	{
		$this->ci =& get_instance();

		if($templating === TRUE) {
			$this->_load_template($data);
		}

		$this->_set_file($file, $data);
	}

	/**
	 * Set view file
	 * @param string view filename
	 * @param array data
	 * @return void;
	 */
	function _set_file($file, $data)
	{
		$this->content = $this->ci->load->view($file, $data, true);
	}

	/**
	 * Load the template (header/ footer)
	 * accepts data array
	 * @param array data
	 */
	function _load_template($data)
	{
		$this->header	= $this->ci->load->view('templates/logical/common-header', $data, true);
        //$this->nav      = $this->ci->load->view('admin/nav', $data, true);
		$this->footer	= $this->ci->load->view('templates/logical/common-footer', $data, true);
	}

	/**
	 * Returns a new Page object
	 * Passes all params onto __construct()
	 *
	 * @param string view filename;
	 * @param array view data;
	 * @param bool template option
	 * @return Page;
	 */
	function factory($file, $data = array(), $templating = true)
	{
		return new Page($file, $data, $templating);
	}

	/**
	 * Output compiled page data to browser
	 *
	 * @return void;
	 */
	function render()
	{
		echo $this->header . $this->content . $this->footer;
	}


}

/* End of file pages.php */
/* Location: ./application_admin/controllers/pages.php */