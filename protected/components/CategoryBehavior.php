<?php
class CategoryBehavior extends CBehavior{
	public function getRootCategory($root = false){
		$sql ="SELECT `id`,`name`,`slug` FROM `tbl_category` WHERE `parent` = 0";
		if($root){
			$sql .=" UNION select 0,'root','root'";
		}
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
	public function getListIdRootCategory($root = false){
		$sql ="SELECT `id` FROM `tbl_category` WHERE `parent` = 0";
		if($root){
			$sql .=" UNION select 0";
		}
		return Yii::app()->db->createCommand($sql)->queryColumn();
	}
	public function getAllById($id){
		$sql = "SELECT * FROM `tbl_category` WHERE `id` = {$id}";
		return Yii::app()->db->createCommand($sql)->query();
	}
	public function getSubClass($id){
		$sql = "SELECT `id`,`name`,`slug` FROM `tbl_category` WHERE `parent` = '{$id}'";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
	
}