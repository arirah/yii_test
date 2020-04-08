<?php
/* @var $this yii\web\View */

use app\components\PersonalCode;
use app\models\NewUser;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';

?>


<div class="site-index">
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3 text-right">
            <?= Html::a('Add User', ['user/create'], ['class' => 'btn btn-info']) ?>
        </div>
    </div>
    <div class="row clearfix">&nbsp;</div>
    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => NewUser::find(),
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'first_name', 'format' => 'text'],
            ['attribute' => 'last_name', 'format' => 'text'],
            [
                'label' => 'Age',
                'format' => 'integer',
                'value' => function ($model) {
                    return (new  PersonalCode($model->personal_code))->getAge();
                }
            ],
            ['attribute' => 'email', 'format' => 'text'],
            ['attribute' => 'personal_code', 'format' => 'text'],
            ['attribute' => 'phone', 'format' => 'text'],
            ['attribute' => 'dead', 'format' => 'text'],
            ['attribute' => 'lang', 'format' => 'text'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{user/view}{user/update} {user/delete}',
                'buttons' => [
                    'user/view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>', $url,['class' => 'btn btn-info btn-xs']);
                    },
                    'user/update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-edit"></i>', $url ,['class' => 'btn btn-warning btn-xs']);
                    },
                    'user/delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash"></i>', $url ,['class' => 'btn btn-danger btn-xs']);
                    }
                ],

            ]
        ]
    ]);

    ?>
</div>