<?
	class Personal_m extends CI_Model {

		public function getlist()
        {
			$sql="select * from member order by name ";    // 전체 자료
			
            return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
        }
		public function getlist_jangbu($no)
        {
			$sql="select jangbu.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name, hotel.area_no, hotel.no as hotel_no 
			from ((jangbu left join member on jangbu.member_no=member.no)
			left join room on jangbu.room_no=room.no)
			left join hotel on room.hotel_no=hotel.no
			where jangbu.member_no =$no";    // 전체 자료
			
            return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
        }
		
		function getrow($no)
		{
			$sql="select * from member where no=$no";
			return $this->db->query($sql)->result();
		}

		public function updaterow($row,$no)
		{
			$where = array("no"=>$no);
			return $this->db->update("member", $row, $where);
		}
	}
?>