<?php
/**
 * @var \yii\web\View $this
 * @var array $jobs
 */
use yii\helpers\Html;

$styles = [
    'unknown' => 'default',
    'waiting' => 'info',
    'reserved' => 'warning',
    'done' => 'success',
];
?>
<h1>Лог выполнения для текущего пользователя <?= count($data) ?></h1>

<?php foreach ($data as $job): ?>
    
     <?php print_r($job)?>
<?php endforeach; ?>
<?php
$this->registerCss(
<<<'CSS'

.panel > .table th {
    width: 25%;
}

CSS
);
