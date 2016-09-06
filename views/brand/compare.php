<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;


$this->title = 'Brands';
$options = '<option value="0">-- Select brand --</option>';
foreach ($model as $brand) {
    $options .= '<option value="' . $brand->brand_id . '">' . $brand->name . '</option>';
}

?>
<div class="category-index">
    <h1><?= Html::encode($this->title) ?> <br><?= $class ?>
    </h1>
    <div class="col-sm-4">
        <div class="form-group field-category-name required">
            <select class="form-control" name="brand">
                <?= $options ?>
            </select>
        </div>
    </div>

    <?php if (isset($category) && !empty($category)) : ?>
        <?php foreach ($category as $item): ?>
            <?php //d($item) ?>
            <div class="item">
                <div class="col-xs-4">
                    <div class="form-group field-category-name required">
                        <input type="text" class="form-control" name="Category[]" value="<?= $item['name'] ?>"
                               maxlength="255">
                        <div class="help-block"></div>
                    </div>
                </div>

                <div class="col-xs-4">
                    <div class="form-group field-category-name required">
                        <select class="form-control" name="category[]">
                            <?php
                            $option = $options;
                            if (strpos($options, 'value="' . $item['category_id'] . '"') && $item['category_id'] != 0) {
                                $option = str_replace('value="' . $item['category_id'] . '"', 'selected value="' . $item['category_id'] . '"', $options);
                            } elseif (strpos($options, $item['name'])) {
                                $pattern = '/value="(\d+)">' . $item['name'] . '/';
                                preg_match($pattern, $options, $matches);
                                $category_id = (int)$matches[1];
                                $alias = \app\models\ShopCategory::findOne($item['id']);
                                $alias->category_id = $category_id;
                                $alias->save();
                                $option = str_replace('>' . $item['name'], ' selected >' . $item['name'], $options);

                            }

                            ?>
                            <?= $option ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="form-group field-category-name required">
                        <a href="#" data-shop_cat_id="<?= $item['id'] ?>" data-shop_cat_name="<?= $item['name'] ?>"
                           class="btn btn-danger save"> save </a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    <?php endif; ?>

    <script>
        var json = '';
        $('#shopform-shop').change(function () {
            var url = $(this).val();
            $('#xml_url').html(url);


//                if (url) {
//                    $.post('/category/compare', {file_xml: url}, function (res) {
//                        json = JSON.parse(res);
//                        var str = '<pre>' + res + '</pre>';
//                        $('.text-center').prepend(str);
//                    })
//                }
        });
        $('option[selected]').parents('select:not(#shopform-shop)').addClass('success');

        $('.save').click(function (e) {
            e.preventDefault();
            var category = parseInt($(this).parents('.item').find('select').val());
            console.log(category);
//            if (!category) {
//                $(this).parents('.item').find('select').addClass('error');
//            }
//            if (category) {
            $(this).parents('.item').find('select').removeClass('error');
            var q = [parseInt($(this).data('shop_cat_id')), $(this).data('shop_cat_name'), category],
                a = $(this);
//                alert(q);
//            console.log(a);

            if (q) {
                console.log(q);
                $.post('/category/save', {category: q}, function (res) {
                    console.log(res);
                    if (res == 'success') {
                        a.removeClass('btn-danger').addClass('btn-success').text('Saved');
                        a.closest('.item').find('select').addClass('success')
                    }
                })
            }
//            }

        });
    </script>
</div>