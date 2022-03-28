<?php
namespace app\components;

use app\models\Statistic;
use app\models\StatisticSearch;
use Yii;
use yii\base\Component;

class StatisticComponent extends Component
{
    const EVENT_REQUEST_COUNT = 'request_count';

    public function requestCount()
    {
        echo "<script>console.log('Halo')</script>";
    }
}