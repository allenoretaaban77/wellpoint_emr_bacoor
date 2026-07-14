<?php

/**
 * @property integer $id
 * @property string $ref_id
 * @property string $user_id
 * @property string $user_name
 * @property string $update_datetime
 * @property string $details
 */
class Logs extends CActiveRecord
{

	public function tableName()
	{
		return 'logs';
	}

	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ref_id, user_id', 'length', 'max'=>20),
			array('details, user_name', 'length', 'max'=>255),
			array('update_datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ref_id, user_id, user_name, update_datetime, details', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ref_id' => 'Ref ID',
			'user_id' => 'User',
			'user_name' => 'User Name',
			'update_datetime' => 'Update Datetime',
			'details' => 'Details'
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('ref_id',$this->ref_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('update_datetime',$this->update_datetime,true);
		$criteria->compare('details',$this->details,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
