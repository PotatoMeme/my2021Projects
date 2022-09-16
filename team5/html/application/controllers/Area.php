<?
	class Area extends CI_Controller {


		function __construct()
		{
			parent::__construct();
			$this->load->database();				  // 데이터베이스 연결
            $this->load->model("area_m");			  // 모델 Detail_m 연결
			$this->load->helper(array("url","date")); //helper라이브러리 사용
			$this->load->library("pagination");		  //page라이브러리
			$this->load->library("form_validation");  //유효성검사 라이브러리
        }


		public function index()
		{
			$this->lists();
		}

		public function map()
		{
			//$this->load->view("c_main_header");		// 상단출력(메뉴)
            $this->load->view("maptest");		// c_area에 자료전달
            //$this->load->view("c_main_footer");		// 하단 출력
		}

		public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);	
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]):""; //검색어
			if($text1=="")
				$base_url="/area/lists/page";
			else
				$base_url="/area/lists/text1/$text1/page";
			
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url ="/~team5".$base_url;

			$config["per_page"]	 = 5;									// 페이지당 표시할 line 수
			$config["total_rows"] = $this->area_m->rowcount($text1);// 전체 레코드개수 구하기		
			$config["uri_segment"] = $page_segment;						// 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;							// 기본 URL
			$this->pagination->initialize($config);						// pagination 설정 적용

			$data["page"]=$this->uri->segment($page_segment,0);		    // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();    // 페이지소스 생성

			$start=$data["page"];         // n페이지 : 시작위치
			$limit=$config["per_page"];   // 페이지 당 라인수

			// // 해당페이지 자료읽기
			$data["list_area"] = $this->area_m->getlist_area($text1);
			
			$data["text1"]=$text1;	//text1전달을 위한 처리  
            $this->load->view("c_main_header");		// 상단출력(메뉴)
            $this->load->view("c_area",$data);		// c_area에 자료전달
            $this->load->view("c_main_footer");		// 하단 출력
		}

		public function view()
		{
			$uri_array=$this->uri->uri_to_assoc(3);		//uri 값을 배열형태로 저장
			$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";		//선택한 레코드no 저장
			$text1=array_key_exists("text1",$uri_array) ?urldecode($uri_array["text1"]):date("Y-m-d",strtotime("-1 month"));	//시작날짜 저장
			$page=array_key_exists("page",$uri_array) ?urldecode($uri_array["page"]):"";	//현재페이지 저장

			$data["page"]=$page;
			$data["text1"]=$text1;	
			$data["row"] = $this->area_m->getrow($no);
			$data["list_hotel"] = $this->area_m->getlist_hotel($no);

			$this->load->view("c_main_header");   
			$this->load->view("c_area_view",$data);
			$this->load->view("c_main_footer");      
		}

	}

?>


