<?php

namespace sinelnikof88\abac\migrations;

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200127_040700_create_policy_action
 */
class m200127_040700_create_policy_action extends Migration {

    public function init() {
        $this->db = 'abac';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('policy_action', [
            'id' => $this->primaryKey(),
            'rule_id' => $this->integer(),
            'action_id' => $this->integer(),
            'variables' => $this->json(),
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
        $this->dropTable('policy_action');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m200127_040700_create_policy_action cannot be reverted.\n";

      return false;
      }
     */
}
