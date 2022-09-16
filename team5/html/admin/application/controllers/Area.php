<?
	class Area extends CI_Controller{ //클래스이름 첫 글자는 대문자
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();            // 데이터베이스 연결
            $this->load->model("area_m");    // 모델 gubun_m 연결
			$this->load->helper(array("url","date")); //helper라이브러리 사용
			$this->load->library("pagination");		  //page라이브러리
			$this->load->library("upload");			  //사진 업로드 기능
			$this->load->library("image_lib");		  //썸네일 자동 변환
			$this->load->library("form_validation");  //유효성검사 라이브러리
        }
		public function index()		//제일 먼저 실행되는 index함수
		{
			
			$this->lists();
		}

		function call_upload($picIndex)
		{
			$config['upload_path'] = '../imgs/area_img';
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
				$config["source_image"] = "../imgs/area_img/".$picname;
				$config["thumb_marker"] = "";
				$config["new_image"] = "../imgs/area_img/thumb";
				$config["create_thumb"] = TRUE;
				$config["maintain_ratio"] = TRUE;
				$config["width"] = 600;
				$config["height"] = 450;

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}
			return $picname;		
		}

		public function insert()
		{
			if($this->session->userdata("rank") ==2){	
				$name = $this->input->post("name",TRUE);
				$data = array(
					"name"  =>  $name	
				);
				$this->area_m->insertrow($data);

				$no = $this->db->insert_id();
				if($no) echo $no;
			}
		}

		public function delete()
		{
			if($this->session->userdata("rank") ==2){
				$no = $this->input->post("no", TRUE);
				$result=$this->area_m->deleterow($no);

				if($result) echo $no;
			} else {
				redirect("~team5/admin/dashboard");
			}
		}

		public function add()
		{
			$uri_array=$this->uri->uri_to_assoc(3);				//uri 값을 배열형태로 저장
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]):"";
			$page=array_key_exists("page",$uri_array) ?"/page/".urldecode($uri_array["page"]):"";
			
			$this->form_validation->set_rules("name","이름","required|max_length[50]");

			if ($this->form_validation->run()==FALSE){ // 목록화면의 추가버튼 클릭한 경우, 값 없이 호출된 경우
				//$data["list"]=$this->area_m->getlist_area();// 추가
				$this->load->view("main_header");
				if($this->session->userdata("rank") == 1){$this->load->view("area_add");}
				else if($this->session->userdata("rank") == 2){$this->load->view("area_add");} //@@@@@2
				$this->load->view("main_footer");
			}
			else{	 // 입력화면의 저장버튼 클릭한 경우
				$data = array(
				"name"		=>$this->input->post("name",TRUE),
				"video"		=>$this->input->post("video",TRUE),
				"gps"		=>$this->input->post("gps",TRUE),
				"intro1"	=>$this->input->post("intro1",TRUE),
				"intro2"	=>$this->input->post("intro2",TRUE)
				);

				$picname1 = $this->call_upload(1);
				$picname2 = $this->call_upload(2);
				if($picname1) $data["pic1"] = $picname1; //그림파일내용이 있으면 경로 저장
				if($picname2) $data["pic2"] = $picname2;
				$this->area_m->insertrow($data);

				redirect("/~team5/admin/area/lists".$text1.$page);
			}
		}

		public function view()
		{
			$uri_array=$this->uri->uri_to_assoc(3);				//uri 값을 배열형태로 저장
			$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";	
			$text1=array_key_exists("text1",$uri_array) ?urldecode($uri_array["text1"]):"";	
			$page=array_key_exists("page",$uri_array) ?urldecode($uri_array["page"]):"";	

			$data["page"]=$page;
			$data["text1"]=$text1;	
			$data["row"] = $this->area_m->getrow($no);    // 자료읽어 data배열에 저장
			if($this->session->userdata("rank") == 2){
				$this->load->view("main_header");   
				$this->load->view("area_view",$data);
				$this->load->view("main_footer");
			} else if($this->session->userdata("no") == $data["row"] -> hotel_owner){
				$this->load->view("main_header");   
				$this->load->view("area_view",$data);
				$this->load->view("main_footer");
			} else {
				redirect('~team5/admin/area/lists');
			};
			
		}

		public function edit()
		{
			if($this->session->userdata("rank") ==2){
				$uri_array=$this->uri->uri_to_assoc(3);			//uri 값을 배열형태로 저장
				$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";
				$text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
				$page=array_key_exists("page",$uri_array) ?"/page/".urldecode($uri_array["page"]):"";

				$this->form_validation->set_rules("name","지역명","required");

				if ($this->form_validation->run()==FALSE) // 수정버튼을 클릭한 경우(값 없이 호출된 경우)
				{
					$this->load->view("main_header");
					$data["row"]=$this->area_m->getrow($no);
					$this->load->view("area_edit",$data);
					$this->load->view("main_footer");
				}
				else{
					$data = array(
					"name"		=>$this->input->post("name",TRUE),
					"video"		=>$this->input->post("video",TRUE),
					"gps"		=>$this->input->post("gps",TRUE),
					"intro1"	=>$this->input->post("intro1",TRUE),
					"intro2"	=>$this->input->post("intro2",TRUE)
					);
					$this->area_m->updaterow($data,$no);

					redirect("/~team5/admin/area/lists".$text1.$page);
				}
			}
		}

		
		public function lists()
        {
			$uri_array=$this->uri->uri_to_assoc(3);				//uri 값을 배열형태로 저장
			$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]):"";			//gubunlist에서 온 값 추출

			if ($text1=="") 
			{$base_url = "/area/lists/page";}                 // $page_segment = 4;
			else 
			{$base_url = "/area/lists/text1/$text1/page";}    // $page_segment = 6;
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url ="/~team5/admin".$base_url;

			$config["per_page"]	 = 5;									// 페이지당 표시할 line 수
			$config["total_rows"] = $this->area_m->rowcount($text1);  // 전체 레코드개수 구하기
			$config["uri_segment"] = $page_segment;						// 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;							// 기본 URL
			$this->pagination->initialize($config);						// pagination 설정 적용

			$data["page"]=$this->uri->segment($page_segment,0);  // 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();  // 페이지소스 생성

			$start=$data["page"];                 // n페이지 : 시작위치
			$limit=$config["per_page"];        // 페이지 당 라인수

			$data["list"]=$this->area_m->getlist($text1,$start,$limit);   // 해당페이지 자료읽기
			$data["text1"]=$text1;								//text1전달을 위한 처리  

            $this->load->view("main_header");                   // 상단출력(메뉴)
			if($this->session->userdata("rank") == 1){// 사업자
						redirect('~team5/admin/dashboard');
			} else if($this->session->userdata("rank") == 2){// 관리자
					$this->load->view("area_list",$data);				// gubun_list에 자료전달
					 $this->load->view("main_footer");                   // 하단 출력 
			}
            
        }

	}
?>