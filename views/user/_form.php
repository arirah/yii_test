<?php

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
        <?= $form->field($model, 'first_name')->label('First Name'); ?>
        <?= $form->field($model, 'last_name')->label('Last Name'); ?>
        <?= $form->field($model, 'email')->label('Email Address'); ?>
        <?= $form->field($model, 'password')->passwordInput()->label('Password'); ?>
        <?= $form->field($model, 'active')->radioList([1 => 'Active', 0 => 'Inactive']); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'personal_code'); ?>
        <?= $form->field($model, 'phone'); ?>
        <?= $form->field($model, 'dead')->label('Dead'); ?>
        <?= $form->field($model, 'lang')->dropDownList(['ENG' => 'English', 'RUSSIA' => 'Russian'], ['prompt' => 'Select...'])->label('Language') ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
