<?php

/**
 * This is the model class for table "diag_hiv".
 *
 * The followings are the available columns in table 'diag_hiv':
 * @property string $id
 * @property string $patient_id
 * @property string $name
 * @property integer $age
 * @property string $sex
 * @property string $address
 * @property string $referred_by
 * @property string $sample_type
 * @property string $method_used
 * @property string $result
 * @property string $remarks
 * @property string $date_requested
 * @property string $date_sample_collection
 * @property string $date_received
 * @property string $date_released
 * @property string $date_created
 * @property string $date_updated
 * @property string $created_by_userid
 * @property string $licenseno
 */
class DiagHiv extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiagHiv the static model class
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
		return 'diag_hiv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('age', 'numerical', 'integerOnly'=>true),
			array('patient_id, created_by_userid', 'length', 'max'=>20),
			array('name, sex, referred_by, sample_type, method_used, result, licenseno', 'length', 'max'=>50),
			array('address, remarks, date_requested, date_sample_collection, date_received, date_released, date_created, date_updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, patient_id, name, age, sex, address, referred_by, sample_type, method_used, result, remarks, date_requested, date_sample_collection, date_received, date_released, date_created, date_updated, created_by_userid, licenseno', 'safe', 'on'=>'search'),
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
			'patient_id' => 'Patient',
			'name' => 'Name',
			'age' => 'Age',
			'sex' => 'Sex',
			'address' => 'Address',
			'referred_by' => 'Referred By',
			'sample_type' => 'Sample Type',
			'method_used' => 'Method Used',
			'result' => 'Result',
			'remarks' => 'Remarks',
			'date_requested' => 'Date Requested',
			'date_sample_collection' => 'Date Sample Collection',
			'date_received' => 'Date Received',
			'date_released' => 'Date Released',
			'date_created' => 'Date Created',
			'date_updated' => 'Date Updated',
			'created_by_userid' => 'Created By Userid',
			'licenseno' => 'Licenseno',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('patient_id',$this->patient_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('referred_by',$this->referred_by,true);
		$criteria->compare('sample_type',$this->sample_type,true);
		$criteria->compare('method_used',$this->method_used,true);
		$criteria->compare('result',$this->result,true);
		$criteria->compare('remarks',$this->remarks,true);
		$criteria->compare('date_requested',$this->date_requested,true);
		$criteria->compare('date_sample_collection',$this->date_sample_collection,true);
		$criteria->compare('date_received',$this->date_received,true);
		$criteria->compare('date_released',$this->date_released,true);
		$criteria->compare('date_created',$this->date_created,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('created_by_userid',$this->created_by_userid,true);
		$criteria->compare('licenseno',$this->licenseno,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}