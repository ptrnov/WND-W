<?php
/**
 * NOTE: Nama Class harus diawali Hurup Besar
 * Server Linux 	: hurup besar/kecil bermasalah -case sensitif-
 * Server Windows 	: hurup besar/kecil tidak bermasalah
 * Author: -ptr.nov-
*/

namespace app\models\hrd;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Author -ptr.nov- Employe Search
 */
class EmployeSearch extends Employe
{
	 /* [1] PUBLIC ALIAS TABLE*/
	 public $emp;
     public $pen;
	 public $user;
     public $corpOne;
     public $deptOne;
	 public $jabOne;
     public $sttOne;
	
	/*	[2] RELATED ATTRIBUTE JOIN TABLE*/
	public function attributes()
	{
		/*Author -ptr.nov- add related fields to searchable attributes */
		return array_merge(parent::attributes(), ['corpOne.CORP_NM','deptOne.DEP_NM','jabOne.JAB_NM','sttOne.STS_NM']);
	}
	
	/*	[3] FILTER */
    public function rules()
    {
        return [
            [['EMP_ID', 'EMP_NM','EMP_NM_BLK','EMP_JOIN_DATE'], 'safe'],
			[['EMP_ID','EMP_CORP_ID'], 'string', 'max' => 10],
			[['corpOne.CORP_NM','deptOne.DEP_NM','jabOne.JAB_NM','sttOne.STS_NM'], 'safe'],
        ];
    }
	
	/*	[4] SCNARIO */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
	
	/*	[5] SEARCH dataProvider -> SHOW GRIDVIEW */
    public function search($params)
    {	
		/*[5.1] JOIN TABLE */
		$query = Employe::find()
						 ->JoinWith('corpOne',true,'LEFT JOIN')
                         ->JoinWith('deptOne',true,'left JOIN')                        
						 ->JoinWith('jabOne',true,'left JOIN')
						  ->JoinWith('sttOne',true,'left JOIN')
						  ->where(['a0001.status' => 0]);
						 /* SUB JOIN*/
						//$query->leftJoin(['company'=>$queryCop],'company.CORP_ID=a0001.EMP_CORP_ID');//->orderBy(['company.CORP_ID'=>SORT_ASC]);
						 //->andFilterWhere(['EMP_ID'=>'006']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		/*[5.2] SHORTING */
			/* SORTING CORPORATE Author -ptr.nov-*/
			$dataProvider->sort->attributes['corpOne.CORP_NM'] = [
				'asc' => ['a0001.CORP_NM' => SORT_ASC],
				'desc' => ['a0001.CORP_NM' => SORT_DESC],
			];
			/* SORTING DEPARTMENT Author -ptr.nov-*/
			$dataProvider->sort->attributes['deptOne.DEP_NM'] = [	
				'asc' => ['a0002.DEP_NM' => SORT_ASC],
				'desc' => ['a0002.DEP_NM' => SORT_DESC],
			];
			/* SORTING JABATAN Author -ptr.nov-*/
			$dataProvider->sort->attributes['jabOne.JAB_NM'] = [	
				'asc' => ['a0003.JAB_NM' => SORT_ASC],
				'desc' => ['a0003.JAB_NM' => SORT_DESC],
			];
			/* SORTING STATUS Author -ptr.nov-*/
			$dataProvider->sort->attributes['sttOne.STS_NM'] = [	
				'asc' => ['b0009.STS_NM' => SORT_ASC],
				'desc' => ['b0009.STS_NM' => SORT_DESC],
			];
			
		/*[5.3] LOAD VALIDATION PARAMS */
			/*LOAD FARM VER 1*/
			$this->load($params);
			if (!$this->validate()) {
				return $dataProvider;
			}
			
			/*LOAD FARM VER 2*/
			// if (!($this->load($params) && $this->validate()))
			//return $dataProvider;		

		/*[5.4] FILTER WHERE LIKE (string/integer)*/
			/* FILTER COLUMN Author -ptr.nov-*/
			 $query->andFilterWhere(['like', 'EMP_ID', $this->EMP_ID])
					->andFilterWhere(['like', 'EMP_NM', $this->EMP_NM])
					->andFilterWhere(['like', 'EMP_NM_BLK', $this->EMP_NM_BLK])
					->andFilterWhere(['like', 'b0009.STS_NM', $this->getAttribute('sttOne.STS_NM')])
					->andFilterWhere(['like', 'a0001.CORP_NM', $this->getAttribute('corpOne.CORP_NM')])
					->andFilterWhere(['like', 'a0002.DEP_NM', $this->getAttribute('deptOne.DEP_NM')])
					->andFilterWhere(['like', 'a0003.JAB_NM', $this->getAttribute('jabOne.JAB_NM')])
					->andFilterWhere(['like', 'b0009.STS_NM', $this->getAttribute('sttOne.STS_NM')]);
					
		/*[5.4] FILTER WHERE LIKE (date)*/	
			/* FILTER COLUMN DATE RANGE Author -ptr.nov-*/
			if(isset($this->EMP_JOIN_DATE) && $this->EMP_JOIN_DATE!=''){
				$date_explode = explode("TO", $this->EMP_JOIN_DATE);
				$date1 = trim($date_explode[0]);
				$date2= trim($date_explode[1]);
				$query->andFilterWhere(['between', 'a0001.EMP_JOIN_DATE', $date1,$date2]);
			}
			
        return $dataProvider;
    }
	
