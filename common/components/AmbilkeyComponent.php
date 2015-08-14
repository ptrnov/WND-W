<?php
/**
 * Created by PhpStorm.
 * User: ptr.nov
 * Date: 10/08/15
 * Time: 19:44
 */

namespace common\components;
use Yii;
use Yii\base\Model;
use modulprj\models\hrd\Karyawan;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


class AmbilkeyComponent extends Model {
    public function getKey_Employe(){
        //$a="asd1234";
        $sql = 'SELECT max(KAR_ID) as KAR_ID FROM karyawan WHERE CORP_ID="WAN" AND CAB_ID="DDPX"';
        $cnt= Karyawan::findBySql($sql)->one();
        $arySplit=explode('.',$cnt->KAR_ID);
        $str_id_cnt0=trim($arySplit[0]);
        $str_id_cnt1=trim($arySplit[1]);
        $str_id_cnt2=trim($arySplit[2]);
        //print_r($str_id_cnt+1);
        $id_cnt=$str_id_cnt2+1;

        /*Combine String and Digit Author: -ptr.nov- */
        //$digit=str_pad($id_cnt,4,"0",STR_PAD_LEFT);
        //$thn=date("Y");
        //$nl='LG'.'.'.$thn.'.'.$digit;
        //return $nl;
        return $str_id_cnt0 . '.' . $str_id_cnt1 . '.' . $id_cnt;
    }
} 