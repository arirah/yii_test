<?php

namespace app\models;

use yii\db\ActiveRecord;

class CreateLoanForm extends ActiveRecord
{
    public $user_id;
    public $amount;
    public $interest;
    public $duration;
    public $start_date;
    public $end_date;
    public $campaign;
    public $status;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'loan';
    }


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'interest', 'duration', 'start_date', 'end_date'], 'required'],
            [['amount','interest'],'double'],
            [['status', 'campaign'], 'safe'],

        ];
    }

    /**
     * @return bool
     */
    public function addLoan()
    {
        $user = new Loan();
        $user->user_id = $this->user_id;
        $user->amount = $this->amount;
        $user->interest = $this->interest;
        $user->duration = $this->duration;
        $user->start_date = $this->start_date;
        $user->end_date = $this->end_date;
        $user->campaign = $this->campaign;
        $user->status = 1;
        return $user->save() ? true : false;
    }
}
