<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'controllers/base.php';

class Pages extends Base {
    var $tablename;

    function __construct()
    {
        parent::__construct();

        $this->tablename = get_class();
        $this->load->model('pages_model');
    }

    /*
     * get common page elements (title/meta description/meta keywords)
     * @param   $page   object
     */
    function _common($page)
    {
        $page = new StdClass();
        $page->title               = '';
        $page->meta_description    = '';
        $page->meta_keywords       = '';
    }

    function index($slug = null)
    {
        if ($slug == null)
        {
            $slug = "home";
        }

        $data = array();
        $data['item'] = $this->pages_model->get_by_slug($slug);
        $this->renderPage(NULL,$data,TRUE,TRUE);
    }
}

/* End of file pages.php */
/* Location: ./application_admin/controllers/pages.php */