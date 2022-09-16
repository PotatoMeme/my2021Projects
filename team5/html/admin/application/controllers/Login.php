<?php
	class Login extends CI_Controller{ //클래스이름 첫 글자는 대문자
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();            // 데이터베이스 연결
            $this->load->model("login_m");    // 모델 Login_m 연결
			$this->load->helper(array("url","date")); //helper라이브러리 사용
        }
	
		public function index()		//제일 먼저 실행되는 index함수
		{
			$this->load->view("login_header.php");
			
			$this->load->view("login_main.php");
		}

		public function check()
		{
			$uid=$this->input->post("uid",TRUE);
			$pwd=$this->input->post("pwd",TRUE);
			
			$row=$this->login_m->getrow($uid,$pwd);
			
			if($row && ($row->rank == '1'|| $row->rank == '2'))
			{	
				 
				$data=array(
					"no"=>$row->no,
					"name"=>$row->name,
					"uid"=>$row->uid,
					"rank"=>$row->rank

				);
				$this->session->set_userdata($data);
				redirect("/~team5/admin/dashboard");
			} else if ($row && $row->rank == '0'){

				$this->load->view("login_header.php");
				echo "<script>alert('일반 고객은 이용을 하실수 없습니다');</script>";
				$this->load->view("login_main.php");
				
				
			} else{
				$this->load->view("login_header.php");
				echo "<script>alert('아이디또는 비밀번호가 맞지 않습니다 ');</script>";
				$this->load->view("login_main.php");
			}
			
		}
		
	
		public function logout()
		{
			$data=array("uid", "rank");
			$this->session->unset_userdata($data);
			
			redirect("/~team5/admin/login");
		}
	}
?>