<?php

use yii\helpers\Html;
use yii\helpers\Url;
# use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm as ActiveForm;
//use dosamigos\datepicker\DateRangePicker;
use dosamigos\datepicker\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Specimen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specimen-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-lg-3" style="padding-left:0">

        <?php //= $form->field($model, 'id')->textInput(['maxlength' => 48]) ?>
        <?= $form->field($model, 'specimenId')->textInput(['maxlength' => 20]) ?>
        <?= $form->field($model, 'localityName')->textInput(['maxlength' => 200]) ?>
        <?= $form->field($model, 'country')->dropDownList(['Germany', 'Spain']); ?>
        <?= $form->field($model, 'countryCodeIso')->textInput(['maxlength' => 2]) ?>
        <?= $form->field($model, 'administrative_area_level_1')->textInput(['maxlength' => 200]) ?>
        <?= $form->field($model, 'administrative_area_level_2')->textInput(['maxlength' => 200]) ?>
        <?= $form->field($model, 'administrative_area_level_3')->textInput(['maxlength' => 200]) ?>
        <?= $form->field($model, 'locality')->textInput(['maxlength' => 200]) ?>
        <?= $form->field($model, 'sublocality')->textInput(['maxlength' => 200]) ?>
    </div>

    <div class="col-lg-5">

        <div class="col-lg-4">
            <?= $form->field($model, 'latitude')->textInput() ?>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'longitude')->textInput() ?>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'altitude')->textInput() ?>
        </div>

        <div class="col-lg-8">
            <?= $form->field($model, 'horizontalAccuracy')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'verticalAccuracy')->textInput() ?>
        </div>

        <div class="col-lg-12">
            <?= $form->field($model, 'mgrs')->textInput(['maxlength' => 18]) ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'beginDate')->widget(
                DatePicker::className(), [
                    'clientOptions' => [
                        'language' => 'de-DE',
                        'autoclose' => true,
                        'clearBtn' => true,
                        'todayHighlight' => true,
                        'data-date-format' => 'yyyy-mm-dd',
                        'format' => 'yyyy-mm-dd',
                        'weekStart' => 1,
                    ]
            ]);?>
        </div>


        <div class="col-lg-6">
            <?= $form->field($model, 'endDate')->widget(
                DatePicker::className(), [
                    'clientOptions' => [
                        'language' => 'de-DE',
                        'autoclose' => true,
                        'clearBtn' => true,
                        'todayHighlight' => true,
                        'data-date-format' => 'yyyy-mm-dd',
                        'format' => 'yyyy-mm-dd',
                        'weekStart' => 1,
                    ]
            ]);?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'legit')->dropDownList([
                '', 'J. Brunner'
            ]); ?>
        </div>


    </div>

<!--    <div class="col-lg-2">-->
<!---->
<!--        --><?php //# echo $form->field($model, 'beginDate')->textInput() ?>
<!--        --><?php //#= $form->field($model, 'endDate')->textInput() ?>
<!---->
<!--    </div>-->

    <div class="col-lg-4">

        <?= $form->field($model, 'circumstance')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'wetherConditions')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'label')->textarea(['rows' => 6]) ?>

        <?php //= $form->field($model, 'localityDescription')->textInput(['maxlength' => 1000]) ?>
        <?php //= $form->field($model, 'localityPrefix')->textInput(['maxlength' => 100]) ?>
        <?php //= $form->field($model, 'localityMajorId')->textInput(['maxlength' => 100]) ?>
        <?php //= $form->field($model, 'localityMinorId')->textInput(['maxlength' => 100]) ?>
        <?php // = $form->field($model, 'fieldsMeta')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
