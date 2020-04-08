<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
} ?>

<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <?php
        $list = [];
        foreach ($users as $user) {
            $list[$user->id]  = $user->first_name .'('.$user->email.')' ;
        }
        ?>
        <?= $form->field($model, 'user_id')->dropDownList($list,['prompt' => 'Select...'])->label('User'); ?>
        <?= $form->field($model, 'amount')->label('Amount'); ?>
        <?= $form->field($model, 'interest')->label('Interest'); ?>
        <?= $form->field($model, 'duration')->label('Duration'); ?>
        <label>Start Date</label>
        <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'start_date',
            'template' => '{addon}{input}',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);?>
        <label>End Date</label>
        <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'end_date',
            'template' => '{addon}{input}',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);?>

        <?= $form->field($model, 'campaign'); ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>
    <div class="col-md-6">

    </div>
</div>
<?php ActiveForm::end(); ?>
