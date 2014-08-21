<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Specimen */

$this->title = Yii::t('app', 'Specimens');
$this->params['breadcrumbs'][] = $this->title;

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specimen'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="specimen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \talma\widgets\FullCalendar::widget([
        'googleCalendar' => false,  // If the plugin displays a Google Calendar. Default false
        'loading' => 'Carregando...', // Text for loading alert. Default 'Loading...'
        'config' => [
            // see http://arshaw.com/fullcalendar/docs/
            'header'=> [
                'left'   => 'prevYear nextYear',
                'center' => 'title',
                'right'  => 'today prev,next'
            ],
            'weekNumbers' => true,
            'defaultView' => 'month',
//            'selectable' => true,
//            'selectHelper' => true,
            'lang' => 'de', // optional, if empty get app language

            'eventSources' => Url::toRoute("specimen/events"),
            'editable'     => false,
        ],
    ]); ?>
</div>




