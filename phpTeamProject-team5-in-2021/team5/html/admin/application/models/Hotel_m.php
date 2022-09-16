<?php
	class Hotel_m extends CI_Model
	{

        public function getlist($text1,$start,$limit)
        {
			
			if (!$text1)
				$sql="select hotel.*, member.name as member_name , 
					area.name as area_name from hotel 
					left join member on hotel.member_no=member.no
					left join area on hotel.area_no=area.no 
					order by hotel.name limit $start,$limit";    // 전체 자료
			else
				$sql="select hotel.*, member.name as member_name , 
					area.name as area_name from hotel 
					left join member on hotel.member_no=member.no
					left join area on hotel.area_no=area.no
					where hotel.name like '%$text1%'
					order by hotel.name limit $start,$limit";
					

			return $this->db->query($sql)->result();
		}
		public function getlist_users($text1,$no,$start,$limit)
        {
			
			if (!$text1)
				$sql="select hotel.*, member.name as member_name , 
					area.name as area_name from hotel 
					left join member on hotel.member_no=member.no
					left join area on hotel.area_no=area.no 
					where hotel.member_no = $no	
					order by hotel.name limit $start,$limit";    // 전체 자료
			else
				$sql="select hotel.*, member.name as member_name , 
					area.name as area_name from hotel 
					left join member on hotel.member_no=member.no
					left join area on hotel.area_no=area.no
					where hotel.member_no = $no 
					and hotel.name like '%$text1%'
					order by hotel.name limit $start,$limit";
					

			return $this->db->query($sql)->result();
		}
		
		public function getlist_area()
		{
			$sql="select * from area order by name";
			return $this->db->query($sql)->result();

		}

		public function rowcount($text1)
		{
			if (!$text1)
				$sql="select * from hotel ";
			else
				$sql="select * from hotel where name like '%$text1%'" ;
			return $this->db->query($sql)->num_rows();

		}
		public function rowcount_users($no,$text1)
		{
			if (!$text1)
				$sql="select * from hotel where hotel.member_no = $no";
			else
				$sql="select * from hotel where hotel.member_no = $no 
			and name like '%$text1%'" ;
			return $this->db->query($sql)->num_rows();

		}
		public function getrow($no)
		{
			/*$sql="select hotel.*, member.name as member_name, area.name as area_name from (hotel left join member on hotel.member_no=member.no) left join area on hotel.area_no=area.no where hotel.no=$no";
			return $this->db->query($sql)->result(); 
			*/
			$sql="select hotel.*, member.name as member_name 
				, area.name as area_name from hotel 
				left join member on hotel.member_no=member.no
				left join area on hotel.area_no=area.no 
				where hotel.no=$no";     // select문 정의
            return $this->db->query($sql)->row();              // 쿼리실행, 결과 리턴
		}	
		/*public function checkuser($no){
			$sql="select rank from member  
				where no = $no";     // select문 정의
            return $this->db->query($sql)->row();  
		}*/

		public function deleterow($no)
		{
		
			$sql="delete hotel,room,select_detail,jangbu,select_jangbu_detail,review from hotel
					left join room on hotel.no =room.hotel_no
					left join select_detail on room.no = select_detail.room_no
					left join jangbu on room.no =jangbu.room_no
					left join select_jangbu_detail on jangbu.no = select_jangbu_detail.jangbu_no
					left join review on jangbu.no=review.jangbu_no
					where hotel.no = $no";
			return $this->db->query($sql);
		}

		public function insertrow($row)
		{

			return $this->db->insert("hotel",$row);
		}

		public function updaterow($row,$no)
		{
			$where = array("no"=>$no);
			return $this->db->update("hotel",$row,$where);
		}
	}

?>