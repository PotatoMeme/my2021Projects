<?
	class Review extends CI_Controller{ //클래스이름 첫 글자는 대문자
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();				  // 데이터베이스 연결
            $this->load->model("Review_m");			  // 모델 Review_m 연결
			$this->load->helper(array("url","date")); //helper라이브러리 사용
			$this->load->library("pagination");		  //page라이브러리
			$this->load->library("form_validation");  //유효성검사 라이브러리
        }
		public function index()	
		{
			/*admin으로 로그인한 경우에만 접근가능*/
			//if($this->session->userdata('rank')!=1) redirect("/~team5/admin/b_Login");
			$this->lists();
		}

		public function add()
		{
			if($this->session->userdata("rank") ==2){
				$uri_array=$this->uri->uri_to_assoc(3);			//uri 값을 배열형태로 저장
				$text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
				$page=array_key_exists("page",$uri_array) ?"/page/".urldecode($uri_array["page"]):"";
				
				$this->form_validation->set_rules("member_no","회원","required|numeric|max_length[11]");
				$this->form_validation->set_rules("room_no","객실","required|numeric|max_length[11]");
				$this->form_validation->set_rules("jangbu_no","예약번호","required|numeric|max_length[11]");
				$this->form_validation->set_rules("title","제목","required|max_length[25]");
				$this->form_validation->set_rules("review","후기","required|max_length[20]");

				if ($this->form_validation->run()==FALSE) // 목록화면의 추가버튼 클릭한 경우, 값 없이 호출된 경우
				{
					$this->load->view("main_header");
					$this->load->view("review_add");    // 입력화면 표시
					$this->load->view("main_footer");
				}
				else // 입력화면의 저장버튼 클릭한 경우
				{
					$data = array(
						"member_no" =>$this->input->post("member_no",TRUE),
						"room_no"	=>$this->input->post("room_no",TRUE),
						"jangbu_no" =>$this->input->post("jangbu_no",TRUE),
						"title"	=>$this->input->post("title",TRUE),
						"review"	=>$this->input->post("review",TRUE)	
					);
					$this->Review_m->insertrow($data);

					redirect("/~team5/admin/review/lists".$text1.$page);
				}
			}
		}

		public function delete()
		{
			if($this->session->userdata("rank") ==2){
				$no = $this->input->post("no", TRUE);
				$result=$this->Review_m->deleterow($no);

				if($result) echo $no;
			} else {
				redirect("~team5/admin/dashboard");
			}
		}

		public function edit()
		{
			if($this->session->userdata("rank") ==2){
				$uri_array=$this->uri->uri_to_assoc(3);			//uri 값을 배열형태로 저장
				$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";
				$text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
				$page=array_key_exists("page",$uri_array) ?"/page/".urldecode($uri_array["page"]):"";

				$this->form_validation->set_rules("member_no","회원","required|numeric|max_length[11]");
				$this->form_validation->set_rules("room_no","객실","required|numeric|max_length[11]");
				$this->form_validation->set_rules("jangbu_no","예약번호","required|numeric|max_length[11]");
				$this->form_validation->set_rules("title","제목","required|max_length[25]");
				$this->form_validation->set_rules("review","후기","required|max_length[20]");

				if ($this->form_validation->run()==FALSE) // 수정버튼을 클릭한 경우(값 없이 호출된 경우)
				{
					$this->load->view("main_header");
					$data["row"]=$this->Review_m->getrow($no);
					$this->load->view("review_edit",$data);
					$this->load->view("main_footer");
				}
				else{
					$data = array(
						"member_no" =>$this->input->post("member_no",TRUE),
						"room_no"	=>$this->input->post("room_no",TRUE),
						"jangbu_no" =>$this->input->post("jangbu_no",TRUE),
						"title"	=>$this->input->post("title",TRUE),
						"review"	=>$this->input->post("review",TRUE)	
					);
					$this->Review_m->updaterow($data,$no);

					redirect("/~team5/admin/review/lists".$text1.$page);
				}
			}
		}

		public function view()
		{
			$uri_array=$this->uri->uri_to_assoc(3);				//uri 값을 배열형태로 저장
			$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";	
			$text1=array_key_exists("text1",$uri_array) ?urldecode($uri_array["text1"]):"";	
			$page=array_key_exists("page",$uri_array) ?urldecode($uri_array["page"]):"";	

			$data["page"]=$page;
			$data["text1"]=$text1;	
			$data["row"] = $this->Review_m->getrow($no);    // 자료읽어 data배열에 저장
			if($this->session->userdata("rank") == 2){
				$this->load->view("main_header");   
				$this->load->view("review_view",$data);
				$this->load->view("main_footer");
			} else if($this->session->userdata("no") == $data["row"] -> hotel_owner){
				$this->load->view("main_header");   
				$this->load->view("review_view",$data);
				$this->load->view("main_footer");
			} else {
				
				redirect('~team5/admin/review/lists');
			};
			
			
		}
		
		public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);	//uri 값을 배열형태로 저장
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]):"";			//gubunlist에서 온 값 추출

			if ($text1=="") 
			{$base_url = "/review/lists/page";}            
			else 
			{$base_url = "/review/lists/text1/$text1/page";} 
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url ="/~team5/admin".$base_url;

			$config["per_page"]	 = 5;									// 페이지당 표시할 line 수
			if($this->session->userdata("rank") == 1){// 사업자
				$config["total_rows"] = $this->Review_m->rowcount_users($this->session->userdata("no"),$text1);  // 전체 레코드개수 구하기
			} else if($this->session->userdata("rank") == 2) {
				$config["total_rows"] = $this->Review_m->rowcount($text1);  // 전체 레코드개수 구하기
			}	
			
			$config["uri_segment"] = $page_segment;						// 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;							// 기본 URL
			$this->pagination->initialize($config);						// pagination 설정 적용

			$data["page"]=$this->uri->segment($page_segment,0);  // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();  // 페이지소스 생성

			$start=$data["page"];              // n페이지 : 시작위치
			$limit=$config["per_page"];        // 페이지 당 라인수
			if($this->session->userdata("rank") == 1){// 사업자
				$config["total_rows"] = $data["list"]=$this->Review_m->getlist_users($this->session->userdata("no"),$text1,$start,$limit);   // 해당페이지 자료읽기
			} else if($this->session->userdata("rank") == 2) {
				$data["list"]=$this->Review_m->getlist($text1,$start,$limit);   // 해당페이지 자료읽기
			}
			
			$data["text1"]=$text1;								//text1전달을 위한 처리  

            $this->load->view("main_header");                   // 상단출력(메뉴)
            $this->load->view("review_list",$data);				// gubun_list에 자료전달
            $this->load->view("main_footer");                   // 하단 출력 
        }

	}
?>