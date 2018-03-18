<?php
/**
 * 迁移Neditor 配置融入ThinkPHP框架
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/3/15
 * Time: 22:41
 */

namespace app\dashboard\controller;

use app\common\NeditorTool;
use app\common\Uploader;
use think\Request;

class Neditor
{
    /**
     * Neditor Config
     * @var array
     */
    protected $CONFIG;
    /**
     * Neditor Controller
     */
    public function controller(Request $request)
    {
        config('app_trace', false);
        $this -> CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", config("neditor.json")), true);
        $action = input('action');
        switch ($action) {
            case 'config':
                $result =  json_encode($this -> CONFIG);
                break;
                /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                /* 上传视频 */
            case 'uploadvideo':
                /* 上传文件 */
            case 'uploadfile':
                $result = $this -> actionUpload($request);
                break;
            /* 列出图片 */
            case 'listimage':
                $result = $this -> actionList($request);
                break;
            /* 列出文件 */
            case 'listfile':
                $result = $this -> actionlist($request);
                break;
            /* 抓取远程文件 */
            case 'catchimage':
                $result = $this -> actionCrawler($request);
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

    /**
     * 处理上传文件
     * @param Request $request
     */
    private function actionUpload(Request $request)
    {

        /* 上传配置 */
        $base64 = "upload";
        switch (htmlspecialchars($_GET['action'])) {
            case 'uploadimage':
                $config = array(
                    "pathFormat" => $this -> CONFIG['imagePathFormat'],
                    "maxSize" => $this -> CONFIG['imageMaxSize'],
                    "allowFiles" => $this -> CONFIG['imageAllowFiles']
                );
                $fieldName = $this -> CONFIG['imageFieldName'];
                break;
            case 'uploadscrawl':
                $config = array(
                    "pathFormat" => $this -> CONFIG['scrawlPathFormat'],
                    "maxSize" => $this -> CONFIG['scrawlMaxSize'],
                    "allowFiles" => $this -> CONFIG['scrawlAllowFiles'],
                    "oriName" => "scrawl.png"
                );
                $fieldName = $this -> CONFIG['scrawlFieldName'];
                $base64 = "base64";
                break;
            case 'uploadvideo':
                $config = array(
                    "pathFormat" => $this -> CONFIG['videoPathFormat'],
                    "maxSize" => $this -> CONFIG['videoMaxSize'],
                    "allowFiles" => $this -> CONFIG['videoAllowFiles']
                );
                $fieldName = $this -> CONFIG['videoFieldName'];
                break;
            case 'uploadfile':
            default:
                $config = array(
                    "pathFormat" => $this -> CONFIG['filePathFormat'],
                    "maxSize" => $this -> CONFIG['fileMaxSize'],
                    "allowFiles" => $this -> CONFIG['fileAllowFiles']
                );
                $fieldName = $this -> CONFIG['fileFieldName'];
                break;
        }
        /* 生成上传实例对象并完成上传 */
        $up = new Uploader($fieldName, $config, $base64);

        /**
         * 得到上传文件所对应的各个参数,数组结构
         * array(
         *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
         *     "url" => "",            //返回的地址
         *     "title" => "",          //新文件名
         *     "original" => "",       //原始文件名
         *     "type" => ""            //文件类型
         *     "size" => "",           //文件大小
         * )
         */

        /* 返回数据 */
        return json_encode($up->getFileInfo());
    }

    /**
     * 列出上传的列表
     * @param Request $request
     */
    private function actionList(Request $request)
    {
        /* 判断类型 */
        switch ($_GET['action']) {
            /* 列出文件 */
            case 'listfile':
                $allowFiles = $this -> CONFIG['fileManagerAllowFiles'];
                $listSize = $this -> CONFIG['fileManagerListSize'];
                $path = $this -> CONFIG['fileManagerListPath'];
                break;
            /* 列出图片 */
            case 'listimage':
            default:
                $allowFiles = $this -> CONFIG['imageManagerAllowFiles'];
                $listSize = $this -> CONFIG['imageManagerListSize'];
                $path = $this -> CONFIG['imageManagerListPath'];
        }
        $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);

        /* 获取参数 */
        $size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
        $start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
        $end = $start + $size;

        /* 获取文件列表 */
        $path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "":"/") . $path;
        $files = NeditorTool::getfiles($path, $allowFiles);
        if (!count($files)) {
            return json_encode(array(
                "state" => "no match file",
                "list" => array(),
                "start" => $start,
                "total" => count($files)
            ));
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
            $list[] = $files[$i];
        }

        //倒序
        //for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
        //    $list[] = $files[$i];
        //}

        /* 返回数据 */
        $result = json_encode(array(
            "state" => "SUCCESS",
            "list" => $list,
            "start" => $start,
            "total" => count($files)
        ));

        return $result;
    }

    /**
     * 抓远程文件
     * @param Request $request
     */
    private function actionCrawler(Request $request)
    {

    }
}