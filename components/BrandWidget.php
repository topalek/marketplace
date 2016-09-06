<?php

namespace app\components;

use app\models\Category;
use app\models\Product;
use yii\base\Widget;
use Yii;

class BrandWidget extends Widget {

    public $tpl;
    public $data;
    public $prod;
    public $tree;
    public $brandHtml;


    public function run(){
        // get cache
        $brand = Yii::$app->cache->get('brand');
        if ($brand) return $brand;

//        $this->data = Category::find()->select('DISTINCT `repository`')->all();
        $this->prod = Product::find()->select('DISTINCT `vendor`')->asArray()->indexBy('vendor')->all();
//        d($this->prod);
        $this->brandHtml = $this->getBrandHtml($this->prod);

        Yii::$app->cache->set('brand',$this->brandHtml,60);
        return $this->brandHtml;

    }

    protected function getBrandHtml($brands){
        $str = "";$i =0;
        foreach ($brands as $brand) {
            if ($i == 9) $str .='<div id="brand-more">';
            if (!$brand['vendor']) continue;
            $str .= $this->brandsToTemplate($brand);
            $i++;
        }
        $str.= '</div>';

        return $str;
    }

    protected function brandsToTemplate($brand){
        ob_start();
        include __DIR__ . '/brand_tpl/brand.php';

        return ob_get_clean();
    }
}