<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $category_id
 * @property integer $parent_id
 * @property string $name
 * @property integer $visible
 * @property integer $order
 * @property string $category_slug
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'category_slug'], 'required'],
            [['parent_id', 'visible', 'order'], 'integer'],
            [['name', 'category_slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'visible' => 'Visible',
            'order' => 'Order',
            'category_slug' => 'Category Slug',
        ];
    }

    /**
     * @return int
     */
    public function getCategory(){
        return $this->hasOne(Category::className(),['category_id'=>'parent_id']);
    }
}
