<?
	class About extends CI_Controller {

		public function index()
			{
			$this->load->view("c_main_header");
			$this->load->view("c_about");
			$this->load->view("c_main_footer");
			}
		}
?>