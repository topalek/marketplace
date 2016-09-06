<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "param_value".
 *
 * @property integer $id
 * @property integer $param_id
 * @property string $value
 * @property string $unit
 */
class ParamValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'param_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param_id', 'value'], 'required'],
            [['param_id'], 'integer'],
            [['value', 'unit'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param_id' => 'Param ID',
            'value' => 'Value',
            'unit' => 'Unit',
        ];
    }
}
