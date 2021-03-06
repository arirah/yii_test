<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-view">
    <h1>Loan ID:<?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'amount',
            'interest',
            'duration',
            'start_date',
            'end_date',
            'campaign',
            'status:boolean',
        ],
    ]) ?>



    <h1>User: <?= $user->first_name; ?> <?= $user->last_name; ?></h1>
    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'first_name:text',
            'last_name:text',
            'email:text',
            'personal_code',
            'phone',
            'active:boolean',
            'dead:boolean',
            'lang:text',
        ],
    ]) ?>

</div>