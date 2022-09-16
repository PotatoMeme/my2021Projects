<?php
	class Dashboard extends CI_Controller{ //클래스이름 첫 글자는 대문자
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper(array("url","date")); //helper라이브러리 사용
			$this->load->model("Dashboard_m");
			date_default_timezone_set("Asia/Seoul");
		}

		public function index()	
		{
			/*admin으로 로그인한 경우에만 접근가능*/
			if($this->session->userdata('rank')==0) redirect("/~team5/admin/Login");
			$this->lists();
		}

		public function lists()
		{
			$text1 = date("Y-m-d");
			$year=date("Y");
			$month=date("m");
			$userno = $this->session->userdata('no');
			$allRooms  = $this->Dashboard_m->getAllRoom(41);
			$allHotels = $this->Dashboard_m->getAllHotel($userno);
			$rented = $this->Dashboard_m->getRentedRoom($text1,$userno);

			$data["hotelArea_list"]=$this->Dashboard_m->getlist_hotelArea($userno);
			$data["bestHotel_list"]=$this->Dashboard_m->getlist_bestHotel($userno);
			$data["bestRoom_list"]=$this->Dashboard_m->getlist_bestRooms($userno);
			$data["price_list"]=$this->Dashboard_m->getlist_price($year,$userno);
			$data["earnings_m"]=$this->Dashboard_m->getearnings_m($year,$month,$userno);
			$data["earnings_y"]=$this->Dashboard_m->getearnings_y($year,$userno);
			$data["earnings"]=$this->Dashboard_m->getearnings($userno);
			if($rented != 0 || $allRooms != 0)
				$data["vacancy"] = round(100 - (($rented / $allRooms)*100));
			else
				$data["vacancy"] = 100;
			$data["room_num"]  = $allRooms;
			$data["hotel_num"] = $allHotels;

			$this->load->view("main_header");
			$this->load->view("dashboard.php",$data);
		}


		

	}
?>