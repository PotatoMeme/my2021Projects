<?
	class Register extends CI_Controller {


		function __construct()
		{
			parent::__construct();
			$this->load->database();				 // 데이터베이스 연결
            $this->load->model("register_m");			 // 모델 Member_m 연결
			$this->load->helper(array("url","date"));//helper라이브러리 사용
			$this->load->library("form_validation"); //유효성검사 라이브러리
        }

		public function index()
			{
			$this->load->view("c_main_header");
			$this->load->view("c_register");
			$this->load->view("c_main_footer");
			}
		

		public function add()
		{
			$this->form_validation->set_rules("name","고객명","required|max_length[20]");
			$this->form_validation->set_rules("uid","아이디","required|max_length[20]");
			$this->form_validation->set_rules("pwd","암호","required|max_length[20]");
			$this->form_validation->set_rules("tel","전화번호","required|max_length[11]|numeric");



			$data = array( 
				"uid"=>$this->input->post("uid",TRUE),
				"pwd"=>$this->input->post("pwd",TRUE),
				"name"=>$this->input->post("name",TRUE),
				"tel"=>$this->input->post("tel",TRUE),
				"rank"=>$this->input->post("rank",TRUE)
			);
	

			$this->register_m->insertrow($data); 
			echo "<script>alert('회원가입이 완료되었습니다! ');</script>";
				echo "<script> document.location.href='/~team5'; </script>"; 
		}
		
	}
?>