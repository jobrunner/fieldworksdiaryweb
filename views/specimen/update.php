<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Specimen */

//$this->title = Yii::t('app', 'Edit Specimen {modelClass}: ', [
//    'modelClass' => 'Specimen',
//]) . ' ' . $model->id;


$this->title = Yii::t('app', 'Edit {modelClass}', [
    'modelClass' => 'Specimen',
]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specimens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="specimen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
