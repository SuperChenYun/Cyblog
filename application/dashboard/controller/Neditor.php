<?php
/**
 * 迁移Neditor 配置融入ThinkPHP框架
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/3/15
 * Time: 22:41
 */

namespace app\dashboard\controller;

class Neditor
{
    /**
     * Neditor Controller
     */
    public function controller()
    {
        config('app_trace', false);
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", config("neditor.json")), true);
        $action = input('action');
        switch ($action) {
            case 'config':
                $result =  json_encode($CONFIG);
                break;

            /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                $result = $this -> actionUpload();
                break;

            /* 列出图片 */
            case 'listimage':
                $result = $this -> actionList();
                break;
            /* 列出文件 */
            case 'listfile':
                $result = $this -> actionlist();
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                $result = $this -> actionCrawler();
                break;

            default:
                $result = json_encode(array(
                    'state'=> '请求地址出错'
                ));
                break;
        }
        /* 输出结果 */
        $callback = input("callback");
        if (isset($callback)) {
            if (preg_match("/^[\w_]+$/", $callback)) {
                echo htmlspecialchars($callback) . '(' . $result . ')';
            } else {
                echo json_encode(array(
                    'state'=> 'callback参数不合法'
                ));
            }
        } else {
            echo $result;
        }
    }
}