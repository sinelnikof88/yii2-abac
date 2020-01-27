<?php

namespace sinelnikof88\abac\migrations;

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200127_040731_create_target_rule
 */
class m200127_040731_create_target_rule extends Migration {

    public function init() {
        $this->db = 'abac';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('target_rule', [
            'id' => $this->primaryKey(),
            'target_id' => $this->integer(),
            'policy_id' => $this->integer(),
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
        $this->dropTable('target_rule');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m200127_040731_create_target_rule cannot be reverted.\n";

      return false;
      }
     */
}
