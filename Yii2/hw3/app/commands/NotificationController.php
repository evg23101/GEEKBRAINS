<?php


namespace app\commands;


use app\components\contacts\Notification;
use app\components\NotificationComponent;
use yii\console\Controller;

class NotificationController extends Controller
{
    public $name;
    public function options($actionID)
    {
        return ['name'];
    }

    public function optionAliases()
    {
        return [
            'n'=>'name'
        ];
    }

    public function actionTest()
    {
        echo 'test'.PHP_EOL;
        echo 'name php'.$this->name.PHP_EOL;
    }

    public function actionNotification()
    {
        $activies=\Yii::$app->activity->getActivityTodayUseNotification();
        echo count($activies).PHP_EOL;

        /** @var @var NotificationComponent $notif */
        $notif = \Yii::$container->get(Notification::class);
        $notif->sendNotification($activies);
    }
}