<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\maxi\Maxiprodak */
/* add Menu Author: -ptr.nov-*/
$this->mddPage = 'admin';
//$this->title = Yii::t('app', 'Create Maxiprodak');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Employe'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="margin-top: 0px">
     <div class="panel-body">
		<h1><?= Html::encode($this->title) ?></h1>

		<?= $this->render('_form', [
			'model' => $model,
		]) ?>
	</div>
</div>
