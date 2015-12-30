<?php
/**
 * Created by PhpStorm.
 * User: lipeng
 * Date: 2015/12/29
 * Time: 13:32
 */

namespace app\modules\mymodule\controllers;


use yii\base\Controller;

class DefaultController extends Controller
{
  public function index(){
      $this->render("index");
  }
}