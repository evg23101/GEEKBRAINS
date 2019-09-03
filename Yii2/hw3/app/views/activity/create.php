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
        <div class="row">
            <div class="col-md-6">
                <?=$form->field($model, 'startDay') -> input('date'); ?>
            </div>
            <div class="col-md-6">
                <?=$form->field($model, 'endDay') -> input('date'); ?>
            </div>
        </div>
        <?=$form->field($model, 'idAuthor'); ?>
        <?=$form->field($model, 'body') -> textarea(); ?>
        <div class="row">
            <div class="col-md-4">
                <?=$form->field($model, 'isRepeated') -> checkbox(); ?>
            </div>
            <div class="col-md-8">
                <?=$form->field($model, 'repeatedType') -> dropDownList($model::REPEATED_TYPE); ?>
            </div>
        </div>
        <?=$form->field($model, 'isBlocked') -> checkbox(); ?>
        <div class="row">
            <div class="col-md-4">
                <?=$form->field($model,'useNotification')->checkbox()?>
            </div>
            <div class="col-md-8">
                <?=$form->field($model,'email',['enableAjaxValidation'=>true,'enableClientValidation'=>false]);?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?=$form->field($model,'file')->fileInput()?>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">Создать</button>
        </div>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
