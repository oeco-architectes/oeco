<div itemscope itemtype="http://schema.org/Organization">
    <meta itemprop="image" content="/img/oeco-team.jpg"></meta>

    <figure>
        @include('partials/image', [
            'href' => '/img/oeco-team.jpg',
            'width' => 363,
            'height' => 363,
            'title' => 'Fondateurs d\'Œco Architectes',
            'color' => '9c9c9c',
        ])
        <figcaption>
            <span itemprop="founder" itemscope itemtype="http://schema.org/Person">
                <span itemprop="givenName">Vanessa</span>
                <span itemprop="familiyName">Larrère</span>
            </span>
            <span itemprop="founder" itemscope itemtype="http://schema.org/Person">
                <span itemprop="givenName">Claire</span>
                <span itemprop="familiyName">Furlan</span>
            </span>
            <span itemprop="founder" itemscope itemtype="http://schema.org/Person">
                <span itemprop="givenName">Coralie</span>
                <span itemprop="familiyName">Bouscal</span>
            </span>
        </figcaption>
    </figure>

    <h3 itemprop="name">Œco Architectes</h3>

    <h4>Adresse</h4>
    <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
        <a href="https://www.google.fr/maps/place/31+Rue+Bertrand+de+Born,+31000+Toulouse/" target="_blank">
            <span itemprop="streetAddress">31 Rue Bertrand de Born</span>,<br />
            <span itemprop="postalCode">31000</span>
            <span itemprop="addressLocality">Toulouse</span><br />
        </a>
    </p>
    <span itemprop="geo" itemscope itemtype="http://data-vocabulary.org/Geo">
        Coordonnées GPS:
        <span itemprop="latitude">43.610289</span>,
        <span itemprop="longitude">1.452549</span>
    </span>

    <h4>Téléphone</h4>
    <p itemprop="phone">
        <a href="tel:+33531989842">+33 (0)5 31 98 98 42</a>
    </p>
    <p itemprop="phone">
        <a href="tel:+33671300261">+33 (0)6 71 30 02 61</a>
    </p>

    <h4>Adresse électronique</h4>
    <p>
        <a href="mailto:agence@oeco-architectes.com" itemprop="email">agence@oeco-architectes.com</a>
    </p>
</div>
