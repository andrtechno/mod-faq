<?php
use yii\helpers\Html;
use panix\engine\bootstrap\ActiveForm;
/**
 * @var panix\engine\bootstrap\ActiveForm $form
 * @var panix\mod\faq\models\Faq $model
 */

$form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]);
?>
<div class="card">
    <div class="card-header">
        <h5><?= Html::encode($this->context->pageName) ?></h5>
    </div>
    <div class="card-body">


        <?= $form->field($model, 'question')->textarea() ?>

        <?php if (Yii::$app->getModule('faq')->enableCategory) { ?>
            <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\panix\mod\faq\models\FaqCategory::find()->all(), 'id', 'name')) ?>
        <?php } ?>
        <?=
        $form->field($model, 'answer')->widget(\panix\ext\tinymce\TinyMce::class, [
            'options' => ['rows' => 6],
        ]);
        ?>


    </div>
    <div class="card-footer text-center">
        <?= $model->submitButton(); ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
