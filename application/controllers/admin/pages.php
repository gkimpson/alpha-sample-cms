<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/admin/auth.php';

class Pages extends Auth
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
        $this->load->model('pages_model');
        $this->module = strtolower(get_class());

        //$this->_load_ckeditor();
        $this->_load_slug_library();
    }

    function _load_slug_library()
    {
        $config = array(
            'field' => 'slug',
            'page_title' => 'Slug',
            'table' => 'pages',
            'id' => 'id',
        );

        $this->load->library('slug', $config);
    }

    function _load_ckeditor()
    {
        require_once '/ckeditor/ckeditor.php';
        $this->ckeditor = new CKEditor();
        $this->ckeditor->basePath = base_url() . 'ckeditor/';
        $this->ckeditor->config['width'] = '850';
        $this->ckeditor->config['height'] = '300';
    }

    function index()
    {
        $data = array();
        $data['items'] = $this->pages_model->get_all();
        $data['items_count'] = count($data['items']);
        $this->display_statistics('box1', 'Number of Pages', $data['items_count']);
        Page::factory('admin/'. $this->module .'/index', $data)->render();
    }

    function add()
    {
        $data = array();
        //$data['ckeditor'] = $this->ckeditor;
        Page::factory('admin/'. $this->module .'/edit', $data)->render();
    }

    function edit($id = NULL)
    {
        if ($id == NULL) redirect('/admin/pages');

        $data = array();
        //$data['ckeditor'] = $this->ckeditor;
        $data['item'] = $this->pages_model->get($id);

        if (!is_object($data['item'])) redirect('admin/pages');

        Page::factory('admin/'. $this->module .'/edit', $data)->render();
    }

    function upload_image($id = NULL)
    {
        if ($id == NULL) redirect('/admin/pages');

        $data = array();
        $data['item'] = $this->pages_model->get($id);
        $data['id'] = $id;

        if (!is_object($data['item'])) redirect('admin/pages');

        Page::factory('admin/'. $this->module .'/upload_image', $data)->render();
    }

    function do_upload($id = NULL)
    {
        if ($id == NULL) redirect('/admin/pages');

        $config['upload_path'] = './uploads/pages/';
        $config['allowed_types'] = 'jpg';
        $config['max_size'] = '500';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['file_name'] = 'product-' . $id;
        $config['overwrite'] = TRUE;

        $data = array();
        $data['item'] = $this->pages_model->get($id);

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data['errors'] = $this->upload->display_errors();
            Page::factory('admin/'. $this->module .'/upload_image', $data)->render();
        }
        else
        {
            $this->create_thumbnail($id);
            $message = ucfirst(strtolower(get_class())) .': '. $data['item']->page_title .' Image uploaded';
            $this->session->set_flashdata('message', $message);
            redirect('/admin/pages');
        }
    }

    function save()
    {
        if ($this->_validation())
        {
            $form = elements(array('page_title', 'meta_description', 'meta_keywords', 'slug', 'h1', 'link_text', 'rank', 'content'), $this->input->post(), NULL);

            if (isset($_POST['id']))
            {
                $form['slug'] = $this->slug->create_uri($form, $_POST['id']);
                //  krumo($form);exit;
                $this->pages_model->update($this->input->post('id'), $form);
                $message = ucfirst(strtolower(get_class())) .': '. $form['page_title'] .' Saved';
            }
            else
            {
                $form['slug'] = $this->slug->create_uri($form);
                $insert_id = $this->pages_model->insert($form);
                $message = ucfirst(strtolower(get_class())) .': '. $form['page_title'] .' Saved';
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
        $this->form_validation->set_rules('slug', 'Slug', 'trim|required|strtolower');
        $this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
        //$this->form_validation->set_rules('content', 'Content', 'trim|required');

        return ($this->form_validation->run()) ? TRUE : FALSE;
    }

    function delete($id = NULL)
    {
        if ($id == NULL) redirect('/admin/pages');

        $data = array();
        $data['item'] = $this->pages_model->get($id);
        Page::factory('admin/'. $this->module .'/delete', $data)->render();
    }

    function do_delete($id = NULL)
    {
        if ($id == NULL) redirect('/admin/pages');

        $item = $this->pages_model->get($id);
        $this->pages_model->delete($id);
        $message = "Page deleted";
        $this->session->set_flashdata('message', $message);
        redirect('/admin/pages');
    }

    function create_thumbnail($id = NULL)
    {
        if ($id == NULL) redirect('admin/pages');

        $config['image_library'] = 'gd2';
        $config['source_image'] = './uploads/pages/product-'. $id .'.jpg';
        $config['thumb_marker'] = '-thumb';
        $config['new_image'] = './uploads/pages/product-'. $id .'.jpg';
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

/* End of file pages.php */
/* Location: ./application_admin/controllers/pages.php */