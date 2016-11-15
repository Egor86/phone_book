<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PhoneBook */

$this->registerJs('
$( ".delete" ).click(function() {
    event.preventDefault();
    $.ajax({
    url: "' . Url::to('/api/users/'. $model->id) . '",
    method: "delete",
    success: function(data){
        if (data) {
            alert("User was deleted");
            location.replace("' . Url::to(['user/index']) . '");
        } else {
            alert("User was not deleted");
        }
    }
    })
});
', \yii\web\View::POS_END);
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Phone Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', null, [
            'class' => 'btn btn-danger delete',
            'data' => [
                'id' => 'Are you sure you want to delete this item?',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'phone',
        ],
    ]) ?>

</div>
