<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brand_alias".
 *
 * @property integer $brand_id
 * @property string $alias
 */
class BrandAlias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand_alias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'alias'], 'required'],
            [['brand_id'], 'integer'],
            [['alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'alias' => 'Alias',
        ];
    }
}
