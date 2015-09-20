<?php  

    /**
     * [str_repair description] 字符串前后填补函数
     * @param  [type] $str         [要填补的字符串]
     * @param  string $directing [方向]  默认右
     * @param  string $t         [填补的内容]
     * @param  string $length         [完成后的长度]
     * @return [string]  
     */
    function str_repair($str,$length,$directing="right",$t='0')
    {
            $len = strlen($str);
            if($len>=$length) return $str;
            if($directing != "right")
            {
                return str_pad($str,$length,$t,STR_PAD_LEFT);
            }
            return str_pad($str,$length,$t,STR_PAD_RIGHT);

    }

    echo  str_repair($a='223333',10+6,'left');

?>