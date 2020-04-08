<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>


<div class="site-index">
    <div class="row">
        <div class="col-md-9">
            <h4>Currently to be paid : <strong>213 $</strong></h4>
        </div>
        <div class="col-md-3">

        </div>
    </div>
    <div class="row clearfix">&nbsp;</div>

    <table class="table table-bordered table-sm">
        <tr>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Amount</th>
            <th>Interest</th>
            <th>Duration</th>
            <th>Start</th>
            <th>End</th>
            <th>Campaign</th>
            <th>Status</th>
        </tr>
        <?php foreach ($loans as $loan): ?>
            <tr>
                <td class="text-danger"><strong><?= $loan->user->first_name ?></strong></td>
                <td class="text-danger"><strong><?= $loan->user->last_name ?></strong></td>
                <td><?= $loan->amount ?></td>
                <td><?= $loan->interest ?></td>
                <td><?= $loan->duration ?></td>
                <td><?= $loan->start_date ?></td>
                <td><?= $loan->end_date ?></td>
                <td><?= $loan->campaign ?></td>
                <td><?= $loan->status ?></td>
            </tr>

        <?php endforeach; ?>
    </table>

    <?=LinkPager::widget(['pagination' => $pages,]);?>
</div>