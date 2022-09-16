<?php
	class AdminQa_m extends CI_Model
	{

        public function getlist($text1,$start,$limit)
        {
			if(!$text1)
				$sql="select adminQA.*, member.name as member_name from adminQA left join member on adminQA.member_no=member.no order by adminQA.depth1 desc,depth2 limit $start,$limit";     // select문 정의
			else
				$sql = "select * from adminQA left join member on adminQA.member_no=member.no where title like '%$text1%' order by adminQA.depth1 desc, depth2 limit $start,$limit";
            return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
		}
		public function getlist_users($text1,$no,$start,$limit)
        {
			
			if(!$text1)
				$sql="select adminQA.*, member.name as member_name from adminQA 
				left join member on adminQA.member_no=member.no 
				where adminQA.member_no = $no 
				order by adminQA.depth1 desc,depth2 limit $start,$limit";     // select문 정의
			else
				$sql = "select *, member.name as member_name from adminQA 
				left join member on adminQA.member_no=member.no 
				where adminQA.member_no = $no
				and title like '%$text1%' 
				order by adminQA.depth1 desc, depth2 limit $start,$limit";
            return $this->db->query($sql)->result();              // 쿼리실행, 결과 리턴
		}

		public function addreply($row,$depth1,$depth2){

			$sql="select depth2 from adminQA where depth1=$depth1 and length(depth2)=length('$depth2')+1 and locate('$depth2',depth2)=1 order by depth2 desc limit 1;";
			$result = $this->db->query($sql)->row_array();
			if(empty($result)){
				$new_depth2=$depth2."A";
			}else{
				$new_depth2= ++$result["depth2"];
			}
			$row["depth2"]=$new_depth2;

			return $this->db->insert("adminQA",$row);
		}

		public function rowcount($text1)
		{
			if(!$text1)
			{
				$sql="select * from adminQA";
			}
			else
			{
				$sql="select * from adminQA where title like '%$text1%'";
			}
			return $this->db->query($sql)->num_rows();
		}

		public function getrow($no)
		{
			$sql="select * from b_gear where no=$no";
			return $this->db->query($sql)->result(); 
		}


		public function deleterow($no)
		{
			$sql="delete from adminQA where no=$no";
			return $this->db->query($sql);
		}

		public function insertrow($row)
		{
			$this->db->insert("adminQA",$row);
			$no = $this->db->insert_id();
			$where = array("no" => $no);
			$depth1= array("depth1" => $no);
			$this->db->update("adminQA",$depth1,$where);
			return $no;
		}

		public function updaterow($row,$no)
		{
			$where = array("no"=>$no);
			return $this->db->update("adminQA",$row,$where);
		}
	}

?>