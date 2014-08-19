<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\Url;
use yii\web\View;

$this->registerJs("$('#specimen-inputformat').on('change', function() {this.form.submit()});", View::POS_READY);


/* @var $this yii\web\View */
/* @var $model app\models\Specimen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specimen-form">

    <div class="col-lg-4">
        <?php $form = ActiveForm::begin([
            'method' => 'GET',
        ]); ?>

        <?php
        echo $form->field($model, 'inputFormat')->dropDownList([
                'geodeticdecimal' => 'Geodetic decimal',
                'geodeticdegrees' => 'Geodetic degrees',
                'utm'             => 'UTM',
                'mgrs'            => 'MGRS',
        ]);

        ?>
    </div>
    <?php ActiveForm::end(); ?>


    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute('create-from-reverse-geocoding')

    ]); ?>
    <div class="col-lg-4">
        <div class="form-group">
        <?php
        echo Html::activeHiddenInput($model, 'geoCodeLanguage');
        echo Html::activeHiddenInput($model, 'inputFormat');

        if ($model->inputFormat == 'geodeticdecimal') {

            echo $form->field($model, 'latitude')->textInput();
            echo $form->field($model, 'longitude')->textInput();

        } elseif ($model->inputFormat == 'geodeticdegrees') {

            echo $form->field($model, 'latitude')->textInput();
            echo $form->field($model, 'longitude')->textInput();
        } elseif ($model->inputFormat == 'utm') {

            echo $form->field($model, 'utm')->textInput();
        } elseif ($model->inputFormat == 'mgrs') {

            echo $form->field($model, 'mgrs')->textInput();
        }
        ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'geoCodeLanguage')->dropDownList([
                'en' => 'English names',
                'de' => 'German names',
                'fr' => 'French names',
            ])?>
        </div>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Lookup'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
