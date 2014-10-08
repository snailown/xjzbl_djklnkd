<?php
	class page{
		private $showrows;//每页显示行数
		private $nowpage;//当前页数
		private $max;//记录总数
		private $pagemax;//总页数
		private $start;//取数据库记录开始处，limit[start,num]
		private $param;//URL参数->本页需要传递的其它参数
		
        private $color_title = '#cccccc';
        
        private $current = 0;
        private $color = array(
            'dddddd', 
            'eeeeee', 
//            'orange', 
//            'red', 
//            'yellow', 
//            'green'
            );
        
        
//		function __construct($max,$showrows,$nowpage,$param=""){
//			$this->showrows = $showrows;
//			$this->setMax($max);
//			$this->setPagemax();
//			$this->setNowpage($nowpage);
//			$this->setStart();
//			$this->param = $param;
//		}
        /**
         * 
         * @param type $max  总行数
         * @param type $request  $_REQUEST
         * @param type $param   其他参数
         */
		function __construct($max, $request, $param){
            @$pg = intval($request['pg']);                 //当前页数
            @$showrows = intval($request['showrows']);     //当前每页显示行数
            $show = ($showrows > 0) ? $showrows : 30;//如没有当前显示行数则默认成配置文件中设置的行数
            
			$this->showrows = $show;
			$this->setMax($max);
			$this->setPagemax();
			$this->setNowpage($pg);
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
        function getNowPage(){
            return $this->nowpage;
        }
		function getShowrows(){
			return $this->showrows;
		}
		
		function showPage(){
			$str = "<table><tr><form action=\"$php_self?$this->param\" method=\"post\">";
			$str .= "<td>每页显示<input type=\"text\" name=\"showrows\" size=\"3\" maxlength=\"3\" value=\"" . $this->showrows . "\" style=\"width:50px;height:15px;display:inline;color:#000000;\" title=\"输入显示行数并回车,最少显示1行,最多999行\" />行</td>";
			$str .= "<td>共<font color=\"#FF0000\">" . $this->max . "</font>条</td>";
			$str .= "<td>第<font color=\"#FF0000\">" . $this->nowpage . "/" . $this->pagemax . "</font>页</td>";
			//if($this->pagemax > 1){
				
				if($this->nowpage > 1){
					$str .= "<td><a href=\"$php_self?pg=1&showrows=$this->showrows&$this->param\">首页</a></td>";
					$str .= "<td><a href=\"$php_self?pg=" . ($this->nowpage-1) . "&showrows=$this->showrows&$this->param\">上一页</a></td>";
				}else{
					$str .= "<td>首页</td>";
					$str .= "<td>上一页</td>";
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
						$str .= "<td><a href=\"$php_self?pg=$i&showrows=$this->showrows&$this->param\">" . $i . "</a></td>";
					else
						$str .= "<td><span style=\"color:#FF0000\">" . $i . "</span></td>";
				}

				if($this->nowpage < $this->pagemax){
					$str .= "<td><a href=\"$php_self?pg=" . ($this->nowpage+1) . "&showrows=$this->showrows&$this->param\">下一页</a></td>";
					$str .= "<td><a href=\"$php_self?pg=$this->pagemax&showrows=$this->showrows&$this->param\">末页</a></td>";
				}else{
					$str .= "<td>下一页</td>";
					$str .= "<td>末页</td>";
				}
			//}
			$str .= "</form></tr></table>";
			echo $str;
		}
        /**
         * 自动切换颜色
         * @return color
         */
        function getColor(){
            $colors = $this->color[$this->current++];
            $this->current %= count($this->color);
            return $colors;
        }
        function getTitleColor(){
            return $this->color_title;
        }
        function getParams(){
            return "pg=$this->nowpage&showrows=$this->showrows&$this->param";
        }
	}
?>