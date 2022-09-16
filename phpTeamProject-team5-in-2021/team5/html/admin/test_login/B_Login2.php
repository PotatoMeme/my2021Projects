<?php
	class B_Login2 extends CI_Controller{ //클래스이름 첫 글자는 대문자
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();            // 데이터베이스 연결
            $this->load->model("b_Login_m");    // 모델 Gigan_m 연결
			$this->load->helper(array("url","date")); //helper라이브러리 사용
        }
	
		public function index()		//제일 먼저 실행되는 index함수
		{
			$this->load->view("b_main_header_nomenu");
			$this->load->view("b_login.php");
		}

		public function check()
		{
			$uid=$this->input->post("uid",TRUE);
			$pwd=$this->input->post("pwd",TRUE);

			$row=$this->b_Login_m->getrow($uid,$pwd);
			if($row && $row->uid6 == 'admin')
			{
				$data=array(
					"uid"=>$row->uid6,
					"rank"=>$row->rank6
				);
				$this->session->set_userdata($data);
				redirect("/~sale6/b_Dashboard");
			}else{
				redirect("/~sale6/b_Login2");
			}
			
			}
	
		public function logout()
		{
			$data=array("uid", "rank");
			$this->session->unset_userdata($data);
			
			redirect("/~sale6/b_Login2");
		}
	}
?>