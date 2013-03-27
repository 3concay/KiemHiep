<?php
class ChooseCategory extends CWidget{
	public $model;
	public $name;
	public $subClass;
	public $list;
	private $checkBoxName;
	private $checkBoxId;
	private $rootCategory;
	public function init(){
		if(!$this->model or !$this->name){
			throw new CException('model and name must be set');
		}
		$this->checkBoxName = get_class($this->model)."[".$this->name."][]";
		$this->checkBoxId = get_class($this->model)."_".$this->name;
		$this->attachBehavior('categoryBehavior', array('class'=>'CategoryBehavior'));
	}
	public function run(){
		echo "<div class='chooseCategory'>";
		$this->rootCategory = $this->getRootCategory();
		foreach($this->rootCategory as $rootCategoryKey =>$rootCategoryVal){
			echo '<p>'.CHtml::checkBox($this->checkBoxName,$this->compare($rootCategoryVal['id']),array('value'=>$rootCategoryVal['id'])).$rootCategoryVal['name'].'</p>';
			$subCategory = $this->getSubClass($rootCategoryVal['id']);
			foreach ($subCategory as $subCategoryKey =>$subCategoryVal){
				echo "<p class='{$this->subClass}'>".CHtml::checkBox($this->checkBoxName,$this->compare($subCategoryVal['id']),array('value'=>$subCategoryVal['id'])).$subCategoryVal['name'].'</p>';
			}
		}
		echo "</div>";
	}
	public function compare($id){
		foreach($this->list as $key=>$val){
			if($val==$id) return true;
		}
		return false;
	}
}