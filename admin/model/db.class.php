<?php 
	define("DB_DBMS","mysql");                     //数据库平台，如mysql，oracle
	define("DB_HOST","218.244.156.133");                 //数据库服务器地址
	define("DB_PORT","3306");                      //数据库端口
	define("DB_NAME","starcraft");                      //数据库名称
	define("DB_USER","root");                      //数据库用户
	define("DB_PASS","dingdingbingoo");                    //数据库密码
	define("DB_CHARSET","UTF8");                   //数据库编码
    
	class db {
		
		private static $instance = null;
		public $dsn;
		public $user;
		public $pass;
		public $sth;
		public $dbh;
	
		private function __construct(){
			$this->dsn = DB_DBMS.':host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME;  
			$this->dbuser = DB_USER;
			$this->dbpass = DB_PASS;
			$this->connect();
			$this->dbh->query('SET NAMES '.DB_CHARSET);
		}
	
		public static function getInstance(){
			if (self::$instance === null){
				self::$instance = new db();
			}
			return self::$instance;
		}
	
		/**
		 * 连接数据库
		 */
		private function connect(){
			try {
				$this->dbh = new PDO($this->dsn,$this->dbuser,$this->dbpass);
			}
			catch (PDOException $e){
				exit('连接失败:'.$e->getMessage());
			}
		}
		
		/**
		 * 获取数据表里的字段
		 * @param $table
		 */
		public function getFields($table){   
			$this->dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); 
			$this->sth = $this->dbh->query("DESCRIBE $table");
			$this->getPDOError();
			$this->sth->setFetchMode(PDO::FETCH_ASSOC);
			$result = $this->sth->fetchAll();
			$this->sth = null;
			return $result;
		}
		
		/** 
		 * 获取要操作的数据   
		 * @param $table
		 * @param $args
		 */
		private function getCode($table,$args){
			//$allTables = require_once(DOCUMENT_ROOT.'/cache/tables.php');
			//if (!is_array($allTables[$table]))
			//{
			//exit('表名错误或未更新缓存!');
			//}
			//$tables = array_flip($allTables[$table]);
			//$unarr = array_diff_key($args,$tables);
			//if (is_array($unarr))
			//{
			//foreach ($unarr as $k => $v)
			//{
			//unset($args[$k]);
			//}
			//}
			$code = '';
			if (is_array($args)){
				foreach ($args as $k => $v){
//					if ($v == ''){
//						continue;
//					}
					$code .= "`$k`='$v',";
				}
			}
			$code = substr($code,0,-1);
			return $code;
		}
		
		/**
		 * 插入数据 
		 * @param $table
		 * @param $args
		 * @param $debug
		 */
		public function insert($table,$args,$debug = false){
			$sql = "INSERT INTO `$table` SET ";
			$code = $this->getCode($table,$args);
			$sql .= $code;
			if ($debug)echo $sql;
			if ($this->dbh->exec($sql)){
				$this->getPDOError();
				return $this->dbh->lastInsertId();
			}
			return false;
		}
		
		/**
		 * 查询数据并返回结果集
		 * @param $table
		 * @param $condition
		 * @param $sort
		 * @param $limit
		 * @param $field
		 * @param $debug
		 */
		public function fetch($table,$condition = '',$sort = '',$limit = '',$field = '*',$debug = false){
			$sql = "SELECT {$field} FROM `{$table}`";
			if (false !== ($con = $this->getCondition($condition))){
				$sql .= $con;
			}
			if ($sort != ''){
				$sql .= " ORDER BY $sort";
			}
			if ($limit != ''){
				$sql .= " LIMIT $limit";
			}
			if ($debug)echo $sql; 
			$this->dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);   
			$this->sth = $this->dbh->query($sql);
			$this->getPDOError();
			$this->sth->setFetchMode(PDO::FETCH_ASSOC);
			$result = $this->sth->fetchAll();
			$this->sth = null;
			return $result;
		}
		
		/** 
		 * 查询数据并返回一条信息的数组，此数据可直接使用
		 * @param $table
		 * @param $condition
		 * @param $field
		 * @param $debug
		 */
		public function fetchOne($table,$condition = '',$field = '*',$debug = false){
			$sql = "SELECT {$field} FROM `{$table}`";
			if (false !== ($con = $this->getCondition($condition))){
				$sql .= $con;
			}
//            echo $sql; exit;
			if ($debug) echo $sql; 
			$this->dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); 
			$this->sth = $this->dbh->query($sql);
			$this->getPDOError();
			$this->sth->setFetchMode(PDO::FETCH_ASSOC);
			$result = $this->sth->fetch();
			$this->sth = null;
			return $result;
		}
		
		/**  
		 * 获取查询条件
		 * @param $condition
		 */
		public function getCondition($condition=''){
			if ($condition != ''){
				$con = ' WHERE';
				if (is_array($condition)){
					$i = 0;
					foreach ($condition as $k => $v){
						if ($i != 0){
							$con .= " AND $k= '$v'";//$k=中间不能有空格，主要是为了实现"!="
						}else {
							$con .= " $k= '$v'";//$k=中间不能有空格，主要是为了实现"!="
						}
						$i++;
					}
				}elseif (is_string($condition)){
					$con .= " $condition";
				}else {
					return false;
				}
				return $con;
			}
			return false;
		}
		
		/**
		 * 获取记录总数
		 * @param $table
		 * @param $condition
		 * @param $debug
		 */
		public function counts($table,$condition = '',$debug = false){
			$sql = "SELECT COUNT(*) AS COUNT FROM `$table`";
			if (false !== ($con = $this->getCondition($condition))){
				$sql .= $con;
			}
			if ($debug) echo $sql;
			$count = $this->dbh->query($sql);
			$this->getPDOError();
			return $count->fetchColumn();
		}
		
		/** 
		 * 按SQL语句查询并返回结果集
		 * @param $sql
		 * @param $model
		 * @param $debug
		 */
		public function doSql($sql,$model='many',$debug = false){
			if ($debug)echo $sql;  
			$this->dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);  
			$this->sth = $this->dbh->query($sql);
			$this->getPDOError();
			$this->sth->setFetchMode(PDO::FETCH_ASSOC);
			if ($model == 'many'){
				$result = $this->sth->fetchAll();
			}else {
				$result = $this->sth->fetch();
			}
			$this->sth = null;
			return $result;
		}
		
		/**
		 * 修改数据并返回影响行数  
		 * @param $table
		 * @param $args
		 * @param $condition
		 * @param $debug
		 */
		public function update($table,$args,$condition,$debug = false){
			$code = $this->getCode($table,$args);
			$sql = "UPDATE `$table` SET ";
			$sql .= $code;
			if (false !== ($con = $this->getCondition($condition))){
				$sql .= $con;
			}
//            echo $sql;exit;
			if ($debug)echo $sql;
			if (($rows = $this->dbh->exec($sql)) > 0){
				$this->getPDOError();
				return $rows;
			}
			return false;
		}
		   
		/**  
		 * 字段递增
		 * @param $table
		 * @param $condition
		 * @param $field
		 * @param $debug
		 */
		public function increase($table,$condition,$field,$debug=false){
			$sql = "UPDATE `$table` SET $field = $field + 1";
			if (false !== ($con = $this->getCondition($condition))){
				$sql .= $con;
			}
			if ($debug)echo $sql;
			if (($rows = $this->dbh->exec($sql)) > 0){
				$this->getPDOError();
				return $rows;
			}
			return false;
		}
		
		/**   
		 * 删除记录并返回影响行数
		 * @param $table
		 * @param $condition
		 * @param $debug
		 */
		public function del($table,$condition,$debug = false){
			$sql = "DELETE FROM `$table`";
			if (false !== ($con = $this->getCondition($condition))){
				$sql .= $con;
			}else {
				exit('条件错误!');
			}
			if ($debug)echo $sql;
			if (($rows = $this->dbh->exec($sql)) > 0){
				$this->getPDOError();
				return $rows;
			}else {
				return false;
			}
		}
		
		/**   
		 * 执行无返回值的SQL查询 
		 * @param $sql
		 */   
		public function execute($sql){
			$this->dbh->exec($sql);
			$this->getPDOError();
		}
		
		/**   
		 * 捕获PDO错误信息   
		 */   
		private function getPDOError(){
			if ($this->dbh->errorCode() != '00000'){
				$error = $this->dbh->errorInfo();
				exit($error[2]);
			}
		}
		
		/**
		 * 关闭数据连接
		 */
		public function __destruct(){
			$this->dbh = null;
		}
	}
?>