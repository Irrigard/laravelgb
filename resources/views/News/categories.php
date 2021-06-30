<h3>Список категорий:</h3>
<?php foreach ($categoriesList as $key => $category): ?>
    <p><a href="<?= route('category', ['id'=>++$key]) ?>"><?= $category ?></a></p>
<?php endforeach; ?>
