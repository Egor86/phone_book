<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhoneBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJs('
$( ".delete" ).click(function() {
    event.preventDefault();
    var id = $(this).data("product-id");
    $.ajax({
    url: "/api/users/" + id,
    method: "delete",
    success: function(data){
        if (data) {
            $("[data-key = " + id +"]").remove();   
            alert("User was deleted");
        } else {
            alert("User was not deleted");
        }
    }
    })
});
', \yii\web\View::POS_END);

$this->title = 'Phone Book';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Phone Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'phone',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['view', 'name' => $model->name]), [
                            'title' => 'Просмотр',
                        ]);
                    },
                    'delete' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                            'title' => 'Удалить',
                            'class' => 'delete',
                            'data-product-id' => $model->id
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
