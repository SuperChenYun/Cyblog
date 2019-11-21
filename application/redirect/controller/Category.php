<?php


namespace app\redirect\controller;


use think\Controller;

class Category extends Controller
{

    public function location($sign)
    {
        $this->redirect('/category/'. $sign, [], 301);
    }

}