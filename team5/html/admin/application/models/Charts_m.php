<?php
	class Charts_m extends CI_Model
	{
		 public function getlist_price($text1,$userno)
         {
			$sql="select
			sum( if(month(jangbu.exitday)=1, jangbu.price,0)) as s1,
			sum( if(month(jangbu.exitday)=2, jangbu.price,0)) as s2, 
			sum( if(month(jangbu.exitday)=3, jangbu.price,0)) as s3, 
			sum( if(month(jangbu.exitday)=4, jangbu.price,0)) as s4, 
			sum( if(month(jangbu.exitday)=5, jangbu.price,0)) as s5, 
			sum( if(month(jangbu.exitday)=6, jangbu.price,0)) as s6, 
			sum( if(month(jangbu.exitday)=7, jangbu.price,0)) as s7, 
			sum( if(month(jangbu.exitday)=8, jangbu.price,0)) as s8, 
			sum( if(month(jangbu.exitday)=9, jangbu.price,0)) as s9, 
			sum( if(month(jangbu.exitday)=10, jangbu.price,0)) as s10, 
			sum( if(month(jangbu.exitday)=11, jangbu.price,0)) as s11, 
			sum( if(month(jangbu.exitday)=12, jangbu.price,0)) as s12 
			from (jangbu left join room on jangbu.room_no=room.no)left join hotel on room.hotel_no=hotel.no
			where year(jangbu.exitday)='$text1' ";     // select문 정의
			
			$where= $userno !=1 ? " and hotel.member_no=$userno ":"";
			$sql=$sql.$where;
			
			return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
		}

		public function getlist_bestRooms($text1,$userno)
		{
			$sql="select jangbu.*, room.name as room_name, room.hotel_no,count(jangbu.room_no) as room_count, hotel.name as hotel_name from (hotel right join room on hotel.no=room.hotel_no)right join jangbu on jangbu.room_no=room.no
			where year(jangbu.exitday)='$text1'";
			$where= $userno !=1 ? " and hotel.member_no=$userno ":" ";
			$sql=$sql.$where."group by room.name limit 10;";

			return $this->db->query($sql)->result(); 
		}

		 public function getlist_bestHotel($text1,$userno)
		{
			$sql="select hotel.name as hotel_name, sum(jangbu.days) as days from (hotel right join room on hotel.no=room.hotel_no) right join jangbu on jangbu.room_no=room.no
			where year(jangbu.exitday)='$text1'";
			$where= $userno !=1 ? " and hotel.member_no=$userno ":" ";
			$sql=$sql.$where."group by hotel.name limit 5;";
		
			return $this->db->query($sql)->result(); 
		}

		public function getlist_hotelArea($userno)
		{
			$sql="select area.name as area_name, count(hotel.area_no) as area_num from hotel left join area on hotel.area_no=area.no";
			$where= $userno !=1 ? " where hotel.member_no=$userno ":" ";
			$sql=$sql.$where."group by area.name limit 5;";

			return $this->db->query($sql)->result(); //group by area_name
		}
	}
?>