<?php
//专门做查询用的
namespace app\models;

use Yii;
use yii\base\Model;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use app\models\Gorder;
use yii\helpers\ArrayHelper;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class GorderSearch extends Gorder
{
    public function attributes()
    {
        // 添加关联字段到可搜索属性集合
        return array_merge(parent::attributes(),
            ['users.telephone'],
            ['users.create_time'],
            ['users.id'],
            ['users.email']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid'], 'integer'],
            [['gordernumber',
                'gototal',
                'create_time',
                'pay_time',
                'finish_time',
                'address',
                'gostatus',
                'users.telephone',
                'users.create_time',
                'users.id',
                'users.email',
            ], 'safe'],
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
        $query = Gorder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//        error_log(print_r($query->from(['users1'=>'kxw_gorder']),1));
        //from(['users'=>'kxw_users']） users 是 表kxw_users的别名
        $query->joinWith(['users'=>function($query){$query->from(['users'=>'kxw_users']);}]);

        // 使得关联字段可以排序
        $dataProvider->sort->attributes['users.telephone'] = [
            'asc' => ['users.telephone' => SORT_ASC],
            'desc' => ['users.telephone' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['users.create_time'] = [
            'asc' => ['users.create_time' => SORT_ASC],
            'desc' => ['users.create_time' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['users.id'] = [
            'asc' => ['users.id' => SORT_ASC],
            'desc' => ['users.id' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['users.email'] = [
            'asc' => ['users.email' => SORT_ASC],
            'desc' => ['users.email' => SORT_DESC],
        ];
        $this->load($params); //从参数的数据中加载过滤条件

        if (!$this->validate()) { //验证
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
            ->andFilterWhere(['like', 'kxw_gorder.create_time', $this->create_time])
            ->andFilterWhere(['like','users.telephone',$this->getAttribute('users.telephone')])
            ->andFilterWhere(['like','users.create_time',$this->getAttribute('users.create_time')]);
        return $dataProvider;
    }
    public function gostatus(){
        return ['代付款','待发货','待评价'];
    }
}
