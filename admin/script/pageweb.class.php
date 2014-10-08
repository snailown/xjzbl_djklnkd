<?php
	class page{
		private $showrows;//每页显示行数
		private $nowpage;//当前页数
		private $max;//记录总数
		private $pagemax;//总页数
		private $start;//取数据库记录开始处，limit[start,num]
		private $param;//URL参数->本页需要传递的其它参数
		
		function __construct($max,$showrows,$nowpage,$param=""){
			$this->showrows = $showrows;
			$this->setMax($max);
			$this->setPagemax();
			$this->setNowpage($nowpage);
			$this->setStart();
			$this->param = $param;
		}
		
		function setMax($max){
			$this->max = $max;
		}
		
		function setPagemax(){
			$temp = ceil($this->max/$this->showrows);
			$this->pagemax = $temp > 0 ? $temp : 1;
		}
		
		function setNowpage($nowpage){
			$this->nowpage = ($nowpage == "" || $nowpage > $this->pagemax) ? 1 : $nowpage;
		}
		
		function setStart(){
			if($this->nowpage > 1){
				$this->start = ($this->nowpage - 1) * $this->showrows;
			}else{
				$this->start = 0;
			}
		}
		
		function getStart(){
			return $this->start;
		}
		
		function getShowrows(){
			return $this->showrows;
		}
		
		function showPage(){
			$str = "<table align=\"right\"><tr><td>记录:".$this->max."</td><td>第<span style=\"color:#FF0000;\">".$this->nowpage."</span>/".$this->pagemax."页</td>";
			//if($this->pagemax > 1){
				
				if($this->nowpage > 1){
					$str .= "<td><a href=\"$php_self?pg=" . ($this->nowpage-1) . "&showrows=$this->showrows&$this->param\">上一页</a> | </td>";
				}else{
					$str .= "<td>上一页 | </td>";
				}
				
				/*
					分页显示效果
					总是显示当前页的前五页和后五页
					当前页在最中间 
				*/
				$i_start = 1;
				$i_end = $this->pagemax;
				if($this->pagemax > 11){//总页数大于11页
					if($this->nowpage < 6){//当前页数小于6
						$i_end = 11;
					}else{//当前页数大于等于6
						if($this->nowpage > $this->pagemax - 5){//当前页数大于总页数减5，显示最后11页
							$i_start = $this->pagemax - 10;
							$i_end = $this->pagemax;
						}else{//当前页数小于总页数减5，显示中间的11页，当前页处在最中间
							$i_start = $this->nowpage - 5;
							$i_end = $this->nowpage + 5;
						}
					}
				}
				
				for($i=$i_start;$i<=$i_end;$i++){
					if($this->nowpage != $i)
						$str .= "<td><a href=\"$php_self?pg=$i&showrows=$this->showrows&$this->param\">" . $i . "</a> | </td>";
					else
						$str .= "<td><span style=\"color:#FF0000\">" . $i . "</span> | </td>";
				}

				if($this->nowpage < $this->pagemax){
					$str .= "<td> <a href=\"$php_self?pg=" . ($this->nowpage+1) . "&showrows=$this->showrows&$this->param\">下一页</a></td>";
				}else{
					$str .= "<td> 下一页</td>";
				}
			//}
			$str .= "</tr></table>";
			echo $str;
		}
	}
?>