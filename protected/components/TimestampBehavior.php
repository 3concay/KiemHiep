<?php
class TimestampBehavior extends CActiveRecordBehavior{
	public $created;
	public function beforeSave($event){
		$obj = $this->getOwner();
		if($obj->isNewRecord && $this->created){
			$obj->{$this->created} = time();
		}
	}
}