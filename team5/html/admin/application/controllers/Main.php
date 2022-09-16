<?php
	class Main extends CI_Controller{
		function __construct()
		{
			parent::__construct();
			$this->load->helper(array("url","date")); //helper라이브러리 사용
        }

		public function index()
			{
			//$this->load->view("main_header");
			//$this->load->view("main_footer");
			redirect("/~team5/admin/dashboard");
			}
	}
?>