<?php

/*
 * @property string $id
 * @property string $patient_id
 * @property string $name
 * @property integer $age
 * @property string $requesting_physician
 * @property string $result_no
 * @property string $date_ordered
 * @property string $date_received
 * @property string $date_released
 * @property string $rapid_antigen_test
 * @property string $date_created
 * @property string $date_updated
 * @property string $created_by_userid
 * @property string $licenseno
 *
 * The followings are the available model relations:
 * @property Patient $patient
 */
class DiagRapidantigentestsaliva extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiagUrinalysis the static model class
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
		return 'diag_rapidantigentest_saliva';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requesting_physician', 'required'),
			array('age', 'numerical', 'integerOnly'=>true),
			array('name, requesting_physician, result_no, date_ordered, date_received, date_released, rapid_antigen_test, licenseno', 'length', 'max'=>250),
			array('patient_id, created_by_userid', 'length', 'max'=>20),
            array('date_created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, age, requesting_physician, result_no, date_ordered, date_received, date_released, licenseno', 'safe', 'on'=>'search'),
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
			'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'patient_id' => 'Patient ID',
			'name' => 'Full Name',
			'age' => 'Age',
			'sex' => 'Sex',
			'patient_birthdate' => 'Birthdate',
			'requesting_physician' => 'Physician',
			'result_no' => 'Result No.',
            'date_ordered' => 'Date Ordered',
            'date_received' => 'Date Received',
            'date_released' => 'Time Released',
            'rapid_antigen_test' => 'Rapid Antigen Test',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'created_by_userid' => 'Created By',
            'licenseno' => 'License No'
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
		$criteria->compare('requesting_physician',$this->requesting_physician,true);
		$criteria->compare('result_no',$this->result_no,true);
        $criteria->order='id desc';  

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}
