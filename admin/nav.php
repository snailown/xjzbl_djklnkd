<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<nav class='' id='main-nav'>
<div class='navigation'>
<div class='search'>
    <form accept-charset="UTF-8" action="search_results.html" method="get" /><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
        <div class='search-wrapper'>
            <input autocomplete="off" class="search-query" id="q" name="q" placeholder="Search..." type="text" value="" />
            <button class="btn btn-link icon-search" name="button" type="submit"></button>
        </div>
    </form>
</div>
<ul class='nav nav-stacked'>
<li class='active'>
    <a href='index.php'>
        <i class='icon-dashboard'></i>
        <span>Dashboard</span>
    </a>
</li>
<li class=''>
    <a class='dropdown-collapse' href='#'>
        <i class='icon-edit'></i>
        <span>视频管理</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li class=''>
            <a href='game_add_video.php'>
                <i class='icon-caret-right'></i>
                <span>添加视频</span>
            </a>
        </li>
        <li class=''>
            <a href='game_video_list.php'>
                <i class='icon-caret-right'></i>
                <span>视频列表</span>
            </a>
        </li>
        <li class=''>
            <a href='game_item.php'>
                <i class='icon-caret-right'></i>
                <span>栏目</span>
            </a>
        </li>
        <li class=''>
            <a href='game_time_item.php'>
                <i class='icon-caret-right'></i>
                <span>年度栏目</span>
            </a>
        </li>
        <li class=''>
            <a href='game_pick.php'>
                <i class='icon-caret-right'></i>
                <span>采集</span>
            </a>
        </li>
    </ul>
</li>
<li>
    <a class='dropdown-collapse ' href='#'>
        <i class='icon-tint'></i>
        <span>战队管理</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li class=''>
            <a href='game_add_player.php'>
                <i class='icon-caret-right'></i>
                <span>添加选手</span>
            </a>
        </li>
        <li class=''>
            <a href='game_player_list.php'>
                <i class='icon-caret-right'></i>
                <span>选手列表</span>
            </a>
        </li>
        <li class=''>
            <a href='game_add_team.php'>
                <i class='icon-caret-right'></i>
                <span>添加战队</span>
            </a>
        </li>
        <li class=''>
            <a href='game_team_list.php'>
                <i class='icon-caret-right'></i>
                <span>战队列表</span>
            </a>
        </li>
    </ul>
</li>

<li>
    <a class='dropdown-collapse ' href='#'>
        <i class='icon-cog'></i>
        <span>其他设置</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li class=''>
            <a href='game_race.php'>
                <i class='icon-caret-right'></i>
                <span>游戏种族设置</span>
            </a>
        </li>
        <li class=''>
            <a href='game_map.php'>
                <i class='icon-caret-right'></i>
                <span>游戏地图设置</span>
            </a>
        </li>
        <li class=''>
            <a href='game_descant.php'>
                <i class='icon-caret-right'></i>
                <span>解说设置</span>
            </a>
        </li>
        <li class=''>
            <a href='game_coach.php'>
                <i class='icon-caret-right'></i>
                <span>教练设置</span>
            </a>
        </li>
        <li class=''>
            <a href='game_country.php'>
                <i class='icon-caret-right'></i>
                <span>国家设置</span>
            </a>
        </li>
    </ul>
</li>

</ul>
</div>
</nav>