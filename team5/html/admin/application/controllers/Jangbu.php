<?
	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	require_once __DIR__."/../libraries/PhpSpreadsheet/autoload.php"; 
	//엑셀출력을 위한 라이브러리

	class Jangbu extends CI_Controller{

		function __construct()
		{
			parent::__construct();
			$this->load->database();				  // 데이터베이스 연결
            $this->load->model("Jangbu_m");		  // 모델 jangbui_m 연결
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

			$base_url = "/jangbu/lists/text1/$text1/text2/$text2/text3/$text3/text4/$text4/page";
			$page_segment = substr_count( substr($base_url,0,strpos($base_url,"page")) , "/" )+1;
			$base_url ="/~team5/admin".$base_url;

			$config["per_page"]	 = 5;									// 페이지당 표시할 레코드 수
			if($this->session->userdata("rank") == 1) {
			$config["total_rows"] = $this->Jangbu_m->rowcount_users($this->session->userdata("no"),$text1,$text2,$text3,$text4);  // 전체 레코드개수 구하기
			} else if($this->session->userdata("rank") == 2) {
			$config["total_rows"] = $this->Jangbu_m->rowcount($text1,$text2,$text3,$text4);  // 전체 레코드개수 구하기
			} 
			$config["uri_segment"] = $page_segment;						// 페이지가 있는 segment 위치
			$config["base_url"]	 = $base_url;							// 기본 URL
			$this->pagination->initialize($config);						// pagination 설정 적용

			$data["page"]=$this->uri->segment($page_segment,0);			// 시작위치, 없으면 0.
			$data["pagination"] = $this->pagination->create_links();	// 페이지소스 생성

			$start=$data["page"];        
			$limit=$config["per_page"];

			$data["list_area"]=$this->Jangbu_m->getlist_area();
			$data["list_hotel"]=$this->Jangbu_m->getlist_hotel();
			
			if($this->session->userdata("rank") == 1) {
			$data["list"] = $this->Jangbu_m->getlist_users($this->session->userdata("no"),$text1,$text2,$text3,$text4,$start,$limit);  // 전체 레코드개수 구하기
			} else if($this->session->userdata("rank") == 2) {
			$data["list"] = $this->Jangbu_m->getlist($text1,$text2,$text3,$text4,$start,$limit);  // 전체 레코드개수 구하기
			} 
			$data["text1"]=$text1;					//text1전달을 위한 처리  
			$data["text2"]=$text2;
			$data["text3"]=$text3;
			$data["text4"]=$text4;

            $this->load->view("main_header");       // 메뉴출력(좌측메뉴)
            $this->load->view("jangbu_list",$data);	// list에 
            $this->load->view("main_footer");       // 하단 출력 
        }

		public function view()
		{
			$uri_array=$this->uri->uri_to_assoc(3);				//uri 값을 배열형태로 저장
			$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";		//선택한 레코드no 저장
			$text1=array_key_exists("text1",$uri_array) ?urldecode($uri_array["text1"]):date("Y-m-d",strtotime("-1 month"));	//시작날짜 저장
			$text2=array_key_exists("text2",$uri_array) ?urldecode($uri_array["text2"]):date("Y-m-d");  //종료날짜 저장
			$text3=array_key_exists("text3",$uri_array) ?urldecode($uri_array["text3"]):"0";		    //지역no 저장
			$text4=array_key_exists("text4",$uri_array) ?urldecode($uri_array["text4"]):"0";			//호텔no 저장
			$page=array_key_exists("page",$uri_array) ?urldecode($uri_array["page"]):"";				//현재페이지 저장

			$data["page"]=$page;
			$data["text1"]=$text1;	
			$data["text2"]=$text2;
			$data["text3"]=$text3;
			$data["text4"]=$text4;
			$data["row"] = $this->Jangbu_m->getrow($no);
			$data["selectedDetail"] = $this->Jangbu_m->getlistDetail($no);

            if($this->session->userdata("rank") == 2){
				$this->load->view("main_header");   
				$this->load->view("jangbu_view",$data);
				$this->load->view("main_footer");
			} else if($this->session->userdata("no") == $data["row"] -> member_no){
				$this->load->view("main_header");   
				$this->load->view("jangbu_view",$data);
				$this->load->view("main_footer");
			} else {
				redirect('~team5/admin/jangbu/lists');
			}        
		}

		public function delete()
		{
			if($this->session->userdata("rank") == 2){
			$no = $this->input->post("no", TRUE);
			$result=$this->Jangbu_m->deleterow($no);

			if($result) echo $no;
			} else {
				redirect('~team5/admin/dashboard');
			}
		}

		public function add()
		{
			$uri_array=$this->uri->uri_to_assoc(3);			//uri 값을 배열형태로 저장
			$text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]):date("Y-m-d",strtotime("-1 month"));
			$text2=array_key_exists("text2",$uri_array) ? "/text2/".urldecode($uri_array["text2"]):date("Y-m-d");
 			$text3=array_key_exists("text3",$uri_array) ? "/text3/".urldecode($uri_array["text3"]):"0";  //호텔no
			$text4=array_key_exists("text4",$uri_array) ? "/text4/".urldecode($uri_array["text4"]):"0";  //지역별 조회
			$page=array_key_exists("page",$uri_array) ?"/page/".urldecode($uri_array["page"]):"";
			
			
			$this->form_validation->set_rules("room_no","객실","required|numeric");
			$this->form_validation->set_rules("member_no","고객","required|numeric");
			$this->form_validation->set_rules("txtInday","체크인","required");
			$this->form_validation->set_rules("txtExitday","체크아웃","required");
			$this->form_validation->set_rules("days","총숙박일","required|numeric");
			$this->form_validation->set_rules("totalPrice","금액","required|numeric");

			if ($this->form_validation->run()==FALSE) // 목록화면의 추가버튼 클릭한 경우, 값 없이 호출된 경우
			{
				$data["exitday"]=date("Y-m-d",strtotime("+1 day"));
				$this->load->view("main_header");
				$this->load->view("jangbu_add",$data);     // 입력화면 표시
				$this->load->view("main_footer");				
				$this->load->view("main_footer");
			}
			else	// 입력화면의 저장버튼 클릭한 경우
			{
				$room_no = $this->input->post("room_no",true);
				$inday = $this->input->post("txtInday",true);
				$exitday = $this->input->post("txtExitday",true);

				$jungbok = $this->Jangbu_m->comparerow($room_no,$inday,$exitday);
				if($jungbok > 0 || $this->form_validation->run()==FALSE){	//중복된 날짜가 존재하는 경우   @@@@나중에 기존입력된데이터 넣는 기능 @@@@
					$data["exitday"]=date("Y-m-d",strtotime("+1 day"));

					$this->load->view("main_header");
					$this->load->view("alert");
					$this->load->view("jangbu_add",$data);     // 입력화면 표시
					$this->load->view("main_footer");
				}else{
					$data = array(							 // 폼 데이터를 배열로 저장
						"room_no"	 =>$this->input->post("room_no",TRUE),
						"member_no"	 =>$this->input->post("member_no",TRUE),
						"inday"		 =>$this->input->post("txtInday",TRUE),
						"exitday"	 =>$this->input->post("txtExitday",TRUE),
						"days"		 =>$this->input->post("days",TRUE),
						"price"		 =>$this->input->post("totalPrice",TRUE),
						"bigo"		 =>$this->input->post("bigo",TRUE)
					);
					/*
					$this->Jangbu_m->insertrow($data); 
					redirect("/~team5/admin/jangbu/lists/".$text1.$text2.$text3.$text4.$page);
					*/	
					//------------------------------------------------------
					$this->Jangbu_m->insertrow($data,$this->input->post("optionDetail",true));
					redirect("/~team5/admin/jangbu/lists/".$text1.$text2.$text3.$text4.$page);
					
					/* 시험중
					*/
				}
			
			}
		}

		public function edit()
		{
			$uri_array=$this->uri->uri_to_assoc(3);			//uri 값을 배열형태로 저장
			$no = array_key_exists("no",$uri_array) ?urldecode($uri_array["no"]):"";
			$text1=array_key_exists("text1",$uri_array) ? "/text1/".urldecode($uri_array["text1"]):date("Y-m-d",strtotime("-1 month"));
			$text2=array_key_exists("text2",$uri_array) ? "/text2/".urldecode($uri_array["text2"]):date("Y-m-d");
 			$text3=array_key_exists("text3",$uri_array) ? "/text3/".urldecode($uri_array["text3"]):"0";  //호텔 no
			$text4=array_key_exists("text4",$uri_array) ? "/text4/".urldecode($uri_array["text4"]):"0";  //지역별 조회
			$page=array_key_exists("page",$uri_array) ?"/page/".urldecode($uri_array["page"]):"";

			
			$this->form_validation->set_rules("room_no","객실","required|numeric");
			$this->form_validation->set_rules("member_no","고객","required|numeric");
			$this->form_validation->set_rules("txtInday","체크인","required");
			$this->form_validation->set_rules("txtExitday","체크아웃","required");
			$this->form_validation->set_rules("days","총숙박일","required|numeric");
			$this->form_validation->set_rules("totalPrice","금액","required|numeric");

			if ($this->form_validation->run()==FALSE) // 수정버튼을 클릭한 경우(값 없이 호출된 경우)
			{
				$data["no"] = $page;
		        $this->load->view("main_header");
				$data["row"]=$this->Jangbu_m->getrow($no);
			    $data["selectedDetail"] = $this->Jangbu_m->getlistDetail($no);
				$this->load->view("jangbu_edit",$data);
			    $this->load->view("main_footer");
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

			$this->Jangbu_m->updaterow($data,$no,$this->input->post("room_no",TRUE),$this->input->post("optionDetail",true));
			redirect("/~team5/admin/jangbu/lists/".$text1.$text2.$text3.$text4.$page);
			
					
			}
		}

		public function excel()
		{
			$uri_array=$this->uri->uri_to_assoc(3);				//uri 값을 배열형태로 저장
			$text1=array_key_exists("text1",$uri_array) ?urldecode($uri_array["text1"]):"";	
			$text2=array_key_exists("text2",$uri_array) ?urldecode($uri_array["text2"]):"";
			$text3=array_key_exists("text3",$uri_array) ?urldecode($uri_array["text3"]):"";	
			$text3=array_key_exists("text4",$uri_array) ?urldecode($uri_array["text4"]):"";	
			$page=array_key_exists("page",$uri_array) ?urldecode($uri_array["page"]):"";
			
			$count = $this->Jangbu_m->rowcount($text1,$text2,$text3,$text4);
			$list = $this->Jangbu_m->getlist_all($text1,$text2,$text3,$text4);
			$hotel = $this->Jangbu_m->getlist_hotel($text3); //hotel_no의 텍스트값을 가져옴
			$area = $this->Jangbu_m->getlist_area($text4);   //area_no 의 텍스트값을 가져옴

			$sheet = new Spreadsheet();
			
			//셀 가로길이 지정
			$sheet->getActiveSheet()->getColumnDimension("A")->setWidth(12); //no
			$sheet->getActiveSheet()->getColumnDimension("B")->setWidth(12); //객실
			$sheet->getActiveSheet()->getColumnDimension("C")->setWidth(12); //예약자
			$sheet->getActiveSheet()->getColumnDimension("D")->setWidth(24); //옵션
			$sheet->getActiveSheet()->getColumnDimension("E")->setWidth(12); //체크인
			$sheet->getActiveSheet()->getColumnDimension("F")->setWidth(12); //체크아웃
			$sheet->getActiveSheet()->getColumnDimension("G")->setWidth(12); //숙박일수
			$sheet->getActiveSheet()->getColumnDimension("H")->setWidth(12); //금액
			$sheet->getActiveSheet()->getColumnDimension("I")->setWidth(24); //비고

			//셀 위치정렬
			$sheet->getActiveSheet()->getStyle("A")->getAlignment()->setHorizontal("center");
			$sheet->getActiveSheet()->getStyle("B")->getAlignment()->setHorizontal("left");
			$sheet->getActiveSheet()->getStyle("C:E")->getAlignment()->setHorizontal("center");
			$sheet->getActiveSheet()->getStyle("E:H")->getAlignment()->setHorizontal("right");
			$sheet->getActiveSheet()->getStyle("I")->getAlignment()->setHorizontal("right");

			//제목
			$sheet->setActiveSheetIndex(0)->setCellValue("A1","예약장부");
			$sheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(13);
			$sheet->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);

			//지역
			$sheet->setActiveSheetIndex(0)->setCellValue("E1","호텔: $hotel");
			$sheet->getActiveSheet()->getStyle("I1")->getAlignment()->setHorizontal("right");

			//기간
			$sheet->setActiveSheetIndex(0)->setCellValue("F1","지역: $area");
			$sheet->getActiveSheet()->getStyle("I1")->getAlignment()->setHorizontal("right");

			//기간
			$sheet->setActiveSheetIndex(0)->setCellValue("I1","기간: $text1 - $text2");
			$sheet->getActiveSheet()->getStyle("I1")->getAlignment()->setHorizontal("right");

			$sheet->getActiveSheet()->getStyle("A2:I2")->getAlignment()->setHorizontal("center");
			$sheet->getActiveSheet()->getStyle("A2:I2")->getFill()
				->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
				->getStartColor()->setARGB("FFCCCCCC");

			$sheet->setActiveSheetIndex(0)
				->setCellValue("A2", "no")
				->setCellValue("B2", "객실")
				->setCellValue("C2", "예약자")
				->setCellValue("D2", "옵션")
				->setCellValue("E2", "체크인")
				->setCellValue("F2", "체크아웃")
				->setCellValue("G2", "숙박일")
				->setCellValue("H2", "금액")
				->setCellValue("I2", "비고");

			$i=3;
			foreach($list as $row)
			{
				$sheet->setActiveSheetIndex(0)
					->setCellValue("A$i",$row->name)
					->setCellValue("B$i",$row->room_name)	//as문
					->setCellValue("C$i",$row->member_name) //as문
					->setCellValue("D$i",$row->detail_name)  //수정@@@@@@@@@@@@
					->setCellValue("E$i",$row->inday)
					->setCellValue("F$i",$row->exitday)
					->setCellValue("G$i",$row->days)
					->setCellValue("H$i",$row->price)
					->setCellValue("I$i",$row->bigo);
				$i++;
			}

			$sheet->setActiveSheetIndex(0);

			$fname="호텔예약장부($text1-$text2).xlsx";
			$fname=iconv("UTF-8","EUC-KR",$fname);
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment;filename=$fname");
			header("Cache-Control:max-age=0");
			header("Cache-Control:max-age=1");

			$writer = IOFactory::createWriter($sheet,"Xlsx");
			$writer->save("php://output");
		}
	}
?>