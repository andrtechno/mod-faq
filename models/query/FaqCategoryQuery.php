<?php

namespace panix\mod\faq\models\query;

use yii\db\ActiveQuery;
use panix\engine\traits\query\DefaultQueryTrait;
use panix\engine\traits\query\TranslateQueryTrait;

class FaqCategoryQuery extends ActiveQuery {

    use DefaultQueryTrait, TranslateQueryTrait;
}
