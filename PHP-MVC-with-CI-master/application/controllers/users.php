<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("form_validation");
		$this->load->model('user');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function register()
	{
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('alias', 'Alias', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required');

        if ($this->form_validation->run())
        {
         	$user['name'] = $this->input->post('name');
         	$user['alias'] = $this->input->post('alias');
         	$user['email'] = $this->input->post('email');
         	$user['password'] = md5($this->input->post('password'));
            $user['birth_date'] = $this->input->post('birth_date');
            $user['poke_history'] = 0;


         	if ($this->user->register($user))
         	{
         		$this->session->set_flashdata('messages', 'Successfully Registered');
         	}
         	else
         	{
         		$this->session->set_flashdata('errors','Could not register');
         	}
         }
         else
        {
            $this->session->set_flashdata('errors', validation_errors());
        }
        redirect('/users');

	}
 public function login()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $user = $this->user->get_user_by_email($email);
        if($user && $user['password'] == $password)
        {
            $user = array(
               'user_id' => $user['id'],
               'user_email' => $user['email'],
               'user_name' => $user['name'],
               'user_alias' => $user['alias'],
               'is_logged_in' => true
            );
            $this->session->set_userdata($user);
            redirect("/users/profile");;

        }
        else
        {
            $this->session->set_flashdata("errors", "Invalid email or password!");
            redirect("/users/index");;
        }

    }
    public function profile()
    {
        if($this->session->userdata('is_logged_in') === TRUE)
        {
            $id = $this->session->userdata('user_id');
            $view_data['users'] = $this->user->get_all_users($id);
            $users = $this->user->get_all_users($id);
            $counter = 0;
            echo "<h3> Welcome, ". $this->session->userdata('user_alias'). 
            "!</h3>  <a href='/users/logout'>Logout</a><br><div class = poke_feed>";
            foreach ($users as $user) 
            {   
                $poke['recipient_id'] = $this->session->userdata('user_id');
                $poke['poke_id'] = $user['id'];
                $count = $this->user->count_pokes($poke);
                foreach ($count as $value) 
                    {
                        if($value > 0)
                        {
                        echo $user['alias'].' poked you ' .$value. ' times.<br>';
                        $counter ++;
                        }
                    }
            }
            echo '</div> <h4>'.$counter.' people poked you!</h4>';
        	$this->load->view('profile',$view_data);
        }
        else
            redirect("/users/login");
    }
    public function poke($id)
    {
        $send_poke = $this->user->get_user_by_id($id);
        $user['poke_history'] = $send_poke['poke_history'] + 1;
        $user['id'] = $id;
        $poke['poke_id'] = $this->session->userdata('user_id');
        $poke['recipient_id'] = $id;
        $poke['alias'] = $this->session->userdata('user_alias');
        $this->user->poke($user);
        $this->user->poke_log($poke);

        redirect('/users/profile');
    }
    
    public function logout()
    {

        $this->session->sess_destroy();
        redirect("/users/index");   
    }
}