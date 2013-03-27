<?php
class ProductBehavior extends CBehavior{
	public function uploadFile($fileUpload){
		if($fileUpload instanceof CUploadedFile){
			$ext = ".".$fileUpload->getExtensionName();
			$name = md5($fileUpload->getName().microtime()).$ext;
			$path = Yii::getPathOfAlias('webroot')."/images/products/".$name;
			if($fileUpload->saveAs($path)){
				return $name;
			}else{
				return false;
			}
		}else{
			throw new CException('fileUpload must be instance of CUploadFile class');
		}
	}
	public function getCategoriesOfProduct($id){
		$sql = "SELECT `category` from `tbl_listcategoryofproduct` where `product` = {$id}";
		return Yii::app()->db->createCommand($sql)->queryColumn();
	}
	public function insertCategoryForProduct($product,$category){
		$sql = "INSERT INTO `tbl_listcategoryofproduct`(`product`,`category`) VALUES (:product,:category)";
		$conn = Yii::app()->db->createCommand($sql);
		$conn->bindParam(":product", $product,PDO::PARAM_INT);
		$conn->bindParam(":category", $category,PDO::PARAM_INT);
		return $conn->execute();
	}
	public function updateCatgeoryForProduct($list,$id){
		$categories = $this->getCategoriesOfProduct($id);
		if($categories){
			
		}else{
			$this->addNewCategoryForProduct($list, $id);
		}
	}
	public function addNewCategoryForProduct($list,$id){
		
		foreach($list as $listKey =>$val){
			$this->insertCategoryForProduct($id, $val);
		}
	}
	public function showThumbnail($image){
		if($image){
			$path = Yii::getPathOfAlias('webroot')."/images/products/".$image;
			echo CHtml::image($path,'thumbnail');
		}
	}
}