<?
	class Main extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->model("main_m");
		}

		public function index()
		{
			$this->lists();
		}

		public function lists()
		{
			//$num1 = $this->main_m->rowcount();
			//$num2 = mt_rand(0, 10);
			$data["num_jangbu"] = $this->main_m->rowcount_jangbu();
			$data["num_hotel"] = $this->main_m->rowcount_hotel();
			$data["num_room"] = $this->main_m->rowcount_room();
			$data["num_area"] = $this->main_m->rowcount_area();
			$data["list_hotel"]=$this->main_m->getlist_hotel(6,7);
			$data["list_room"]=$this->main_m->getlist_room(6,7);
			$this->load->view("c_main_header");
			$this->load->view("c_index",$data);
			$this->load->view("c_main_footer");
		}
	}
?>