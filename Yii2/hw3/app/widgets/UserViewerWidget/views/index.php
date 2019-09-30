<?php

/* @var $this */
/* @var $users  */

use \app\widgets\UserViewerWidget\assets\UserViewerAsset;
use \yii\web\View;
UserViewerAsset::register($this);
?>
<strong>Это виджет
</strong>
<pre>
    <?=print_r($users);?>
</pre>