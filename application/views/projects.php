<?php

require_once realpath(__DIR__ . '/../Bootstrap.php');
use App\Models\ImageRegistry;
use App\Models\MozaicLayout;

$registry = new ImageRegistry(
    $config->data->imgDir,
    $config->data->cacheDir,
    '1x1.png'
);

function tiles($type)
{
    switch ($type) {
        case MozaicLayout::ITEM_SMALL:
            return [290, 190, 'pic-small', 'col-sm-3'];
        case MozaicLayout::ITEM_HIGH_TOP:
            return [290, 390, 'pic-high', 'col-sm-3'];
        case MozaicLayout::ITEM_LARGE_LEFT:
            return [570, 190, 'pic-large', 'col-sm-6'];
    }
}

function projectPictureClasses($project)
{
    return array_map(
        function ($category) {
            return 'pic-' . $category;
        },
        $project['categories']
    );
}

// Render layout
$this->layout('layout', [
  'view' => $view,
  'config' => $config,
  'baseUrl' => $baseUrl,
  'min' => $min,
  'title' => 'Projets',
]);
?>
<section>

  <ul id="project-categories" class="inline-list">
    <?php $categories = include __DIR__ . '/../services/categories.php'; ?>
    <?php if ($categories['ok']) : ?>
        <?php foreach ($categories['categories'] as $category) : ?>
        <li class="project-category-<?=$category['id']?>"><a href="#" data-id="<?=$category['id']?>"><?=mb_strtolower($category['name'], 'UTF-8')?></a></li>
        <?php endforeach; ?>
    <?php endif; ?>
  </ul>

<div id="projects">
    <?php
    $projects = include __DIR__ . '/../services/projects.php';
    $projects = $projects['projects'];
    foreach ($projects as $i => $project) {
        if (!$project['published']) {
            unset($projects[$i]);
        } else {
            $projects[$i]['image'] = 'projects/' . $project['id'] . '/' . $project['id'] . '-01.jpg';
        }
    }
    shuffle($projects);

    $layout = new MozaicLayout(count($projects), 4);
    ?>

    <?php $i = -1; ?>
    <?php foreach ($layout->getLines() as $line) : ?>
    <div class="row">
        <?php foreach ($line as $item) : ?>
            <?php if ($item === MozaicLayout::ITEM_LARGE_RIGHT) : ?>
                <?php // Nothing ?>
            <?php elseif ($item === MozaicLayout::ITEM_HIGH_BOTTOM) : ?>
                <div class="col col-xs-12 col-sm-3">
                    <div class="pic pic-placeholder"></div>
                </div>
            <?php else : ?>
                <?php
                    $project = $projects[++$i];
                    [$width, $height, $picClass, $containerClass] = tiles($item);
                    $picClass .= ' ' . implode(' ', projectPictureClasses($project));
                ?>
                <a href="<?= BASEURL . '/projets/' . $project['id'] ?>" class="col col-xs-12 <?= $containerClass ?>">
                    <figure class="pic <?= $picClass ?> active">
                        <img
                            srcset="
                                <?= BASEURL . '/img/' . $registry->get($project['image'], 768, null)->path ?> 768w,
                                <?= BASEURL . '/img/' . $registry->get($project['image'], $width, $height)->path ?> <?= $width ?>w
                            "
                            sizes="(min-width: 769px) <?= $width ?>px, 768px"
                        >
                        <figcaption><?= $this->e($project['title']) ?></figcaption>
                    </figure>
                </a>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>

</section>
