<h3>Новость c id = <?= $id ?> из категории c id = <?= $catId ?></h3>
<p><?= $newsItemText ?></p>
<p><a href="<?= route('category', ['id'=>$catId]) ?>">Назад к списку новостей категории <?= $catId ?></a></p>
