<?php


namespace app\redirect\controller;


use think\Controller;

class Tag extends Controller
{

    public function location($sign)
    {
        $this->redirect('/tags/'. $sign, [], 301);
    }

}