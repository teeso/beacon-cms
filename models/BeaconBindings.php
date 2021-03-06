<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "beacon_bindings".
 *
 * @property integer $id
 * @property integer $beacon_id
 * @property integer $group_id
 *
 * @property Beacons $beacon
 * @property Groups $group
 */
class BeaconBindings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'beacon_bindings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'beacon_id', 'group_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'beacon_id' => Yii::t('app', 'Beacon ID'),
            'group_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeacon()
    {
        return $this->hasOne(Beacons::className(), ['id' => 'beacon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasOne(Users::className(), ['id' => 'group_id']);
    }
}
