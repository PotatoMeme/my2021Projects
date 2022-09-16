<?
	class Findjangbu extends CI_Controller{

		function __construct()
		{
			parent::__construct();
			$this->load->database();				  // 데이터베이스 연결
            $this->load->model("Findjangbu_m");		  // 모델 jangbui_m 연결
			$this->load->helper(array("url","date")); // helper라이브러리 사용
			$this->load->library("pagination");		  // page라이브러리
			$this->load->library("form_validation");  //유효성검사 라이브러리
			date_default_timezone_set("Asia/Seoul");
        }
	
		public function index()	
		{
			/*admin으로 로그인한 경우에만 접근가능*/
			//if($this->session->userdata('rank')!=1) redirect("/~team5/admin/b_Login"); 
			$this->lists();
		}

		public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);	//uri 값을 배열형태로 저장
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]): date("Y-m-d",strtotime("-1 month"));//-부터
 			$text2=array_key_exists("text2",$uri_array) ? urldecode($uri_array["text2"]):date("Y-m-d"); //-까지
			$text3=array_key_exists("text3",$uri_array) ? urldecode($uri_array["text3"]):"0";  //지역별 조회
			$text4=array_key_exists("text4",$uri_array) ? urldecode($uri_array["text4"]):"0";  //호텔별 조회

			$base_url = "/findjangbu/lists/text1/$text1/text2/$text2/text3/$text3/text4/$text4/page";
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url ="/~team5/admin".$base_url;

			$config["per_page"]	 = 5;									// 페이지당 표시할 레코드 수
			$config["total_rows"] = $this->Findjangbu_m->rowcount($text1,$text2,$text3,$text4);  // 전체 레코드개수 구하기

			$config["uri_segment"] = $page_segment;						// 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;							// 기본 URL
			$this->pagination->initialize($config);						// pagination 설정 적용

			$data["page"]=$this->uri->segment($page_segment,0);			// 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();	// 페이지소스 생성

			$start=$data["page"];        
			$limit=$config["per_page"];

			$data["list_area"]=$this->Findjangbu_m->getlist_area();
			$data["list_hotel"]=$this->Findjangbu_m->getlist_hotel();
			$data["list"]=$this->Findjangbu_m->getlist($text1,$text2,$text3,$text4,$start,$limit);//지정한 페이지만큼 읽어옴
			$data["text1"]=$text1;					//text1전달을 위한 처리  
			$data["text2"]=$text2;
			$data["text3"]=$text3;
			$data["text4"]=$text4;

            $this->load->view("main_header_nomenu");       // 메뉴출력(좌측메뉴)
            $this->load->view("findjangbu_list",$data);	// list에 
            $this->load->view("main_footer");       // 하단 출력 
        }

	 
	}
?>