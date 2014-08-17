<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Specimen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specimen-form">

    <div class="col-lg-4">

    <?php $form = ActiveForm::begin(
//        [
//            'action' => Url::toRoute('create')
//    ]
    );
    ?>

    <?php //= $form->field($model, 'id')->textInput(['maxlength' => 48]) ?>

    <?= $form->field($model, 'specimenId')->textInput(['maxlength' => 20]) ?>

    <?php #= $form->field($model, 'country')->textInput(['maxlength' => 200]) ?>
    <?= $form->field($model, 'country')->dropDownList(['Germany', 'Spain']); ?>

    <?php //= $form->field($model, 'countryCodeIso')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'administrative_area_level_1')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'administrative_area_level_2')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'administrative_area_level_3')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'locality')->textInput(['maxlength' => 200]) ?>

    <?php // = $form->field($model, 'sublocality')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?php // = $form->field($model, 'horizontalAccuracy')->textInput() ?>

    <?= $form->field($model, 'altitude')->textInput() ?>

    <?php // = $form->field($model, 'verticalAccuracy')->textInput() ?>

</div>
<div class="col-lg-4">

    <?= $form->field($model, 'beginDate')->textInput() ?>

    <?= $form->field($model, 'endDate')->textInput() ?>
</div>

<div class="col-lg-4">

    <?= $form->field($model, 'legit')->dropDownList(['J. Brunner', 'Neuer Sammler']); ?>

    <?= $form->field($model, 'localityName')->textInput(['maxlength' => 200]) ?>

    <?php // = $form->field($model, 'localityDescription')->textInput(['maxlength' => 1000]) ?>

    <?php // = $form->field($model, 'localityPrefix')->textInput(['maxlength' => 100]) ?>

    <?php // = $form->field($model, 'localityMajorId')->textInput(['maxlength' => 100]) ?>

    <?php //= $form->field($model, 'localityMinorId')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'mgrs')->textInput(['maxlength' => 18]) ?>

    <?= $form->field($model, 'circumstance')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wetherConditions')->textarea(['rows' => 6]) ?>

    <?php // = $form->field($model, 'label')->textarea(['rows' => 6]) ?>

    <?php // = $form->field($model, 'fieldsMeta')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
