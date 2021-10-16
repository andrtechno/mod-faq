<?php

namespace panix\mod\faq\models;

use Yii;
use panix\engine\db\ActiveRecord;
use panix\mod\faq\models\query\FaqQuery;
use panix\mod\faq\models\search\FaqSearch;
use panix\mod\user\models\User;

/**
 * This is the model class for table "faq".
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $category_id
 * @property FaqCategory $category
 * @property User $user
 */
class Faq extends ActiveRecord
{

    const route = '/admin/faq/default';
    const MODULE_ID = 'faq';
    public $translationClass = FaqTranslate::class;

    public static function find()
    {
        return new FaqQuery(get_called_class());
    }

    public function getGridColumns()
    {
        return [
            'id' => [
                'attribute' => 'id',
                'contentOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'question',
                'contentOptions' => ['class' => 'text-left'],
            ],
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => new FaqSearch(),
                    'attribute' => 'created_at',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['class' => 'form-control']
                ]),
                'contentOptions' => ['class' => 'text-center'],
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->created_at, 'php:d D Y H:i:s');
                }
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'raw',
                'filter' => \yii\jui\DatePicker::widget([
                    'model' => new FaqSearch(),
                    'attribute' => 'updated_at',
                    'dateFormat' => 'yyyy-MM-dd',
                    'options' => ['class' => 'form-control']
                ]),
                'contentOptions' => ['class' => 'text-center'],
                'value' => function ($model) {
                    return Yii::$app->formatter->asDatetime($model->updated_at, 'php:d D Y H:i:s');
                }
            ],
            'DEFAULT_CONTROL' => [
                'class' => 'panix\engine\grid\columns\ActionColumn',
            ],
            'DEFAULT_COLUMNS' => [
                ['class' => 'panix\engine\grid\columns\CheckboxColumn'],
                [
                    'class' => \panix\engine\grid\sortable\Column::class,
                    'url' => ['/admin/faq/default/sortable']
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%faq}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {

        $rules = [];
        $rules[] = [['question','answer'], 'required'];
        if (Yii::$app->getModule('faq')->enableCategory) {
            $rules[] = [['category_id'], 'required'];
        }
        $rules[] = [['question', 'answer'], 'string'];
        $rules[] = [['question'], 'trim'];
        $rules[] = [['updated_at', 'created_at'], 'safe'];
        $rules[] = [['answer'], 'default'];

        return $rules;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Yii::$app->user->identityClass, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(FaqCategory::class, ['id' => 'category_id']);
    }

}
