<?php
class AddCategory extends CFormModel{
	public $name;
	public $slug;
	public $des;
	public $parent;
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
				array('slug','unique','className'=>'Category'),
				array('slug','match','pattern'=>'/^[a-z0-9\-]+$/i'),
				array('des', 'safe'),
				array('parent','in','range'=>$this->getListIdRootCategory(true)),
		);
	}
	public function save(){
		$category = new Category();
		$category->attributes = $this->attributes;
		return $category->save(false);
	}
}