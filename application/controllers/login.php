<?php

/**
* 
*/
class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('login');
	}
	public function signin()
	{

		if($this->input->post('employee'))
			{
				$this->form_validation->set_rules('username','Username','required');
				$this->form_validation->set_rules('password','Password','required');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				if($this->form_validation->run() == true)
					{
						$where = array(
										'name' => $this->input->post('username') ,
										'password' => md5($this->input->post('password')),
									   );
						$query = $this->restaurant->user_authenticate('user',$where);
						if($query)
							{
								$user_id = $query->u_id;
								$username = $query->name;
								$areas = array(
								'username' => $query->name,
								'u_id'  => $query->u_id,
								'logged_in'=> TRUE 
								 );
								$this->session->set_userdata($areas);
//                                $time_out= date("hh:ii:ss");                                
//                                $date_out= date("Y:m:d");
//
//								$time = array(
//									$i=idate("h"),
//									$m=idate("i"),
//									$y=idate("s"),
//									);
//								$time_out = implode(':', $time);
//								$date = array(
//									$i=idate("Y"),
//									$m=idate("m"),
//									$y=idate("d"),
//									);
//								$date_out = implode('-', $date);
								//$data= array(
//									'u_id' => $query->u_id,
//									'date' => $date_out,
//									'time' => $time_out,
//									);
								//$execute = $this->restaurant->addition('use_status',$data);
								redirect('rest/index?Action=1');
							}
						else{					
								redirect(base_url().'login?Action=2');
							}	
					}
			}
		redirect(base_url().'login?Action=2');
	}
	public function log_out()
	{
		$id   = $this->session->userdata('u_id'); 
		$status = 0;
		$currentid = $this->restaurant->outing_time('use_status',$status,'status',$id,'u_id');
		$sid = $currentid->sid;
//		$time = array(
//				$i=idate("h"),
//				$m=idate("i"),
//				$y=idate("s"),
//				);
//		$time_out = implode(':', $time);
//		$this->restaurant->out('use_status',$time_out,$id,$sid);
		$this->session->sess_destroy();
		redirect(base_url().'login?Action=3');
	}
}

?>