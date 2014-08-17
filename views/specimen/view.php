<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Specimen */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specimens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specimen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a(Yii::t('app', 'Copy'), ['create-from-id', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'specimenId',
            'country',
            'countryCodeIso',
            'administrative_area_level_1',
            'administrative_area_level_2',
            'administrative_area_level_3',
            'locality',
            'sublocality',
            'latitude',
            'longitude',
            'horizontalAccuracy',
            'altitude',
            'verticalAccuracy',
            'beginDate',
            'endDate',
            'legit',
            'localityName',
            'localityDescription',
            'localityPrefix',
            'localityMajorId',
            'localityMinorId',
            'mgrs',
            'circumstance:ntext',
            'wetherConditions:ntext',
            'label:ntext',
            'fieldsMeta:ntext',
        ],
    ]) ?>

</div>
