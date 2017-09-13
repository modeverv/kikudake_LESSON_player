<?php
error_reporting(E_ALL);
setlocale(LC_ALL, "ja_JP.utf8");

function mp3glob(){
  $mp3s = [];
  foreach(glob("./data/LESSON_MP3/*.mp3") as $mp3){
    $mp3s[] = $mp3;
  }
  return $mp3s;
}
$mp3s = mp3glob();
?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>聴くだけ作曲入門</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
var player;
$(function(){
  player = document.getElementById('player');
  $("#play").on("click",play);
  $("#stop").on("click",stop);
  $("#to15").on("click",to15);
  $("#to10").on("click",to10);
  $("#plusS").on("click",plusS);
  $("#minusS").on("click",minusS);
  $("#skip90").on("click",skip90);
  $("#skip10").on("click",skip10);
  $("#rev10").on("click",rev10);
});
function play(){
  player.play();
}
function stop(){
  player.pause();
}
function to15(){
  player.playbackRate = 1.5;
  display("rate:" + myRound(player.playbackRate,1));
}
function to10(){
  player.playbackRate = 1.0;
  display("rate:" + myRound(player.playbackRate,1));
}
function plusS(){
  player.playbackRate += 0.1;
  display("rate:" + myRound(player.playbackRate,1));
}
function minusS(){
  player.playbackRate -= 0.1;
  display("rate:" + myRound(player.playbackRate,1));
}
function skip90(){
  player.currentTime += 90;
}
function skip10(){
  player.currentTime += 10;
}
function rev10(){
  player.currentTime -= 10;
}
function display(str){
    $("#display").html(str);
    $("#display").show(1);
    setTimeout(function(){
      $("#display").hide(1);
    },1000);
}
function display2(str){
    $("#display2").html(str);
}

function myRound(val, precision) {
     digit = Math.pow(10, precision);
     val = val * digit;
     val = Math.round(val);
     val = val / digit;
     return val;
}
function set(elem){
    $elem = $(elem);
    var src = $elem.data("src");
    var $player = $("#player");
    $player.attr("src",src);
    display2(src.replace("./data/",""));
}
</script>
</head>
<body>
	<div id="player-area" style="position:fixed;top:0;background-color:#fff">
		<div id="player-div" style="font-size:0.8em;">
			<audio id="player" controls></audio>
			<span id="display2"></span>
			<span id="display"></span>
		</div>
		<div id="menu">
			<button id="play">再生</button>
			<button id="stop">停止</button>
			<button id="to15">1.5倍速</button>
			<button id="to10">1.0倍速</button>
			<button id="plusS">+</button>
			<button id="minusS">-</button>
			<button id="skip90">90秒早送り</button>
			<button id="skip10">10秒早送り</button>
			<button id="rev10">10秒巻き戻し</button>
		</div>
	</div>
	<div id="src-area" style="margin-top:75px;">
		<?php
			 foreach($mp3s as $mp3){
			 echo("<li style=\"cursor:pointer;\" data-src=\"". $mp3 ."\" onclick=\"set(this);\">". basename($mp3) . "</li>\n");
			 }
			 ?>
	</div>
</body>
</html>
	

