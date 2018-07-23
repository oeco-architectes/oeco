<?php
// Render layout
$this->layout('layout', [
  'view' => $view,
  'config' => $config,
  'baseUrl' => $baseUrl,
  'min' => $min,
]);
?>

<section>
  <?php $news = include __DIR__ . '/../services/news.php'; ?>
  <?php if($news['ok']): ?>
    <div id="news" class="carousel slide">

      <ol class="carousel-indicators">
        <?php foreach($news['news'] as $i => $new): ?>
          <li data-target="#news" data-slide-to="<?php echo $i; ?>" class="<?= $i == 0 ? 'active ' : ''?>"></li>
        <?php endforeach; ?>
      </ol>

      <div class="carousel-inner">
        <?php foreach($news['news'] as $i => $new): ?>
          <figure class="item<?= $i == 0 ? ' active' : ''?>">
            <img src="<?=BASEURL?>/services/image.php?path=news/<?=$new['id']?>.jpg&amp;width=800&amp;height=500" width="800" height="500" alt="<?=$new['title']?>" />
            <figcaption>
              <p class="news-title"><?=$new['title']?></p>
              <p class="news-summary"><?=$new['summary']?></p>
            </figcaption>
          </figure>
        <?php endforeach; ?>
      </div>

      <a class="left carousel-control" href="#news" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a class="right carousel-control" href="#news" data-slide="next">
        <span class="icon-next"></span>
      </a>

    </div>
  <?php endif; ?>
</section>
