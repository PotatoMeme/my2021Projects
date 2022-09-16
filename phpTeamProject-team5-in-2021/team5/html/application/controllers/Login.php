<?
    class Login extends CI_Controller {       // login클래스 선언
        function __construct()                           // 클래스생성할 때 초기설정
        {
            parent::__construct();
            $this->load->database();                     // 데이터베이스 연결
            $this->load->model("login_m");    // 모델 login_m 연결
			$this->load->helper(array("url", "date"));   
        }

		public function index()
		{

		}

		

	    public function check()                 
        {
			$uid=$this->input->post("uid", true);
			$pwd=$this->input->post("pwd", true);

			$row=$this->login_m->getrow($uid, $pwd);
			
			if ($row)
			{
				echo "<script>alert($row->no);</script>";
				$data=array(
					"no"=>$row->no,
					"name"=>$row->name,
					"uid"=>$row->uid,
					"rank"=>$row->rank
					
				);
				$this->session->set_userdata($data);
				redirect("/~team5");
			} else{
				
				echo "<script>alert('아이디 또는 비밀번호가 맞지 않습니다 ');</script>";
				echo "<script> document.location.href='/~team5'; </script>"; 

			}
			
		/*	$this->load->view("c_main_header");         // 상단출력(메뉴)
			$this->load->view("c_index"); 
		 $this->load->view("c_main_footer");      */  
        }
	
		public function logout()                 
        {	
			$data=array('uid', 'rank');
			$this->session->unset_userdata($data);
			
			redirect("/~team5");
		/*	$this->load->view("c_main_header");            
			$this->load->view("c_index"); 
            $this->load->view("c_main_footer");  */         
        }

    }
?>
