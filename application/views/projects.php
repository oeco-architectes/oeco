<?php
require_once realpath(__DIR__ . '/../Bootstrap.php');
use \App\Models\MozaicLayout;

function projectFigure($project, $images)
{
    $output = '';
    foreach ($images as [$width, $height, $classes]) {
        $output .= includeWithVariables(__DIR__ . '/parts/figure.phtml', array(
        'classes' => $classes . ' active ' . implode(' ', array_map(function ($c) {
            return 'pic-' . $c;
        }, $project['categories'])),
        'href' => BASEURL . '/projets/' . $project['id'],
        'caption' => $project['title'],
        'image' => array(
        'width' => $width,
        'height' => $height,
        'src' => BASEURL . '/img/projects/' . $project['id'] . '/' . $project['id'] . '-01@' . $width . 'x' . $height . '.jpg',
        'alt' => $project['title']
        ),
        ));
    }
    return $output;
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
        }
    }
    shuffle($projects);

    $layout = new MozaicLayout(count($projects), 4);
    ?>

    <?php $i = -1; ?>
    <?php foreach ($layout->getLines() as $line) : ?>
    <div class="row">
        <?php foreach ($line as $item) : ?>
            <?php
            switch ($item) {
                case MozaicLayout::ITEM_SMALL:
                    print projectFigure($projects[++$i], [[290, 190, 'hidden-xs pic pic-desktop pic-small col-sm-3'], [768, false, 'pic pic-mobile visible-xs-block col-xs-12']]);
                    break;
                case MozaicLayout::ITEM_HIGH_TOP:
                                  print projectFigure($projects[++$i], [[290, 390, 'hidden-xs pic pic-desktop pic-high col-sm-3'], [768, false, 'pic pic-mobile visible-xs-block col-xs-12']]);
                    break;
                case MozaicLayout::ITEM_HIGH_BOTTOM:
                                  print '<div class="hidden-xs col-sm-3"><div class="pic-placeholder"></div></div>';
                    break;
                case MozaicLayout::ITEM_LARGE_LEFT:
                                  print projectFigure($projects[++$i], [[590, 190, 'hidden-xs pic pic-desktop pic-large col-sm-6'], [768, false, 'pic pic-mobile visible-xs-block col-xs-12']]);
                    break; case MozaicLayout::ITEM_LARGE_RIGHT: // nothing
            }
            ?>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>

</section>
