<?php
	class Contact_m extends CI_Model
	{
		public function getlist_hotel($text1,$start,$limit)
        {
           if (!$text1)
			$sql="select hotel.*  from hotel order by hotel.name limit $start,$limit";
			else
			$sql="select hotel.*  from hotel where hotel.name like '%$text1%' order by hotel.name limit $start,$limit";
            return $this->db->query($sql)->result();    // 쿼리실행, 결과 리턴
        }

		public function get_member($no){
			$sql="select * from member where no=$no;";
			return $this->db->query($sql)->row_array();  
		}

		public function insertrow($row) // $detail이 없는 경우 예외처리가 되었는지 확인111
		{
			$this->db->insert("adminQA",$row);
			$no = $this->db->insert_id();
			$where = array("no" => $no);
			$depth1= array("depth1" => $no);
			$this->db->update("adminQA",$depth1,$where);
			return $this->db->insert("adminQA",$row);
		}
    }
?>