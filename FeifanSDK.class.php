<?php
/**
 * 非凡数据接口v0.1
 * @author: sue@mikr.net
 * @date: 2018-11-22
 */

class FeifanSDK
{
    const API_KEY = '********'; //非凡数据接口Key
    const API_SECRETKEY = '********';//非凡数据接口密钥

    const URL_PNIDCARDVERIFY = 'http://www.feifandata.com/PNIdcardVerify';//身份认证接口地址;
    const URL_PNBANKVERIFY = 'http://www.feifandata.com/PNBankVerify';//银行卡认证接口地址
    const URL_PNUSERPORTRAITDATASEARCH = 'http://www.feifandata.com/PNUserPortraitDataSearch';//身份画像接口地址
    const URL_PNEDUCATIONREPORTSEARCH = 'http://www.feifandata.com/PNEducationReportSearch';//教育经历接口地址
    const URL_PNRADARREPORTSEARCH = 'http://www.feifandata.com/PNRadarReportSearch';//信贷雷达接口地址
    const URL_PNJIETIAODATASEARCH = 'http://www.feifandata.com/PNJieTiaoDataSearch';//借款借据接口地址
    const URL_PNGONGFORGETTOKEN = 'http://www.feifandata.com/PNGongForGetToken';//电商报告接口地址
    const URL_PNMOBILEREPORTSEARCH = 'http://www.feifandata.com/PNMobileReportSearch';//运营商标签版接口地址
    const URL_PNMOBILEREPORTSEARCHFORHL = 'http://www.feifandata.com/PNMobileReportSearchForHL';//运营商检黑版接口地址

