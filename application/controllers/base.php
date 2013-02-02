<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'controllers/page.php';
require_once APPPATH . 'third_party/debugging/krumo/class.krumo.php';
require_once APPPATH . 'third_party/debugging/dBug.php';

class Base extends CI_Controller {
    public $var = array();
    public $data = array();

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function init()
    {

    }

    public function renderPage($file, $data, $common = FALSE)
    {
        if ($common)
        {    //use the common-header and common-footer views
            $header     = $this->load->view("templates/common-header", $data, TRUE);
            $footer     = $this->load->view("templates/common-footer", $data, TRUE);
        }
        else
        {
            $header     = $this->load->view("templates/header", $data, TRUE);
            $footer     = $this->load->view("templates/footer", $data, TRUE);
        }

        echo $header;
        if ($file != NULL)
        {
            $content    = $this->load->view("{$file}", $data, TRUE);
            echo $content;
        }
        echo $footer;
    }

    /**
     * Send email
     * @param   array   $params
     * @param   array   $config
     * @param   boolean $sendmail
     * @param   boolean $debug
     * @return  void
    **/
    public function _send_email($params = array(), $config = array(), $sendmail = FALSE, $debug = FALSE)
    {
        $this->load->library('email');

        if ($sendmail == TRUE)
        {
            $config['protocol']     = 'sendmail';
            $config['mailpath']     = '/usr/sbin/sendmail';
            $config['charset']      = 'iso-8859-1';
            $config['wordwrap']     = TRUE;
        } else {
            $config['protocol']     = 'smtp';
            $config['smtp_host']    = 'mail.cogent-x.net';
            $config['smtp_user']    = 'test.relay@cogent-x.net';
            $config['smtp_pass']    = 'nbmg5vlf';
            $config['smtp_port']    = 25;
        }

        if (count($config) > 0)
        {
            $this->email->initialize($config);
        }

        $this->email->clear();

        if (array_key_exists('from_email', $params) && array_key_exists('from_name', $params))
            $this->email->from($params['from_email'], $params['from_name']);

        if (array_key_exists('reply_email', $params) && array_key_exists('reply_name', $params))
            $this->email->reply_to($params['reply_email'], $params['reply_name']);

        if (array_key_exists('to', $params))
            $this->email->to($params['to']);

        if (array_key_exists('cc', $params))
            $this->email->cc($params['cc']);

        if (array_key_exists('bcc', $params))
            $this->email->bcc($params['bcc']);

        if (array_key_exists('subject', $params))
            $this->email->subject($params['subject']);

        if (array_key_exists('message', $params))
            $this->email->message($params['message']);

        if (array_key_exists('attach', $params))
            $this->email->set_alt_message($params['alt_message']);

        if (array_key_exists('attach', $params) && is_array($params['attach']))
        {
            foreach ($params['attach'] as $path_to_attachment)
            {
                $this->email->attach($path_to_attachment);  // eg /path not a URL eg /path/to/path/photo.jpg
            }
        }

        $this->email->send();

        if ($debug == TRUE)
        {
            echo $this->email->print_debugger();
        }
    }

    protected function _set_page_defaults()
    {
        $params = func_get_args();

        $this->page = new StdClass;
        $this->page->page_name = (isset($params[0]['page_name'])) ? $params[0]['page_name'] : '';
        $this->page->meta_description = (isset($params[0]['meta_description'])) ? $params[0]['meta_description'] : '';
        $this->page->meta_keywords = (isset($params[0]['meta_keywords'])) ? $params[0]['meta_keywords'] : '';
        $this->page->h1 = (isset($params[0]['h1'])) ? $params[0]['h1'] : '';
        $this->page->content = (isset($params[0]['content'])) ? $params[0]['content'] : '';
    }

}

/* End of file base.php */
/* Location: ./application_admin/controllers/base.php */