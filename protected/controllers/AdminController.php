<?php

class AdminController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
	// return the filter configuration for this controller, e.g.:
	return array(
			'inlineFilterName',
			array(
					'class'=>'path.to.FilterClass',
					'propertyName'=>'propertyValue',
			),
	);
	}

	public function actions()
	{
	// return external action classes, e.g.:
	return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
					'class'=>'path.to.AnotherActionClass',
					'propertyName'=>'propertyValue',
			),
	);
	}
	*/
	public function loadModel($id,$type){
		return CActiveRecord::model($type)->findByPk($id);
	}
	public function actionAddCategory()
	{
		$model=new Category;
		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->validate())
			{
				if($model->save(false)){
					Yii::app()->user->setFlash("done","Thêm mới danh mục thành công");
					$this->refresh();
				}else{
					Yii::app()->user->setFlash("error","Thêm mới danh mục thất bại");
				}
			}
		}
		$this->render('category/add',array('model'=>$model));
	}
	public function actionAddProduct(){
		$model=new Product;
		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->image = CUploadedFile::getInstance($model, 'image');
			if($model->validate())
			{
				if($model->save(false)){
					Yii::app()->user->setFlash("done","Thêm mới sàn phẩm thành công");
					//$this->refresh();
				}else{
					Yii::app()->user->setFlash("error","Thêm mới sản phẩm thất bại");
				}
			}
		}
		$this->render('product/add',array('model'=>$model));
	}
	public function actionUpdateProduct($id){
		$model=$this->loadModel($id, 'product');
		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->image = CUploadedFile::getInstance($model, 'image');
			if($model->validate())
			{
				if($model->save(false)){
					Yii::app()->user->setFlash("done","Thêm mới sàn phẩm thành công");
					$this->refresh();
				}else{
					Yii::app()->user->setFlash("error","Thêm mới sản phẩm thất bại");
				}
			}
		}
		$this->render('product/add',array('model'=>$model));
	}
}