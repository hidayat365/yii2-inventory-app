<?php

namespace app\controllers;

use app\models\Model;
use app\models\Transactions;
use app\models\TransactionsSearch;
use app\models\TransactionDetails;
use app\models\TransactionDetailsSearch;
use app\models\TransactionsInSearch;
use app\models\TransactionsOutSearch;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * TransactionController implements the CRUD actions for Transactions model.
 */
class TransactionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transactions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransactionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Transactions models.
     * @return mixed
     */
    public function actionIn()
    {
        $searchModel = new TransactionsInSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index-in', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Transactions models.
     * @return mixed
     */
    public function actionOut()
    {
        $searchModel = new TransactionsOutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index-out', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transactions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'details' => $this->findDetails($id),
        ]);
    }

    /**
     * Creates a new Transactions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transactions();
        $details = [ new TransactionDetails ];

        // proses isi post variable 
        if ($model->load(Yii::$app->request->post())) {
            $details = Model::createMultiple(TransactionDetails::classname());
            Model::loadMultiple($details, Yii::$app->request->post());

            // assign default transaction_id
            foreach ($details as $detail) {
                $detail->trans_id = 0;
            }

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($details),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid1 = $model->validate();
            $valid2 = Model::validateMultiple($details);
            $valid = $valid1 && $valid2;

            // jika valid, mulai proses penyimpanan
            if ($valid) {
                // mulai database transaction
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    // simpan master record                   
                    if ($flag = $model->save(false)) {
                        // simpan details record
                        foreach ($details as $detail) {
                            $detail->trans_id = $model->id;
                            if (! ($flag = $detail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        // sukses, commit database transaction
                        // kemudian tampilkan hasilnya
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        return $this->render('create', [
                            'model' => $model,
                            'details' => $details,
                        ]);
                    }
                } catch (Exception $e) {
                    // penyimpanan galga, rollback database transaction
                    $transaction->rollBack();
                    throw $e;
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'details' => $details,
                    'error' => 'valid1: '.print_r($valid1,true).' - valid2: '.print_r($valid2,true),
                ]);
            }

        } else {
            // inisialisai id 
            // diperlukan untuk form master-detail
            $model->id = 0;
            // render view
            return $this->render('create', [
                'model' => $model,
                'details' => $details,
            ]);
        }
    }

    /**
     * Updates an existing Transactions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $details = $model->transactionDetails;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($details, 'id', 'id');
            $details = Model::createMultiple(TransactionDetails::classname(), $details);
            Model::loadMultiple($details, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($details, 'id', 'id')));

            // assign default transaction_id
            foreach ($details as $detail) {
                $detail->trans_id = $model->id;
            }

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($details),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid1 = $model->validate();
            $valid2 = Model::validateMultiple($details);
            $valid = $valid1 && $valid2;

            // jika valid, mulai proses penyimpanan
            if ($valid) {
                // mulai database transaction
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    // simpan master record                   
                    if ($flag = $model->save(false)) {
                        // delete dahulu semua record yang ada
                        if (! empty($deletedIDs)) {
                            TransactionDetails::deleteAll(['id' => $deletedIDs]);
                        }
                        // simpan details record
                        foreach ($details as $detail) {
                            $detail->trans_id = $model->id;
                            if (! ($flag = $detail->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        // sukses, commit database transaction
                        // kemudian tampilkan hasilnya
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    // penyimpanan galga, rollback database transaction
                    $transaction->rollBack();
                    throw $e;
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'details' => $details,
                    'error' => 'valid1: '.print_r($valid1,true).' - valid2: '.print_r($valid2,true),
                ]);
            }
        }

        // render view
        return $this->render('update', [
            'model' => $model,
            'details' => (empty($details)) ? [new TransactionDetails] : $details
        ]);
    }

    /**
     * Deletes an existing Transactions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $details = $model->transactionDetails;

        // mulai database transaction
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            // pertama, delete semua detail records
            foreach ($details as $detail) {
                $detail->delete();
            }
            // kemudian, delete master record
            $model->delete();
            // sukses, commit transaction
            $transaction->commit();

        } catch (Exception $e) {
            // gagal, rollback database transaction
            $transaction->rollBack();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transactions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transactions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transactions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the TransactionDetails model based on its foreign key value.
     * @param integer $id
     * @return data provider TransactionDetails for GridView 
     */
    protected function findDetails($id)
    {
        $detailModel = new TransactionDetailsSearch();
        return $detailModel->search(['TransactionDetailsSearch'=>['trans_id'=>$id]]);
    }
}
