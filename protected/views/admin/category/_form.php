<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-_form-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Nội Dung Có Dấu <span class="required">*</span> Là Bắt Buộc.</p>
	<?php $this->widget('ext.showFlash.ShowFlash');?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>40)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php $this->widget('ext.toSlug.ToSlug',array('model'=>$model,"source"=>'name','target'=>'slug'));?>
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>40)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->dropDownList($model,"parent",CHtml::listData($model->getRootCategory(true),'id', 'name')); ?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'des'); ?>
		<?php echo $form->textArea($model,'des',array('cols'=>40,'rows'=>10)); ?>
		<?php echo $form->error($model,'des'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord?"Thêm mới":"Cập Nhật"); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->