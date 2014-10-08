<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'model/UserModel.php';
?>

<section id='content'>
<div class='container-fluid'>
<div class='row-fluid' id='content-wrapper'>
<div class='span12'>
    
<div class='page-header'>
    <h1 class='pull-left'>
        <i class='icon-dashboard'></i>
        <span>Dashboard</span>
    </h1>
    <div class='pull-right'>
        <div class='btn-group'>
            <a href="#" class="btn btn-white hidden-phone">Last month</a>
            <a href="#" class="btn btn-white">Last week</a>
            <a href="#" class="btn btn-white ">Today</a>
            <a href="#" class="btn btn-white" id="daterange"><i class='icon-calendar'></i>
                <span class='hidden-phone'>Custom</span>
                <b class='caret'></b>
            </a>
        </div>
    </div>
</div>
<div class='alert alert-info'>
    <a class='close' data-dismiss='alert' href='#'>&times;</a>
    Welcome to
    <strong>Flatty (v2)</strong>
    - I hope you'll like it. Don't forget - you can change theme color in top right corner
    <i class='icon-adjust'></i>
    if you want.
</div>
<div class='row-fluid'>
    <div class='span12 box box-transparent'>
        <div class='row-fluid'>
            <div class='span2 box-quick-link blue-background'>
                <a href='/orders.html'>
                    <div class='header'>
                        <div class='icon-comments'></div>
                    </div>
                    <div class='content'>Comments</div>
                </a>
            </div>
            <div class='span2 box-quick-link green-background'>
                <a href='#'>
                    <div class='header'>
                        <div class='icon-star'></div>
                    </div>
                    <div class='content'>Veeeery long title of this quick link</div>
                </a>
            </div>
            <div class='span2 box-quick-link orange-background'>
                <a href='#'>
                    <div class='header'>
                        <div class='icon-magic'></div>
                    </div>
                    <div class='content'>Magic</div>
                </a>
            </div>
            <div class='span2 box-quick-link purple-background'>
                <a href='#'>
                    <div class='header'>
                        <div class='icon-eye-open'></div>
                    </div>
                    <div class='content'>Show</div>
                </a>
            </div>
            <div class='span2 box-quick-link red-background'>
                <a href='#'>
                    <div class='header'>
                        <div class='icon-inbox'></div>
                    </div>
                    <div class='content'>Orders</div>
                </a>
            </div>
            <div class='span2 box-quick-link muted-background'>
                <a href='#'>
                    <div class='header'>
                        <div class='icon-refresh'></div>
                    </div>
                    <div class='content'>Spinning</div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class='row-fluid'>
    <div class='span6 box'>
        <div class='box-header'>
            <div class='title'>
                <i class='icon-inbox'></i>
                Orders
            </div>
            <div class='actions'>
                <a href="#" class="btn box-remove btn-mini btn-link"><i class='icon-remove'></i>
                </a>
                <a href="#" class="btn box-collapse btn-mini btn-link"><i></i>
                </a>
            </div>
        </div>
        <div class='box-content'>
            <div id='stats-chart1'></div>
        </div>
    </div>
    <div class='span6 box'>
        <div class='box-header'>
            <div class='title'>
                <i class='icon-group'></i>
                Users
            </div>
            <div class='actions'>
                <a href="#" class="btn box-remove btn-mini btn-link"><i class='icon-remove'></i>
                </a>
                <a href="#" class="btn box-collapse btn-mini btn-link"><i></i>
                </a>
            </div>
        </div>
        <div class='box-content'>
            <div id='stats-chart2'></div>
        </div>
    </div>
</div>
<hr class='hr-drouble' />
<div class='row-fluid'>
    <div class='span6 box'>
        <div class='box-header'>
            <div class='title'>
                <div class='icon-inbox'></div>
                Orders
            </div>
            <div class='actions'>
                <a href="#" class="btn box-remove btn-mini btn-link"><i class='icon-remove'></i>
                </a>
                <a href="#" class="btn box-collapse btn-mini btn-link"><i></i>
                </a>
            </div>
        </div>
        <div class='row-fluid'>
            <div class='span6'>
                <div class='box-content box-statistic'>
                    <h3 class='title text-error'>191</h3>
                    <small>New</small>
                    <div class='text-error icon-inbox align-right'></div>
                </div>
                <div class='box-content box-statistic'>
                    <h3 class='title text-warning'>311</h3>
                    <small>In process</small>
                    <div class='text-warning icon-check align-right'></div>
                </div>
                <div class='box-content box-statistic'>
                    <h3 class='title text-info'>3</h3>
                    <small>Pending</small>
                    <div class='text-info icon-time align-right'></div>
                </div>
            </div>
            <div class='span6'>
                <div class='box-content box-statistic'>
                    <h3 class='title text-primary'>3</h3>
                    <small>Shipped</small>
                    <div class='text-primary icon-truck align-right'></div>
                </div>
                <div class='box-content box-statistic'>
                    <h3 class='title text-success'>981</h3>
                    <small>Completed</small>
                    <div class='text-success icon-flag align-right'></div>
                </div>
                <div class='box-content box-statistic'>
                    <h3 class='title muted'>0</h3>
                    <small>Canceled</small>
                    <div class='muted icon-remove align-right'></div>
                </div>
            </div>
        </div>
    </div>
    <div class='span3 box'>
        <div class='box-header'>
            <div class='title'>
                <i class='icon-group'></i>
                Visitors
            </div>
            <div class='actions'>
                <a href="#" class="btn box-remove btn-mini btn-link"><i class='icon-remove'></i>
                </a>
                <a href="#" class="btn box-collapse btn-mini btn-link"><i></i>
                </a>
            </div>
        </div>
        <div class='row-fluid'>
            <div class='span12'>
                <div class='box-content box-statistic'>
                    <h3 class='title text-error'>9100</h3>
                    <small>Unique</small>
                    <div class='text-error icon-user align-right'></div>
                </div>
                <div class='box-content box-statistic'>
                    <h3 class='title text-warning'>41 000</h3>
                    <small>Pageviews</small>
                    <div class='text-warning icon-book align-right'></div>
                </div>
                <div class='box-content box-statistic'>
                    <h3 class='title text-primary'>12:21</h3>
                    <small>Average time</small>
                    <div class='text-primary icon-time align-right'></div>
                </div>
            </div>
        </div>
    </div>
    <div class='span3 box'>
        <div class='box-header'>
            <div class='title'>
                <i class='icon-comments'></i>
                Comments
            </div>
            <div class='actions'>
                <a href="#" class="btn box-remove btn-mini btn-link"><i class='icon-remove'></i>
                </a>
                <a href="#" class="btn box-collapse btn-mini btn-link"><i></i>
                </a>
            </div>
        </div>
        <div class='row-fluid'>
            <div class='span12'>
                <div class='box-content box-statistic'>
                    <h3 class='title text-error'>91</h3>
                    <small>New</small>
                    <div class='text-error icon-plus align-right'></div>
                </div>
                <div class='box-content box-statistic'>
                    <h3 class='title text-success'>1</h3>
                    <small>Approved</small>
                    <div class='text-success icon-ok align-right'></div>
                </div>
                <div class='box-content box-statistic'>
                    <h3 class='title text-info'>123</h3>
                    <small>Pending</small>
                    <div class='text-info icon-time align-right'></div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
</div>
</div>
</section>