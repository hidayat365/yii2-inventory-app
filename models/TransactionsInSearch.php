<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transactions;

/**
 * TransactionsSearch represents the model behind the search form about `app\models\Transactions`.
 */
class TransactionsInSearch extends Transactions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'warehouse_id'], 'integer'],
            [['trans_code', 'trans_date', 'remarks'], 'safe'],
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
        $query = Transactions::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'trans_date' => $this->trans_date,
            'warehouse_id' => $this->warehouse_id,
            'type_id' => TransactionTypes::findOne(['code' => 'IN'])->id,
        ]);

        $query->andFilterWhere(['like', 'trans_code', $this->trans_code])
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
