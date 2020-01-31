<?php

namespace sinelnikof88\abac\migrations;

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200127_040651_create_policy
 */
class m200127_040651_create_policy extends Migration {

    public function init() {
        $this->db = 'abac';
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function up() {
        $this->createTable('policy', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'date_create' => $this->dateTime(),
            'date_update' => $this->dateTime(),
            'is_active' => $this->integer(),
            'is_delete' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down() {
        $this->dropTable('policy');
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m200127_040651_create_policy cannot be reverted.\n";

      return false;
      }
     */
}
