<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\Users */
$this->title = 'Регистрация';
?>
<h1><?=$this->title?></h1>
<div class="row">
    <div class="col-md-6">
        <?php $form=\yii\bootstrap\ActiveForm::begin()?>
        <?=$form->field($model,'email')?>
        <?=$form->field($model,'password')?>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Регистрация</button>
        </div>
        <?php $form=\yii\bootstrap\ActiveForm::end();?>
    </div>
</div>
