<?
require_once "computer.inc.php"; 

class TotalSearch extends Computer
{
	
	function TotalSearch($db)
	{
		$this->db = $db;
	}

	public function getTotalSearch()
	{
		// $this->db->que = "  SELECT c.seq , c.departmentName , c.employeeName , c.networkName ,
							// c.locationGubun , c.locationName , c.os , c.cpu ,c.memory , c.storeType ,c.ip ,
							// s.productName , s.product , s.code
							// FROM computer as c
							// LEFT JOIN software as s ON c.seq = s.owner
							// where type in ('데스크탑','노트북') AND s.amount = 1".$this->where;
		$this->db->que = " select * from totalSearch_view WHERE amount <= 1 ORDER BY departmentName ";				
		$this->db->query();
		$rows = $this->db->getRows();
		$DATA = $this->checkSoftwareCount($rows);
		return $DATA;
	}
	
	private function getTotalSearchList($row)
	{
		$DATA .= "
				<tr>
				  <td>".$row["seq"]."</td>
				  <td>".$row["locationGubun"]."</td>
				  <td>".$row["departmentName"]."</td>
				  <td>".$row["employeeName"]."</td>
				  <td>".$row["locationName"]."</td>
				  <td>".$row["os"]."</td>
				  <td>".$row["cpu"]."</td>
				  <td>".$row["memory"]."</td>
				  <td>".$row["storeType"]."</td>
				  <td>".$row["ip"]."</td>
				  <td>".$this->product."</td>
				  <td>".$this->code."</td>
				</tr>";	
		
		$this->product = "";
		$this->code = "";
		return $DATA;
	}

	private function checkSoftwareCount($rows)
	{
		// lib::Plog($rows[0]." ".$rows[1]);
		
		for($i=0;$i<count($rows);$i++)
		{
			$row = $rows[$i];
			$rowPlus = $rows[$i+1];
			$this->owner = $row["seq"];
			$this->multipleSoftwareCheck(); // 복수인 소프트웨어 확인
			
			if($seq == $row["seq"])
			{
				$this->productAndCodeStore($row);				
			}
			else
			{
				if($row["seq"] == $rowPlus["seq"]) // 소프트웨어가 하나이면 뿌려도 되는데 다음거를 비교해서 똑같은게 하나더 있으면 참아야함
				{
					$this->productAndCodeStore($row);
					continue;
				}
				else
				{
					$this->productAndCodeStore($row);
					$DATA .= $this->getTotalSearchList($row);
					$seq = $row["seq"];
				}

			}
		}
		return $DATA;
	}
	
	private function productAndCodeStore($row)
	{
		$this->product .= $row["product"]."<br>";
		$this->code .= $row["code"]."<br>";	
	}
	
	private function multipleSoftwareCheck() // 한번씩만 실행 해야됨
	{
		if($this->diffOnwer == $this->owner)
		{
			return;
		}
		else
		{	
			$this->diffOnwer = $this->owner;	
			$this->db->que = "SELECT product , code , owner FROM software WHERE amount > 1 and owner like '%".$this->owner."%' ";
			$this->db->query();
			$rows = $this->db->getRows();
			
			if(mysql_affected_rows() > 0)
			{
				$this->makeExplodeOfOwner($rows);
			}
			
			
		}
	}
	
	private function makeExplodeOfOwner($rows)
	{
		for($i=0;$i<count($rows);$i++)
		{
			$row = $rows[$i];
			$arrayOwner = explode(",",$row["owner"]);
			if($this->checkRealOwner($arrayOwner))
			{
				$this->productAndCodeStore($row);
			}
			else
			{
				continue;
			}
		}	
	}
	
	public function checkRealOwner($DATA)
	{
		$count = count($DATA);
		for($i=0;$i<$count;$i++)
		{
			if($DATA[$i] == $this->owner)
			{
				return true;		
			}
			else
			{
				continue;
			}
		}
	}
	
}
?>