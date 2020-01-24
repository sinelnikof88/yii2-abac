<?php
/**
 * @var \yii\web\View $this
 * @var string $url
 * @var int $count
 */
?>
<div class="yii-debug-toolbar__block">
    <a href="<?= $url ?>">
     ABAC
        <span class="yii-debug-toolbar__label yii-debug-toolbar__label_<?= $count ? 'info' : 'default' ?>">
             <?= $countAttr ?> -ролей
        </span>
        <span class="yii-debug-toolbar__label yii-debug-toolbar__label_<?= $count ? 'info' : 'default' ?>">
             <?= $countPolicy ?> -политик

        </span>
    </a>
</div>

