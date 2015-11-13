<?php 
class apisdk{
    //开放平台key
    public $openKey = "";
    //远程获取数据方法 post or get
    public $method = "post";
    //返回数据格式 xml or json
    public $returnType = "json";
    //数据服务器 url
    public $host = "http://api.tietuku.com/v2";
    /**
     * 构造函数
     * @param [type] $openkey    开放平台key
     * @param string $method     远程获取数据方法 post or get
     * @param string $returntype 返回数据格式 xml or json
     */
    function __construct($openkey,$method="post",$returntype="json"){
        if($openkey == ''){
            return false;
        }
        $this->openKey = $openkey;
        $this->method = $method;
        $this->returnType = $returntype;
    }
    /**
     * 获取用户收藏的图片
     * @param  Array $param 参数数组
     * $param['p'] = 1;//页码
     * @return String   
     */
    public function getLovePic($param){
        $url = "/Api/getlovepic/";
        return $this->getData($url,$param);
    }
    /**
     * 获取某个图片的详细信息
     * @param  Array $param 参数数组 
     * $param['pid'] = 13508;
     * $param['findurl'] = "506868fbe740c632";
     * pid 和 findurl 必须有一个 ,二者共存的情况下 findurl 有效
     * @return String       
     */
    public function getOnePic($param){
        $url = "/Api/getonepic/";
        return $this->getData($url,$param);
    }
    /**
     * 获取最新图片数据
     * @param  Array $param  参数数组
     * $param['p'] = 1;//页码
     * $param['cid'] = 1;//图片分类id 
     * @return String       
     */
    public function getNewPic($param){
        $url = "/Api/getnewpic/";
        return $this->getData($url,$param);
    }
    /**
     * 随机获取图片30张
     * @return String        
     */
    public function getRandRec(){
        $url = "/Api/getrandrec/";
        return $this->getData($url);
    }
    /**
     * 获取用户自己的图片列表
     * @param  Array $param 参数数组
     * $param['aid'] = 18214;//相册ID 如果不填 将返回用户所有相册中的图片
     * $param['p'] = 1; //页码
     * @return String 
     */
    public function getPicList($param){
        $url = "/Api/getpiclist/";
        return $this->getData($url,$param);
    }
    /**
     * 获取相册列表
     * @param  Array $param 参数数组
     * $param['p'] = 1; //页码
     * @return String
     */
    public function getAlbum($param){
        $url = "/Api/getalbum/";
        return $this->getData($url,$param);
    }
    /**
     * 获取图片分类
     * @return String 
     */
    public function getCatalog(){
        $url = "/Api/getcatalog/";
        return $this->getData($url);
    }
    /**
     * 
     * @param  [type] $url   module/action
     * @param  array  $param 参数数组
     * @return String
     */
    private function getData($url,$param=array()){
        $param['returntype'] = $this->returnType;
        $param['key'] = $this->openKey;
        $url = $this->host.$url;
        return ($this->method=="post")?$this->getDataByPost($url,$param):$this->getDataByGet($url,$param);
    }
    /**
     * 通过Get方式获取数据
     * @param  String $url   API地址
     * @param  Array $param 参数数组
     * @return String     
     */
    private function getDataByGet($url,$param){
        $urlstr = http_build_query($param);
        $geturl = str_replace(array("=","&"),array("/","/"), $urlstr);
        $output = file_get_contents($url.$geturl);
        return $output;
    }
    /**
     * 通过POST方式
     * @param  String $url   API地址
     * @param  Array $param 参数数组
     * @return String
     */
    private function getDataByPost($url,$param){
        $urlstr = http_build_query($param);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $urlstr);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

?>