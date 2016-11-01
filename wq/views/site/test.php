
<h1>音调</h1>
<audio class="music">
    <source  src="/music/tkzc.mp3" type="audio/mp3">
</audio>
<p class="note" style="background-color: grey">11111</p>

<?php
$js = '
    $(".note").mouseenter(function(){
      $(".note").css("background-color","red");
      $(".music").attr("autoplay","autoplay");
      $(".music")[0].play()
    }).mouseleave(function(){
      $(".note").css("background-color","grey");
      $(".music")[0].pause();
    });
';
//
$this->registerJs($js,\yii\web\View::POS_END);
?>