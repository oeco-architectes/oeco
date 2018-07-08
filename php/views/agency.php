<?php
define('PAGE', 'projects');
require_once realpath(__DIR__ . '/../bootstrap.php');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <title>Agence - oeco architectes</title>
  <link rel="stylesheet" href="<?=BASEURL?>/css/website<?=MIN?>.css" />
</head>
<body>

<div class="agency container">

  <header>
    <a href="<?=BASEURL?>/"><img class="logo" src="<?=BASEURL?>/img/oeco-architectes-logo.jpg" width="280" height="127" alt="oeco architectes" /></a>
    <nav id="navigation">
      <ul class="inline-list">
        <li><a href="<?=BASEURL?>/projets">projets</a></li>
        <li><a href="<?=BASEURL?>/agence" class="active">agence</a></li>
        <li><a href="<?=$config->facebook?>" title="Facebook page" target="_blank"><img src="<?=BASEURL?>/img/facebook.png" /></a></li>
      </ul>
    </nav>
  </header>

  <div class="row">

    <section class="col-sm-7">
      <h1 class="title">ŒCO Architectes : Œuvre Collective</h1>
      <article class="description">
        <p>
Pourquoi ce nom ? Car l’architecture est avant tout une aventure collective.
        </p>
        <p>
ŒCO, il s’agit de l’histoire d’une rencontre entre jeunes architectes, il y a de cela neuf ans lors de nos études à l’École d’Architecture de Toulouse. Diplômées en 2007 et 2008, nous avons poursuivi nos expériences dans diverses agences d’architecture à Toulouse et à Paris avant de fonder le collectif ŒCO en 2009, une structure commune de recherche et de création au sein de laquelle nos idéaux pour la ville et l’architecture de demain peuvent se développer.
ŒCO est aujourd’hui devenu une Société d’architecture SARL autour de Claire Furlan, de Coralie Bouscal et de Vanessa Larrère, qui pour sa part, exerçait déjà en libéral depuis 2010 à Toulouse. Elle a dans ce cadre réalisé un bâtiment de bureaux pour l’exploitation familiale Larrère, celui-là même qui lui a permis de décrocher le prix de la Première œuvre de l’Équerre d’Argent du Moniteur 2011. Aujourd’hui, l’agence ŒCO a plusieurs projets publics et privés en cours, des bureaux, des équipements, des logements et l’objectif de développer son activité.
        </p>
        <p>
Nous cherchons tout particulièrement à redéfinir le lieu commun, le déjà là d’un territoire, en extraire la singularité et l’utiliser dans le but avoué de rendre heureux ses occupants.
        </p>
        <p>
Pour cela, nous avons développé progressivement un « process » de recherches qui nous permet de travailler ensemble sur des buts communs, de trouver notre langage architectural. Le site et le paysage sont nos premiers points d’accroche, nous les parcourons pour mieux nous en inspirer. Souvent, nos projets rendent compte d’une expression synthétique de ce qui préexiste dans le territoire, ou bien souhaitent mettre en œuvre des qualités urbaines déjà présentes qu’il suffit de révéler : il y a une poétique de l’existant.
        </p>
        <p>
Originaires de tout le grand sud ouest, nous sommes inspirées par les paysages de nos régions, ils enrichissent et influencent nos projets d’architectes contemporains.
Sans êtres passéistes et tout en croyant que l’architecture doit sans cesse se renouveler, ces sensibilités personnelles font partie de nous et nous permettent, nous l’espérons, de fabriquer une architecture qui pourra émouvoir celui qui la regarde et qui la vit.
        </p>
        <p>
Nous nous intéressons à toutes les échelles de projet, aussi bien urbaines qu’au  détail, dans le souci de produire une œuvre avec un sens social et collectif, intégrée au sein de son contexte spatial et économique, en adéquation avec les souhaits de nos clients et des futurs habitants. Les préoccupations environnementales sont également à la base de nos projets.
        </p>
      </article>

      <p class="actions">
        <a href="<?=BASEURL?>/agence/publications">Publications</a> ▸
      </p>
    </section>

    <aside class="people col-sm-4 col-sm-offset-1" itemscope itemtype="http://schema.org/Organization">
      <div class="row-fluid">
        <figure class="col-sm-12">
          <img src="<?=BASEURL?>/img/people/team.jpg"/>
        </figure>
        <figcaption>
          <span class="col-sm-4 text-center">Vanessa<br/>Larrère</span>
          <span class="col-sm-4 text-center">Claire<br/>Furlan</span>
          <span class="col-sm-4 text-center">Coralie<br/>Bouscal</span>
        </figcaption>
      </div>
      <div class="row-fluid">
        <div class="col-sm-11">
          <h2 itemprop="name">ŒCO Architectes</h2>

          <h3>Adresse</h3>
          <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <span itemprop="streetAddress">13 Rue Delpy</span>,<br />
            <span itemprop="postalCode">31000</span>
            <span itemprop="addressLocality">Toulouse</span>.<br />
          </p>

          <h3>Téléphone</h3>
          <p class="telephone" itemprop="phone">05 31 98 98 42</p>

          <h3>Adresse électronique</h3>
          <p>
            <a href="mailto:agence@oeco-architectes.com" itemprop="email">agence@oeco-architectes.com</a>
          </p>

          <span id="geolocalisation" itemprop="geo" itemscope itemtype="http://data-vocabulary.org/Geo">
            Coordonnées GPS:
            <span itemprop="latitude">43.59731</span>,
            <span itemprop="longitude">1.45402</span>
          </span>
        </div>
      </div>
    </aside>
  </div>
</div>

<?php include __DIR__ . '/parts/scripts.phtml'; ?>
</body>
</html>
