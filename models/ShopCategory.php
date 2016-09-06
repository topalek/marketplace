<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_category".
 *
 * @property string $id
 * @property integer $shop_category_id
 * @property integer $shop_parent_id
 * @property integer $shop_id
 * @property string $name
 * @property integer $category_id
 *
 * @property Shop $shop
 */
class ShopCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_category_id', 'shop_parent_id', 'shop_id', 'name'], 'required'],
            [['shop_category_id', 'shop_parent_id', 'shop_id', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'shop_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_category_id' => 'Shop Category ID',
            'shop_parent_id' => 'Shop Parent ID',
            'shop_id' => 'Shop ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['shop_id' => 'shop_id']);
    }
}
