<?php
class ToSlug extends CWidget{
	public $model;
	public $source;
	public $target;
	public function init(){
		if(!$this->model or !$this->source or !$this->target){
			throw new CException("model, source, target must be set");
		}
		$this->registerAssets();
		$this->source = "#".get_class($this->model)."_".$this->source;
		$this->target = "#".get_class($this->model)."_".$this->target;
	}
	public function registerAssets(){
		$cs = Yii::app()->clientScript;
		$path = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR."assets");
		$cs->registerScriptFile($path."/string.toalias.js");
		$cs->registerScriptFile($path."/jquery.toslug.js");
	}
	public function run(){
		$cs = Yii::app()->clientScript;
		$script = "$('{$this->source}').toSlug({'target':'{$this->target}'});";
		$cs->registerScript("toslug_".$this->source,$script,CClientScript::POS_READY);
	}
}
?>