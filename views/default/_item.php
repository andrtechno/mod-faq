<?php

use panix\engine\Html;
use panix\engine\CMS;

/**
 * @var \panix\mod\faq\models\Faq $model
 * @var \yii\web\View $this
 */


?>

<div class="mt-3">
<a class="h5" data-toggle="collapse" href="#collapse-faq-<?= $model->id; ?>" role="button" aria-expanded="false"
   aria-controls="collapse-faq-<?= $model->id; ?>">
    <?= $model->question; ?>
</a>

<div class="collapse" id="collapse-faq-<?= $model->id; ?>">
    <?= $model->isText('answer'); ?>
</div>
</div>

