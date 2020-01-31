<?php

namespace sinelnikof88\abac\migrations;

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200127_040642_create_action
 */
class m200127_040642_create_action extends Migration {

    public function init() {
        $this->db = 'abac';
        parent::init();
    }

    // Use up()/down() to run migration code without a transaction.
    public function up() {
        $this->createTable('action', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'class' => $this->string(),
            'date_create' => $this->dateTime(),
            'date_update' => $this->dateTime(),
            'is_active' => $this->integer(),
            'is_delete' => $this->integer(),
        ]);
    }

    public function down() {
        $this->dropTable('action');
    }

}
