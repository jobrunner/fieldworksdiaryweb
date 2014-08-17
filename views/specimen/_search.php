<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SpecimenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specimen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'specimenId') ?>

    <?= $form->field($model, 'country') ?>

    <?= $form->field($model, 'countryCodeIso') ?>

    <?= $form->field($model, 'administrative_area_level_1') ?>

    <?php // echo $form->field($model, 'administrative_area_level_2') ?>

    <?php // echo $form->field($model, 'administrative_area_level_3') ?>

    <?php // echo $form->field($model, 'locality') ?>

    <?php // echo $form->field($model, 'sublocality') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'horizontalAccuracy') ?>

    <?php // echo $form->field($model, 'altitude') ?>

    <?php // echo $form->field($model, 'verticalAccuracy') ?>

    <?php // echo $form->field($model, 'beginDate') ?>

    <?php // echo $form->field($model, 'endDate') ?>

    <?php // echo $form->field($model, 'legit') ?>

    <?php // echo $form->field($model, 'localityName') ?>

    <?php // echo $form->field($model, 'localityDescription') ?>

    <?php // echo $form->field($model, 'localityPrefix') ?>

    <?php // echo $form->field($model, 'localityMajorId') ?>

    <?php // echo $form->field($model, 'localityMinorId') ?>

    <?php // echo $form->field($model, 'mgrs') ?>

    <?php // echo $form->field($model, 'circumstance') ?>

    <?php // echo $form->field($model, 'wetherConditions') ?>

    <?php // echo $form->field($model, 'label') ?>

    <?php // echo $form->field($model, 'fieldsMeta') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
