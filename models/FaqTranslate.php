<?php

namespace panix\mod\faq\models;

use panix\mod\faq\models\query\FaqQuery;
use app\modules\search\behaviors\SearchBehavior;
use yii\db\ActiveRecord;
use Yii;
use yii\helpers\Json;
/**
 * Class FaqTranslate
 * @package panix\mod\faq\models
 *
 * @property array $translationAttributes
 */
class FaqTranslate extends ActiveRecord
{

    public static $translationAttributes = ['question', 'answer'];

    public static function tableName()
    {
        return '{{%faq_translate}}';
    }

}
