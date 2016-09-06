<li>
    <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $category['id']]) ?>" class="
    <?php if (isset($category['childs'])): ?>childs<?php endif; ?>">
        <?= $category['name'] ?>
        <?php if (isset($category['childs'])): ?>
        <?php endif; ?>
    </a>
    <?php if (isset($category['childs'])): ?>
        <ul class="catalog">
            <?= $this->getMenuHtml($category['childs']) ?>
        </ul>
    <?php endif; ?>
    <?php if (!isset($category['childs']) && $category['id'] != 0) {
        $products = \app\models\Product::find()->where(['category_id' => $category['id']])->limit(3)->all(); ?>
        <?php if (!empty($products)) : ?>
            <div class="menu-products clearfix">
                <?php foreach ($products as $item) : ?>
                    <div class="col-sm-4 col-xs-6 no-padding">
                        <div class="prod">
                            <div class="prod-item">
                                <div class="prod-img">
                                    <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $item['id']]) ?>">
                                        <img src="<?= $item['img'] ?>" alt="<?= $item['name'] ?>"/>
                                    </a>
                                </div>
                                <h3 class="prod-name">
                                    <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $item['id']]) ?>"><?= $item['name'] ?></a>
                                </h3>
                                <h4 class="price"><?= (int)$item['price'] ?> грн.</h4>
                                <a href="#" class="my-btn btn-gift">добавить в вишлист</a></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php } ?>
</li>