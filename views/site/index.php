<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

?>
<?php if(Yii::$app->user->isGuest)
{
?>
<div class="site-index">

</div>
<?php } ?>