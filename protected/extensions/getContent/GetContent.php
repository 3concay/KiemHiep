<?php
class GetContent extends CWidget{
	public $model;
	public $attribute;
	public $actionLink;
	private $attId;
	private $table;
	public function init(){
		if(!$this->model or !$this->attribute){
			throw new CException("model and attribute must be set");
		}
		$this->table = CActiveRecord::model(get_class($this->model))->tableName();
		$this->attId = get_class($this->model)."_".$this->attribute;
	}
	
}