<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_alias".
 *
 * @property integer $category_id
 * @property string $alias
 */
class CategoryAlias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_alias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'alias'], 'required'],
            [['category_id'], 'integer'],
            [['alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'alias' => 'Alias',
        ];
    }

}
