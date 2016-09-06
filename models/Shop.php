<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop".
 *
 * @property integer $shop_id
 * @property string $name
 * @property string $logo
 * @property string $url
 * @property string $xml_url
 * @property string $method_xml
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'logo', 'url'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['logo', 'url','xml_url','method_xml'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shop_id' => 'Номер магазина',
            'name' => 'Название',
            'logo' => 'Ссылка на логотип',
            'url' => 'Ссылка на магазин',
            'xml_url' => 'Ссылка выгрузки',
            'method_xml' => 'Ссылка на обработчик выгрузки',
        ];
    }
}
