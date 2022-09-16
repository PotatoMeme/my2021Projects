<?
	class Hotelsingle extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->database();				  // 데이터베이스 연결
            $this->load->model("Hotel_m");			  // 모델 Detail_m 연결
			$this->load->helper(array("url","date")); //helper라이브러리 사용
			$this->load->library("pagination");		  //page라이브러리
			$this->load->library("form_validation");  //유효성검사 라이브러리
        }

		public function index()
		{
			$this->lists();
		}

		public function lists()
        {
			//$data["hotel_room"] =  $this->hotel_m->getlist_room();
			
			$this->load->view("c_main_header");
			$this->load->view("c_hotelsingle",$data);
			$this->load->view("c_main_footer");		
			
		}
		
	}
?>

		