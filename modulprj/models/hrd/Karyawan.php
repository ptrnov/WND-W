<?php
/**
 * Created by PhpStorm.
 * User: ptr.nov
 * Date: 10/08/15
 * Time: 20:21
 */
namespace modulprj\models\hrd;
use Yii;
use yii\web\UploadedFil;


class Karyawan extends \yii\db\ActiveRecord{

    public $upload_file;

    /* [1] SOURCE DB */
    public static function getDb()
    {
        /* Author -ptr.nov- : HRD */
        return \Yii::$app->db1;
    }

    /* [2] TABLE SELECT */
    public static function tableName()
    {
        return '{{attpayroll.karyawan}}';
    }

    /* [3] RULE SCENARIO -> DetailView */
    public function rules()
    {
        return [
            //--Emp Identity--
            [['KAR_ID'], 'required'],
            [['KAR_ID'], 'string','max' => 13],                                 //gridview
            [['KAR_NM'], 'string', 'max' => 50],                                //gridview
            [['DEP_ID'], 'integer'],                            //JOIN TABLE    //gridview
            [['CORP_ID'], 'string'],                            //JOIN TABLE    //gridview
            [['CAB_ID'], 'integer'],                            //JOIN TABLE    //gridview
            [['LVL_ID'], 'integer'],                            //JOIN TABLE    //gridview
            [['JAB_ID'], 'integer'],                            //JOIN TABLE    //gridview
            [['KAR_STS'], 'integer'],                           //JOIN TABLE    //gridview
            [['KAR_KTP'], 'string'],
            [['KAR_ALMT'], 'string'],
            [['KAR_TLP'], 'string'],
            [['KAR_HP'], 'string'],
            [['KAR_TGL'], 'date','format' => 'yyyy-mm-dd'],
            [['KAR_AGM'], 'string'],
            [['KAR_STSK'], 'string'],
            [['KAR_TGLM'], 'date','format' => 'yyyy-mm-dd'],                    //gridview
            [['KAR_TGLK'], 'date','format' => 'yyyy-mm-dd'],                    //gridview
            [['KAR_STSP'], 'string'],
            [['KAR_MAILP'], 'string'],
            [['KAR_MAILK'], 'string'],
            //[['UPDT'], 'string'],                             //timestamp
            //--Profile--
            [['KAR_KOTA'], 'string'],
            [['KAR_TMP_LAHIR'], 'string'],
            [['KAR_TGL_LAHIR'], 'string'],
            [['KAR_JK'], 'string'],
            [['KAR_DARAH'], 'string'],
            [['KAR_PEN'], 'string'],
            //--Bank--
            [['KAR_BANK'], 'string'],
            [['KAR_NOREK'], 'string'],
            //--fasility--
            [['NPWP'], 'string'],                               //JOIN TABLE
            [['NO_JAMSOS'], 'string'],                          //JOIN TABLE
            [['PTKP_NM'], 'string'],                            //JOIN TABLE
            [['STT_ID'], 'string'],                             //JOIN TABLE
            [['JML_ANAK'], 'integer'],                           //JOIN TABLE
            [['NO_ASR'], 'string'],                             //JOIN TABLE
            [['ASR_ID'], 'string'],                             //JOIN TABLE
            [['STT_OT_DPN'], 'integer'],                         //JOIN TABLE
            [['PEN_ID'], 'integer'],                             //JOIN TABLE
            [['KAR_KET'], 'string'],                            //JOIN TABLE
            [['AGAMA_ID'], 'integer'],
            [['EMP_IMG'], 'string'],
        ];
    }

    /* [4] ATRIBUTE LABEL  -> DetailView/GridView */
    public function attributeLabels()
    {
        return [
          'KAR_ID' => Yii::t('app', 'Employee.ID'),
          'KAR_NM' => Yii::t('app', 'Name'),
          'DEP_ID' => Yii::t('app', 'Dept.'),
          'CORP_ID' => Yii::t('app', 'Corp'),
          'CAB_ID' => Yii::t('app', 'Cabang'),
          'LVL_ID' => Yii::t('app', 'OT.Level'),
          'JAB_ID' => Yii::t('app', 'Jabatan'),
          'KAR_STS' => Yii::t('app', 'Emp.Status'),
          'KAR_KTP'  => Yii::t('app', 'No.KTP'),
          'KAR_ALMT' => Yii::t('app', 'Alamat'),
          'KAR_TLP' => Yii::t('app', 'Tlp'),
          'KAR_HP' => Yii::t('app', 'Handphone'),
          'KAR_TGL'  => Yii::t('app', 'Tgl.ID'),
          'KAR_AGM' => Yii::t('app', 'Agama'),
          'KAR_STSK'  => Yii::t('app', 'Status Karyawan'),
          'KAR_TGLM' => Yii::t('app', 'Tgl.Masuk'),
          'KAR_TGLK'  => Yii::t('app', 'Tgl.Keluar'),
          'KAR_STSP' => Yii::t('app', 'Tgl.ID'),
          'KAR_MAILP' => Yii::t('app', 'Email.Kantor'),
          'KAR_MAILK' => Yii::t('app', 'Email.Pribadi'),
           //'UPDT' => Yii::t('app', 'Employee.ID'),
          'KAR_KOTA'  => Yii::t('app', 'Kota'),
          'KAR_TMP_LAHIR' => Yii::t('app', 'Tmp.Lahir'),
          'KAR_TGL_LAHIR' => Yii::t('app', 'Tgl Lahir'),
          'KAR_JK' => Yii::t('app', 'Jenis Kelamin'),
          'KAR_DARAH' => Yii::t('app', 'Daerah'),
          'KAR_PEN'  => Yii::t('app', 'Pendidikan.ID'),
           // --Bank--
          'KAR_BANK'  => Yii::t('app', 'Bank Name'),
          'KAR_NOREK' => Yii::t('app', 'Bank Reg'),
           // lain-lain
          'NPWP'  => Yii::t('app', 'NPWP'),
          'NO_JAMSOS'  => Yii::t('app', 'NO_JAMSOS'),
          'PTKP_NM'  => Yii::t('app', 'PTKP_NM'),
          'KAR_NPWP'  => Yii::t('app', 'KAR_NPWP'),
          'STT_ID'  => Yii::t('app', 'STT_ID'),
          'JML_ANAK'  => Yii::t('app', 'JML_ANAK'),
          'NO_ASR'  => Yii::t('app', 'NO_ASR'),
          'STT_OT_DPN'  => Yii::t('app', 'STT_OT_DPN'),
          'PEN_ID'  => Yii::t('app', 'PEN_ID'),
          'KAR_KET'  => Yii::t('app', 'KAR_KET'),
          'AGAMA_ID'  => Yii::t('app', 'AGAMA_ID'),
          'EMP_IMG'  => Yii::t('app', 'EMP_IMG')
        ];
    }

} 