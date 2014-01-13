<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
/* @var $this MassScheduleController */
/* @var $model MassSchedule */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mass-schedule-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->dropDownList($model,"language",FieldNames::values('languages')); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day'); ?>
		<?php echo $form->dropDownList($model,"day",FieldNames::values('weekdays')); ?>
		<?php echo $form->error($model,'day'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
