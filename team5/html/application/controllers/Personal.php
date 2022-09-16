<?
	class Personal extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->model("personal_m");		
			$this->load->helper(array("url","date")); //helper라이브러리 사용
		}

		public function index()
		{
			$this->lists();
		}

		public function lists()
		{
			$no = $this->session->userdata("no");
			$data["list"]=$this->personal_m->getrow($no);
			$data["jangbu"]=$this->personal_m->getlist_jangbu($no);

			$this->load->view("c_main_header");
			$this->load->view("c_personal",$data);
			$this->load->view("c_main_footer");
		}


		public function view()
		{
			$no=$this->uri->segment(4);
			$data["row"]=$this->personal_m->getrow($no);
			
			redirect("/~team5");
			/*
			$this->load->view("c_main_header");
			$this->load->view("c_personal");
			$this->load->view("c_main_footer"); */

		
		}

		public function edit()
		{
			$no=$this->uri->segment(4);

			$uri_array=$this->uri->uri_to_assoc(3);
			$no = array_key_exists("no",$uri_array) ? urldecode($uri_array["no"]) : "" ;
			$text1 = array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "" ;
			$page = array_key_exists("page",$uri_array) ? "/page/" . urldecode($uri_array["page"]) : "" ;

			$this->load->library("form_validation");

			$this->form_validation->set_rules("name","이름","required|max_length[20]");
			$this->form_validation->set_rules("uid","아이디","required|max_length[20]");
			$this->form_validation->set_rules("pwd","비밀번호","required|max_length[20]");
			$this->form_validation->set_rules("tel","전화번호","required|max_length[11]");


			if ( $this->form_validation->run()==FALSE )
			{
				
				$this->load->view("c_main_header");
				
				$data["list"] = $this->personal_m->getrow($no);
				$this->load->view("c_personal_edit",$data);    // 입력화면 표시
				$this->load->view("c_main_footer");
			}
			else              // 입력화면의 저장버튼 클릭한 경우
			{
				$tel1 = $this -> input -> post("tel1",true);
				$tel2 = $this->input->post("tel2",true);
				$tel3 = $this->input->post("tel3",true);
				$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
				  
				$data=array(
					"name" => $this->input->post("name",TRUE),
					"uid" => $this->input->post("uid",TRUE),
					"pwd" => $this->input->post("pwd",TRUE),
					"tel" => $this->input->post("tel",TRUE)
					/* "rank" => $this->input->post("rank",TRUE) */
					);
				$result = $this->personal_m->updaterow($data, $no); 
				
				$dataedit=array(
					"no"=>$this->session->userdata("no"),
					"name" => $this->input->post("name",TRUE),
					"uid" => $this->input->post("uid",TRUE),
					"rank"=>$this->session->userdata("rank")
					
					);
				$this->session->set_userdata($dataedit);
				redirect("/~team5" );
			}
		}
	
}
?>