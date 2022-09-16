<?php
	class Hotel_m extends CI_Model
	{
		public function getlist_hotel($text1,$start,$limit)
        {
           if (!$text1)
			$sql="select hotel.*  from hotel order by hotel.name limit $start,$limit";
			else
			$sql="select hotel.*  from hotel where hotel.name like '%$text1%' order by hotel.name limit $start,$limit";
            return $this->db->query($sql)->result();    // ��������, ��� ����
        }


		function getrow($no)
		{
			$sql="select hotel.*, area.name as area_name
              from hotel left join area on hotel.area_no=area.no 
              where hotel.no=$no";
			return $this->db->query($sql)->row();
		}
		function getrow_room($no)
		{
			$sql="select room.*, hotel.name as hotel_name from room 
			left join hotel on room.hotel_no =hotel.no
              where room.no=$no";
			return $this->db->query($sql)->row();
		
		}
		public function getlist_roomdetail($no)
		{
			$sql="select select_detail.* , detail.* from select_detail
			left join detail on select_detail.detail_no = detail.no
			where select_detail.room_no = $no";
			return $this->db->query($sql)->result();
		}
		public function getlist_detail()
		{
			$sql="select * from detail";
			return $this->db->query($sql)->result();
		}

		public function getlist_area()
		{
			$sql="select * from area";
			return $this->db->query($sql)->result();
		}

		public function getlist_room()
		{
			$sql="select * from room;";
			return $this->db->query($sql)->result();
		}

		public function rowcount($text1)
		{
			if(!$text1)
			{
				$sql="select * from hotel";
			}
			else
			{
				$sql="select * from hotel where name like '%$text1%'";
			}
			return $this->db->query($sql)->num_rows();
		}
		
		public function insertrow($row,$detail) // $detail�� ���� ��� ����ó���� �Ǿ����� Ȯ��111
		{
			$detailArr = explode("_", $detail);// detail ��� start_no1_no2
			if(count($detailArr)>1){ //������ ������ �ɼ��� 1�� �̻��϶�
				$this->db->insert("jangbu",$row);
				$last_id=$this->db->insert_id();

				for($i=1;$i<count($detailArr);$i=$i+1){
					$data = array(
					'jangbu_no' => $last_id, 
					'detail_no'=>intval($detailArr[$i])
					);
					$this->db->insert("select_jangbu_detail",$data);
				}
			} else { //������ ���õ� �ɼ��� ������ 
				
				return $this->db->insert("jangbu",$row);
			}
		}
    }
?>