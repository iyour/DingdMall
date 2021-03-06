<?php
header("Content-Type: text/html;charset=UTF-8");
session_start();
//注销登录
//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
  header("Location:index.html");
  exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>叮咚Mall</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/foundation.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/foundation.min.js"></script>
  <script src="../js/modernizr.js"></script>
  <style>
  .panel {
    width:100%;
    height:100%;
    background: #f2f2f2;
    padding: 0;
    border:none;
    border-radius: 5%;
    overflow: hidden;
    transition-duration: 0.5s;
  }
  .panel:hover{
    -webkit-box-shadow:0px 0px 15px #333333; 
    box-shadow:0px 0px 15px #333333;
    margin-top: -5px;
    cursor:pointer;
  }
  .goods_text{
    padding-top: 5px;
    padding-left: 15px;
    padding-right: 15px;
    padding-bottom: 0;
  }
  @media screen and (min-width: 600px) {
 #content{
  width: 90%;
  height:100%;
  margin: 7% auto;
 }
}
@media screen and (max-width: 600px) {
#content{
  width: 100%;
  height:100%;
  margin: 7% auto;
 }
}

 </style>
</head>
<body>

<div class="fixed">
<nav id="nav" class="top-bar" data-topbar>
  <ul class="title-area">
    <li class="name">
     
      <h1><a href="#">叮咚Mall</a></h1>
    </li>
      
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <ul class="left">
      <li class="active"><a href="#">Home</a></li>

    </ul>
    <ul class="right">
      <li ><a href="myhome.php"><?php echo $username ?></a></li>
    </ul>
  </section>
</nav>
</div>
<div class="banner">
    <picture>
    <source srcset="../images/banner-small.png" media="(max-width: 650px)">
    <img src="../images/banner-max.png" alt="Flowers" style="max-width:100%;">
    </picture>
</div>

<ul id="content" class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
</ul>

<div id="button" style="width: 90%;margin:0 auto;visibility: visible;">
 <button id="more_button" type="button" class="button expand">加载更多</button>
</div>
<div id="alert" data-alert class="alert-box alert" style="width: 90%;height:10%;margin: 0 auto;display: none;">
      <p style="text-align: center;">已无更多加载!</p>
</div>

<div class="bottom" style="width: 100%;height:4em;background: #333;position: relative;top: 5%;">
    <p style="color: #fff;font-size: 12px;text-align: center;padding: 1em;margin-bottom:0;">Copyright 2015-2016 www.DingdMall.com 叮咚Mall All Rights Reserved</p> 
  </div>
<script>

$(document).ready(function() {
    $(document).foundation();
$.more_load();
$("#more_button").click(function(){
      $.more_load();
  });
})
 var last=0;
 var max;
 $.post("max_id.php",function(data,status){
    max =data;
  });
 var last=0;
  $.extend({more_load:function(){
    $.getJSON("main_goods.php", {last:last,amount:"12"}, function(json){
      last=last+12;
      if (last<max) {  
        for(i=0;i<12;i++){
           $("#content").append("<li id="+json.list[i].good_id+"><div class=panel><img src=../images/"+json.list[i].good_image+".jpg alt="+json.list[i].good_image+"><div class=goods_text><h5>"+json.list[i].good_head+"&nbsp;&nbsp;<small>￥"+json.list[i].good_much+"</small></h5><a href=more.php?good_id="+json.list[i].good_id+" target=_blank><p>"+json.list[i].good_text+"···</p></a></div></div></li>");

          console.log(json.list[i].good_id,json.list[i].good_head,json.list[i].good_text,json.list[i].good_image,json.list[i].good_much);
        } 
          console.log(last);
      }  
         else{
          $("#button").css("visibility","hidden");
          $("#alert").css("display","block");
         
         }
    });

  }});

</script>

</body>
</html>
