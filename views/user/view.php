<?php

use app\components\PersonalCode;
use app\models\Loan;
use app\models\NewUser;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'first_name:text',
            'last_name:text',
            'email:text',
            'personal_code',
            'lang:text',
            [
                'label' => 'Age',
                'value' => (new  PersonalCode($model->personal_code))->getAge(),
            ],
            'phone',
            'active:boolean',
            'dead:boolean',
        ],
    ]) ?>

    <h1>User Loans: <?= $model->id ?></h1>


    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => Loan::find()->where(['loan.user_id' => $model->id]),
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showOnEmpty' => false,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            'id',
            'amount',
            'interest',
            'duration',
            'start_date',
            'end_date',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{loan/view}{loan/update} {loan/delete}',
                'buttons' => [
                    'loan/view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>', $url,['class' => 'btn btn-info btn-xs']);
                    },
                    'loan/update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-edit"></i>', $url ,['class' => 'btn btn-warning btn-xs']);
                    },
                    'loan/delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash"></i>', $url ,['class' => 'btn btn-danger btn-xs']);
                    }
                ],

            ],
        ],
    ]); ?>

</div>