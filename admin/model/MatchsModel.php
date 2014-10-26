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
class MatchsModel extends BaseModel{
    const _table = 'starcraft_matchs';
    
    const _id = 'id';
    const _name = 'name';
    const _group_id = 'group_id';
    const _fixtures_id = 'fixtures_id';
    const _orders = 'orders';
    const _player_one = 'player_one_id';
    const _player_two = 'player_two_id';
    const _team_one = 'team_one_id';
    const _team_two = 'team_two_id';
    
    const _video_id = 'video_id';
    
    private $key = '';
    public function __construct(){
        parent::__construct(self::_table);
    }
    public function getCounts($key){
        if($key != ''){
            $this->key = $key;
            $count_sql = 'select count(id) as num from ' . self::_table . ' where ' . self::_name . ' like \'' . '%' . $this->key . '%\'' ;
            $result = $this->db->doSql($count_sql);
            foreach($result as $temp);
            $this->counts = @intval($temp['num']);     
        }else{
            $this->key = '';
            return $this->getCount();
        }
    }
    public function getList(){
        $limit = ' limit '. $this->page->getStart() . ',' . $this->page->getShowrows();
        if($this->key != ''){
            $sql = 'select * from ' . self::_table . ' where ' . self::_name . ' like \'' . '%' . $this->key . '%\'' . $limit;
        }else{
            $sql = 'select * from ' . self::_table . ' order by id desc ' . $limit;
        }
        return $this->db->doSql($sql);
    }
    public function getAllList(){
        return $this->db->fetch(self::_table, '', '', '', '*' );
    }
    
    public function add($name, $group, $fixtures, $orders, $palyer1, $palyer2, $team1, $team2, $video){
        return $this->db->insert(self::_table, 
            array(
                self::_name => $name,
                self::_group_id => $group, 
                self::_fixtures_id => $fixtures,
                self::_orders => $orders,
                self::_player_one => $palyer1, 
                self::_player_two => $palyer2,
                self::_team_one => $team1,
                self::_team_two => $team2, 
                self::_video_id => $video,
            )
                );
    }
    public function update($id, $name, $group, $fixtures, $orders, $palyer1, $palyer2, $team1, $team2, $video){
        $id = intval($id);
        if($id == 0){
            return false;
        }
        $data = array(
            self::_name => $name,
            self::_group_id => $group, 
            self::_fixtures_id => $fixtures,
            self::_orders => $orders,
            self::_player_one => $palyer1, 
            self::_player_two => $palyer2,
            self::_team_one => $team1,
            self::_team_two => $team2, 
            self::_video_id => $video,
        );
        return $this->db->update(self::_table, $data, array(self::_id => $id));
    }
    
    public function get($id){
        $id = intval($id);
        if($id == 0){
            return null;
        }
        return $this->db->fetchOne(self::_table, array(self::_id => $id));
    }
    public function getMatchsName($id){
        $fixtures = $this->get($id);
        if($fixtures != null){
            return $fixtures[self::_name];
        }else{
            return '--';
        }
    }
    
    public function getPageList($pid, $fid){
        $pid = intval($pid);
        $fid = intval($fid);
        if($pid == 0 || $fid == 0){
            return null;
        }
        $sql = 'select a.' . self::_name . ' as match_name, ' . 'a.' . self::_player_one . ', ' .  'a.' . self::_player_two 
                . ', b.' .VideoModel::_name. ' as video_name, b.' . VideoModel::_url . ', b.' . VideoModel::_count 
                . ' from ' . self::_table . ' as a, ' . VideoModel::_table . ' as b '
                . ' where (a.' . self::_player_one . ' = ' . $pid . ' or a.' . self::_player_two . ' = ' . $pid . ')'
                .' and a.' . self::_fixtures_id . ' = ' . $fid . ' and a.' . self::_video_id . ' = b.' . VideoModel::_id
                . ' order by a.' . self::_id . ' asc ';
        return $this->db->doSql($sql, 'many');
    }
    
    public function getPlayerPageList($pid, $page=0, $start=0){
        $pid = intval($pid);
        $page = intval($page);
        $start = intval($start);
        if($pid == 0){
            return null;
        }
        $size = 20;
        $limit = ' limit ' . ($page*$size) . ', ' . $size;
        $sql = 'select b.' .FixturesModel::_name. ', b.' . FixturesModel::_id 
                . ' from ' . self::_table . ' as a, ' . FixturesModel::_table . ' as b '
                . ' where (a.' . self::_player_one . ' = ' . $pid . ' or a.' . self::_player_two . ' = ' . $pid . ')'
                .' and a.' . self::_fixtures_id . ' = b.' . FixturesModel::_id
                . ' group by a.' . self::_fixtures_id
                . ' order by a.' . FixturesModel::_id . ' asc '
                .$limit;
        return $this->db->doSql($sql, 'many');
    }
}
