<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//change class name to reflect the controller page name
class Quotes extends CI_Controller {

	public function index()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->load->view('main');
	}

	public function login()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules("email","Email","required|valid_email");
		
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));

		$this->load->model('user');
		$user = $this->user->get_user_by_email($email);
		// echo "<pre>";
		// var_dump($user);
		// die(' end of login');
		if ($user && $user['password']==$password) 
		{
			$currentuser = array(
				'userid'=>$user['id'],
				'username'=>$user['name'],
				'useralias'=>$user['alias'],
				);
			$this->session->set_userdata('name',$currentuser['username']);
			$this->session->set_userdata('alias',$currentuser['useralias']);
			$this->session->set_userdata('userid',$currentuser['userid']);
			// echo $this->session->userdata('name');
			// die(' testing session name');
			$this->load->model('quote');
			$results['quotes'] = $this->quote->get_quotes();
			$results['favorites'] = $this->quote->get_favorites();
			$this->load->view('quotes',$results);
		}
		else 
		{
			$this->session->set_flashdata('login_error',"Invalid email or password");
			redirect("/");
		}

	}

	public function register()
	{
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules("name","Name","trim|required");
		$this->form_validation->set_rules("alias","Alias","trim|required");
		$this->form_validation->set_rules("emailaddress","Email Address","required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("rpassword","Password","required|min_length[8]");
		$this->form_validation->set_rules("dob","Date of Birth","required");

		$newuser = $this->input->post();

		if ($this->form_validation->run() == FALSE) 
		{
			$this->load->view('main');
		}
		else
		{
			$this->load->model('user');
			$data = $this->user->create($newuser);
			$this->session->set_flashdata('success',"You have successfully registered");
			// var_dump($data);
			// die(' test');
			$this->session->set_userdata('name',$data['name']);
			$this->session->set_userdata('alias',$data['alias']);
			$this->session->set_userdata('userid',$data['id']);
			$this->load->model('quote');
			$results['quotes']=$this->quote->get_quotes();
			$results['favorites']=$this->quote->get_favorites();
			$this->load->view('quotes',$results);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/");
	}

	public function quotesmain()
	{
		$this->load->view('quotes');
	}

	public function add()
	{

		$data = $this->input->post();
		$this->load->model('quote');
		$results['quotes']=$this->quote->get_quotes();
		$results['favorites']=$this->quote->add_favorite($data);
		// echo "<pre>";
		// var_dump($results);
		// die(' add test');
		$this->load->view('quotes',$results);
	}

	public function create()
	{
		$data = $this->input->post();
		$this->load->model('quote');
		$results['quotes'] = $this->quote->create($data);
		$results['favorites'] = $this->quote->get_favorites();
		$this->load->view('quotes',$results);
	}

	public function remove()
	{
		$data = $this->input->post();
		// var_dump($data);
		// die(' remove test');
		$this->load->model('quote');
		$this->quote->remove_favorite($data);
		$results['quotes']=$this->quote->get_quotes();
		$results['favorites']=$this->quote->get_favorites();
		$this->load->view('quotes',$results);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */