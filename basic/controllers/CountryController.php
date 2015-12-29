<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2015/12/29
 * Time: 9:37
 */

namespace app\controllers;


use yii\data\Pagination;
use yii\web\Controller;
use app\models\Country;

class CountryController extends Controller
{
    public function actionIndex(){
        $query = Country::find();
        $pagination = new Pagination([ //分页
            'defaultPageSize'=>5,
            'totalCount'=>$query->count(),
        ]);
        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
//        error_log(print_r($countries,1));
//        error_log(print_r($pagination,1));
        return $this->render('index',[
            'countries'=>$countries,
            'pagination'=>$pagination, //分页
        ]);
    }
}