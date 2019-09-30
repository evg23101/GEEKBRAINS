<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\DaoComponent;
use yii\filters\PageCache;

class DaoController extends BaseController
{
    public function behaviors()
    {
        return [
            ['class'=>PageCache::class,
                'only' => ['test'],
                'duration' => 10]
        ];
    }

    public function actionTest()
    {
        /** @var DaoComponent $dao */
        $dao=\Yii::$app->dao;

        $dao->inserts();
        $users = $dao->getUsers();
        $activityUsers = $dao->getActivityUser(\Yii::$app->request->get('user'));
        $acity = $dao->getActivityAny();
        $count = $dao->getCountActivity();
        $reader = $dao->getReaderActivity();
        return $this->render('dao', ['users' => $users,'activityUser' => $activityUsers,
            'activity' => $acity, 'count' => $count,'reader'=>$reader]);
    }

    public function actionCache()
    {
//        $val='value1';
//        \Yii::$app->cache->set('key1',$val);
        $val=\Yii::$app->cache->get('key1');
        $val2=\Yii::$app->cache->getOrSet('key2',function (){
            return 'value2';
        });
        echo $val2;
//        echo $val;
    }
}