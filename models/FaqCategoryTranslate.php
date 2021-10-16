<?php

namespace panix\mod\faq\models;

use yii\db\ActiveRecord;

/**
 * Class FaqCategoryTranslate
 * @package panix\mod\faq\models
 *
 * @property array $translationAttributes
 */
class FaqCategoryTranslate extends ActiveRecord
{

    public static $translationAttributes = ['name'];

    public static function tableName()
    {
        return '{{%faq_categories_translate}}';
    }

}
