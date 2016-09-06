<?php

namespace app\components;

use app\models\Category;
use app\models\Product;
use yii\base\Widget;
use Yii;
use yii\helpers\Url;

class MenuWidget extends Widget {

    public $tpl;
    public $data;
    public $rec;
    public $id;
    public $model;
    public $prod;
    public $brand;
    public $tree;
    public $menuHtml;

    public function init(){
        parent::init();
        if ($this->tpl === null) {
            $this->tpl = 'menu';
        }
        $this->tpl .= ".php";

        if ($this->id === null) {
            $this->id = 0;
        }


    }

    private function getAllCategory($model = null){

        if ($this->data === null) {
            $this->data = Category::find()->indexBy('category_id')->asArray()->all();
        }
        if ($model === null) $model = $this->data;
        return $model;
    }

    private function getBrand($ids){

        if ($this->brand === null) {
            $this->brand = Product::find()->select('DISTINCT `vendor`')->where(['category_id' => $ids])->asArray()->indexBy('vendor')->all();
        }

        return $this->brand;
    }

    public function run(){



//        $this->prod = Product::find()->asArray()->select(['category_id'])->indexBy('category_id')->all();
//        $ids = array_keys($this->data);

//        d($this->tree);
//        d($this->getChildCat($this->id));
        if ($this->tpl == "menu_id.php") {
            $this->menuHtml = $this->getMenuHtml($this->getChildCat($this->id));
        }
        if ($this->tpl == "brand.php") {
            $ids = explode(',', $this->getChildCatRecursive($this->id));
            $this->getBrand($ids);
            $this->menuHtml = $this->getBrandHtml($this->brand);

        }
        if ($this->tpl == "menu.php") {
            $this->getAllCategory();
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
        }
        if ($this->tpl == "menu-prod.php") {
            $this->getAllCategory();
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
        }
        if ($this->tpl == "select.php") {
            $this->getAllCategory();
            $this->tree = $this->getTree();
            $this->menuHtml = '<option value="0"> - Выберите категорию -</option>'.$this->getMenuHtml($this->tree);
        }
        /*if ($this->tpl == "select-brand.php") {
            $this->getAllBrand();
            $this->tree = $this->getTree();
            $this->menuHtml = '<option value="0"> - Выберите категорию -</option>'.$this->getMenuHtml($this->tree);
        }*/
        if ($this->tpl == "breadcrumps.php") {
            $this->menuHtml = $this->getBreadcrumpsHtml($this->id);
        }

//        d(array_filter($this->brand));
//        d($this->data);
        // set cache
//        Yii::$app->cache->set('menu',$this->menuHtml,60);
        return $this->menuHtml;
    }

    protected function getChildCatRecursive($id, $subcategory = ''){

        $data = $this->data;
        $subfound = array();

        if ($subcategory == '') $subcategory = $id;

        foreach ($data as $k => $v) {
            if ($v['parent_id'] == $id) {
                $subfound[] = $v['id'];
            }
        }

        foreach ($subfound as $parentid) {
            $subcategory .= "," . $parentid;
            $subcategory = $this->getChildCatRecursive($parentid, $subcategory);
        }

        return $subcategory;
    }

    protected function getChildCat($id){

        $data = $this->data;
        $subcategory = array();

        foreach ($data as $k => $v) {
            if ($v['parent_id'] == $id) {
                $subcategory[$k]['id'] = $v['id'];
                $subcategory[$k]['name'] = $v['name'];
            }
        }

//        d($subcategory);
        return $subcategory;
    }

    protected function getBreadcrumps($id){
        $id = (int)$id;
        $array = $this->data;
//        d($array);
        if (!$id) return false;
        $count = count($array);
        $breadcrumps = [];
        for ($i = 0; $i < $count; $i++) {
            if (!empty($array[$id])) {
                $breadcrumps[$array[$id]['id']] = $array[$id]['name'];
                $id = $array[$id]['parent_id'];
            } else break;

        }

        return array_reverse($breadcrumps, true);
    }

    protected function getTree(){
        // get cache
//        $tree = Yii::$app->cache->get('tree');
//        if ($tree) return $tree;
        $data = $this->data;
        $tree = [];
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) $tree[$id] = &$node; else
                $data[$node['parent_id']]['childs'][$node['category_id']] = &$node;

        }
        //        set cache
        Yii::$app->cache->set('tree', $tree, 60);

//        d($tree);
        return $tree;
    }

    protected function getBreadcrumpsHtml($id){
        $str = "<ul class='breadcrumps'>";
        $array = $this->getBreadcrumps($id);
        if (empty($array)) return '';
        $str .= "<li class='bcrmp-item'><a class='bcrmp-link' href='" . Url::home() . "'>Магазин Bontoy</a>";
        $i = 0;
        foreach ($array as $k => $name) {

            if ($i == count($array) - 1) {
                $str .= "<li class='bcrmp-item'>{$name}</li>";
            } else {
                $str .= "<li class='bcrmp-item'><a class='bcrmp-link' href='" . Url::to(['category/view', 'id' => $k]) . "'>{$name}</a></li>";
            }

            $i++;
        }
        $str .= '</ul>';

        return $str;
    }

    protected function getMenuHtml($tree, $tab =''){
//        d($tree);
        $str = "";
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    protected function getBrandHtml($brands){
        $str = "";
        $i = 0;
        foreach ($brands as $brand) {
            if ($i == 9) $str .= '<div id="brand-more">';
            if (!$brand['vendor']) continue;
            $str .= $this->catToTemplate($brand['vendor']);
            $i++;
        }
        if ($i >= 9) $str .= '</div><div class="text-center">
                                    <a href="#" id="brand-trigger">Показать все</a>
                                </div>';

        return $str;
    }

    protected function catToTemplate($category,$tab){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;

        return ob_get_clean();
    }
}