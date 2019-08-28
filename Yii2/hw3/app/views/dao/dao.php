<?php

use app\widgets\UserViewerWidget\UserViewerWidget;
use app\widgets\UserViewsWidget\UserViewsWidget;
use yii\web\View;


/** @var UserViewerWidget */
/* @var $this View */
/* @var $users array */
echo UserViewerWidget::widget(['users'=>$users]);
?>
<div class="row">
<!--    <div class="col-md-6">-->
<!--        <pre>-->
<!--            --><?//=print_r($users);?>
<!--        </pre>-->
<!--    </div>-->

    <div class="col-md-6">
        <pre>
            <?=print_r($activityUser);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?=print_r($activity);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?php echo ($count);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?php foreach ($reader  as $value):?>
                <?=print_r($value);?>
            <?php endforeach;?>
        </pre>
    </div>
</div>