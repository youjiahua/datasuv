<?php
/**
 * is_idcard
 *
 * 检验字符串是否合法的中国居民身份证号码
 *
 * @access  public
 * @param   string  $idcard
 * @return  bool
 */
function is_idcard($idcard){
    if(empty($idcard)) return FALSE;

    $area = array(11=>"北京",12=>"天津",13=>"河北",14=>"山西",15=>"内蒙古",21=>"辽宁",22=>"吉林",23=>"黑龙江",31=>"上海",32=>"江苏",33=>"浙江",34=>"安徽",35=>"福建",36=>"江西",37=>"山东",41=>"河南",42=>"湖北",43=>"湖南",44=>"广东",45=>"广西",46=>"海南",50=>"重庆",51=>"四川",52=>"贵州",53=>"云南",54=>"西藏",61=>"陕西",62=>"甘肃",63=>"青海",64=>"宁夏",65=>"新疆",71=>"台湾",81=>"香港",82=>"澳门",91=>"国外");
    //长度验证
    if(!preg_match('/^\d{17}(\d|x)$/i',$idcard) AND !preg_match('/^\d{15}$/i',$idcard)) return FALSE;
    //地区验证
    if(!array_key_exists(intval(substr($idcard,0,2)), $area)) return FALSE;
    // 15位身份证验证生日，转换为18位
    if (strlen($idcard) == 15){
        // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
        if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false){
            $century = '18';
        }else{
            $century = '19';
        }

        $sBirthday = $century.substr($idcard,6,2).'-'.substr($idcard,8,2).'-'.substr($idcard,10,2);
        try{
            $d = new DateTime($sBirthday);
        }catch(Exception $e){
            return FALSE;
        }
        $dd = $d->format('Y-m-d');
        if($sBirthday != $dd){
            return FALSE;
        }

        $idcard = substr($idcard,0,6).$century.substr($idcard,6,9); //15to18
        $Bit18 = get_verify_bit($idcard); //算出第18位校验码
        $idcard = $idcard.$Bit18;
    }
    // 判断是否大于2078年，小于1900年
    $year = substr($idcard,6,4);
    if ($year<1900 || $year>2078 ){
        return FALSE;
    }

    //18位身份证处理
    $sBirthday = substr($idcard,6,4).'-'.substr($idcard,10,2).'-'.substr($idcard,12,2);
    $d = new DateTime($sBirthday);
    $dd = $d->format('Y-m-d');
    if($sBirthday != $dd){
        return FALSE;
    }
    //身份证编码规范验证
    $idcard_base = substr($idcard,0,17);
    return strtoupper(substr($idcard,17,1)) == get_verify_bit($idcard_base);
}

// 计算身份证校验码，根据国家标准GB 11643-1999
function get_verify_bit($idcard_base){
    if(strlen($idcard_base) != 17) return FALSE;
    //加权因子
    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
    //校验码对应值
    $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4','3', '2');
    $checksum = 0;
    for ($i = 0; $i < strlen($idcard_base); $i++){
        $checksum += intval(substr($idcard_base, $i, 1)) * $factor[$i];
    }
    $mod = $checksum % 11;
    $verify_number = $verify_number_list[$mod];
    return $verify_number;
}

/**
 * 是否手机号
 */
function is_mobile($phone=''){
    return preg_match("/^1[34578]\d{9}$/", $phone) > 0;
}

/**
 * 能否被divided_by整除
 */
function divided_by($num,$divided_by){
	return  $num % $divided_by== 0;
}