	public function searchAll($params)
    {
        $query = Pendidikan::find()->JoinWith('emp',true,'INNER JOIN')
            ->JoinWith('user',true,'INNER JOIN');
            //->Where(['a0001.EMP_ID'=>'LG.0005']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }


    public function searchtest($params)
    {
	
		//$query = Employe::find();
		///$subquery=Pendidikan::find()->select('*');
		
	//		$query ->leftJoin(['EMP'=>$subquery], 'EMP.EMP_ID=a0001.EMP_ID');
		
		
		//$query = Pendidikan::find()->JoinWith('emp',false,'INNER JOIN')
		//			->Where(['a0001.EMP_ID'=>'LG.0005']);
		
		//$query =  self::find()->select('*')->from('a0001')->Join('INNER JOIN','a0002', 'a0002.EMP_ID=a0001.EMP_ID')->where(['a0001.EMP_ID'=>'a0002.Emp_ID']);
		
		
		//$query = Itprogramer::findOne('EMP_ID');
		//$query = Itprogramer::find()
			//->select('employe.*')
			//->leftJoin('employe_data', 'employe_data.EMP_ID = employe.EMP_ID')
			//->where(['order.status' => Order::STATUS_ACTIVE])
			//->with('employe_data')
			//->all();
			
		//echo  \yii\helpers\Json::encode($query);
		
		
	/*
		$query = Employe::find()->select('*')->from('a0001')
			->join( 'INNER JOIN', 'a0002', 'a0002.EMP_ID = a0001.EMP_ID')
			->where(['a0001.EMP_ID' => 'LG.0005']);//->all();
			//print_r($query);
		$command = $query->createCommand();
		//$data= $command->queryAll(); 
		
	*/	
		
		
		//$query = Employe::find();
		$query = Pendidikan::find()->JoinWith('emp',true,'INNER JOIN')
												->JoinWith('user',true,'INNER JOIN')
												;//->Where(['a0001.EMP_ID'=>'LG.0005']);
        $dataProvider = new ActiveDataProvider([
           'query' => $query,
        ]);
		
		//$dataProvider = new SqlDataProvider([
		//	'sql' => 'SELECT * FROM employe',
		//]);
       // $this->load($params);

       //if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
        //    return $dataProvider;
        //}

        //$query->andFilterWhere(['like', 'EMP_ID', $this->EMP_ID])
        //    ->andFilterWhere(['like', 'EMP_NM', $this->EMP_NM]);
		//echo  \yii\helpers\Json::encode($dataProvider);
        return $dataProvider;
    }
}
