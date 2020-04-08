<?php

namespace app\controllers;

use app\components\PersonalCode;
use app\models\CreateLoanForm;
use app\models\Loan;
use app\models\NewUser;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class LoanController extends Controller
{

    CONST AGE = 36;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout','index','view', 'index', 'update', 'create'],
                'rules' => [
                    [
                        'actions' => ['logout', 'view', 'index', 'update', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $query = Loan::find()->orderBy('id desc');
        $pages = new Pagination(['totalCount' => $query->count()]);
        $pages->defaultPageSize = 10;
        $loans = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'loans' => $loans,
            'pages' => $pages,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = new User();
        $loanModel = $this->findModel($id);

        $user = $model->findOne($loanModel->user_id);
        return $this->render('view', [
            'model' => $loanModel,
            'user' => $user
        ]);

    }

    public function actionCreate()
    {
        //print_r(Yii::$app->request->post());exit;
        $model = new CreateLoanForm();
        if ($model->load(Yii::$app->request->post()) && $model->addLoan()) {
            $userId = Yii::$app->request->post('CreateLoanForm')['user_id'];
            if (!$this->ageValidate(NewUser::findOne($userId))) {
                Yii::$app->session->setFlash('warning', 'User is not eligible for loan');
                return $this->goBack();
            }
            Yii::$app->session->setFlash('success', 'Loan added for user ');
            return $this->redirect(['loan/index']);
        }
        $users = NewUser::find()->all();
        return $this->render('create', ['model' => $model, 'users' => $users]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Loan updated for user ');
            return $this->redirect(['loan/index']);
        }
        $users = User::find()->all();
        return $this->render('create', ['model' => $model, 'users' => $users]);
    }

    /**
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $users = NewUser::find()->all();
        return $this->render('update', [
            'model' => $model,
            'users' => $users
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $model = Loan::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model->delete();
        Yii::$app->session->setFlash('danger', 'Loan deleted for user ');

        return $this->redirect(['loan/index']);
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Loan::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param NewUser $user
     * @return bool
     */
    protected function ageValidate(NewUser $user): bool
    {
        return ((new PersonalCode($user->personal_code))->getAge() > self::AGE) ? true : false;
    }

}
