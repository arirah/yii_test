<!--<table class="top-bar-table">-->
<!--    <tr>-->
<!--        <td style="padding-left: 38px;">Customer support</td>-->
<!--        <td> </td>-->
<!--        <td><i class="fa fa-phone"> 1715</td>-->
<!--        <td> </td>-->
<!--        <td><i class="fa fa-clock-o"> Mon-Sun 9 a.m. - 9 p.m.</td>-->
<!--        <td width="50%">&nbsp;</td>-->
<!--        <td style="text-align: right;">Test exercise</td>-->
<!--    </tr>-->
<!--</table>-->
<?php

use yii\helpers\Html;

?>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <span>  <i class="fa fa-phone"></i> Support:  23123 &nbsp;&nbsp; <i class="fa fa-clock-o"></i> Call: 10:00AM - 8.00PM  </span>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4 text-right">

            <?php
            if (!Yii::$app->user->isGuest) {
                ?>
                <?= Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '<i class="fa fa-lock"></i> Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-warning logout']
                )
                . Html::endForm() ?>
            <?php } else {
                echo Html::a("Login", ['site/login'], ['class' => 'btn btn-warning btn-xs']);
            } ?>

        </div>
    </div>
</div>