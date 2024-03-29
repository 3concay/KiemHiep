<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $id
 * @property integer $name
 * @property string $slug
 * @property string $des
 * @property integer $created
 * @property integer $parent
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('name, slug, parent', 'required'),
				array('created, parent', 'numerical', 'integerOnly'=>true),
				array('slug,name', 'length', 'max'=>250,'min'=>6),
				array('slug','unique'),
				array('parent','in','range'=>$this->getListIdRootCategory(true)),
				array('slug','match','pattern'=>'/^[a-z0-9\-]+$/i'),
				array('des', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, name, slug, des, created, parent', 'safe', 'on'=>'search'),
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
	public function behaviors(){
		return array(
				'categoryBehavior'=>array(
						'class'=>'CategoryBehavior',
				),
				'timestampBehavior'=>array(
						'class'=>'TimestampBehavior',
						'created'=>'created'
				)
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
				'des' => 'Des',
				'created' => 'Created',
				'parent' => 'Parent',
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
		$criteria->compare('name',$this->name);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('des',$this->des,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('parent',$this->parent);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}