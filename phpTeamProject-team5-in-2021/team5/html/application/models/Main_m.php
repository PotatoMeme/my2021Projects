<?php
	class Main_m extends CI_Model
	{
		public function getlist_hotel($start,$limit)
        {
			$sql="select hotel.*, area.name as area_name from hotel left join area on hotel.area_no=area.no order by hotel.name limit $start,$limit";
            return $this->db->query($sql)->result();    // 쿼리실행, 결과 리턴
        }

		public function getlist_room($start,$limit)
        {
			$sql="select room.*, area.name as area_name, hotel.name as hotel_name from (room left join hotel on room.hotel_no=hotel.no) left join area on hotel.area_no=area.no order by hotel.name limit $start,$limit";
            return $this->db->query($sql)->result();    // 쿼리실행, 결과 리턴
        }

		public function rowcount_hotel()
		{
			$sql="select * from hotel";
			return $this->db->query($sql)->num_rows();
		}

		public function rowcount_room()
		{
			$sql="select * from hotel";
			return $this->db->query($sql)->num_rows();
		}

		public function rowcount_area()
		{
			$sql="select * from hotel";
			return $this->db->query($sql)->num_rows();
		}

		public function rowcount_jangbu()
		{
			$sql="select * from jangbu";
			return $this->db->query($sql)->num_rows();
		}
	}

?>
