<?php

namespace app\models\hrd;
use yii\data\ActiveDataProvider;
use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "{{%maxi_b0001}}".
 *
 * @property string $BRG_ID
 * @property string $BRG_NM
 */
class Employedata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
	 
	 
	public static function getDb()
	{
		/* Author -ptr.nov- : HRD | Dashboard I */
		return \Yii::$app->db2;  
	}
	
    public static function tableName()
    {
        return '{{%employe_data}}';
    }

	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMP_ID'], 'required'],
            [['EMP_ID'], 'string', 'max' => 10],
            [['EMP_ALAMAT'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EMP_ID' => Yii::t('app', 'EMP ID'),
            'EMP_ALAMAT' => Yii::t('app', 'ALAMAT'),
        ];
    }
	 
	 public function getFormAttribs() 
	 {
        return [
            'EMP_ID'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'EMP_ALAMAT'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter password...']],
           // 'actions'=>['type'=>Form::INPUT_RAW, 'value'=>Html::submitButton('Submit', ['class'=>'btn btn-primary'])];
        ];
    }   
	
     
}