    private static $_instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (null === static::$_instance) {
            self::$_instance = new FeifanSDK();
        }
        return self::$_instance;
    }

    /**
     * 身份认证接口
     * @param string $name 用户姓名
     * @param string $idcard 用户身份证号码
     * @return array|boolean
     */
    public function PNIdcardVerify($name, $idcard)
    {
        $data = array(
            'name' => $name,
            'idcard' => $idcard,
        );
        $hfsign = $this->getHfSign($data);
        $params = array(
            'api_key' => self::API_KEY,
            'hfsign' => $hfsign,
            'data' => json_encode($data),
        );
        return $this->_sendPost(self::URL_PNIDCARDVERIFY, $params);
    }

    /**
     * 银行卡认证接口
     * @param string $name 用户姓名
     * @param string $idcard 用户身份证号码
     * @param string $acc_no 银行卡号
     * @param string $phone 用户手机号码
     * @return array|boolean
     */
    public function PNBankVerify($name, $idcard, $acc_no, $phone = null)
    {
        $data = array(
            'name' => $name,
            'idcard' => $idcard,
            'acc_no' => $acc_no,
        );
        if ($phone) {
            $data['phone'] = $phone;
            $data['type'] = 'bankcardforfour';
        } else {
            $data['type'] = 'bankcardforthree';
        }

        $hfsign = $this->getHfSign($data);
        $params = array(
            'api_key' => self::API_KEY,
            'hfsign' => $hfsign,
            'data' => json_encode($data),
        );
        return $this->_sendPost(self::URL_PNBANKVERIFY, $params);
    }

    /**
     * 身份画像接口
     * @param string $phone 用户手机号码
     * @param string $name 用户姓名
     * @param string $idcard 用户身份证号码
     * @return array|boolean
     */
    public function PNUserPortraitDataSearch($phone, $name, $idcard)
    {
        $data = array(
            'phone' => $phone,
            'name' => $name,
            'idcard' => $idcard,
        );
        $hfsign = $this->getHfSign($data);
        $params = array(
            'api_key' => self::API_KEY,
            'hfsign' => $hfsign,
            'data' => json_encode($data),
        );
        return $this->_sendPost(self::URL_PNUSERPORTRAITDATASEARCH, $params);
    }

    /**
     * 教育经历接口
     * @param string $idcard 身份证号码
     * @param string $name 姓名
     * @param string $username 账号
     * @param string $password 密码
     * @param string $tradeNo 订单ID
     * @param string $message 验证码
     * @return array|boolean
     */
    public function PNEducationReportSearch($idcard, $name, $username, $password, $tradeNo = null, $message = null)
    {
        $data = array(
            'idcard' => $idcard,
            'name' => $name,
            'username' => $username,
            'password' => $password,
        );
        if ($tradeNo) {
            $data['tradeNo'] = $tradeNo;
            $data['message'] = $message;
        }
        $hfsign = $this->getHfSign($data);
        $params = array(
            'api_key' => self::API_KEY,
            'hfsign' => $hfsign,
            'data' => json_encode($data),
        );
        return $this->_sendPost(self::URL_PNEDUCATIONREPORTSEARCH, $params);
    }

    /**
     * 信贷雷达接口
     * @param string $phone 用户手机号码
     * @param string $name 用户姓名
     * @param string $idcard 用户身份证号码
     * @return array|boolean
     */
    public function PNRadarReportSearch($phone, $name, $idcard)
    {
        $data = array(
            'phone' => $phone,
            'name' => $name,
            'idcard' => $idcard,
        );
        $hfsign = $this->getHfSign($data);
        $params = array(
            'api_key' => self::API_KEY,
            'hfsign' => $hfsign,
            'data' => json_encode($data),
        );
        return $this->_sendPost(self::URL_PNRADARREPORTSEARCH, $params);
    }

    /**
     * 借条借据接口
     * @param string $phone 用户手机号码
     * @param string $name 用户姓名
     * @param string $idcard 用户身份证号码
     * @return array|boolean
     */
    public function PNJieTiaoDataSearch($phone, $name, $idcard)
    {
        $data = array(
            'phone' => $phone,
            'name' => $name,
            'idcard' => $idcard,
        );
        $hfsign = $this->getHfSign($data);
        $params = array(
            'api_key' => self::API_KEY,
            'hfsign' => $hfsign,
            'data' => json_encode($data),
        );
        return $this->_sendPost(self::URL_PNJIETIAODATASEARCH, $params);
    }

    /**
     * 电商报告接口
     * @param string $phone 用户手机号码
     * @param string $name 用户姓名
     * @param string $idcard 用户身份证号码
     * @return array|boolean
     */
    public function PNGongForGetToken($phone, $name, $idcard)
    {
        $data = array(
            'phone' => $phone,
            'name' => $name,
            'idcard' => $idcard,
        );
        $hfsign = $this->getHfSign($data);
        $params = array(
            'api_key' => self::API_KEY,
            'hfsign' => $hfsign,
            'data' => json_encode($data),
        );
        return $this->_sendPost(self::URL_PNGONGFORGETTOKEN, $params);
    }

    /**
     * 运营商标签版接口
     * @param string $phone 用户手机号码
     * @param string $name 用户姓名
     * @param string $idcard 用户身份证号码
     * @param string $password 手机服务密码
     * @param array $relation 用户身份证号码
     * @param string $sid 订单ID
     * @param string $message 验证码
     * @return array|boolean
     */
    public function PNMobileReportSearch($phone, $name, $idcard, $password = null, $relation = array(), $sid = null, $message = null)
    {
        $data = array(
            'phone' => $phone,
            'name' => $name,
            'idcard' => $idcard,
        );
        if (!empty($password)) {
            $data['password'] = $password;
        }
        if ($relation) {
            $data['relation'] = $relation;
        }
        if ($sid) {
            $data['sid'] = $sid;
            $data['message'] = $message;
        }
        $hfsign = $this->getHfSign($data);
        $params = array(
            'api_key' => self::API_KEY,
            'hfsign' => $hfsign,
            'data' => json_encode($data),
        );
        return $this->_sendPost(self::URL_PNMOBILEREPORTSEARCH, $params);
    }

    /**
     * 运营商检黑接口
     * @param string $phone 用户手机号码
     * @param string $name 用户姓名
     * @param string $idcard 用户身份证号码
     * @param string $password 手机服务密码
     * @param array $relation 用户身份证号码
     * @param string $sid 订单ID
     * @param string $message 验证码
     * @return array|boolean
     */
    public function PNMobileReportSearchForHL($phone, $name, $idcard, $password, $relation = array(), $sid = null, $message = null)
    {
        $data = array(
            'phone' => $phone,
            'name' => $name,
            'idcard' => $idcard,
        );
        if (!empty($password)) {
            $data['password'] = $password;
        }
        if ($relation) {
            $data['relation'] = $relation;
        }
        if ($sid) {
            $data['sid'] = $sid;
            $data['message'] = $message;
        }
        $hfsign = $this->getHfSign($data);
        $params = array(
            'api_key' => self::API_KEY,
            'hfsign' => $hfsign,
            'data' => json_encode($data),
        );
        return $this->_sendPost(self::URL_PNMOBILEREPORTSEARCHFORHL, $params);
    }

    /**
     * 数字签名
     * @param array $data 签名参数
     * @return string
     */
    public function getHfSign($data)
    {
        $str1 = $this->_jsonAscSort($data);
        $str2 = $this->_strAscSort(self::API_SECRETKEY);
        $str3 = md5(self::API_KEY);
        $str4 = date('Y-m-d');
        return md5($str1 . $str2 . $str3 . $str4) . '==';
    }

    private function _strAscSort($str)
    {
        if (!empty($str) && is_string($str)) {
            $strArr = str_split($str);
            sort($strArr);
            return implode('', $strArr);
        }
        return false;
    }

    private function _jsonAscSort($arr)
    {
        if (is_array($arr)) {
            $json = json_encode($arr);
            return $this->_strAscSort($json);
        }
        return false;
    }


    private function _sendPost($url, $params)
    {
        $temps = array();
        foreach ($params as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if (!isset($url_info['port']) || $url_info['port'] == '') {
            $url_info['port'] = 80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader .= "Host:" . $url_info['host'] . "\r\n";
        $httpheader .= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader .= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader .= "Connection:close\r\n\r\n";
        $httpheader .= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets .= fread($fd, 128);
        }
        fclose($fd);
        if (empty($gets)) {
            return false;
        }
        return json_decode($gets, true);
    }
}


