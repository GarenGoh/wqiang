<!--<h1>音调</h1>
<audio class="music">
    <source src="/music/tkzc.mp3" type="audio/mp3">
</audio>
<p class="note" style="background-color: grey">11111</p>-->
<?php
$js = '
    $(".note").mouseenter(function(){
      $(".note").css("background-color","red");
      $(".music")[0].play()
    }).mouseleave(function(){
      $(".note").css("background-color","grey");
      $(".music")[0].pause();
    });
    console.log($(".music"));
';
//$(".music")[0].currentTime = 0;  //设置当前时间
//$(".music")[0].duration   //该音乐的总时长
$this->registerJs($js, \yii\web\View::POS_END);
?>




<style type="text/css">
    .div {
        margin: auto;
        background-color: #00CCFF;
        width: 276px;
    }
    .div1 {
        float: left;
        background-color: #0000aa;
        height: 100px;
        width: 100px;
        border: solid 5px #51ff3c;
        padding: 20px;
        word-break: break-all;
        margin-right: 50px;
    }
    .div2 {
        float: left;
        background-color: #900;
        height: 70px;
        width: 70px;
        border: solid 3px #f7a2ff;
    }
</style>
<div>
    <div class="div">
        <div class="div1">
            1111111111adadaddddddddd
        </div>
        <div class="div2">
        </div>
    </div>
</div>