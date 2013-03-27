<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

$this->widget("ext.showFlash.ShowFlash");
?>

<?php 
$this->widget("ext.chooseCategory.ChooseCategory",array(
'name'=>'aaa',
'model'=>Category::model(),
'subClass'=>'chooseCategory',
		'list'=>array(1,3,5,7,8),
));
?>
