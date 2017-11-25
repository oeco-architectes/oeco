Oeco Architectes website
========================


Requirements
------------

- [PHP](http://php.net/) >=7.0
- [Composer](https://getcomposer.org/)
- [NodeJS](https://nodejs.org/en/) ([NVM](https://github.com/creationix/nvm) recommended)
- [Yarn](https://yarnpkg.com/en/)

MacOS install instructions:
```bash
# PHP & Composer
brew tap homebrew/homebrew-php
brew install php70-xdebug composer

# NVM, NodeJS and Yarn
brew install nvm
nvm install node
npm install -g yarn
```


Development environment
-----------------------

### Installation

```bash
composer create-project
```

### Run tests

Tests are not set up yet.

### Start a local server

```bash
yarn run watch # Static assets
php artisan serve # Web server
```


Production environment
----------------------

### Installation

```bash
composer install --no-dev
yarn run production
```

### Server configuration

1. Create `.env` file (use `.env.production.example` as template).
2. Serve `public/` directory using [Apache](https://www.apache.org/) with
[PHP](http://php.net/) module enabled.


Continuous Integration
----------------------

Continuous Integration is not setup yet.


License
-------

Copyright (c) 2017, Alex Mercier and Oeco Architectes - All rights reserved.
