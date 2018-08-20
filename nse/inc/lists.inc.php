<?
class Lists
{

	function Lists($db)
	{
		$this->db = $db;
	}
	
	public function getLists()
	{
			
		$this->db->que = 	"
								select  p.seq , p.region_cd , t.cd_meyng , 
								case
										When p.item_cd = 1010 THEN '왕란'
										When p.item_cd = 1020 THEN '계란(특란)'
										When p.item_cd = 1030 THEN '대란'
										When p.item_cd = 1040 THEN '중란'
										When p.item_cd = 1050 THEN '소란'
										When p.item_cd = 2010 THEN '육계(대)'
										When p.item_cd = 2020 THEN '육계(중)'
										When p.item_cd = 2030 THEN '육계(소)'
										When p.item_cd = 3010 THEN '양돈(박피)'
										When p.item_cd = 3020 THEN '모돈'
										When p.item_cd = 3030 THEN '탕박'																				
										When p.item_cd = 4010 THEN '한우'
										When p.item_cd = 4020 THEN '육우'
										When p.item_cd = 4030 THEN '유우'
										else 'x'
								END as item_cd ,
										p.item_price , p.dDate
								from price_info as p
								LEFT JOIN total_cd_mst as t ON p.region_cd = t.cd
								where item_price > 0 {$this->where}
								order by p.dDate desc 
							";
		$this->db->query();
		$rows = $this->db->getRows();		
		$DATA = $this->getListsInfoList($rows);
		return $DATA;
	}
	
	//<button type='button' class='btn btn-primary btn-xs' onclick=\"modify(".$row["seq"].",'".$row["cd_meyng"]."','".$row["item_cd"]."','".$row["item_price"]."','".$row["dDate"]."')\">수정</button>

	private function getListsInfoList($rows)
	{
		$count = count($rows);
		for($i=0;$i<count($rows);$i++)
		{
			$row = $rows[$i];
			$jsonRow =  json_encode($row);
			$item_price = number_format($row["item_price"]);
			$softwareInfo .= "
								<tr>
								  <td>".$row["seq"]."</th>
								  <td>".$row["cd_meyng"]."</td>
								  <td>".$row["item_cd"]."</td>
								  <td>".$item_price."</td>
								  <td>".$row["dDate"]."</td>
								  <td>					  
								  <button type='button' class='btn btn-success btn-xs' onclick='modify(".$jsonRow.")'>수정</button>
								  <button type='button' class='btn btn-success btn-xs' onclick='remove(".$row["seq"].");'>삭제</button>
								  </td>
								</tr>";	
		}

		return $softwareInfo;
	}

	public function getRegion_cd()
	{
		$this->db->que = "
							SELECT distinct region_cd , t.cd_simple_meyng , t.cd_meyng FROM price_info as p
							LEFT JOIN total_cd_mst as t ON p.region_cd = t.cd
						 ";
		$this->db->query();
		$rows = $this->db->getRows();
		return $rows;
	}

	public function getRegion_cdSelectBoxOptions($selectedSeq="0")
	{
		$DATA = $this->getRegion_cd();
		$count = count($DATA);
		for($i=0; $i<$count; $i++)
		{			
			if($selectedSeq == $DATA[$i]["region_cd"])
			{
				$selected = "selected";
			}
			else
			{
				$selected = "";
			}


			$LIST .= "<option value='". $DATA[$i]["region_cd"]. "' ". $selected. ">". $DATA[$i]["cd_meyng"]."(".$DATA[$i]["cd_simple_meyng"]. ")</option>\n";

		}
		return $LIST;
	}

	public function getItem_cd()
	{
		$this->db->que = "
							SELECT distinct p.item_cd , t.cd_meyng FROM price_info as p
							LEFT JOIN total_cd_mst as t ON p.item_cd = t.cd
						 ";
		$this->db->query();
		$rows = $this->db->getRows();
		return $rows;
	}

	public function getItem_cdSelectBoxOptions($selectedSeq="0")
	{
		$DATA = $this->getItem_cd();
		$count = count($DATA);
		for($i=0; $i<$count; $i++)
		{			
			if($selectedSeq == $DATA[$i]["item_cd"])
			{
				$selected = "selected";
			}
			else
			{
				$selected = "";
			}


			$LIST .= "<option value='". $DATA[$i]["item_cd"]. "' ". $selected. ">". $DATA[$i]["cd_meyng"]. "</option>\n";

		}
		return $LIST;
	}
	
	


	
}
?>