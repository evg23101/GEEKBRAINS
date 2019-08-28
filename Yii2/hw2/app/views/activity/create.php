<?php
/**
 * @var $model Activity
 */

use app\models\Activity;

?>
<div class="row">
    <div class="col-md-12">
        <h3>Создание активности</h3>
        <?php     $form = \yii\bootstrap\ActiveForm::begin();  ?>
        <?=$form->field($model, 'title'); ?>
        <?=$form->field($model, 'startDay') -> input('date'); ?>
        <?=$form->field($model, 'endDay') -> input('date'); ?>
        <?=$form->field($model, 'idAuthor'); ?>
        <?=$form->field($model, 'body') -> textarea(); ?>
        <?=$form->field($model, 'isBlocked') -> checkbox(); ?>
        <div class="form-group">
            <button class="btn btn-default" type="submit">Создать</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
