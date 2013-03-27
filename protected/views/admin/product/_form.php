<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'product-_form-form',
			'enableAjaxValidation'=>false,
			//'enableClientValidation'=>true,
			'clientOptions'=>array(
					//'validateOnSubmit'=>true,
			),
			'htmlOptions'=>array(
		'enctype'=>'multipart/form-data')
)); ?>

	<p class="note">
		Nội Dung Có Dấu <span class="required">*</span> Là Bắt Buộc.
	</p>
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
		<?php echo $form->labelEx($model,'image'); ?>
		<?php echo $form->fileField($model,'image'); ?>
		<?php $model->showThumbnail($model->image); ?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'des'); ?>
		<?php echo $form->textArea($model,'des',array('cols'=>40,'rows'=>10)); ?>
		<?php echo $form->error($model,'des'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'listCategory'); ?>
		<?php 
		$this->widget("ext.chooseCategory.ChooseCategory",
						array(
					'model'=>$model,
					'name'=>'listCategory',
					'subClass'=>'subCategory',
					'list'=>$model->getCategoriesOfProduct(isset($model->id)?$model->id:0)
)); ?>
		<?php echo $form->error($model,'listCategory'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord?"Thêm mới":"Cập Nhật"); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form -->
