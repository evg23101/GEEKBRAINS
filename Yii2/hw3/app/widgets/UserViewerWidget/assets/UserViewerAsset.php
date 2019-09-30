<?php


namespace app\widgets\UserViewerWidget\assets;


use yii\web\AssetBundle;

class UserViewerAsset extends AssetBundle
{
    public $sourcePath='@app/widgets/UserViewerWidget/source';

    public $js=[
        'js/userViewer.js'
    ];
}