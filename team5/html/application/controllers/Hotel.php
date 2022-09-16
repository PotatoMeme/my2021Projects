<?
	class Hotel extends CI_Controller {


		function __construct()
		{
			parent::__construct();
			$this->load->database();				  // 데이터베이스 연결
            $this->load->model("hotel_m");			  // 모델 Detail_m 연결
			$this->load->helper(array("url","date")); //helper라이브러리 사용
			$this->load->library("pagination");		  //page라이브러리
			$this->load->library("form_validation");  //유효성검사 라이브러리
			date_default_timezone_set("Asia/Seoul");
        }


		public function index()
		{
			if($this->session->userdata('rank') != 0);
			
			$this->lists();
			//$this->room_m->getlist_detailname($no);
			
			//$data["list"] = $this->Hotel_m->getrow($no); //$no은 정의되지 않은 변수
			
			/*
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]):"";
			$start=$data["page"]; 
			$limit=$config["per_page"];
			$data["list"] = $this->Hotel_m->getlist($text1,$start,$limit);
			*/
		}

		public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);	
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]):""; //검색어
			$text2=array_key_exists("text2",$uri_array) ? urldecode($uri_array["text2"]):"";
			$text3=array_key_exists("text3",$uri_array) ? urldecode($uri_array["text3"]):"";
 
			if($text1=="")
				$base_url="/hotel/lists/page";
			else
				$base_url="/hotel/lists/text1/$text1/page";
			
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url ="/~team5".$base_url;

			$config["per_page"]	 = 6;									// 페이지당 표시할 line 수
			$config["total_rows"] = $this->hotel_m->rowcount($text1);// 전체 레코드개수 구하기		
			$config["uri_segment"] = $page_segment;						// 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;							// 기본 URL
			$this->pagination->initialize($config);						// pagination 설정 적용

			$data["page"]=$this->uri->segment($page_segment,0);		    // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();    // 페이지소스 생성

			$start=$data["page"];         // n페이지 : 시작위치
			$limit=$config["per_page"];   // 페이지 당 라인수

			// // 해당페이지 자료읽기
			$data["list_area"] = $this->hotel_m->getlist_area();
			$data["list_hotel"] =  $this->hotel_m->getlist_hotel($text1,$start,$limit);
			
			$data["text1"]=$text1;										 //text1전달을 위한 처리  

            $this->load->view("c_main_header");						     // 상단출력(메뉴)
            $this->load->view("c_hotel",$data);					 	 // jangbui_list에 자료전달
            $this->load->view("c_main_footer");						     // 하단 출력
		}

		public function view()
        {

			$uri_array=$this->uri->uri_to_assoc(3);
			$no = array_key_exists("no",$uri_array) ? urldecode($uri_array["no"]) : "" ;
			$text1 = array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "" ;
			$page = array_key_exists("page",$uri_array) ? urldecode($uri_array["page"]) : "" ;


			$data["text1"]=$text1;
			$data["page"] = $page;
			$data["row"] = $this->hotel_m->getrow($no);
			
			$data["hotel_room"] =  $this->hotel_m->getlist_room();
			$data["hotel_detail"] =  $this->hotel_m->getlist_detail();

			$this->load->view("c_main_header");                 
            $this->load->view("c_hotelsingle",$data);          
            $this->load->view("c_main_footer");                  
		}
		public function add()
		{
			$uri_array=$this->uri->uri_to_assoc(3);			//uri 값을 배열형태로 저장
			$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";
			
			
			$this->form_validation->set_rules("txtInday","체크인","required");
			$this->form_validation->set_rules("txtExitday","체크아웃","required");
			$this->form_validation->set_rules("days","총숙박일","required|numeric");
			$this->form_validation->set_rules("totalPrice","금액","required|numeric");

			if ($this->form_validation->run()==FALSE) // 수정버튼을 클릭한 경우(값 없이 호출된 경우)
			{
				$data["exitday"]=date("Y-m-d",strtotime("+1 day"));
		        $this->load->view("c_main_header");
				$data["no"]=$no;
				$data["row"]=$this->hotel_m->getrow_room($no);
			    $data["selectedDetail"] = $this->hotel_m->getlist_roomdetail($no);
				$this->load->view("c_hotel_add",$data);
			    $this->load->view("c_main_footer");
			}

			else{
			$data = array(
				"room_no"	 =>$this->input->post("room_no",TRUE),
				"member_no"	 =>$this->input->post("member_no",TRUE),
				"inday"		 =>$this->input->post("txtInday",TRUE),
				"exitday"	 =>$this->input->post("txtExitday",TRUE),
				"days"		 =>$this->input->post("days",TRUE),
				"price"		 =>$this->input->post("totalPrice",TRUE),
				"bigo"		 =>$this->input->post("bigo",TRUE)
			);

			$this->hotel_m->insertrow($data,$this->input->post("optionDetail",true));
			redirect("/~team5/main");
			
					
			}
		}
		/*
		public function add()
		{
			$this->form_validation->set_rules("","방","required|max_length[30]");
			$this->form_validation->set_rules("","추가 옵션","required|max_length[30]");
			$this->form_validation->set_rules("","입실","required|max_length[30]");
			$this->form_validation->set_rules("","퇴실","required|max_length[30]");
			$this->form_validation->set_rules("","퇴실","required|max_length[30]");



			$data = array( 
				"room_no"=>$this->input->post("room_no",TRUE),
				"member_no"=>$this->input->post("member_no",TRUE),
				"inday"=>$this->input->post("inday",TRUE),
				"exitday"=>$this->input->post("exitday",TRUE),
				"days"=>$this->input->post("days",TRUE)
				"price"=>$this->input->post("price",TRUE)
			);
	

			$this->register_m->insertrow($data); 
			echo "<script>alert('예약이 완료되었습니다! ');</script>";
				echo "<script> document.location.href='/~team5'; </script>"; 
		}
		*/
	}
?>


