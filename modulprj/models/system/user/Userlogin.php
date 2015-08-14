<?php

namespace app\models\system\user;
use app\models\hrd\Employe;
use kartik\builder\Form;
use modulprj\models\hrd\Karyawan;
use Yii;

class Userlogin extends \yii\db\ActiveRecord
{
	
	 public static function getDb()
	{
		/* Author -ptr.nov- : HRD | Dashboard I */
		return \Yii::$app->db1;  
	}
	
    public static function tableName()
    {
        return '{{wnd_admin.user}}';
    }

    public function rules()
    {
        return [
            [['id','username','auth_key','password_hash'], 'required'],
			[['username','auth_key','password_hash','password_reset_token','KAR_ID'], 'string'],
            [['email','avatar','avatarImage'], 'string'],
			[['id','status','created_at','updated_at'],'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'User.ID'),
            'username' => Yii::t('app', 'Username'),
			'auth_key' => Yii::t('app', 'AuthKey'),
			'password_hash' => Yii::t('app', 'Password Hash'),
			'password_reset_token' => Yii::t('app', 'Reset Password'),
			'email' => Yii::t('app', 'Email'),
			'EMP_ID' => Yii::t('app', 'Employe.ID'),
			'created_at' => Yii::t('app', 'Created'),
			'updated_at' => Yii::t('app', 'Update'),
			'avatar' => Yii::t('app', 'Avatar'),
			'avatarImage' => Yii::t('app', 'Avatar Image'),
        ];
    } 
	public function getEmp()
	{
		return $this->hasOne(Karyawan::className(), ['KAR_ID' => 'EMP_ID']);
	}

	
     
}


