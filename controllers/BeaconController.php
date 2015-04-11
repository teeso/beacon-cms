<?php

namespace app\controllers;

use app\filters\BeaconLayout;
use Yii;
use app\models\Beacons;
use app\models\BeaconsSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BeaconController implements the CRUD actions for Beacons model.
 */
class BeaconController extends MainController
{


    public $defaultAction = 'list';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['list','create','update','view','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'layout' => [
                'class' => BeaconLayout::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Beacons models.
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new BeaconsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('beacon-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Beacons model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('beacon-view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Beacons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Beacons();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('beacon-form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Beacons model.
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
            return $this->render('beacon-form', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Beacons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['list']);
    }

    /**
     * Finds the Beacons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Beacons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Beacons::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
