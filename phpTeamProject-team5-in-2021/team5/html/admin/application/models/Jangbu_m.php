<?php
	class Jangbu_m extends CI_Model
	{

        public function getlist($text1,$text2,$text3,$text4,$start,$limit)
        {
			
			$sql="select jangbu.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name, hotel.area_no, hotel.no as hotel_no from ((jangbu left join member on jangbu.member_no=member.no)
				left join room on jangbu.room_no=room.no)
				left join hotel on room.hotel_no=hotel.no 
				where jangbu.exitday>='$text1' and jangbu.inday <= '$text2' ";
			$where1= ($text3 == 0) ? "":"and hotel.area_no=$text3 ";
			$where2= ($text4 == 0) ? "":"and hotel.no=$text4 ";
			$sql = $sql.$where1.$where2."order by jangbu.inday limit $start,$limit";

			return $this->db->query($sql)->result();
		}
		public function getlist_users($no,$text1,$text2,$text3,$text4,$start,$limit)
        {
			
			$sql="select jangbu.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name, hotel.area_no, hotel.no as hotel_no from ((jangbu left join member on jangbu.member_no=member.no)
				left join room on jangbu.room_no=room.no)
				left join hotel on room.hotel_no=hotel.no
				where hotel.member_no = $no
				and jangbu.exitday>='$text1' and jangbu.inday <= '$text2' ";
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
		public function rowcount_users($no,$text1,$text2,$text3,$text4)
		{
			$sql="select * from (jangbu left join room on jangbu.room_no=room.no) left join hotel on room.hotel_no=hotel.no 
			where hotel.member_no = $no
			and jangbu.exitday>='$text1' and jangbu.inday <= '$text2' ";
			$where1= ($text3 == 0) ? "":"and hotel.area_no=$text3 ";
			$where2= ($text4 == 0) ? "":"and hotel.no=$text4 ";
			$sql = $sql.$where1.$where2;
			return $this->db->query($sql)->num_rows();//where member_name like '%$text1%'
		}
		public function getrow($no)
		{
			$sql="select jangbu.*, member.name as member_name, room.name as room_name, room.price as room_price, hotel.name as hotel_name,hotel.member_no as member_no  from ((jangbu left join member on jangbu.member_no=member.no) left join room on jangbu.room_no=room.no) left join hotel on room.hotel_no=hotel.no where jangbu.no=$no";
			return $this->db->query($sql)->row(); 
			
			/*$sql="select jangbu.*, member.name as member_name, room.name as room_name, hotel.name as hotel_name from (jangbu left join member on jangbu.member_no=member.no) left join room on jangbu.room_no=room.no) left join hotel on room.hotel_no=hotel.no where jangbu.no=$no";
            return $this->db->query($sql)->row();*/              // ????????????, ?????? ??????
		}	
		public function getlistDetail($no)
		{
			$sql="select select_jangbu_detail.*, detail.name as detail_name ,detail.price as detail_price 
			from select_jangbu_detail 
			left join detail on select_jangbu_detail.detail_no=detail.no 
			where select_jangbu_detail.jangbu_no=$no";
			return $this->db->query($sql)->result(); 
			
		}	
		public function comparerow($room_no,$inday,$exitday)
		{
			$sql="select * from jangbu 
				where room_no = $room_no
				and inday < '$exitday'
				and exitday > '$inday'";
			return $this->db->query($sql)->num_rows();
		}

		public function deleterow($no)
		{
			$sql="delete jangbu,select_jangbu_detail,review from jangbu 
			left join select_jangbu_detail on jangbu.no = select_jangbu_detail.jangbu_no
			left join review on jangbu.no=review.jangbu_no
			where jangbu.no = $no";
			return $this->db->query($sql);
		}

		/*public function insertrow($row)
		{
		
			return $this->db->insert("jangbu",$row);
		}*/
		//-----------------------------------------
		public function insertrow($row,$detail) // $detail??? ?????? ?????? ??????????????? ???????????? ??????111
		{
			$detailArr = explode("_", $detail);// detail ?????? start_no1_no2
			if(count($detailArr)>1){ //????????? ????????? ????????? 1??? ????????????
				$this->db->insert("jangbu",$row);
				$last_id=$this->db->insert_id();

				for($i=1;$i<count($detailArr);$i=$i+1){
					$data = array(
					'jangbu_no' => $last_id, 
					'detail_no'=>intval($detailArr[$i])
					);
					$this->db->insert("select_jangbu_detail",$data);
				}
			} else { //????????? ????????? ????????? ????????? 
				
				return $this->db->insert("jangbu",$row);
			}
		}

		/*public function updaterow($row,$no)
		{
			$where = array("no"=>$no);
			return $this->db->update("jangbu",$row,$where);
		}*/
		//--------------------------
		public function updaterow($row,$no,$room_no,$detail)
		{	/* 
			$row:????????????????????? ??????
			$no:????????? row??????
			$detail:????????? ????????? ??????(1????????????)
			*/
			
			$sql="select detail_no from select_detail where room_no = $room_no";
			$sel=$this->db->query($sql)->result();
			$detailArr = explode("_", $detail);
			//?????? ???????????? ????????? ????????? ???????????? ????????? ????????? ??????
			$sql="select detail_no from select_jangbu_detail where jangbu_no=$no;";
			$sel1=$this->db->query($sql)->result();			
			foreach($sel1 as $row2){
				$a = false;
				foreach($sel as $row3){
					if($row2->detail_no ==  $row3->detail_no){ $a = true;}
				}
				if($a == false){
					$sql="delete from select_jangbu_detail where jangbu_no=$no and detail_no=$row2->detail_no;";
					$this->db->query($sql);
				}
			}
			//????????? ?????? ?????? ??????
			foreach($sel as $row1){
				$a = false;
				$b = false;
				for($i=1;$i<count($detailArr);$i=$i+1){
					if($detailArr[$i] == $row1->detail_no ){ $a = true; }
				}
				$sql="select detail_no from select_jangbu_detail where jangbu_no=$no and detail_no=$row1->detail_no;";
				$num=$this->db->query($sql)->num_rows();
				if($num > 0){$b = true;}
				if($a == true and $b == false){
					$data = array(
						'jangbu_no' => $no, 
						'detail_no'=>$row1->detail_no
					);
					$this->db->insert("select_jangbu_detail",$data);
				}
				if($a == false and $b == true){
					$sql="delete from select_jangbu_detail where jangbu_no=$no and detail_no=$row1->detail_no;";
					$this->db->query($sql);
				}
			}
			$where = array("no"=>$no);
			return $this->db->update("jangbu",$row,$where);
	
		}
	}

?>