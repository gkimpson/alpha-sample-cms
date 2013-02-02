<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/admin/auth.php';

class Products extends Auth
{

	function __construct()
	{
		parent::__construct();

        // prevent access if not logged in
        if (!$this->ion_auth->logged_in())
        {
            redirect('admin/auth/login');
        }

        $this->init();
	}

    function init()
    {
        $this->load->model('products_model');
        $this->load->model('categories_model');
        $this->load->helper('date');
        $this->module = strtolower(get_class());
    }

    function index()
    {
        $data = array();
        $data['items'] = $this->products_model->get_all();
        $data['items_count'] = count($data['items']);
        $this->display_statistics('box1', 'Number of Products', $data['items_count']);
        Page::factory('admin/'. $this->module .'/index', $data)->render();
    }

    function add()
    {
        $data = array();
        //$data['ckeditor'] = $this->ckeditor;
        $data['options']['categories'] = $this->categories_model->dropdown('id', 'title');
        Page::factory('admin/'. $this->module .'/edit', $data)->render();
    }

    function edit($id = NULL)
    {
        if ($id == NULL) redirect('/admin/products');

        $data = array();
        $data['item'] = $this->products_model->get_row($id, "'categories', 'categories.id = products.category_id'");
        //krumo($data['item']);

        if (!is_object($data['item'])) redirect('admin/products');

        $data['options']['categories'] = $this->categories_model->dropdown('id', 'title');

        //echo $data['ckeditor']->editor('content');
        Page::factory('admin/'. $this->module .'/edit', $data)->render();
    }

    function eedit($id = NULL)
    {
        require_once '/ckeditor/ckeditor.php';
        $ckeditor = new CKEditor();
        $ckeditor->basePath = '../../../ckeditor/';
        $ckeditor->config['width'] = '850';
        $ckeditor->config['height'] = '300';
        echo $ckeditor->editor('description');
    }

    function upload_image($id = NULL)
    {
        if ($id == NULL) redirect('/admin/products');

        $data = array();
        $data['item'] = $this->products_model->get_row($id, "'categories', 'categories.id = products.category_id'");
        $data['id'] = $id;

        if (!is_object($data['item'])) redirect('admin/products');

        Page::factory('admin/'. $this->module .'/upload_image', $data)->render();
    }

    function do_upload($id = NULL)
    {
        if ($id == NULL) redirect('/admin/products');

        $config['upload_path'] = './uploads/products/';
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = '500';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['file_name'] = 'product-' . $id;
        $config['overwrite'] = TRUE;

        $data = array();
        $data['item'] = $this->products_model->get_row($id, "'categories', 'categories.id = products.category_id'");

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data['errors'] = $this->upload->display_errors();
            Page::factory('admin/'. $this->module .'/upload_image', $data)->render();
        }
        else
        {
            $this->create_thumbnail($id);
            $message = ucfirst(strtolower(get_class())) .': '. $data['item']->title .' Image uploaded';
            $this->session->set_flashdata('message', $message);
            redirect('/admin/products');
        }
    }

    function save()
    {
        if ($this->_validation())
        {
            $form = elements(array('page_title', 'meta_description', 'meta_keywords', 'title', 'category_id', 'price', 'description'), $this->input->post(), NULL);
            //krumo($form);exit;

            if (isset($_POST['id']))
            {
                $this->products_model->update($this->input->post('id'), $form);
                $message = ucfirst(strtolower(get_class())) .': '. $form['title'] .' Saved';
            }
            else
            {
                $insert_id = $this->products_model->insert($form);
                $message = ucfirst(strtolower(get_class())) .': '. $form['title'] .' Saved';
            }

            $this->session->set_flashdata('message', $message);
            redirect('admin/'. $this->module);
        }
        else
        {
            if ($this->input->post('id'))
            {
                $this->edit($this->input->post('id'));
            }
            else
            {
                $this->add();
            }
        }
    }

    function _validation()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        //$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');

        return ($this->form_validation->run()) ? TRUE : FALSE;
    }

    function delete($id = NULL)
    {
        if ($id == NULL) redirect('/admin/products');

        $data = array();
        $data['item'] = $this->products_model->get_row($id, "'categories', 'categories.id = products.category_id'");
        Page::factory('admin/'. $this->module .'/delete', $data)->render();
    }

    function do_delete($id = NULL)
    {
        if ($id == NULL) redirect('/admin/products');

        $item = $this->products_model->get_row($id, "'categories', 'categories.id = products.category_id'");
        $this->products_model->delete($id);
        $message = "Product deleted : $item->title";
        $this->session->set_flashdata('message', $message);
        redirect('/admin/products');
    }

    function create_thumbnail($id = NULL)
    {
        if ($id == NULL) redirect('admin/products');

        $config['image_library'] = 'gd2';
        $config['source_image'] = './uploads/products/product-'. $id .'.jpg';
        $config['thumb_marker'] = '-thumb';
        $config['new_image'] = './uploads/products/product-'. $id .'.jpg';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']     = 150;
        $config['height']   = 100;

        $this->load->library('image_lib', $config);

        if ( ! $this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }
    }

}

/* End of file products.php */
/* Location: ./application_admin/controllers/admin/products.php */