<?php
/* @var $this ConfirmationRecordsController */
/* @var $model ConfirmationRecord */

$this->breadcrumbs=array(
       'Registers' => array('site/page', 'view' => 'registers'),
	'Confirmation Records'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ConfirmationRecord', 'url'=>array('index')),
	array('label'=>'Create ConfirmationRecord', 'url'=>array('create')),
	array('label'=>'View ConfirmationRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ConfirmationRecord', 'url'=>array('admin')),
	array('label'=>'View Certificates', 'url'=>array('/confirmationCertificate/byRecord', 'id'=>$model->id))
);
?>

<h1>Update ConfirmationRecord <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>