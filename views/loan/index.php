<?php
/* @var $this yii\web\View */

use app\models\Loan;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
$this->title = 'My Yii Application';
?>

<div class="site-index">
    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3 text-right">
            <?= Html::a('Add Loan', ['loan/create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="row clearfix">&nbsp;</div>

    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => Loan::find(),
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'user.first_name'],
            ['attribute' => 'user.last_name'],
            ['attribute' => 'user.email'],
            ['attribute' => 'amount'],
            ['attribute' => 'interest'],
            ['attribute' => 'start_date'],
            ['attribute' => 'end_date'],
            ['attribute' => 'campaign'],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{loan/view}{loan/update} {loan/delete}',
                'buttons' => [
                    'loan/view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye"></i>', $url, ['class' => 'btn btn-info btn-xs']);
                    },
                    'loan/update' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-edit"></i>', $url, ['class' => 'btn btn-warning btn-xs']);
                    },
                    'loan/delete' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-trash"></i>', $url, ['class' => 'btn btn-danger btn-xs']);
                    }
                ],

            ]
        ]
    ]);
    ?>
</div>