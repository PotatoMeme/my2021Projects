<?php
	class Area_m extends CI_Model
	{

        public function getlist($text1,$start,$limit)
        {
			if(!$text1)
				$sql="select * from area order by name limit $start,$limit";     // select문 정의
			else
				$sql = "select * from area where name like '%$text1%' order by name limit $start,$limit";
            return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
		}

		public function rowcount($text1)
		{
			if(!$text1)
			{
				$sql="select * from area";
			}
			else
			{
				$sql="select * from area where name like '%$text1%'";
			}
			return $this->db->query($sql)->num_rows();
		}

		public function getrow($no)
		{
			$sql="select * from area where no=$no";
			return $this->db->query($sql)->row(); 
		}	

		public function deleterow($no)
		{
			$sql="delete area,hotel,room,select_detail,jangbu,select_jangbu_detail,review from area 
			left join hotel on area.no = hotel.area_no
			left join room on hotel.no = room.hotel_no
			left join select_detail on room.no = select_detail.room_no
			left join jangbu on room.no =jangbu.room_no
			left join select_jangbu_detail on jangbu.no = select_jangbu_detail.jangbu_no
			left join review on jangbu.no = review.jangbu_no
			where area.no = $no";
			return $this->db->query($sql);
		}

		public function insertrow($row)
		{

			return $this->db->insert("area",$row);
		}

		public function updaterow($row,$no)
		{
			$where = array("no"=>$no);
			return $this->db->update("area",$row,$where);
		}
	}

?>