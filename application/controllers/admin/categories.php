<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/admin/auth.php';

class Categories extends Auth
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
        $this->load->model('categories_model');
        $this->load->helper('date');
        $this->module = strtolower(get_class());

        // require_once '/ckeditor/ckeditor.php';
        // $this->ckeditor = new CKEditor();
        // $this->ckeditor->basePath = base_url() . 'ckeditor/';
        // $this->ckeditor->config['width'] = '850';
        // $this->ckeditor->config['height'] = '300';
    }

    function index()
    {
        $data = array();
        $data['items'] = $this->categories_model->get_all();
        $data['items_count'] = count($data['items']);
        $this->display_statistics('box1', 'Number of Categories', $data['items_count']);
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
        if ($id == NULL) redirect('/admin/categories');

        $data = array();
        // $data['ckeditor'] = $this->ckeditor;
        $data['item'] = $this->categories_model->get($id);

        if (!is_object($data['item'])) redirect('admin/categories');

        $data['options']['categories'] = $this->categories_model->dropdown('id', 'title');
        Page::factory('admin/'. $this->module .'/edit', $data)->render();
    }

    function upload_image($id = NULL)
    {
        if ($id == NULL) redirect('/admin/categories');

        $data = array();
        $data['item'] = $this->categories_model->get($id);
        $data['id'] = $id;

        if (!is_object($data['item'])) redirect('admin/categories');

        Page::factory('admin/'. $this->module .'/upload_image', $data)->render();
    }

    function do_upload($id = NULL)
    {
        if ($id == NULL) redirect('/admin/categories');

        $config['upload_path'] = './uploads/categories/';
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = '500';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['file_name'] = 'category-' . $id;
        $config['overwrite'] = TRUE;

        $data = array();
        $data['item'] = $this->categories_model->get($id);

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
            redirect('/admin/categories');
        }
    }

    function save()
    {
        if ($this->_validation())
        {
            $form = elements(array('page_title', 'meta_description', 'meta_keywords', 'title', 'description', 'rank'), $this->input->post(), NULL);

            if (isset($_POST['id']))
            {
                $this->categories_model->update($this->input->post('id'), $form);
                $message = ucfirst(strtolower(get_class())) .': '. $form['title'] .' Saved';
            }
            else
            {
                $insert_id = $this->categories_model->insert($form);
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

        return ($this->form_validation->run()) ? TRUE : FALSE;
    }

    function delete($id = NULL)
    {
        if ($id == NULL) redirect('/admin/categories');

        $data = array();
        $data['item'] = $this->categories_model->get($id);
        Page::factory('admin/'. $this->module .'/delete', $data)->render();
    }

    function do_delete($id = NULL)
    {
        if ($id == NULL) redirect('/admin/categories');

        $item = $this->categories_model->get($id);
        $this->categories_model->delete($id);
        $message = "Category deleted : $item->title";
        $this->session->set_flashdata('message', $message);
        redirect('/admin/categories');
    }

    function create_thumbnail($id = NULL)
    {
        if ($id == NULL) redirect('admin/categories');

        $config['image_library'] = 'gd2';
        $config['source_image'] = './uploads/categories/category-'. $id .'.jpg';
        $config['thumb_marker'] = '-thumb';
        $config['new_image'] = './uploads/categories/category-'. $id .'.jpg';
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

/* End of file categories.php */
/* Location: ./application_admin/controllers/admin/categories.php */