<?php
	class Findjangbu_m extends CI_Model
	{

        public function getlist($text1,$text2,$text3,$text4,$start,$limit)
        {
			
			$sql="select jangbu.*, member.no as member_no, member.name as member_name, room.no as room_no, room.name as room_name, hotel.name as hotel_name, hotel.area_no, hotel.no as hotel_no from ((jangbu 
				left join member on jangbu.member_no=member.no)
				left join room on jangbu.room_no=room.no)
				left join hotel on room.hotel_no=hotel.no 
				where jangbu.exitday>='$text1' and jangbu.inday <= '$text2' ";
			$where1= ($text3 == 0) ? "":"and hotel.area_no=$text3 ";
			$where2= ($text4 == 0) ? "":"and hotel.no=$text4 ";
			$sql = $sql.$where1.$where2."order by jangbu.inday limit $start,$limit";

			return $this->db->query($sql)->result();
		}
		
		public function getlist_room()
		{
			$sql="select * from room order by name";
			return $this->db->query($sql)->result();

		}

		public function getlist_hotel()
		{
			$sql="select * from hotel order by name";
			return $this->db->query($sql)->result();

		}

		public function getlist_area()
		{
			$sql="select * from area order by no";
			return $this->db->query($sql)->result();

		}

		public function rowcount($text1,$text2,$text3,$text4)
		{
			$sql="select * from (jangbu left join room on jangbu.room_no=room.no) left join hotel on room.hotel_no=hotel.no 
			where jangbu.exitday>='$text1' and jangbu.inday <= '$text2' ";
			$where1= ($text3 == 0) ? "":"and hotel.area_no=$text3 ";
			$where2= ($text4 == 0) ? "":"and hotel.no=$text4 ";
			$sql = $sql.$where1.$where2;
			return $this->db->query($sql)->num_rows();//where member_name like '%$text1%'
		}

		public function getrow($no)
		{
			$sql="select jangbu.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name from ((jangbu left join member on jangbu.member_no=member.no) left join room on jangbu.room_no=room.no) left join hotel on room.hotel_no=hotel.no where jangbu.no=$no";
			return $this->db->query($sql)->row(); 
			
			$sql="select jangbu.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name from (jangbu left join member on jangbu.member_no=member.no) left join room on jangbu.room_no=room.no) left join hotel on room.hotel_no=hotel.no where jangbu.no=$no";
            return $this->db->query($sql)->row();              // 쿼리실행, 결과 리턴
		}	


		public function deleterow($no)
		{
			$sql="delete from jangbu where no=$no";
			return $this->db->query($sql);
		}

		public function insertrow($row)
		{
		
			return $this->db->insert("jangbu",$row);
		}

		public function updaterow($row,$no)
		{
			$where = array("no"=>$no);
			return $this->db->update("jangbu",$row,$where);
		}
	}

?>