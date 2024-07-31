<?php
use yii\db\Migration;

class m240730_065741_user_table_task extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'country_code' => $this->string(3)->notNull(),
            'mobile' => $this->string(15)->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'gender' => $this->string(1)->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}

?>