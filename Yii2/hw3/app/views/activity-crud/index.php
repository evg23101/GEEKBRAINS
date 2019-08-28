<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'startDay',
            'endDay',
            'body:ntext',
            //'isBlocked',
            //'useNotification',
            //'email:email',
            [
                    'attribute' => 'createdAt',
                    'value' => function(\app\models\Activity $model){
                        return $model->getDateCreated();
                    }],
            //'isDeleted',
            'user.email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
