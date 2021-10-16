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

    public function behaviors()
    {
        $b['search'] = [
            'class' => SearchBehavior::class,
            'searchScope' => function ($model) {
                /** @var FaqQuery $model */
                // $model->translate(2);
                // $model->published();
                // $model->select(['slug', 'translate.name']);
                //echo $model->createCommand()->rawSql;die;
                //  $model->andWhere(['indexed' => true]);
            },
            'searchFields' => function ($model) {
                /** @var self $model */
                $lang = Yii::$app->languageManager->getById($model->language_id)->code;
                return [
                    ['name' => 'language', 'value' => $lang, 'type' => SearchBehavior::FIELD_UNSTORED],
                    ['name' => 'title', 'value' => $model->question, 'type' => SearchBehavior::FIELD_TEXT],
                    ['name' => 'short_text', 'value' => strip_tags($model->answer)],
                    ['name' => 'text', 'value' => strip_tags($model->answer)],
                    //['name' => 'url', 'value' => Json::encode($model->item->getUrl($model->item->slug)), 'type' => SearchBehavior::FIELD_KEYWORD],
                ];
            }
        ];


        return \yii\helpers\ArrayHelper::merge($b, parent::behaviors());
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Faq::class, ['id' => 'object_id']);
    }
}
