<?php
class ShowFlash extends CWidget{
	public function init(){
		Yii::app()->clientScript->registerCoreScript("jquery");
	}
	public function run(){
		foreach(Yii::app()->user->getFlashes() as $flashKey =>$flashVal){
			echo "<div class='flash-{$flashKey} flash'>";
			echo $flashVal;
			echo "</div>";
		}
	}
}