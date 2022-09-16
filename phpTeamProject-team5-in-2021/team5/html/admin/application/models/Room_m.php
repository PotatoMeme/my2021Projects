<?php
	class Room_m extends CI_Model
	{

        public function getlist($text1,$start,$limit)
        {
			if (!$text1)
				$sql="select room.*, hotel.name as hotel_name from room 
				left join hotel on room.hotel_no=hotel.no 
				order by hotel.name, room.name limit $start,$limit";    // 전체 자료
			else
				$sql="select room.*, hotel.name as hotel_name from room 
				left join hotel on room.hotel_no=hotel.no 
				where room.name like '%$text1%' 
				order by hotel.name, room.name limit $start,$limit";
			
			return $this->db->query($sql)->result();
		}
		public function getlist_users($no,$text1,$start,$limit)
        {
			if (!$text1)
				$sql="select room.*, hotel.name as hotel_name from room 
				left join hotel on room.hotel_no=hotel.no 
				where hotel.member_no = $no
				order by hotel.name, room.name limit $start,$limit";    // 전체 자료
			else
				$sql="select room.*, hotel.name as hotel_name from room 
				left join hotel on room.hotel_no=hotel.no 
				where hotel.member_no = $no
				and room.name like '%$text1%' 
				order by hotel.name, room.name limit $start,$limit";
			
			return $this->db->query($sql)->result();
		}
		
		public function getlist_hotel()
		{
			$sql="select * from hotel order by name";
			return $this->db->query($sql)->result();

		}

		public function getlist_detail()
		{
			$sql="select * from detail";
			return $this->db->query($sql)->result();
		}

		public function rowcount($text1)
		{
			if (!$text1)
				$sql="select * from room";
			else
				$sql="select * from room where name like '%$text1%'" ;
			return $this->db->query($sql)->num_rows();
		}
		public function rowcount_users($no,$text1)
		{
			if (!$text1)
				$sql="select * from room left join hotel on room.hotel_no=hotel.no where hotel.member_no = $no";
			else
				$sql="select * from room left join hotel on room.hotel_no=hotel.no where hotel.member_no = $no
				and name like '%$text1%'" ;
			return $this->db->query($sql)->num_rows();
		}

		public function getrow($no)
		{
			$sql="select room.*, hotel.name as hotel_name, hotel.member_no as member_no from room 
				left join hotel on room.hotel_no=hotel.no 
				where room.no=$no";     // select문 정의
            
			return $this->db->query($sql)->row();              // 쿼리실행, 결과 리턴
		}	

		public function getlist_seldetail($no)
		{
			$sql="select detail_no from select_detail where room_no=$no";

			return $this->db->query($sql)->result_array();
		}

		public function getlist_detailname($no)
		{
			$sql="select detail.name as detail_name from select_detail left join detail on select_detail.detail_no=detail.no where room_no=$no";

			return $this->db->query($sql)->result();
		}

		public function deleterow($no)
		{
			
			$sql="delete room,select_detail,jangbu,select_jangbu_detail,review from room
					left join select_detail on room.no = select_detail.room_no
					left join jangbu on room.no =jangbu.room_no
					left join select_jangbu_detail on jangbu.no = select_jangbu_detail.jangbu_no
					left join review on jangbu.no=review.jangbu_no
					where room.no = $no";
			return $this->db->query($sql);
		}

		public function insertrow($row,$detail) // $detail이 없는 경우 예외처리가 되었는지 확인111
		{
			if(isset($detail)){ //폼에서 옵션이 체크되었을 때
				$this->db->insert("room",$row);
				$last_id=$this->db->insert_id();

				foreach($detail as $selectedDetail)
				{
					$data = array(
					'room_no' => $last_id, 
					'detail_no'=>$selectedDetail
					);
					$this->db->insert("select_detail",$data);
				}
			}else{ //폼에서 선택된 옵션이 없으면 
				return $this->db->insert("room",$row);
			}
		}

		public function updaterow($row,$no,$detail)
		{	/* 
			$row:업데이트해야할 내용
			$no:수정할 row넘버
			$detail:폼에서 선택된 옵션(1차원배열)
			*/
			$sql="select detail_no from select_detail where room_no=$no";
			$sel=$this->db->query($sql)->result_array(); //기존옵션리스트(2차원배열)

			if(isset($detail)||isset($sel))//기존 또는 새로 입력된 옵션이 있는 경우실행 @@@@@@@@이러면 update안됨 0예외처리 다시@@@@@@@
			{
				$where = array("no"=>$no);
				$this->db->update("room",$row,$where);

				foreach($detail as $selectedDetail) //새로 추가해야될 옵션
				{
					$row_array = array(		// selected_detail은 2차원배열 배열이라 비교를 위해 2차원으로 변환
						'detail_no' =>$selectedDetail
					);
					if(in_array($row_array,$sel)==false) // 새로 입력된 옵션 중 없는것을 찾아 insert
					{
						$data = array(
						'room_no' => $no, 
						'detail_no'=>$selectedDetail
						);
						$this->db->insert("select_detail",$data);
					}
				}

				$selLength=count($sel);

				for($i=0; $i<$selLength; $i++){
					if(in_array($sel[$i]["detail_no"],$detail)==false) //기존 옵션과 새로운 옵션을 비교하여 delete
					{
						$oldDetail=$sel[$i]['detail_no'];
						$sql="delete from select_detail where room_no=$no and detail_no=$oldDetail;";
						$this->db->query($sql);
					}
				}

			}else{
				$where = array("no"=>$no);
				return $this->db->update("room",$row,$where);
			}
		}
	}

?>