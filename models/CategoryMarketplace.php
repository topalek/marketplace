<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_marketplace".
 *
 * @property integer $id
 * @property string $name
 * @property integer $shop_id
 * @property integer $category_id
 * @property integer $brand_id
 */
class CategoryMarketplace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_marketplace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['shop_id', 'category_id', 'brand_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'shop_id' => 'Shop ID',
            'category_id' => 'Category ID',
            'brand_id' => 'Brand ID',
        ];
    }
}
