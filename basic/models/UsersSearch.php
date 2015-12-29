<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_type'], 'integer'],
            [['telephone', 'email', 'password', 'create_time', 'equipment_id', 'login_time', 'client_type', 'token'], 'safe'],
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
        $query = Users::find();

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
            'user_type' => $this->user_type,
        ]);

        $query->andFilterWhere(['like', 'telephone', $this->telephone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'create_time', $this->create_time])
            ->andFilterWhere(['like', 'equipment_id', $this->equipment_id])
            ->andFilterWhere(['like', 'login_time', $this->login_time])
            ->andFilterWhere(['like', 'client_type', $this->client_type])
            ->andFilterWhere(['like', 'token', $this->token]);

        return $dataProvider;
    }
}
