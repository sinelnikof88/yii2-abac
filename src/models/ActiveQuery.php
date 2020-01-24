<?php

namespace sinelnikof88\abac\models;

/**
 * This is the ActiveQuery class for [[\common\models\basic\activeRecord\AccessMatrixColumns]].
 *
 * @see \common\models\basic\activeRecord\AccessMatrixColumns
 */
class ActiveQuery extends \yii\db\ActiveQuery {

    public function active() {
        return $this->andWhere('[[is_active]]=1');
    }

    /**
     * {@inheritdoc}
     * @return \common\models\basic\activeRecord\AccessMatrixColumns[]|array
     */
    public function all($db = null) {
        $this->andWhere(['is', 'is_delete', null]);
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\basic\activeRecord\AccessMatrixColumns|array|null
     */
    public function one($db = null) {
        $this->andWhere(['is', 'is_delete', null]);

        return parent::one($db);
    }

}
