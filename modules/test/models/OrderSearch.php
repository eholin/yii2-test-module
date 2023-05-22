<?php

namespace app\modules\test\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\test\models\Order;

/**
 * OrderSearch represents the model behind the search form of `app\modules\test\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['id', 'status_id'], 'integer'],
            [['created_at', 'name'], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function scenarios(): array
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
    public function search(array $params): ActiveDataProvider
    {
        $query = Order::find()->with('status');

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            ]
        );

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(
            [
                'id' => $this->id,
                'created_at' => $this->created_at,
                'status_id' => $this->status_id,
            ]
        );

        $query->andFilterWhere(['ilike', 'name', $this->name]);

        return $dataProvider;
    }
}
