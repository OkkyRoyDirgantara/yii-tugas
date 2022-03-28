<?php

namespace app\controllers;

use app\components\StatisticComponent;
use app\models\Statistic;
use app\models\StatisticSearch;
use phpDocumentor\Reflection\Types\Object_;
use Yii;
use yii\base\Event;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StatisticController implements the CRUD actions for Statistic model.
 */
class StatisticController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Statistic models.
     *
     * @return string
     */
    public function actionIndex()
    {
        Event::on(StatisticComponent::class, StatisticComponent::EVENT_REQUEST_COUNT, function (){
            $statisticComponent = new StatisticComponent();
            $statisticComponent->requestCount();
        });
        if (Yii::$app->request->isGet) {
            $statistic = new Statistic();
            $statistic->user_ip = Yii::$app->request->userIP;
            $statistic->user_host = Yii::$app->request->userHost;
            $statistic->path_info = Yii::$app->request->pathInfo;
            $statistic->query_string = Yii::$app->request->queryString;
            $statistic->access_time = date('Y-m-d H:i:s');
            $statistic->save();
        }

        $searchModel = new StatisticSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);



        $info_access_time = date('Y-m-d H:i:s');
        $info_user_ip = Yii::$app->request->userIP;
        $info_user_agent = Yii::$app->request->userAgent;
        $info_path = Yii::$app->request->pathInfo;
        $info_query_string = Yii::$app->request->queryString;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

            'info_access_time' => $info_access_time,
            'info_user_ip' => $info_user_ip,
            'info_user_agent' => $info_user_agent,
            'info_path' => $info_path,
            'info_query_string' => $info_query_string,
        ]);
    }

    /**
     * Displays a single Statistic model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isGet) {
            $statistic = new Statistic();
            $statistic->user_ip = Yii::$app->request->userIP;
            $statistic->user_host = Yii::$app->request->userHost;
            $statistic->path_info = Yii::$app->request->pathInfo;
            $statistic->query_string = Yii::$app->request->queryString;
            $statistic->access_time = date('Y-m-d H:i:s');
            $statistic->save();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Statistic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        if (Yii::$app->request->isGet) {
            $statistic = new Statistic();
            $statistic->user_ip = Yii::$app->request->userIP;
            $statistic->user_host = Yii::$app->request->userHost;
            $statistic->path_info = Yii::$app->request->pathInfo;
            $statistic->query_string = Yii::$app->request->queryString;
            $statistic->access_time = date('Y-m-d H:i:s');
            $statistic->save();
        }

        $model = new Statistic();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Statistic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Statistic model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Statistic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Statistic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (Yii::$app->request->isGet) {
            $statistic = new Statistic();
            $statistic->user_ip = Yii::$app->request->userIP;
            $statistic->user_host = Yii::$app->request->userHost;
            $statistic->path_info = Yii::$app->request->pathInfo;
            $statistic->query_string = Yii::$app->request->queryString;
            $statistic->access_time = date('Y-m-d H:i:s');
            $statistic->save();
        }

        if (($model = Statistic::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
