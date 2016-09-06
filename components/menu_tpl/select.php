<option value="<?=$category['category_id']?>"<?php if ($category['category_id'] == $this->model->parent_id) echo 'selected';?><?php if ($category['category_id'] == $this->model->id) echo 'disabled';?>
><?=$tab.$category['name']?></option>

<?php if (isset($category['childs']) ): ?>
        <?= $this->getMenuHtml($category['childs'],$tab.'&nbsp;&nbsp;&nbsp;') ?>
<?php endif; ?>

