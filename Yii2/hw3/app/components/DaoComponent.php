<?php


namespace app\components;


use app\base\BaseComponent;
use yii\base\Component;
use yii\db\Connection;
use yii\db\Query;

class DaoComponent extends BaseComponent
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

    public function getActivityUser($user_id)
    {
        $sql = 'select * from activity where user_id=:user';
        return $this->getDb()->createCommand($sql, [':user' => $user_id])->queryAll();
    }

    public function getActivityAny()
    {
        $query = new Query();
        $data = $query->from('activity')
            ->select(['id', 'title'])
            ->andWhere(['user_id' => 2])
            ->orderBy(['startDay' => SORT_DESC])
            ->limit(2)
            ->createCommand()->queryOne();
        return $data;
    }

    public function getReaderActivity(){
        $query = new Query();
        $data = $query->from('activity')
            ->createCommand()->query();
        return $data;
    }

    public function getCountActivity()
    {
        $query = new Query();
        $data = $query->from('activity')
            ->select('count(id) as cnt')
            ->scalar($this->getDb());
        return $data;
    }

    public function inserts(){
//        $this->getDb()->transaction(function(){
//            $this->getDb()->createCommand()
//                ->update('users',['email'=>'emai@email.ru'],['id'=>1])
//                ->execute();
//        });
        $trans=$this->getDb()->beginTransaction();
        try{
            $this->getDb()->createCommand()
                ->update('users',['email'=>'emai@email.ru'],['id'=>1])
                ->execute();
            throw new \Exception('err');
            $this->getDb()->createCommand()
                ->update('users',['email'=>'email@email.ru'],['id'=>2])
                ->execute();
            $trans->commit();
        }catch (\Exception $e){
            $trans->rollBack();
        }
    }
}