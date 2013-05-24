<?php
/* @var $this BannsRecordsController */
/* @var $model BannsRecord */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'groom_name'); ?>
		<?php echo $form->textField($model,'groom_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'groom_parent'); ?>
		<?php echo $form->textField($model,'groom_parent',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'groom_parish'); ?>
		<?php echo $form->textField($model,'groom_parish',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bride_name'); ?>
		<?php echo $form->textField($model,'bride_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bride_parent'); ?>
		<?php echo $form->textField($model,'bride_parent',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bride_parish'); ?>
		<?php echo $form->textField($model,'bride_parish',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'banns_dt1'); ?>
		<?php echo $form->textField($model,'banns_dt1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'banns_dt2'); ?>
		<?php echo $form->textField($model,'banns_dt2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'banns_dt3'); ?>
		<?php echo $form->textField($model,'banns_dt3'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->