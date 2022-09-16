<?php
	class Review_m extends CI_Model
	{

        public function getlist($text1,$start,$limit)
        {
			
			if (!$text1)
				$sql="select review.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name from ((review 
					left join member on review.member_no=member.no)
					left join room on review.room_no=room.no)
					left join hotel on room.hotel_no=hotel.no
					order by review.title limit $start,$limit";    // 전체 자료
			else
				$sql="select review.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name from from ((review 
					left join member on review.member_no=member.no)
					left join room on review.room_no=room.no)
					left join hotel on room.hotel_no=hotel.no
					where member_name like '%$text1%'
					order by review.title limit $start,$limit";
					

			return $this->db->query($sql)->result();
		}
		public function getlist_users($no,$text1,$start,$limit)
        {
			
			if (!$text1)
				$sql="select review.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name from ((review 
					left join member on review.member_no=member.no)
					left join room on review.room_no=room.no)
					left join hotel on room.hotel_no=hotel.no
					where hotel.member_no = $no
					order by review.title limit $start,$limit";    // 전체 자료
			else
				$sql="select review.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name from from ((review 
					left join member on review.member_no=member.no)
					left join room on review.room_no=room.no)
					left join hotel on room.hotel_no=hotel.no
					where hotel.member_no = $no
					and member_name like '%$text1%'
					order by review.title limit $start,$limit";
					

			return $this->db->query($sql)->result();
		}
		
		public function getlist_room()
		{
			$sql="select * from room order by name";
			return $this->db->query($sql)->result();

		}

		public function rowcount($text1)
		{
			if (!$text1)
				$sql="select * from review";
			else
				$sql="select review.*, member.name as member_name, room.name as room_name from review left join member on review.member_no=member.no 
				where member_name like '%$text1%'";
			return $this->db->query($sql)->num_rows();
		}
		public function rowcount_users($no,$text1)
		{
			if (!$text1)
				$sql="select * from review
				left join room on review.room_no=room.no
				left join hotel on room.hotel_no=hotel.no
				where hotel.member_no = $no";
			else
				$sql="select review.*, member.name as member_name, room.name as room_name from review 
				left join member on review.member_no=member.no 
				left join room on review.room_no=room.no
				left join hotel on room.hotel_no=hotel.no
				where hotel.member_no = $no
				and member_name like '%$text1%'";
			return $this->db->query($sql)->num_rows();
		}
		public function getrow($no)
		{
			$sql="select review.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name,hotel.member_no as hotel_owner from ((review left join member on review.member_no=member.no) left join room on review.room_no=room.no) left join hotel on room.hotel_no=hotel.no where review.no=$no";
			return $this->db->query($sql)->row(); 
			
		}	


		public function deleterow($no)
		{
			$sql="delete from review where no=$no";
			return $this->db->query($sql);
		}

		public function insertrow($row)
		{
		
			return $this->db->insert("review",$row);
		}

		public function updaterow($row,$no)
		{
			$where = array("no"=>$no);
			return $this->db->update("review",$row,$where);
		}
	}

?>