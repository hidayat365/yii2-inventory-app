<?php

namespace app\modules\shared\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TransactionDetailsSearch represents the model behind the search form about `app\models\TransactionDetails`.
 */
class TransactionDetailsSearch extends TransactionDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'trans_id', 'item_id'], 'integer'],
            [['quantity'], 'number'],
            [['remarks'], 'safe'],
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
        $query = TransactionDetails::find();

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
            'trans_id' => $this->trans_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}
