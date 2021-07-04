<h3>Новости из категории c id = <?= $id ?></h3>
<?php foreach ($newsList as $key => $news): ?>
    <p><a href="<?= route('news', ['catId'=>$id, 'id'=>++$key]) ?>"><?= $news ?></a></p>
<?php endforeach; ?>
<p><a href="<?= route('categories') ?>">Назад к списку категорий</a></p>
