<?
class Teho 

{
	 var $son = "아들";
	
	 function Teho($db)
	 {
		 $this->db = $db;
	 }

	 function getDBTeho()
	{
		$this->db->que = " select kcfeed from teho ";				
		$this->db->query();
		$teho = $this->db->getOne();
		return $teho;
	}
	
	function hiTeho()
	{
		return "하이!";
	}
	
	function echoHiTeho()
	{
		echo "바로출력!";
	}
	
	function getSon() 
	{
		return $this->son;
	}
	
	function kcfeed() 
	{
		return "kcfeed 통은 누구??".$this->tong;
	}

	function DFDF()
	{
		//$this->db->que = " select * from computer where employeeName = '서태호' ";	//
		$this->db->que = "select * from dbkcfeed.teho ";
		$this->db->query();
		$DATA = $this->db->getRow();
		//var_dump($DATA["kcfeed"]);
		return $DATA;
		//return $teho;
	}
}
?>