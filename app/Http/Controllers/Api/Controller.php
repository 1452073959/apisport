<?php

namespace App\Http\Controllers\Api;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Response;
use App\Http\Controllers\Controller as BaseController;
class Controller extends BaseController
{
    use Helpers;
    /**
     * @var int

    1. 返回正确信息

    return $this->success('用户登录成功...');
    2. 返回正确资源信息

    return $this->success($user);
    3. 返回自定义 http 状态码的正确信息

    return $this->setStatusCode(201)->success('用户登录成功...');
    4. 返回错误信息

    return $this->failed('用户注册失败');
    5. 返回自定义 http 状态码的错误信息

    return $this->failed('用户登录失败',401);
    6. 返回自定义 http 状态码的错误信息，同时也想返回自己内部定义的错误码

    return $this->failed('用户登录失败',401,10001);
    默认 success 返回的状态码是 200，failed 返回的状态码是 400
     */
    protected $statusCode = FoundationResponse::HTTP_OK;
    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode,$httpCode=null)
    {
        $httpCode = $httpCode ?? $statusCode;
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {

        return Response::json($data,$this->getStatusCode(),$header);
    }

    /**
     * @param $status
     * @param array $data
     * @param null $code
     * @return mixed
     */
    public function status($status, array $data, $code = null){

        if ($code){
            $this->setStatusCode($code);
        }
        $status = [
            'status' => $status,
            'code' => $this->statusCode
        ];

        $data = array_merge($status,$data);
        return $this->respond($data);

    }

    /**
     * @param $message
     * @param int $code
     * @param string $status
     * @return mixed
     */
    /*
     * 格式
     * data:
     *  code:422
     *  message:xxx
     *  status:'error'
     */
    public function failed($message, $code = FoundationResponse::HTTP_BAD_REQUEST,$status = 'error'){

        return $this->setStatusCode($code)->message($message,$status);
    }

    /**
     * @param $message
     * @param string $status
     * @return mixed
     */
    public function message($message, $status = "success"){

        return $this->status($status,[
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function internalError($message = "Internal Error!"){

        return $this->failed($message,FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function created($message = "created")
    {
        return $this->setStatusCode(FoundationResponse::HTTP_CREATED)
            ->message($message);

    }

    /**
     * @param $data
     * @param string $status
     * @return mixed
     */
    public function success($data, $status = "success"){

        return $this->status($status,compact('data'));
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function notFond($message = 'Not Fond!')
    {
        return $this->failed($message,Foundationresponse::HTTP_NOT_FOUND);
    }
    // 其他通用的Api帮助函数

    public function HttpPost($content = null,$url='') {
        $postUrl = $url;
        $curlPost = $content;
        $ch = curl_init (); // 初始化curl
        curl_setopt ( $ch, CURLOPT_URL, $postUrl ); // 抓取指定网页
        curl_setopt ( $ch, CURLOPT_HEADER, 0 ); // 设置header
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 ); // 要求结果为字符串且输出到屏幕上
        curl_setopt ( $ch, CURLOPT_POST, 1 ); // post提交方式
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $curlPost );
        $data = curl_exec ( $ch ); // 运行curl
        curl_close ( $ch );
        return $data;
    }


    public function httpget($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko)");
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");//加入gzip解析
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }


    public function getAccessToken($appid,$appsecret)
    {
//        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET";
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret;
        $verify= json_decode($this->httpget($url),true);
        $verify= $verify['access_token'];
        return $verify;
    }
}
