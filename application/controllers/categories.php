<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'controllers/base.php';

class Categories extends Base {

    function __construct()
    {
        parent::__construct();
        $this->load->model('categories_model');
    }

    public function index()
    {
        $this->data['categories'] = $this->categories_model->get_all();
        $this->renderPage('categories/index', $this->data, TRUE);
    }

    public function view($id = NULL)
    {
        if ($id == NULL)
        {
            show_404();
        }

        $this->data['product'] = $this->_id_check($id);
        $this->renderPage('categories/view', $this->data, TRUE);
    }

    private function _id_check($id = NULL)
    {
        $result = $this->categories_model->get($id);

        if(isset($result) && is_object($result))
        {
            return $result;
        }
        else
        {
            redirect('/categories', 'location', 301);
        }
    }

}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */