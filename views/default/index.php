<?php

use panix\engine\widgets\ListView;


?>


<h1><?= $this->context->pageName; ?></h1>


<?php

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    //'layout' => '{sorter}{summary}{items}{pager}',
    'layout' => '{items}{pager}',
    'emptyText' => 'Empty',
    'options' => ['class' => 'list-view'],
    'itemOptions' => ['class' => 'item'],
    'emptyTextOptions' => ['class' => 'alert alert-info'],
    'pager' => [
        'class' => '\panix\engine\widgets\LinkPager',
        'options' => ['class' => 'pagination justify-content-center']
    ]
]);

?>
<div class="flat-tabs flat-tabs-1">
    <div class="text-center">
        <?php if (Yii::$app->getModule($this->context->module->id)->enableCategory) { ?>
            <ul class="menu-tab text-center">
                <?php
                $categories = \panix\mod\faq\models\FaqCategory::find()->published()->all();
                $faqsList = [];
                foreach ($categories as $k => $item) {
                    $active = ($k == 0) ? 'active' : '';
                    if ($item->items) {
                        $faqsList[] = $item->items;
                    }
                    ?>
                    <li class="<?= $active; ?>"><?= $item->name; ?></li>
                <?php } ?>

            </ul>
        <?php } ?>
    </div>
    <div class="content-tab">
        <?php
        //$faqsList = array_chunk($faqsList, 5);
        if (Yii::$app->getModule($this->context->module->id)->enableCategory) {

            foreach ($faqsList as $k => $faqItems) { ?>
                <div class="content-inner">
                    <div class="row">

                        <?php
                        // $faqsListChuck = array_chunk($faqsList[$k], 2);
                        ?>
                        <?php foreach ($faqItems as $faq) { ?>

                            <?php // foreach ($list as $faq) { ?>
                            <div class="col-md-6 col-sm-12">
                                <div class="questions-content">
                                    <h4 class="item-qs">
                                        <a href="#"><?= $faq->question; ?></a>
                                    </h4>
                                    <div class="item-reply">
                                        <?= $faq->answer; ?>
                                    </div>
                                </div>
                            </div>
                            <?php //} ?>

                        <?php } ?>


                    </div>
                </div>
            <?php }
        } ?>
    </div>
</div>



