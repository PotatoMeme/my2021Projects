<?
	class Room extends CI_Controller{ //클래스이름 첫 글자는 대문자
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();				  // 데이터베이스 연결
            $this->load->model("room_m");			  // 모델 jangbui_m 연결
			$this->load->helper(array("url","date")); //helper라이브러리 사용
			$this->load->library("pagination");		  //page라이브러리
			$this->load->library("upload");			  //사진 업로드 기능
			$this->load->library("image_lib");		  //썸네일 자동 변환
		}

		function call_upload($picIndex)
		{
			$config['upload_path'] = '../imgs/room_img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite'] = TRUE;
			$config['max_size'] = 10000000;
			$config['max_width'] = 10000;
			$config['max_height'] = 10000;
			$this->upload->initialize($config);

			$formPic="pic".$picIndex;
			if(!$this->upload->do_upload($formPic)) //pic 컨트롤로부터 파일 업로드
				$picname="";
			else
			{
				$picname=$this->upload->data("file_name");
				$config["image_library"] = "gd2";
				$config["source_image"] = "../imgs/room_img/".$picname;
				$config["thumb_marker"] = "";
				$config["new_image"] = "../imgs/room_img/thumb";
				$config["create_thumb"] = TRUE;
				$config["maintain_ratio"] = TRUE;
				$config["width"] = 600;
				$config["height"] = 450;

				$this->image_lib->initialize($config);

				$this->image_lib->resize();

			}
			return $picname;
			
			
		}
	
		public function index()
		{
			/*admin으로 로그인한 경우에만 접근가능*/
			//if($this->session->userdata('rank')!=1) redirect("/~team5/admin/b_Login");
			$this->lists();
		}

		public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);	
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]):""; //검색어
 
			//$base_url = "/room/lists/text1/$text1/page"; 
			if($text1=="")
				$base_url="/room/lists/page";
			else
				$base_url="/room/lists/text1/$text1/page";
			
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url ="/~team5/admin".$base_url;

			$config["per_page"]	 = 5;									// 페이지당 표시할 line 수
			if($this->session->userdata("rank") ==1) {
				$config["total_rows"] = $this->room_m->rowcount_users($this->session->userdata("no"),$text1);// 전체 레코드개수 구하기	
			} else if ($this->session->userdata("rank") ==2) {
				$config["total_rows"] = $this->room_m->rowcount($text1);// 전체 레코드개수 구하기	
			}
				
			$config["uri_segment"] = $page_segment;						// 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;							// 기본 URL
			$this->pagination->initialize($config);						// pagination 설정 적용

			$data["page"]=$this->uri->segment($page_segment,0);		    // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();    // 페이지소스 생성

			$start=$data["page"];         // n페이지 : 시작위치
			$limit=$config["per_page"];   // 페이지 당 라인수

			// // 해당페이지 자료읽기
			if($this->session->userdata("rank") ==1) {
				$data["list"]=$this->room_m->getlist_users($this->session->userdata("no"),$text1,$start,$limit); // 해당페이지 자료읽기
			} else if ($this->session->userdata("rank") ==2) {
				$data["list"]=$this->room_m->getlist($text1,$start,$limit);
			}
			
			$data["text1"]=$text1;										 //text1전달을 위한 처리  

            $this->load->view("main_header");						     // 상단출력(메뉴)
            $this->load->view("room_list",$data);					 	 // jangbui_list에 자료전달
            $this->load->view("main_footer");						     // 하단 출력
		}

		public function view()
		{
			//-- team5
			$uri_array=$this->uri->uri_to_assoc(3);	//uri 값을 배열형태로 저장
			$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";	
			$text1=array_key_exists("text1",$uri_array) ?urldecode($uri_array["text1"]):"";	
			$page=array_key_exists("page",$uri_array) ?urldecode($uri_array["page"]):"";	

			$data["page"]=$page;
			$data["text1"]=$text1;	
			$data["row"] = $this->room_m->getrow($no); // 자료를 읽어 data배열에 저장 
			$data["pic"] = explode("^",$data["row"]->pic);
			$data["seldetail_name"]=$this->room_m->getlist_detailname($no);
			
           
			if($this->session->userdata("rank") == 2){
				$this->load->view("main_header");   
				$this->load->view("room_view",$data);
				$this->load->view("main_footer");
			} else if($this->session->userdata("no") == $data["row"] -> member_no){
				$this->load->view("main_header");   
				$this->load->view("room_view",$data);
				$this->load->view("main_footer");
			} else {
				redirect('~team5/admin/room/lists');
			}
		}

		public function delete()
		{
			$no = $this->input->post("no", TRUE);
			$result=$this->room_m->deleterow($no);

			if($result) echo $no;
		}

		public function add()
		{
			//--- team5
			$uri_array=$this->uri->uri_to_assoc(3);			//uri 값을 배열형태로 저장
			$text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
			$page=array_key_exists("page",$uri_array) ?"/page/".urldecode($uri_array["page"]):"";
			$totalPic=3;  //사진업로드 컨트롤 수

			$this->load->library("form_validation");  //유효성검사 라이브러리
		
			$this->form_validation->set_rules("hotel_no","구분명","required");
			$this->form_validation->set_rules("name","이름","required|max_length[50]");
			$this->form_validation->set_rules("price","단가","required|numeric");
			$this->form_validation->set_rules("max_member","단가","required|numeric");
			
			if ($this->form_validation->run()==FALSE) // 목록화면의 추가버튼 클릭한 경우, 값 없이 호출된 경우
			{
				$data["totalPic"]=$totalPic;
				$data["list"]=$this->room_m->getlist_hotel();
				$data["list_detail"]=$this->room_m->getlist_detail();

				$this->load->view("main_header");
				$this->load->view("room_add",$data);    // 입력화면 표시
				$this->load->view("main_footer");
			}
			else // 입력화면의 저장버튼 클릭한 경우
			{
				$data = array(
					'hotel_no' => $this->input->post("hotel_no",true), 
					'name'=>$this->input->post("name",true), 
					'price'=>$this->input->post("price",true),
					'max_member'=>$this->input->post("max_member",true),
					'bigo'=>$this->input->post("bigo",true)
				);

			for($i=1; $i<$totalPic+1; $i++){
				$picname = $this->call_upload($i);
				if($picname) $data["pic"] .= $picname."^"; //그림파일내용이 있으면 경로 저장
			}

			$this->room_m->insertrow($data,$this->input->post("detail",true)); 

			redirect("/~team5/admin/room/lists".$text1.$page);
			}
	
		}

		public function edit()
		{
			//--- team5
			$uri_array=$this->uri->uri_to_assoc(3);	//uri 값을 배열형태로 저장
			$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";
			$text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
			$page=array_key_exists("page",$uri_array) ?"/page/".urldecode($uri_array["page"]):"";
			$totalPic=3;  //사진업로드 컨트롤 수

			$this->load->library("form_validation");
			$this->form_validation->set_rules("hotel_no","구분명","required");
			$this->form_validation->set_rules("name","이름","required|max_length[50]");
			$this->form_validation->set_rules("price","단가","required|numeric");
			$this->form_validation->set_rules("max_member","단가","required|numeric");
			
			if ($this->form_validation->run()==FALSE) // 수정버튼을 클릭한 경우(값 없이 호출된 경우)
			{
				$data["totalPic"]=$totalPic;
		        $data["list"]=$this->room_m->getlist_hotel();
				$data["list_detail"]=$this->room_m->getlist_detail();
				$data["selected_detail"]=$this->room_m->getlist_seldetail($no);
				$data["row"]=$this->room_m->getrow($no);
				$data["pic"] = explode("^",$data["row"]->pic);

				$this->load->view("main_header");
			    $this->load->view("room_edit",$data);
			    $this->load->view("main_footer");
			}
			else{
				$data = array( 
					'hotel_no' => $this->input->post("hotel_no",true), 
					'name'=>$this->input->post("name",true), 
					'price'=>$this->input->post("price",true),
					'max_member'=>$this->input->post("max_member",true),
					'bigo'=>$this->input->post("bigo",true)
				);
				$data["pic"]=$this->input->post("oldPic",TRUE);
				for($i=1; $i<$totalPic+1; $i++){
					$picname = $this->call_upload($i);
					if($picname) $data["pic"] .= $picname."^"; //그림파일내용이 있으면 경로 저장
				}

				$this->room_m->updaterow($data,$no,$this->input->post("detail",true));
				redirect("/~team5/admin/room/lists".$text1.$page);
			}
		}
	}
?>