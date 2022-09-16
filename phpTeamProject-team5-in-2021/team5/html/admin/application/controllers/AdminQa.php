<?php
	class AdminQa extends CI_Controller{ //클래스이름 첫 글자는 대문자
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();            // 데이터베이스 연결
            $this->load->model("adminQa_m");    // 모델 gubun_m 연결
			$this->load->helper(array("url","date")); //helper라이브러리 사용
			$this->load->library("pagination");		  //page라이브러리
        }
		public function index()		//제일 먼저 실행되는 index함수
		{
			//if($this->session->userdata('rank')!=1) redirect("/~team5/Login");
			$this->lists();
		}

		public function insert()
		{
			$dapth1 = "";
			$depth2 = $this->input->post("depth2",TRUE);
			$title = $this->input->post("title",TRUE);
			$contents = $this->input->post("contents",TRUE);
			$member_no = $this->session->userdata('no');
			$member_name = $this->session->userdata('name');
			$writeday = date("Y-m-d");

			$data = array(
				"depth2" => $depth2,
				"title" => $title,
				"member_no" => $member_no,
				"writeday"  =>  $writeday,
				"contents" => $contents
			);
			$no =  $this->adminQa_m->insertrow($data);
			$depth1 = $no."^".$writeday."^".$member_name."^".$member_no;
			

			//$this->db->insert_id(); //방금 삽입한 레코드의 id를 저장
			
			if($depth1) echo $depth1;
		}

		public function delete()
		{
			$no = $this->input->post("no", TRUE);
			$result=$this->adminQa_m->deleterow($no);

			if($result) echo $no;
		}

		public function reply()
		{
			$depth1 = $this->input->post("depth1",TRUE);
			$depth2 = $this->input->post("depth2",TRUE);
			$title = "Re:".$this->input->post("title",TRUE);
			$contents = $this->input->post("contents",TRUE);
			$member_no = $this->input->post("member_no",TRUE);
			$writeday = date("Y-m-d");

			$data = array(
				"depth1"	=>  $depth1,
				"depth2"	=>  $depth2,
				"title"		=>  $title,	
				"writeday"	=>	$writeday,
				"contents"  =>  $contents,	
				"member_no" =>  $member_no
			);

			$result=$this->adminQa_m->addreply($data,$depth1,$depth2);
			if($result) echo $result;
		}

		public function update()
		{
			$no = $this->input->post("no",TRUE);
			//$depth2 = $this->input->post("depth2",TRUE);
			$title = $this->input->post("title",TRUE);
			$contents = $this->input->post("contents",TRUE);
			//$member_no = $this->input->post("member_no",TRUE);

			$data = array(//??
				"title"		=>  $title,	
				"contents"  =>  $contents,
			);
			$result= $this->adminQa_m->updaterow($data,$no);

			//$no = $this->db->insert_id();
			if($result) echo $result;
		}

		
		public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);				//uri 값을 배열형태로 저장
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]):"";			//gubunlist에서 온 값 추출

			if($text1=="")
				$base_url="/adminQa/lists/page";
			else
				$base_url="/adminQa/lists/text1/$text1/page";

			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url ="/~team5/admin".$base_url;

			$config["per_page"]	 = 10;									// 페이지당 표시할 line 수
			if($this->session->userdata("rank") == 1){// 사업자
				$config["total_rows"] = $this->adminQa_m->rowcount($this->session->userdata("no"),$text1);// 전체 레코드개수 구하기
			}else if($this->session->userdata("rank") == 2) {
				$config["total_rows"] = $this->adminQa_m->rowcount($text1);								// 전체 레코드개수 구하기
			}
			$config["uri_segment"] = $page_segment;						// 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;							// 기본 URL
			$this->pagination->initialize($config);						// pagination 설정 적용

			$data["page"]=$this->uri->segment($page_segment,0);  // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();  // 페이지소스 생성

			$start=$data["page"];                 // n페이지 : 시작위치
			$limit=$config["per_page"];        // 페이지 당 라인수


			if($this->session->userdata("rank") == 1){// 사업자
				$no = $this->session->userdata("no");
				$data["list"]=$this->adminQa_m->getlist_users($text1,$no,$start,$limit);
			} else if($this->session->userdata("rank") == 2) {
				$data["list"]=$this->adminQa_m->getlist($text1,$start,$limit); // 해당페이지 자료읽기
			}
			$data["text1"]=$text1;								//text1전달을 위한 처리  


            $this->load->view("main_header");                   // 상단출력(메뉴)
            $this->load->view("adminqa_list",$data);				// gubun_list에 자료전달
            $this->load->view("main_footer");                   // 하단 출력 
        }

	}
?>