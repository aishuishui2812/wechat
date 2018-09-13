<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeXinController extends Controller {

    /**
     * 验证服务器URL以及token
     * @param Request $request
     */
    public function serverValidate(Request $request) {
        $nonce      = $request->get('nonce');
        $signature  = $request->get('signature');
        $timestamp  = $request->get('timestamp');
        $echoStr    = $request->get('echostr');

        $token      = env('WEIXIN_TOKEN');

        $wxParam = array($token, $timestamp, $nonce);
        sort($wxParam);
        $encryptStr = sha1(join($wxParam));

        if ($encryptStr == $signature && $echoStr) {
            echo $echoStr;
            exit();
        } else {
            exit("-1");
        }
    }
}