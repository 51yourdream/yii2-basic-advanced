<?php
//专门做查询用的
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() //情景
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
        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'uid' => $this->uid,
        ]);

        $query->andFilterWhere(['like', 'gordernumber', $this->gordernumber])
            ->andFilterWhere(['like', 'gototal', $this->gototal])
            ->andFilterWhere(['like', 'gostatus', $this->gostatus])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'create_time', $this->create_time]);

        return $dataProvider;
    }
}
