<?php


namespace app\components;


use yii\base\Component;
use yii\db\Connection;

class DaoComponent extends Component
{
    public function getDB(): Connection
    {
        return \Yii::$app->db;
    }

    public function getUsers()
    {
        $sql = 'select * from users;';
        return $this->getDb()->createCommand($sql)->queryAll();
    }
}