<?php

/**
 * User: Vladimir Baranov <phpnt@yandex.ru>
 * Git: <https://github.com/phpnt>
 * VK: <https://vk.com/phpnt>
 * Date: 01.09.2018
 * Time: 15:29
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

Pjax::begin([
    'id' => 'checkDatabase',
    'timeout' => 10000,
    'enablePushState' => false,
    'options' => [
        'class' => 'min-height-250',
    ]
]);
?>

<?php try { ?>

    <p> полключение установленно</p>

    <div> 
        <p>статистика:</p>
        <p>   <span>Правил :<b><?= \sinelnikof88\abac\models\Rule::find()->count() ?></b></span></p>
        <p>   <span>Политик :<b><?= \sinelnikof88\abac\models\Policy::find()->count() ?></b></span></p>
        <p>   <span>Действий :<b><?= \sinelnikof88\abac\models\Action::find()->count() ?></b></span></p>
        <p>   <span>Назначений :<b><?= \sinelnikof88\abac\models\TargetRule::find()->count() ?></b></span></p>
    </div>

<?php } catch (Exception $exc) { ?>    
    <p> Необходимо добавить abac как компонент</p>
    <pre>
        <?php
        print_r([
            'components' => [
                'abac' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=localhost;dbname=accsess',
                    'username' => '...login...',
                    'password' => '...pass...',
                    'charset' => 'utf8',
                ],
                '....'=>'[...]',
            ],
        ]);
        ?>
    </pre>
    Импорт базы
    Начать
<?php } ?>


<?php Pjax::end(); ?>