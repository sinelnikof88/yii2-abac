Abac access control module for Yii2
===================================
Some realisation for assign role to user

ВНИМАНИЕ!
на настоящий момент этот репозиторий заморожен,
реализация получилась неоправданно дорогой для веб приложения и слишком сложной для управления.
Возможно в будущем буду дописывать этот модуль


ATTENTION!
this repository is currently frozen,
the implementation turned out to be unreasonably expensive for a web application and too complicated to manage.
Maybe in the future I will add this module

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