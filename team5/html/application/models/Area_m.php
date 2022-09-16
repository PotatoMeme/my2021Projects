<?php
	class Area_m extends CI_Model
	{

		public function getlist_detail()
		{
			$sql="select * from detail";
			return $this->db->query($sql)->result();
		}

		public function getlist_area($text1)
		{
			if(!$text1)
				$sql="select * from area";
			else
				$sql="select * from area where name like '%$text1%';";
			return $this->db->query($sql)->result();
		}

		public function getlist_hotel($area)
        {
			$sql="select hotel.*  from hotel where area_no = $area order by hotel.name ";
            return $this->db->query($sql)->result();    // 쿼리실행, 결과 리턴
        }

		public function rowcount($text1)
		{
			if(!$text1)
				$sql="select * from area";
			else
				$sql="select * from area where name like '%$text1%'";

			return $this->db->query($sql)->num_rows();
		}

		public function getrow($no)
		{
			$sql="select * from area where no=$no";     // select문 정의
            
			return $this->db->query($sql)->row_array();              // 쿼리실행, 결과 리턴
		}	
    }
?>