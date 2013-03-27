<?php

/**
 * This is the model class for table "{{product}}".
 *
 * The followings are the available columns in table '{{product}}':
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $created
 * @property string $image
 * @property string $des
 */
class Product extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public $listCategory;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function behaviors(){
		return array(
				'productBehavior'=>array(
						'class'=>'ProductBehavior'
				),
				'timestampBehavior'=>array(
						'class'=>'TimestampBehavior',
						'created'=>'created'
				)
		);
	}
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('name, slug', 'required'),
				array('created', 'numerical', 'integerOnly'=>true),
				array('slug, name', 'length', 'max'=>250,'min'=>6),
				array('image','file','types'=>'jpg,jpeg,gif,png','allowEmpty'=>true),
				array('slug','unique'),
				array('slug','match','pattern'=>'/^[a-z0-9\-]+$/i'),
				array('des,listCategory', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, name, slug, created, image, des', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'name' => 'Name',
				'slug' => 'Slug',
				'created' => 'Created',
				'image' => 'Image',
				'des' => 'Des',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('des',$this->des,true);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	public function beforeSave(){
		if(parent::beforeSave()){
			if($this->isNewRecord){
				if($this->image){
					$this->image = $this->uploadFile($this->image);
					return $this->image;
				}
			}else{
				$path = Yii::getPathOfAlias('webroot')."/images/products/".$this->image;
				if(unlink($path)){
					$this->image = $this->uploadFile($this->image);
					return $this->image;
				}
			}
		}
		return false;
	}
	public function afterSave(){
		$this->updateCatgeoryForProduct($this->listCategory,$this->id);
	}
}