<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $category_id
 * @property integer $shop_id
 * @property double $price
 * @property string $img
 * @property string $url
 * @property integer $xml_id
 * @property string $code
 * @property integer $rating
 * @property integer $status
 * @property string $description
 * @property integer $brand_id
 * @property string $brand_name
 * @property integer $time_update
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'category_id', 'shop_id', 'price', 'img', 'url', 'xml_id'], 'required'],
            [['category_id', 'shop_id', 'xml_id', 'rating', 'status', 'brand_id', 'time_update'], 'integer'],
            [['price'], 'number'],
            [['brand_name','code','description'], 'string'],
            [['name', 'slug', 'img', 'url', 'code', 'brand_name'], 'string', 'max' => 255],
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
            'slug' => 'Slug',
            'category_id' => 'Category ID',
            'shop_id' => 'Shop ID',
            'price' => 'Price',
            'img' => 'Img',
            'url' => 'Url',
            'xml_id' => 'Xml ID',
            'code' => 'Code',
            'rating' => 'Rating',
            'status' => 'Status',
            'description' => 'Description',
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'time_update' => 'Time Update',
        ];
    }
    public static function getProducts($id){
        if (!$id) return false;
        $model = CategoryMarketplace::findOne($id);
        if ($model){
            $tmp = array();

            if ($model->shop_id != null){
                $tmp[] = 'shop_id ='.$model->shop_id;
            }
            if ($model->brand_id != null){
                $tmp[] = 'brand_id ='.$model->brand_id;
            }

            if ($model->category_id != null){
                $tmp[] = 'category_id ='.$model->category_id;
            }
        }
        if (count($tmp) == 1) $sql = 'SELECT * FROM product WHERE '.$tmp[0];
        $sql = 'SELECT * FROM product WHERE '.implode(' AND ',$tmp);
        $product = Product::findBySql($sql)->all();
        return $product;
    }
}
