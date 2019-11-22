<?php


namespace app\redirect\controller;


use think\Controller;

class Blog extends Controller
{

    public function location($id)
    {
        $this->redirect('/article/'. $id, [], 301);
    }

}