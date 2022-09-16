<?php
	class Member_m extends CI_Model
	{

        public function getlist($text1,$start,$limit)
        {
			if(!$text1)
				$sql="select * from member order by name limit $start,$limit";     // select문 정의
			else
				$sql = "select * from member where name like '%$text1%' order by name limit $start,$limit";
            return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
		}

		public function rowcount($text1)
		{
			if(!$text1)
			{
				$sql="select * from member";
			}
			else
			{
				$sql="select * from member where name like '%$text1%'";
			}
			return $this->db->query($sql)->num_rows();
		}

		public function getrow($no)
		{
			$sql="select * from member where no=$no";
			return $this->db->query($sql)->result(); 
		}	

		public function deleterow($no,$rank)
		{
			
			$sql="delete member,jangbu,select_jangbu_detail,review from member
				left join jangbu on member.no =jangbu.member_no
				left join select_jangbu_detail on jangbu.no = select_jangbu_detail.jangbu_no
				left join review on jangbu.no=review.jangbu_no
				where member.no = $no";
			if($rank >= 1){
				$this->db->query($sql);
				$sql="delete adminQA from adminQA
					left join member on adminQA.member_no = member.no
					where adminQA.member_no = $no";
				$this->db->query($sql);
				$sql="delete hotel,room,select_detail,jangbu,select_jangbu_detail,review from hotel
					left join room on hotel.no =room.hotel_no
					left join select_detail on room.no = select_detail.room_no
					left join jangbu on room.no =jangbu.room_no
					left join select_jangbu_detail on jangbu.no = select_jangbu_detail.jangbu_no
					left join review on jangbu.no=review.jangbu_no
					where hotel.member_no = $no";
			}
			return $this->db->query($sql);
			
			
		}

		public function insertrow($row)
		{

			return $this->db->insert("member",$row);
		}

		public function updaterow($row,$no)
		{
			$where = array("no"=>$no);
			return $this->db->update("member",$row,$where);
		}
	}

?>