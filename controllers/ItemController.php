<?php

namespace app\controllers;

use Yii;
use app\models\Items;
use app\models\ItemsSearch;
use yii\db\Query;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemController implements the CRUD actions for Items model.
 */
class ItemController extends Controller
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
     * Lists all Items models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Items model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        // query kartu stok
        $sql_list = "
            SELECT t.id AS trans_id
            , t.trans_code AS trans_code
            , t.trans_date AS trans_date
            , a.id AS detail_id, a.item_id AS item_id
            , trim(concat(t.remarks,' - ',a.remarks)) AS remarks
            , b.code AS item_code, b.name AS item_name
            , CASE 
                WHEN t.type_id=1 THEN a.quantity 
                WHEN t.type_id=2 THEN -a.quantity 
                ELSE 0 END 
              AS quantity
            , @sal := @sal + CASE 
                WHEN t.type_id=1 THEN a.quantity 
                WHEN t.type_id=2 THEN -a.quantity 
                ELSE 0 END 
              AS saldo
            FROM transactions t
            JOIN transaction_details a ON t.id = a.trans_id
            JOIN items b ON a.item_id = b.id
            JOIN ( SELECT @sal:=0 ) v
            WHERE b.id = :id
            ORDER BY t.trans_date, t.id, a.id
        ";
        // query total data di kartu stok
        $sql_count = "
            SELECT count(*) 
            FROM transactions t
            JOIN transaction_details a ON t.id = a.trans_id
            JOIN items b ON a.item_id = b.id
            ORDER BY t.trans_date, t.id, a.id;
        ";
        // count data
        $count = Yii::$app->db->createCommand($sql_count, [':id' => $id])->queryScalar();
        // data provider untuk ditampilkan di view
        $dataProvider = new SqlDataProvider([
            'sql' => $sql_list,
            'params' => [':id' => $id],
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        // render view
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Items();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Items model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Items model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Items model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Items the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
