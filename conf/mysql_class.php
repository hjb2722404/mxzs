<?php
//应用名称：新城市APP服务端
//程序名称：服务端数据库操作类
//作者：bobking
//编写日期：2014-08-27

	class Mysql
	{
		private $db_host; 
		private $db_root;
		private $db_pass;
		private $db_name;
		
		
		function __construct($db_host,$db_root,$db_pass,$db_name){
		
			$this->host = $db_host;
			$this->root = $db_root;
			$this->pass = $db_pass;
			$this->name = $db_name;
			
			$this->connect();
		
		}
		
		
		function connect(){
		
			$this->conn = mysql_connect($this->host,$this->root,$this->pass) or die("数据库连接错误".mysql_error());
			
			mysql_select_db($this->name,$this->conn);
			
			mysql_query("set names utf8");
			
		}
		
		function dbclose(){
		
			mysql_close($this->conn);
			
		}
		
		function query($sql){
		
			return mysql_query($sql);
		
		}
		
		function myArray($result){
		
			return mysql_fetch_array($result);
		
		}
		
		function rows($result){
		
			return mysql_num_rows($result);
		
		}
		
		function af_rows(){
		
			return mysql_affected_rows();
		
		}
		
		function select($tableName,$condition){
		
			return $this->query("SELECT * FROM $tableName $condition");
		
		}
		
		function insert($tableName,$fields,$value){
			
			$this->query("INSERT INTO $tableName $fields VALUES $value");

		}
		
		function update($tableName,$change,$condition){
		
			$this->query("UPDATE $tableName SET $change $condition");
		
		}
		
		function delete($tableName,$condition){
		
			$this->query("DELETE FROM $tableName $condition");
		
		}
	}
	
	$db = new Mysql($app_db_host,$app_db_root,$app_db_pass,$app_db_dbname);

?>