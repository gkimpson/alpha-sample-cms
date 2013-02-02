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
        $data['products'] = $this->products_model->get_all_items();
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

    public function add_to_quote($id)
    {
        // get existing array from session var (returns false if first time called)
        $items = $this->session->userdata('items');

        // add new $key=>$val to array
        if (is_object($this->_id_check($id)))
        {
            $items[$id] = $id;
        }

        // pass it back to the session var
        $this->session->set_userdata('items', $items);
    }

    public function quote()
    {
        $data = array();
        $this->items = $this->session->userdata('items');

        if($this->items)
        {
            $num = count($this->items);
            if($num > 1)
            {
                $this->items_text = ''. (int) $num . ' items';
            }
            else
            {
                $this->items_text = ''. (int) $num .' item';
            }
        }
        else
        {
            $this->items_text = 'no items';
        }

        $data['products'] = $this->products_model->get_many($this->items);
        $this->renderPage('products/quote', $data, TRUE);
    }

    public function _validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

        return ($this->form_validation->run()) ? TRUE : FALSE;
    }

    public function _get_items($ids)
    {
        $products = array();

        if (is_array($ids))
        {
            $products = $this->products_model->get_many($ids);
        }

        return $products;
    }

    public function _generate_products_message($products = array())
    {
        if (is_array($products))
        {
            $message = "\nProducts:\n";
            foreach ($products as $key => $value)
            {
                $message .= "{$value->title},\n";
            }

            return substr($message, 0, -1);
        }
        else
        {
            return FALSE;
        }
    }

    public function _generate_message()
    {
        $name = $this->input->post('first_name') .' '. $this->input->post('last_name');
        $message = "{$name} made the following 'Request a Quote' enquiry :- \n";
        $message .= "Company: ". $this->input->post('company') . "\n";
        $message .= "Email: ". $this->input->post('email') . "\n";
        $message .= "Telephone: ". $this->input->post('telephone') . "\n";
        $message .= "Message: ". $this->input->post('message') . "\n";
        return $message;
    }

    public function save()
    {
        $items = $this->session->userdata('items');
        $products = $this->_get_items($items);

        $message = $this->_generate_message();
        $message .= $this->_generate_products_message($products);
        $message .= "\n\nPlease contact them shortly";

        if ($this->_validation())
        {
            // send email to web admin
            $params = array(
                'from_email'    => $this->site->email,
                'from_name'     => $this->site->name,
                'to'            => $this->input->post('email'),
                'subject'       => 'Request a quote enquiry',
                'message'       => $message,
                );

            $this->_send_email($params, TRUE);

            redirect('/products/thanks');
        }
        else
        {
            $this->quote();
        }
    }

    public function thanks()
    {
        die('thanks page');
    }


}

/* End of file products.php */
/* Location: ./application/controllers/products.php */