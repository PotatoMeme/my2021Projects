<?
	class Hotel extends CI_Controller {


		function __construct()
		{
			parent::__construct();
			$this->load->database();				  // �����ͺ��̽� ����
            $this->load->model("hotel_m");			  // �� Detail_m ����
			$this->load->helper(array("url","date")); //helper���̺귯�� ���
			$this->load->library("pagination");		  //page���̺귯��
			$this->load->library("form_validation");  //��ȿ���˻� ���̺귯��
			date_default_timezone_set("Asia/Seoul");
        }


		public function index()
		{
			if($this->session->userdata('rank') != 0);
			
			$this->lists();
			//$this->room_m->getlist_detailname($no);
			
			//$data["list"] = $this->Hotel_m->getrow($no); //$no�� ���ǵ��� ���� ����
			
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
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]):""; //�˻���
			$text2=array_key_exists("text2",$uri_array) ? urldecode($uri_array["text2"]):"";
			$text3=array_key_exists("text3",$uri_array) ? urldecode($uri_array["text3"]):"";
 
			if($text1=="")
				$base_url="/hotel/lists/page";
			else
				$base_url="/hotel/lists/text1/$text1/page";
			
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url ="/~team5".$base_url;

			$config["per_page"]	 = 6;									// �������� ǥ���� line ��
			$config["total_rows"] = $this->hotel_m->rowcount($text1);// ��ü ���ڵ尳�� ���ϱ�		
			$config["uri_segment"] = $page_segment;						// �������� �ִ� segment ��ġ
			$config["base_url"]	 = $base_url;							// �⺻ URL
			$this->pagination->initialize($config);						// pagination ���� ����

			$data["page"]=$this->uri->segment($page_segment,0);		    // ������ġ, ������ 0.
			$data["pagination"] = $this->pagination->create_links();    // �������ҽ� ����

			$start=$data["page"];         // n������ : ������ġ
			$limit=$config["per_page"];   // ������ �� ���μ�

			// // �ش������� �ڷ��б�
			$data["list_area"] = $this->hotel_m->getlist_area();
			$data["list_hotel"] =  $this->hotel_m->getlist_hotel($text1,$start,$limit);
			
			$data["text1"]=$text1;										 //text1������ ���� ó��  

            $this->load->view("c_main_header");						     // ������(�޴�)
            $this->load->view("c_hotel",$data);					 	 // jangbui_list�� �ڷ�����
            $this->load->view("c_main_footer");						     // �ϴ� ���
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
			$uri_array=$this->uri->uri_to_assoc(3);			//uri ���� �迭���·� ����
			$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";
			
			
			$this->form_validation->set_rules("txtInday","üũ��","required");
			$this->form_validation->set_rules("txtExitday","üũ�ƿ�","required");
			$this->form_validation->set_rules("days","�Ѽ�����","required|numeric");
			$this->form_validation->set_rules("totalPrice","�ݾ�","required|numeric");

			if ($this->form_validation->run()==FALSE) // ������ư�� Ŭ���� ���(�� ���� ȣ��� ���)
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
			$this->form_validation->set_rules("","��","required|max_length[30]");
			$this->form_validation->set_rules("","�߰� �ɼ�","required|max_length[30]");
			$this->form_validation->set_rules("","�Խ�","required|max_length[30]");
			$this->form_validation->set_rules("","���","required|max_length[30]");
			$this->form_validation->set_rules("","���","required|max_length[30]");



			$data = array( 
				"room_no"=>$this->input->post("room_no",TRUE),
				"member_no"=>$this->input->post("member_no",TRUE),
				"inday"=>$this->input->post("inday",TRUE),
				"exitday"=>$this->input->post("exitday",TRUE),
				"days"=>$this->input->post("days",TRUE)
				"price"=>$this->input->post("price",TRUE)
			);
	

			$this->register_m->insertrow($data); 
			echo "<script>alert('������ �Ϸ�Ǿ����ϴ�! ');</script>";
				echo "<script> document.location.href='/~team5'; </script>"; 
		}
		*/
	}
?>


