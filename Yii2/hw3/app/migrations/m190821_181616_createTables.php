<?php

use yii\db\Migration;

/**
 * Class m190821_181616_createTables
 */
class m190821_181616_createTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('activity',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(150)->notNull(),
            'startDay'=>$this->date()->notNull(),
            'endDay'=>$this->date()->notNull(),
            'body'=>$this->text(),
            'isBlocked'=>$this->boolean()->notNull()->defaultValue(0),
            'useNotification'=>$this->boolean()->notNull()->defaultValue(0),
            'email'=>$this->string(150),
            'createAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'isDeleted'=>$this->boolean()->notNull()->defaultValue(0)
        ]);

        $this->createTable('users',[
            'id'=>$this->primaryKey(),
            'email'=>$this->string(150)->notNull(),
            'password_hash'=>$this->string(150)->notNull(),
            'token'=>$this->string(150),
            'auth_key'=>$this->string(150),
            'createAt'=>$this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        $this->createIndex('userEmailUni','users','email',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
        $this->dropTable('activity');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190821_181616_createTables cannot be reverted.\n";

        return false;
    }
    */
}
