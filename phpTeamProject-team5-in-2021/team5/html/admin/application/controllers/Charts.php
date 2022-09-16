<?php
	class Charts extends CI_Controller{ //클래스이름 첫 글자는 대문자
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper(array("url","date")); //helper라이브러리 사용
			$this->load->model("Charts_m");
			date_default_timezone_set("Asia/Seoul");

		}
		public function index()		//제일 먼저 실행되는 index함수
		{
			/*admin으로 로그인한 경우에만 접근가능*/
			//if($this->session->userdata('rank')!=1) redirect("/~team5/b_Login");
			$this->lists();
		}
		public function lists()
		{
			$uri_array=$this->uri->uri_to_assoc(3);	//uri 값을 배열형태로 저장
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]): date("Y");

			$userno = $this->session->userdata('no');
			$data["hotelArea_list"]=$this->Charts_m->getlist_hotelArea($userno);
			$data["bestHotel_list"]=$this->Charts_m->getlist_bestHotel($text1,$userno);
			$data["bestRoom_list"]=$this->Charts_m->getlist_bestRooms($text1,$userno);
			$data["price_list"]=$this->Charts_m->getlist_price($text1,$userno);
			$data["text1"]=$text1;
			$this->load->view("main_header");
			$this->load->view("charts.php",$data);
		}
	}
?>