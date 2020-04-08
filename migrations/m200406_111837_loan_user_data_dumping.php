<?php

use app\models\Loan;
use yii\db\Migration;

/**
 * Class m200406_111837_loan_user_data_dumping
 */
class m200406_111837_loan_user_data_dumping extends Migration
{
    /**
     * @return bool|void
     */
    public function up()
    {
        $this->down();
        $users = (array)json_decode(file_get_contents(__DIR__ . '/../users.json'));
        $tableFields = array_keys((array)$users[0]);
        $records = array();
        foreach ($users as $user) {
            $records[] = array_values((array)$user);
        }
        $this->batchInsert('user', $tableFields, $records);

        // LOAN
        $loans = (array)json_decode(file_get_contents(__DIR__ . '/../loans.json'));
        foreach ($loans as $loan) {
            $model = new Loan();
            $model->id = $loan->id;
            $model->user_id = $loan->user_id;
            $model->amount = $loan->amount;
            $model->interest = $loan->interest;
            $model->duration = $loan->duration;
            $model->start_date = date("Y-m-d H:i:s", $loan->start_date );
            $model->end_date = date("Y-m-d H:i:s", $loan->end_date );
            $model->campaign = $loan->campaign;
            $model->status = $loan->status;
            $model->save();
        }
    }

    public function down()
    {
        $this->truncateTable('loan');
        $this->truncateTable('user');
    }
}
