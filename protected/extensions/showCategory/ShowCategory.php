<?php
class ShowCategory extends CWidget{
	public $link;
	public $id;
	public $class;
	public $subClass;
	private $rootCategory;
	public function init(){
		if(!$this->link){
			throw new CException("link must be set");
		}
		$this->attachBehavior('categoryBehavior', array('class'=>'CategoryBehavior'));
		$this->rootCategory = $this->getRootCategory();
	}
	public function run(){
		if($this->rootCategory){
			echo "<div class='{$this->class}' id='{$this->id}'>";
			foreach($this->rootCategory as $rootKey =>$rootVal){
				echo "<li>";
				echo "<a href='".Yii::app()->createUrl($this->link,array('slug'=>$rootVal['slug']))."' title='{$rootVal['name']}'>";
				echo $rootVal['name'];
				$subClass = $this->getSubClass($rootVal['id']);
				if($subClass){
					echo "<ul class='{$this->subClass}'>";
					foreach($subClass as $subClassKey =>$subClassVal){
						echo "<li>";
						echo "<a href='".Yii::app()->createUrl($this->link,array('slug'=>$subClassVal['slug']))."' title='{$subClassVal['name']}'>";
						echo $subClassVal['name'];
						echo "</a>";
						echo "</li>";
					}
					echo "</ul>";
				}
				echo "</a>";
				echo "</li>";
			}
			echo "</div>";
		}
	}
	
}