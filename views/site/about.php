<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $xml = 'http://bontoy.com.ua/ipopo/ipopo.xml';
        $local_file = 'c:\OpenServer\domains\untitled\bontoy-new.xml';


//        $file = file_get_contents($xml);
//        file_put_contents($local_file,$file);


    ?>
</div>
