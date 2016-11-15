<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PhoneBook */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phone-book-form">

    <?php $form = ActiveForm::begin(['action' => '/api/users', 'options' => ['class' => 'form']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->error(['id' => 'name']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->error(['id' => 'phone']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id' => 'update']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
