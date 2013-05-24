<?php
/* @var $this DeathCertificateController */
/* @var $model DeathCertificate */

$this->breadcrumbs=array(
	'Death Certificates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeathCertificate', 'url'=>array('index')),
	array('label'=>'Create DeathCertificate', 'url'=>array('create')),
	array('label'=>'View DeathCertificate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DeathCertificate', 'url'=>array('admin')),
);
?>

<h1>Update DeathCertificate <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>