<?php

/**
 * This is the model class for table "need_data".
 *
 * The followings are the available columns in table 'need_data':
 * @property integer $family_id
 * @property integer $id
 * @property integer $need_id
 * @property integer $need_value
 *
 * The followings are the available model relations:
 * @property Families $family
 * @property NeedItems $need
 */
class NeedData extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NeedData the static model class
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
		return 'need_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('family_id, need_id, need_value', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('family_id, id, need_id, need_value', 'safe', 'on'=>'search'),
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
			'family' => array(self::BELONGS_TO, 'Families', 'family_id'),
			'need' => array(self::BELONGS_TO, 'NeedItems', 'need_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'family_id' => 'Family',
			'id' => 'ID',
			'need_id' => 'Need',
			'need_value' => 'Need Value',
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

		$criteria->compare('family_id',$this->family_id);
		$criteria->compare('id',$this->id);
		$criteria->compare('need_id',$this->need_id);
		$criteria->compare('need_value',$this->need_value);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public $val_count;
}
