<?php

namespace panix\mod\faq\models\search;

use Yii;
use yii\base\Model;
use panix\engine\data\ActiveDataProvider;
use panix\mod\faq\models\Faq;
use panix\mod\faq\models\FaqTranslate;

/**
 * NewsSearch represents the model behind the search form about `panix\mod\faq\models\News`.
 */
class FaqSearch extends Faq
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['question', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Faq::find()->translate();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => self::getSort(),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'translate.question', $this->question]);
        $query->andFilterWhere(['like', 'DATE(created_at)', $this->created_at]);
        $query->andFilterWhere(['like', 'DATE(created_at)', $this->created_at]);

        return $dataProvider;
    }

    public static function getSort()
    {
        $sort = new \yii\data\Sort([
            'attributes' => [
                'created_at',
                'updated_at',
                'name' => [
                    'asc' => ['name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC],
                ],
            ],
        ]);
        return $sort;
    }
}
