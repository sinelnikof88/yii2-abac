Abac access control module for Yii2
===================================
Some realisation for assign role to user

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist sinelnikof88/yii2-abac "*"
```

or add

```
"sinelnikof88/yii2-abac": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \sinelnikof88\abac\AutoloadExample::widget(); ?>```

Подключение к базе
// это имя используетья в модуле
'abac' => [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=accsess',
    'username' => 'mysqlUser',
    'password' => 'MysqlPasswd',
    'charset' => 'utf8',
],

// подключение трейтов
для того что бы модель работала с придекатами нужно в поисковой модели прописать
class User  extends \yii\db\ActiveQuery
{
    use \sinelnikof88\abac\components\traits\PredicateModelTrait;
.....
}

--------------------------------
в конфиге консоли

'migrate-abac' => [
    'class' => 'yii\console\controllers\MigrateController',
    'migrationNamespaces' => ['sinelnikof88\abac\migrations'],
 ],

 ./yii migrate-abac/up
--------------------------------
 'components' => [
....
        'abac' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=accsess',
            'username' => '...user...',
            'password' => '...pass...',
            'charset' => 'utf8',
        ],
....
],


![2020-01-31_135520](https://user-images.githubusercontent.com/58765150/73518610-6235ca00-4431-11ea-886c-143734370149.png)

