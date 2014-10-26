<?php
//echo 'usermodel';exit;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'BaseModel.php';
/**
 * Description of UserModel
 *
 * @author koudejian
 */
class PlayerModel extends BaseModel{
    const _table = 'starcraft_players';
    
    const _id = 'id';
    const _name = 'name';
    const _avatar = 'avatar';
    const _game_id = 'game_id';
    const _nick = 'nick';
    const _race = 'race_id';
    const _team = 'team_id';
    const _preteam = 'previous_team';
    
    private $key = '';
    public function __construct(){
        parent::__construct(self::_table);
    }
    public function getCounts($key){
        if($key != ''){
            $this->key = $key;
            $count_sql = 'select count(id) as num from ' . self::_table . ' where ' 
                    . self::_name . ' like \'' . '%' . $this->key . '%\'' 
                    . ' or ' . self::_game_id . ' like \'' . '%' . $this->key . '%\''
                    . ' or ' . self::_nick . ' like \'' . '%' . $this->key . '%\''
                    ;
            $result = $this->db->doSql($count_sql);
            foreach($result as $temp);
            $this->counts = @intval($temp['num']);     
        }else{
            $this->key = '';
            return $this->getCount();
        }
    }
    public function getList($rid = 0){
        $limit = ' limit '. $this->page->getStart() . ',' . $this->page->getShowrows();
        if($this->key != ''){
            $sql = 'select * from ' . self::_table . ' where ' 
                    . self::_name . ' like \'' . '%' . $this->key . '%\'' 
                    . ' or ' . self::_game_id . ' like \'' . '%' . $this->key . '%\''
                    . ' or ' . self::_nick . ' like \'' . '%' . $this->key . '%\''
                    . ' order by id desc ' . $limit;
        }else{
            if($rid == 0){
                $sql = 'select * from ' . self::_table . ' order by id desc ' . $limit;
            }else{
                $sql = 'select * from ' . self::_table . ' where ' . self::_race . '= \'' . $rid . '\' order by id desc ' . $limit;
            }
            
        }
        return $this->db->doSql($sql);
    }
    public function getAllList(){
        return $this->db->fetch(self::_table, '', '', '', '*');
    }
    
    public function add($name, $avatar, $gameid, $nick, $raceid, $teamid, $preteamid){
        return $this->db->insert(self::_table, 
                array(
                    self::_name => $name, 
                    self::_avatar => $avatar, 
                    self::_game_id => $gameid,
                    self::_nick => $nick, 
                    self::_race => $raceid, 
                    self::_team => $teamid,
                    self::_preteam => $preteamid,
                ));
    }
    
    public function update($id, $name, $avatar, $gameid, $nick, $raceid, $teamid, $preteamid){
        $id = intval($id);
        if($id == 0){
            return false;
        }
        $data = array(
            self::_name => $name, 
            self::_avatar => $avatar, 
            self::_game_id => $gameid,
            self::_nick => $nick, 
            self::_race => $raceid, 
            self::_team => $teamid,
            self::_preteam => $preteamid,
        );
       
        return $this->db->update(self::_table, $data, array(self::_id => $id));
    }
    //修改战队
    public function editTeam($tid, $pid){
        $pid = intval($pid);
        $tid = intval($tid);
        if($pid > 0 && $tid > 0){
            return $this->db->update(self::_table, array(self::_team => $tid), array(self::_id => $pid));
        }
        return false;
    }
    public function get($id){
        $id = intval($id);
        if($id == 0){
            return null;
        }
        return $this->db->fetchOne(self::_table, array(self::_id => $id));
    }
    public function getPlayerName($id, $url = null){
        $player = $this->get($id);
        if($player != null){
            if($url != null){
                return '<a href="'. $url . '?id='. $player[self::_id] .'">' . $player[self::_name]. '</a>';
            }else{
                return $player[self::_name];
            }
        }else{
            return '--';
        }
    }
    
    public function getTeamGroup($tid){
//        return array('1','2', '3');
        $tid = intval($tid);
        $result = array();
        if($tid > 0){
            $arr = $this->db->fetch(self::_table, array(self::_team => $tid), '', '', 'id');
            $i = 0;
            foreach($arr as $temp){
                if($temp['id'] > 0){
                    $result[$i++] = $temp['id'];
                }
            }
        }
        return $result;
    }
    
    public function getByTeam($tid){
        $tid = intval($tid);
        $result = '';
        if($tid > 0){
            $arr = $this->db->fetch(self::_table, array(self::_team => $tid), '', '', 'id');
            foreach($arr as $temp){
                if($temp['id'] > 0){
                    $result .= ',' . $temp['id'];
                }
            }
        }
        $result .= ',';
        return $result;
    }
    public function getPlayersNameByTeam($tid, $url = null){
        $tid = intval($tid);
        $result = '';
        if($tid > 0){
            $arr = $this->db->fetch(self::_table, array(self::_team => $tid), '', '', 'id,name');
            foreach($arr as $temp){
                if($temp['name'] != ''){
                    if($url != null){
                        $result .= '<a href="'. $url . '?id='. $temp['id'] .'">' . $temp['name']. '</a>'  . ',';
                    }else{
                        $result .= $temp['name'] . ',';
                    }
                }
           }
        }
        return $result;
    }
    //修改战队
    public function editTeams($tid, $players){
        $tid = intval($tid);
        $old = $this->getTeamGroup($tid);
        $new = explode(',', $players);
        //change
        $count = count($new);
        if($count > 0){
            for($i = 0; $i < $count; $i++){
                $this->editTeam($tid, $new[$i]);
            }
        }
        //remove
        $counts = count($old);
        if($counts > 0){
            for($i = 0; $i < $counts; $i++){
                $temp_oldid = intval($old[$i]);
                if($temp_oldid > 0){
                    $flag = true;
                    for($j = 0; $j < $count; $j++){
                        $temp_id = intval($new[$j]);
                        if( $temp_id > 0 && $temp_id == $temp_oldid){
                            $flag = false;
                        }
                    }
                    if($flag){
                        $this->db->update(self::_table, array(self::_team => 0), array(self::_id => $temp_oldid));
                    }
                } 
            }
        }
        
        return false;
    }
    
    public function getPageList($lid, $page=0, $start=0){
        $lid = intval($lid);
        $page = intval($page);
        $start = intval($start);
        if($lid == 0){
            return null;
        }
        $size = 12;
        $limit = ($page*$size) . ', ' . $size;
        $condition = self::_race . ' = ' . $lid;
        if($start > 0){
            $condition .= ' and ' . self::_id . ' < ' . $start;
        }
        $order = self::_id . ' desc ';
        $field = self::_id . ', ' . self::_avatar . ', ' . self::_game_id . ', ' . self:: _nick;
        return $this->db->fetch(self::_table, $condition, $order, $limit, $field);
    }
}
