<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\ButtonDropdown;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SpecimenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Specimens');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specimen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Specimen',
        ]), ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a(Yii::t('app', 'Create {modelClass} from Coordinates', [
            'modelClass' => 'Specimen',
        ]), ['reverse-geocoding'], ['class' => 'btn btn-success']) ?>


        <?php
        /*
            echo ButtonDropdown::widget([
            'label' => 'Create form Coordinates',
            'dropdown' => [
                'items' => [
                    ['label' => 'Geodetic decimal', 'url' => Url::toRoute(['create-from-reverse-geocoding',
                                                                           'latitude' => '9.0',
                                                                           'longitude' => 49.0,
                                                                           'language' => 'en'])],
                    ['label' => 'Geodetic degrees', 'url' => '#'],
                    ['label' => 'UTM', 'url' => '#'],
                    ['label' => 'MGRS', 'url' => '#'],
                ],
            ],
        ]);
        */
        ?>
        <?= Html::a(Yii::t('app', 'Calendar'), ['calendar'], ['class' => 'btn btn-primary']) ?>

    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'specimenId',
            'localityName',
            'country',
            //'countryCodeIso',
            'administrative_area_level_1',
//            'administrative_area_level_2',
            'administrative_area_level_3',
            // 'locality',
            // 'sublocality',
            // 'latitude',
            // 'longitude',
            // 'horizontalAccuracy',
            // 'altitude',
            // 'verticalAccuracy',
             'beginDate',

//            [
//                         'class' => 'yii\grid\DataColumn', // can be omitted, default
//                         'value' => function ($data) {
//                             return $data->beginDate;
//                         },
//                     ],

            // 'endDate',
            // 'legit',
            // 'localityDescription',
            // 'localityPrefix',
            // 'localityMajorId',
            // 'localityMinorId',
            // 'mgrs',
            // 'circumstance:ntext',
            // 'wetherConditions:ntext',
            // 'label:ntext',
            // 'fieldsMeta:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
