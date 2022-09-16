<?php
	class Findroom_m extends CI_Model
	{
        public function getlist($text1,$start,$limit)
        {
			if(!$text1)
				$sql="select room.*, hotel.name as hotel_name, sum(detail.price) as detail_prices from ((room left join hotel on room.hotel_no=hotel.no) left join select_detail on room.no=select_detail.room_no)left join detail on detail.no=select_detail.detail_no group by room.name order by room.name limit $start,$limit";     // select문 정의
			else
				$sql = "select room.*, hotel.name as hotel_name, sum(detail.price) as detail_prices from ((room left join hotel on room.hotel_no=hotel.no) left join select_detail on room.no=select_detail.room_no)left join detail on detail.no=select_detail.detail_no where room.name like '%$text1%' group by room.name  order by room.name limit $start,$limit";
            return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
		}

		public function rowcount($text1)
		{
			if(!$text1)
			{
				$sql="select * from room";
			}
			else
			{
				$sql="select * from room where name like '%$text1%'";
			}
			return $this->db->query($sql)->num_rows();
		}
		public function getrow($no)
		{
			$sql="select room.*, hotel.name as hotel_name, hotel.member_no as member_no from room 
				left join hotel on room.hotel_no=hotel.no 
				where room.no=$no";     // select문 정의
            
			return $this->db->query($sql)->row();              // 쿼리실행, 결과 리턴
		}
		public function getlistDetail($no)
		{
			$sql="select select_detail.*, detail.name as detail_name ,detail.price as detail_price 
			from select_detail 
			left join detail on select_detail.detail_no=detail.no 
			where select_detail.room_no=$no";
			return $this->db->query($sql)->result(); 
			
		}
		public function getlistDetailCount($no)
		{
			$sql="select select_detail.*  
			from select_detail 
			where select_detail.room_no=$no";
			return $this->db->query($sql)->num_rows(); 
			
		}
	}

?>