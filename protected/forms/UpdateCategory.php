<?php
class UpdateCategory extends CFormModel{
	public $name;
	public $slug;
	public $des;
	public $parent;
	public $id;
	public function behaviors(){
		return array(
				'categoryBehavior'=>array(
						'class'=>'CategoryBehavior',
				),
		);
	}
	public function rules(){
		return array(
				array('name, slug, parent', 'required'),
				array('slug, name', 'length', 'max'=>250,'min'=>6),
				//array('slug','checkunique','table'=>Category::model()->tableName()),
				array('slug','match','pattern'=>'/^[a-z0-9\-]+$/i'),
				array('des,id', 'safe'),
				array('parent','in','range'=>$this->getListIdRootCategory(true)),
		);
	}
	public function loadAll(){
		
	}
}
?>