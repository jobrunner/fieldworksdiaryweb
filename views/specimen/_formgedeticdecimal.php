<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\ButtonDropdown;
use yii\helpers\Url;


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
        echo $form->field($model, 'geoCodeLanguage')->dropDownList([
                'en' => 'English names',
                'de' => 'German names',
                'fr' => 'French names',
        ]);

//        ['onchange'=>'this.form.submit()']

        ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Change Input format'), ['class' => 'btn btn-primary']) ?>
            <?php #= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>


    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute('create-from-reverse-geocoding')

    ]); ?>
    <div class="col-lg-4">
        <?php
        echo $form->field($model, 'geoCodeLanguage')->hiddenInput();
        echo $form->field($model, 'inputFormat')->hiddenInput();

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
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Lookup'), ['class' => 'btn btn-primary']) ?>
            <?php #= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
