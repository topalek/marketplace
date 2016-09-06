<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="comtainer">
        <div class="row">
            <div class="col-xs-12">
                <?php foreach ($shops as $shop) : ?>
                    <div class="col-lg-4">
                        <div class="shop-item text-center">
                            <h2><?=$shop->name?></h2>

                            <p><img src="<?=$shop->logo?>" alt="<?=$shop->name?>"></p>

                            <p><a class="btn btn-default" href="<?=$shop->url?>"><?=$shop->name?></a></p>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
