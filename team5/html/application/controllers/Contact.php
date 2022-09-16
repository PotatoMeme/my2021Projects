<?
	class Contact extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->model("contact_m");
			$this->load->library("form_validation");
		}

		public function index()
		{
			$this->main();
		}

		public function main()
		{			
			//$this->form_validation->set_rules("title","이름","required|max_length[50]");
			//$this->form_validation->set_rules("contents","내용","required");
			$writeday = date("Y-m-d");
			if ($this->form_validation->run()==FALSE){ // 목록화면의 추가버튼 클릭한 경우, 값 없이 호출된 경우
				if(!$this->session->userdata("uid"))
					$mno = 71;
				else 
					$mno = $this->session->userdata("no");
				$data["member"] = $this->contact_m->get_member($mno);
				$this->load->view("c_main_header");
				$this->load->view("c_contact",$data);
				$this->load->view("c_main_footer");
			}
			else{	 // 입력화면의 저장버튼 클릭한 경우
				$data = array(
				"depth2"	=>$this->input->post("name",TRUE),
				"member_no"	=>$this->input->post("member_no",TRUE),
				"title"		=>$this->input->post("title",TRUE),
				"writeday"  =>$writeday,
				"contents"	=>$this->input->post("contents",TRUE)
				);

				$this->contact_m->insertrow($data);

				redirect("/~team5/main");
			}
		}
	}
?>