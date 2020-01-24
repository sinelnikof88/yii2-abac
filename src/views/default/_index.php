<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<h1>Модуль Управления Доступом</h1>

<div class="row">
    <div class="col-lg-6">
        Делать в моделях активквери так
        <pre>
namespace common\models\basic\search;
 
class RequestQuery extends \yii\db\ActiveQuery
{...
  use \sinelnikof88\abac\components\traits\PredicateModelTrait;
  ...
}
в самих запросах можно использовать :
model::find() .... ->pre()->all();
model::find() .... ->pre()->one();

$dataProvider = new ActiveDataProvider([
            'query' => model::find()->pre(),
]);

! Всегда ставить в конце запроса что бы можно выло оперировать полностью с предзапросом
        </pre>  

    </div>
    <div class="col-lg-6">
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

    </div>

</div>
