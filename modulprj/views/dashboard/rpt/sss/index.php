<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\system\Dashboard */
?>
<div class="panel panel-default">
    
			<?php
			
				$content1='test ahhhhhhhhhhhhhhhhhhh';
				$items=[
					[
						'label'=>'<i class="glyphicon glyphicon-home"></i> Prodak','content'=>$content1,
						'active'=>true,
						
					],
					[
						'label'=>'<i class="glyphicon glyphicon-home"></i> Tenant','content'=>'asdasd',//$content1,
						//active'=>true
					],
					[
						'label'=>'<i class="glyphicon glyphicon-home"></i> SDM','content'=>'asdasd',//$content1,
						//active'=>true
					],
					[
						'label'=>'<i class="glyphicon glyphicon-home"></i> Seles Order','content'=>'asdasd',//$content1,
						//active'=>true
					],
					[
						'label'=>'<i class="glyphicon glyphicon-home"></i> Customer','content'=>'asdasd',//$content1,
						//active'=>true
					],
					[
						'label'=>'<i class="glyphicon glyphicon-home"></i> Asset','content'=>'asdasd',//$content1,
						//active'=>true
					],
				];	
			
			
				echo TabsX::widget([
						'items'=>$items,
						'position'=>TabsX::POS_ABOVE,
						'height'=>TabsX::SIZE_TINY,
						'bordered'=>true,
						'encodeLabels'=>false,
						'align'=>TabsX::ALIGN_LEFT,						
					]);											
				?>
</div>