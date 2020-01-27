<?php

namespace sinelnikof88\abac\migrations;

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200127_040722_create_rule
 */
class m200127_040722_create_rule extends Migration {

    public function init() {
        $this->db = 'abac';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('rule', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'class' => $this->string(),
            'date_create' => $this->dateTime(),
            'date_update' => $this->dateTime(),
            'is_active' => $this->integer(),
            'is_delete' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('rule');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m200127_040722_create_rule cannot be reverted.\n";

      return false;
      }
     */
}
