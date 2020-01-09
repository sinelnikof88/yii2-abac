<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<h1>Модуль Управления Доступом</h1>
<p> тут какое то описание как юзать</p>
 
Делать в моделях активквери так
<pre>
namespace common\models\basic\search;
 
class RequestQuery extends \yii\db\ActiveQuery
{...
  use \sinelnikof88\abac\components\traits\PredicateModelTrait;
  ...
}
</pre>  
 <?=
    Html::button(Yii::t('app', 'проверка базы'), [
        'class' => 'btn btn-success',
        'onclick' => '
                    $.pjax({
                        type: "GET",
                        url: "' . Url::to(['/abac/default/check-database']) . '",
                        container: "#checkDatabase",
                        push: false,
                        timeout: 10000,
                        scrollTo: false
                    })'
    ])
    ?>
<div class="box box-solid  box-info ">
   
    <?php
    Pjax::begin(['id' => 'checkDatabase', 'timeout' => 10000,
        'enablePushState' => false,
        'options' => [
            'class' => 'min-height-250',
]])
    ?>

    <?php Pjax::end() ?>


</div>