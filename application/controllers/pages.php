<?php
// require_once APPPATH . 'controllers/auth.php';
// require_once APPPATH . 'controllers/pages.php';

class Pages extends CI_Controller
{
    var $tablename;

	function __construct()
	{
		parent::__construct();

        // prevent access if not logged in
        // if (!$this->ion_auth->logged_in())
        //     redirect('auth/login');

        $this->tablename = strtolower(get_class());

        $this->load->model('pages_model');

        $config = array(
            'field' => 'slug',
            'title' => 'Slug',
            'table' => 'pages',
            'id' => 'id',
        );

        $this->load->library('slug', $config);
	}

    function index()
    {
        $data = array();
        //$data['items'] = $this->pages_model->get_all(TRUE);
        //Page::factory('admin/pages/index', $data)->render();
    }

    function _validation()
    {
        $this->form_validation->set_rules('slug','Slug', 'trim|required');
        /*$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
        $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|required');*/
        $this->form_validation->set_rules('page_title', 'Page Title', 'trim|required');
        $this->form_validation->set_rules('h1', 'H1', 'trim|required');
        $this->form_validation->set_rules('link_text', 'Link Text', 'trim|required');
        //$this->form_validation->set_rules('content', 'Content', 'trim|required');

        return ($this->form_validation->run()) ? TRUE : FALSE;
    }

    function edit($id = '')
    {
        if (!$id)
        {
            show_404();
        }

        $data = array();
        $dropdowns = $this->pages_model->get_for_drop_downs();

        $data['parent_dropdowns'] = $dropdowns['all'];
        $data['item'] = $this->pages_model->get_row($id);
        $data['selected_parent'] = $data['item']->parent_id;

        if (!$data['item']) redirect('admin/pages');

        Page::factory('admin/pages/edit', $data)->render();
    }

    function add()
    {
        $data = array();
        $dropdowns = $this->pages_model->get_for_drop_downs();
        $data['parent_dropdowns'] = $dropdowns['all'];

        Page::factory('admin/pages/edit', $data)->render();
    }

    function save()
    {
        if ($this->_validation())
        {
            $online = ($this->input->post('online') != '') ? TRUE : FALSE;
            $on_menu = ($this->input->post('on_menu') != '') ? TRUE : FALSE;

            $form = array(
                'slug' =>  $this->input->post('slug'),
                'parent_id' =>  $this->input->post('parent_id'),
                'type'  =>  $this->input->post('type'),
                'meta_description' =>  $this->input->post('meta_description'),
                'meta_keywords' =>  $this->input->post('meta_keywords'),
                'page_title' =>  $this->input->post('page_title'),
                'h1' =>  $this->input->post('h1'),
                'link_text' =>  $this->input->post('link_text'),
                'seo_text_link' =>  $this->input->post('seo_text_link'),
                'content' => $this->input->post('content'),
                'online' =>  $online,
                'on_menu' =>  $on_menu,
                'date_expire' => strtotime($this->input->post("date_expire")),
                'image_id' => $this->input->post('image_id'),
            );

            if (isset($_POST['id']))
            {
                $form['slug'] = $this->slug->create_uri($form, $_POST['id']); // use slug library
                $this->pages_model->update($form, $this->input->post('id')); // update

                // amend this in the navigation table
                $this->navigation_model->update_page(array('parent_id' => $form['parent_id']), $_POST['id']);
                $message = $form['page_title'] .' Saved';
            }
            else
            {
                $form['slug'] = $this->slug->create_uri($form); // use slug library
                $insert_id = $this->pages_model->insert($form);      // insert

                // add this to the navigation table
                $this->navigation_model->insert(array('page_id' => $insert_id, 'parent_id' => $form['parent_id']));
                $message = $form['page_title'] .' Added';
            }

            $this->session->set_flashdata('message', $message);
            redirect($this->tablename);
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

    function delete($id)
    {
        if (!$id)
        {
            show_404();
        }

        $data = array();
        $data['item'] = $this->pages_model->get_row($id);

        if (!$data['item'])
        {
            show_404();
        }

        Page::factory('admin/pages/delete', $data)->render();
    }

    function do_delete($id)
    {
        if (!$id)
        {
            show_404();
        }

        $data = array();
        $data['item'] = $this->pages_model->get_row($id);

        if (!$data['item'])
        {
            show_404();
        }

        $this->session->set_flashdata('message', $data['item']->page_title . ' Deleted');

        $this->pages_model->delete($id);

        // delete navigation row too
        $this->navigation_model->delete_by_page_id($id);
        redirect($this->tablename);
    }
}

/* End of file pages.php */
/* Location: ./application_admin/controllers/pages.php */