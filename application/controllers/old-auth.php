<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/base.php';

class Auth extends Base {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('url');
	}

	//redirect if needed, otherwise display the user list
	function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect($this->config->item('base_url'), 'refresh');
		}
		else
		{
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->load->view('auth/index', $this->data);
		}
	}

	//log the user in
	function login()
	{
		$this->data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{ //check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{ //if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect($this->config->item('base_url'), 'refresh');
			}
			else
			{ //if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{  //the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);

			$this->load->view('auth/login', $this->data);
		}
	}

	//log the user out
	function logout()
	{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('auth', 'refresh');
	}


	//change password
	function change_password()
	{
		$this->form_validation->set_rules('old', 'Old password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user();

		if ($this->form_validation->run() == false)
		{ //display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			//render
			$this->load->view('auth/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{ //if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password()
	{
		$sendmail = TRUE;
		if ($sendmail == TRUE)
        {
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
        } else {
            $config['protocol']     = 'smtp';
            $config['smtp_host']    = 'mail.cogent-x.net';
            $config['smtp_user']    = 'test.relay@cogent-x.net';
            $config['smtp_pass']    = 'nbmg5vlf';
            $config['smtp_port']    = 25;
        }
		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
			);

			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->load->view('auth/forgot_password', $this->data);
		}
		else
		{
			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));

			if ($forgotten)
			{ //if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code)
	{
		$reset = $this->ion_auth->forgotten_password_complete($code);

		if ($reset)
		{  //if the reset worked then send them to the login page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth/login", 'refresh');
		}
		else
		{ //if the reset didnt work then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
			$activation = $this->ion_auth->activate($id, $code);
		else if ($this->ion_auth->is_admin())
			$activation = $this->ion_auth->activate($id);

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		// no funny business, force to integer
		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|is_natural');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->load->view('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_404();
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	function _create_user($group = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}


		$groups = array('admin', 'coaches', 'customers');
		if ($group == NULL || !in_array($group, $groups))
		{
			redirect('auth');
		}

		if ($group == 'admin')
		{

		}
		elseif ($group == 'coaches')
		{

		}
		elseif ($group == 'customers')
		{

		}

		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		//$this->form_validation->set_rules('phone1', 'First Part of Phone', 'required|xss_clean|min_length[3]|max_length[3]');
		//$this->form_validation->set_rules('phone2', 'Second Part of Phone', 'required|xss_clean|min_length[3]|max_length[3]');
		//$this->form_validation->set_rules('phone3', 'Third Part of Phone', 'required|xss_clean|min_length[4]|max_length[4]');
		//$this->form_validation->set_rules('company', 'Company Name', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('first_name')) . '' . strtolower($this->input->post('last_name'));
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => array_key_exists('first_name', $this->input->post()) ? $this->input->post('first_name') : NULL,
				'last_name' => array_key_exists('last_name', $this->input->post()) ? $this->input->post('last_name') : NULL,
				'company' => array_key_exists('company', $this->input->post()) ? $this->input->post('company') : NULL,
				'phone' => array_key_exists('phone', $this->input->post()) ? $this->input->post('phone') : NULL,
				'county_id' => array_key_exists('county_id', $this->input->post()) ? $this->input->post('county_id') : NULL,
				'organisation_id' => array_key_exists('organisation_id', $this->input->post()) ? $this->input->post('organisation_id') : NULL,
				'title' => array_key_exists('title', $this->input->post()) ? $this->input->post('title') : NULL,
				'address1' => array_key_exists('address1', $this->input->post()) ? $this->input->post('address1') : NULL,
				'address2' => array_key_exists('address2', $this->input->post()) ? $this->input->post('address2') : NULL,
				'city' => array_key_exists('county_id', $this->input->post()) ? $this->input->post('city') : NULL,
				'postcode' => array_key_exists('postcode', $this->input->post()) ? $this->input->post('postcode') : NULL,
				'home_tel' => array_key_exists('home_tel', $this->input->post()) ? $this->input->post('home_tel') : NULL,
				'work_tel' => array_key_exists('work_tel', $this->input->post()) ? $this->input->post('work_tel') : NULL,
				'mobile' => array_key_exists('mobile', $this->input->post()) ? $this->input->post('mobile') : NULL,
				'description' => array_key_exists('description', $this->input->post()) ? $this->input->post('description') : NULL,
				'licence_expiry' => array_key_exists('licence_expiry', $this->input->post()) ? $this->input->post('licence_expiry') : NULL,
				'other_contact' => array_key_exists('other_contact', $this->input->post()) ? $this->input->post('other_contact') : NULL,
				'training_attendance' => array_key_exists('training_attendance', $this->input->post()) ? $this->input->post('training_attendance') : NULL,
				'coach_rating_id' => array_key_exists('coach_rating_id', $this->input->post()) ? $this->input->post('coach_rating_id') : NULL,
				'price_individual' => array_key_exists('price_individual', $this->input->post()) ? $this->input->post('price_individual') : NULL,
				'price_corporate' => array_key_exists('price_corporate', $this->input->post()) ? $this->input->post('price_corporate') : NULL,
				'image' => array_key_exists('image', $this->input->post()) ? $this->input->post('image') : NULL,
				'date_created' => date('Y-m-d H:i:s'),
				'date_updated' => date('Y-m-d H:i:s'),
			);
		}

		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{ //check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', "User Created");
			redirect("auth", 'refresh');
		}
		else
		{ //display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array('name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array('name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array('name' => 'company',
				'id' => 'company',
				'type' => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone1'] = array('name' => 'phone1',
				'id' => 'phone1',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone1'),
			);
			$this->data['phone2'] = array('name' => 'phone2',
				'id' => 'phone2',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone2'),
			);
			$this->data['phone3'] = array('name' => 'phone3',
				'id' => 'phone3',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone3'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array('name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);

			$this->load->view('auth/create_user', $this->data);
		}
	} // ef

	//create a new user
	function create_user()
	{
		$this->data['title'] = "Create User";

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('first_name', 'First Name', 'required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		//$this->form_validation->set_rules('phone1', 'First Part of Phone', 'required|xss_clean|min_length[3]|max_length[3]');
		//$this->form_validation->set_rules('phone2', 'Second Part of Phone', 'required|xss_clean|min_length[3]|max_length[3]');
		//$this->form_validation->set_rules('phone3', 'Third Part of Phone', 'required|xss_clean|min_length[4]|max_length[4]');
		//$this->form_validation->set_rules('company', 'Company Name', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');

		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('first_name')) . '' . strtolower($this->input->post('last_name'));
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => array_key_exists('first_name', $this->input->post()) ? $this->input->post('first_name') : NULL,
				'last_name' => array_key_exists('last_name', $this->input->post()) ? $this->input->post('last_name') : NULL,
				'company' => array_key_exists('company', $this->input->post()) ? $this->input->post('company') : NULL,
				'phone' => array_key_exists('phone', $this->input->post()) ? $this->input->post('phone') : NULL,
				'county_id' => array_key_exists('county_id', $this->input->post()) ? $this->input->post('county_id') : NULL,
				'organisation_id' => array_key_exists('organisation_id', $this->input->post()) ? $this->input->post('organisation_id') : NULL,
				'title' => array_key_exists('title', $this->input->post()) ? $this->input->post('title') : NULL,
				'address1' => array_key_exists('address1', $this->input->post()) ? $this->input->post('address1') : NULL,
				'address2' => array_key_exists('address2', $this->input->post()) ? $this->input->post('address2') : NULL,
				'city' => array_key_exists('county_id', $this->input->post()) ? $this->input->post('city') : NULL,
				'postcode' => array_key_exists('postcode', $this->input->post()) ? $this->input->post('postcode') : NULL,
				'home_tel' => array_key_exists('home_tel', $this->input->post()) ? $this->input->post('home_tel') : NULL,
				'work_tel' => array_key_exists('work_tel', $this->input->post()) ? $this->input->post('work_tel') : NULL,
				'mobile' => array_key_exists('mobile', $this->input->post()) ? $this->input->post('mobile') : NULL,
				'description' => array_key_exists('description', $this->input->post()) ? $this->input->post('description') : NULL,
				'licence_expiry' => array_key_exists('licence_expiry', $this->input->post()) ? $this->input->post('licence_expiry') : NULL,
				'other_contact' => array_key_exists('other_contact', $this->input->post()) ? $this->input->post('other_contact') : NULL,
				'training_attendance' => array_key_exists('training_attendance', $this->input->post()) ? $this->input->post('training_attendance') : NULL,
				'coach_rating_id' => array_key_exists('coach_rating_id', $this->input->post()) ? $this->input->post('coach_rating_id') : NULL,
				'price_individual' => array_key_exists('price_individual', $this->input->post()) ? $this->input->post('price_individual') : NULL,
				'price_corporate' => array_key_exists('price_corporate', $this->input->post()) ? $this->input->post('price_corporate') : NULL,
				'image' => array_key_exists('image', $this->input->post()) ? $this->input->post('image') : NULL,
				'date_created' => date('Y-m-d H:i:s'),
				'date_updated' => date('Y-m-d H:i:s'),
			);

			// $additional_data = array(
			// 	'first_name' => (array_key_exists(key, search) ? $this->input->post('first_name') : NULL,
			// 	'last_name' => (isset($this->input->post('last_name')) ? $this->input->post('last_name') : NULL,
			// 	'company' => (isset($this->input->post('company')) ? $this->input->post('company') : NULL,
			// 	'phone' => (isset($this->input->post('phone')) ? $this->input->post('phone') : NULL
			// 	'home_tel' => (isset($this->input->post('home_tel')) ? $this->input->post('home_tel') : NULL,
			// 	'county_id' => (isset($this->input->post('county_id')) ? $this->input->post('county_id') : NULL,
			// );

		}

		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{ //check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', "User Created");
			redirect("auth", 'refresh');
		}
		else
		{ //display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array('name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array('name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array('name' => 'company',
				'id' => 'company',
				'type' => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone1'] = array('name' => 'phone1',
				'id' => 'phone1',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone1'),
			);
			$this->data['phone2'] = array('name' => 'phone2',
				'id' => 'phone2',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone2'),
			);
			$this->data['phone3'] = array('name' => 'phone3',
				'id' => 'phone3',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone3'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array('name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);
			$this->load->view('auth/create_user', $this->data);
		}
	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
				$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}
