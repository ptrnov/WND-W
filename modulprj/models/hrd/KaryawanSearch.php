<?php
/**
 * NOTE: Nama Class harus diawali Hurup Besar
 * Server Linux 	: hurup besar/kecil bermasalah -case sensitif-
 * Server Windows 	: hurup besar/kecil tidak bermasalah
 * Author: -ptr.nov-
*/

namespace modulprj\models\hrd;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Author -ptr.nov- Employe Search
 */
class KaryawanSearch extends Karyawan
{
	 /* [1] PUBLIC ALIAS TABLE*/
	 //public $emp;
     //public $pen;
	 //public $user;
     //public $corpOne;
     //public $deptOne;
	 ///public $jabOne;
     //public $sttOne;
	
	//	[2] RELATED ATTRIBUTE JOIN TABLE
    /*
	public function attributes()
	{
		//Author -ptr.nov- add related fields to searchable attributes
		return array_merge(parent::attributes(), ['corpOne.CORP_NM','deptOne.DEP_NM','jabOne.JAB_NM','sttOne.STS_NM']);
	}
	*/

	/*	[3] FILTER */
    public function rules()
    {
        return [
            [['KAR_ID', 'KAR_NM','KAR_TGLM'], 'safe'],
			//[['KAR_ID','EMP_CORP_ID'], 'string', 'max' => 10],
			//[['corpOne.CORP_NM','deptOne.DEP_NM','jabOne.JAB_NM','sttOne.STS_NM'], 'safe'],
        ];
    }
	
	//	[4] SCNARIO
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
	
	//	[5] SEARCH dataProvider -> SHOW GRIDVIEW
    public function search($params)
    {	
		// [5.1] JOIN TABLE
		$query = Karyawan::find();
						 //->JoinWith('corpOne',true,'LEFT JOIN')
                         //->JoinWith('deptOne',true,'left JOIN')
						 //->JoinWith('jabOne',true,'left JOIN')
						 //->JoinWith('sttOne',true,'left JOIN')
						 //->where(['a0001.status' => 0]);
						 // SUB JOIN
						//$query->leftJoin(['company'=>$queryCop],'company.CORP_ID=a0001.EMP_CORP_ID');//->orderBy(['company.CORP_ID'=>SORT_ASC]);
						 //->andFilterWhere(['EMP_ID'=>'006']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		/*
		//[5.2] SHORTING
			// SORTING CORPORATE Author -ptr.nov-
			$dataProvider->sort->attributes['corpOne.CORP_NM'] = [
				'asc' => ['a0001.CORP_NM' => SORT_ASC],
				'desc' => ['a0001.CORP_NM' => SORT_DESC],
			];
			// SORTING DEPARTMENT Author -ptr.nov-
			$dataProvider->sort->attributes['deptOne.DEP_NM'] = [	
				'asc' => ['a0002.DEP_NM' => SORT_ASC],
				'desc' => ['a0002.DEP_NM' => SORT_DESC],
			];
			// SORTING JABATAN Author -ptr.nov-
			$dataProvider->sort->attributes['jabOne.JAB_NM'] = [	
				'asc' => ['a0003.JAB_NM' => SORT_ASC],
				'desc' => ['a0003.JAB_NM' => SORT_DESC],
			];
			// SORTING STATUS Author -ptr.nov-
			$dataProvider->sort->attributes['sttOne.STS_NM'] = [	
				'asc' => ['b0009.STS_NM' => SORT_ASC],
				'desc' => ['b0009.STS_NM' => SORT_DESC],
			];
			*/
		// [5.3] LOAD VALIDATION PARAMS
			//LOAD FARM VER 1
			$this->load($params);
			if (!$this->validate()) {
				return $dataProvider;
			}
			/*
			///LOAD FARM VER 2
			// if (!($this->load($params) && $this->validate()))
			//return $dataProvider;		
        */
		//[5.4] FILTER WHERE LIKE (string/integer)
			// FILTER COLUMN Author -ptr.nov-
			 $query->andFilterWhere(['like', 'KAR_ID', $this->KAR_ID])
					->andFilterWhere(['like', 'KAR_NM', $this->KAR_NM]);
        /*
					->andFilterWhere(['like', 'EMP_NM_BLK', $this->EMP_NM_BLK])
					->andFilterWhere(['like', 'b0009.STS_NM', $this->getAttribute('sttOne.STS_NM')])
					->andFilterWhere(['like', 'a0001.CORP_NM', $this->getAttribute('corpOne.CORP_NM')])
					->andFilterWhere(['like', 'a0002.DEP_NM', $this->getAttribute('deptOne.DEP_NM')])
					->andFilterWhere(['like', 'a0003.JAB_NM', $this->getAttribute('jabOne.JAB_NM')])
					->andFilterWhere(['like', 'b0009.STS_NM', $this->getAttribute('sttOne.STS_NM')]);
        */
		/*
		//[5.4] FILTER WHERE LIKE (date)
			// FILTER COLUMN DATE RANGE Author -ptr.nov-
			if(isset($this->EMP_JOIN_DATE) && $this->EMP_JOIN_DATE!=''){
				$date_explode = explode("TO", $this->EMP_JOIN_DATE);
				$date1 = trim($date_explode[0]);
				$date2= trim($date_explode[1]);
				$query->andFilterWhere(['between', 'a0001.EMP_JOIN_DATE', $date1,$date2]);
			}
	    */
        return $dataProvider;
    }
}
