<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\DaoComponent;

class DaoController extends BaseController
{
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
}