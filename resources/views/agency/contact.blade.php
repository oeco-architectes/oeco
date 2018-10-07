<div class="oe-contact" itemscope itemtype="http://schema.org/Organization">
    <meta itemprop="image" content="/img/oeco-team.jpg"></meta>
    <meta itemprop="geo" itemscope itemtype="http://data-vocabulary.org/Geo">
        <meta itemprop="latitude" content="43.610289"></meta>
        <meta itemprop="longitude" content="1.452549"></meta>
    </meta>

    <figure>
        @include('partials/image', [
            'class' => 'oe-contact__picture',
            'image' => new \App\Image('/img/oeco-team.jpg', 363, 363),
            'title' => 'Fondateurs d\'Œco Architectes',
            'color' => '9c9c9c',
        ])
        <figcaption class="oe-contact__caption">
            <span class="oe-contact__caption-member" itemprop="founder" itemscope itemtype="http://schema.org/Person">
                <span class="oe-contact__caption-member-name" itemprop="givenName">Vanessa</span>
                <span class="oe-contact__caption-member-name" itemprop="familiyName">Larrère</span>
            </span>
            <span class="oe-contact__caption-member" itemprop="founder" itemscope itemtype="http://schema.org/Person">
                <span class="oe-contact__caption-member-name" itemprop="givenName">Claire</span>
                <span class="oe-contact__caption-member-name" itemprop="familiyName">Furlan</span>
            </span>
            <span class="oe-contact__caption-member" itemprop="founder" itemscope itemtype="http://schema.org/Person">
                <span class="oe-contact__caption-member-name" itemprop="givenName">Coralie</span>
                <span class="oe-contact__caption-member-name" itemprop="familiyName">Bouscal</span>
            </span>
        </figcaption>
    </figure>

    <h3 class="oe-contact__title" itemprop="name">Œco Architectes</h3>

    <div class="oe-contact__section">
        <h4>Adresse</h4>
        <p itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <a href="https://www.google.fr/maps/place/31+Rue+Bertrand+de+Born,+31000+Toulouse/" target="_blank">
                <span itemprop="streetAddress">31 Rue Bertrand de Born</span>,<br />
                <span itemprop="postalCode">31000</span>
                <span itemprop="addressLocality">Toulouse</span><br />
            </a>
        </p>
    </div>

    <div class="oe-contact__section">
        <h4>Téléphone</h4>
        <p itemprop="phone">
            <a href="tel:+33531989842">+33 (0)5 31 98 98 42</a>
        </p>
        <p itemprop="phone">
            <a href="tel:+33671300261">+33 (0)6 71 30 02 61</a>
        </p>
    </div>

    <div class="oe-contact__section">
        <h4>Adresse électronique</h4>
        <p>
            <a href="mailto:agence@oeco-architectes.com" itemprop="email">agence@oeco-architectes.com</a>
        </p>
    </div>
</div>
