<?php

namespace sinelnikof88\abac\migrations;

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200127_040731_create_target_rule
 */
class m200127_040733_renameColumn extends Migration {

    public function init() {
        $this->db = 'abac';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->renameColumn('policy_action', 'rule_id', 'policy_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->renameColumn('policy_action', 'policy_id', 'rule_id');
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
