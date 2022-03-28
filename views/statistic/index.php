<?php

use app\components\StatisticComponent;
use app\models\Statistic;
use yii\base\Event;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatisticSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Anda mengakses pada waktu : <?= $info_access_time ?></p>
    <p>Anda mengakses dengan user ip : <?= $info_user_ip ?></p>
    <p>Anda mengakses dengan user agent : <?= $info_user_agent ?></p>
    <p>Anda mengakses dengan pada path : <?= $info_path ?></p>
    <p>Anda mengakses dengan pada query string : <?= $info_query_string ?></p>
    <?= Event::trigger(StatisticComponent::class, StatisticComponent::EVENT_REQUEST_COUNT); ?>

    <p>
        <?= Html::a('Create Statistic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'access_time',
            'user_ip',
            'user_host',
            'path_info',
            'query_string',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Statistic $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>