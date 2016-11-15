<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PhoneBook */

$this->registerJs('
    $("#update").on("click", function(){
        event.preventDefault();
        var form = $(".form");
        $.ajax({
            url: "'. Url::to(['user/update', 'id' => $model->id]) . '",
            type: "PUT",
            data: form.serialize(),
            success: function(data) {
                if (data.success) {
                    location.replace(data.location);
                }
                for (name in data.error) {
                    $("#" + name).text(data.error[name]).css("color", "red");
                }
            }
        });
    })
', \yii\web\View::POS_END);

$this->title = 'Update Phone Book: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Phone Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phone-book-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
