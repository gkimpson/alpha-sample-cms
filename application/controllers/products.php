<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'controllers/base.php';

class Products extends Base {

    function __construct()
    {
        parent::__construct();
        $this->load->model('products_model');
    }

    public function index()
    {
        $data['products'] = $this->products_model->get_all();
        $this->renderPage('products/index', $data, TRUE);
    }

    public function view($id = NULL)
    {
        if ($id == NULL)
        {
            show_404();
        }

        $data['product'] = $this->_id_check($id);

        $this->products_model->add_hit($id, $data['product']->hits);
        $this->renderPage('products/view', $data, TRUE);
    }

    private function _id_check($id = NULL)
    {
        $result = $this->products_model->get($id);

        if(isset($result) && is_object($result))
        {
            return $result;
        }
        else
        {
            redirect('/products', 'location', 301);
        }
    }

}

/* End of file products.php */
/* Location: ./application/controllers/products.php */