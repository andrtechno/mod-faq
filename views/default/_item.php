<?php

use panix\engine\Html;
use panix\engine\CMS;

/**
 * @var \panix\mod\faq\models\Faq $model
 * @var \yii\web\View $this
 */


?>
<div class="faq">
    <div class="faq-header" data-toggle="collapse" data-target="#faq-<?= $index; ?>"
         aria-expanded="false" aria-controls="faq-<?= $index; ?>" id="heading<?= $index; ?>">
        <?= $model->question; ?>
<span class="faq-indicator"></span>
    </div>

    <div id="faq-<?= $index; ?>" class="collapse" aria-labelledby="heading<?= $index; ?>" data-parent="#accordion">
        <?= $model->isText('answer'); ?>
    </div>
</div>


