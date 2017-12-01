Oeco Architectes website
========================

[![Build Status](https://img.shields.io/travis/oeco-architectes/oeco/master.svg)](https://travis-ci.org/oeco-architectes/oeco)
[![Test Coverage](https://img.shields.io/codecov/c/github/oeco-architectes/oeco/master.svg)](https://codecov.io/github/oeco-architectes/oeco?branch=master)
[![Code Climate](https://img.shields.io/codeclimate/maintainability/oeco-architectes/oeco.svg)](https://codeclimate.com/github/oeco-architectes/oeco)
[![Dependency Status](http://img.shields.io/gemnasium/oeco-architectes/oeco.svg)](https://gemnasium.com/oeco-architectes/oeco)


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

```bash
composer lint
composer test
```

### Run end-to-end tests

```bash
yarn run development
php artisan serve --env=testing
composer e2e
```

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


Continuous Deployment
---------------------

Each commit triggers a CI build on Travis CI. Tests are run in the following
order:
1. linting: `composer lint`
2. unit tests: `composer test`
3. end-to-end tests: `composer e2e`

Each commit to `master` branch, after having passed all tests, is automatically
deployed (when build passes) to the **staging platform**
(https://staging.oeco-architectes.com).

Each tagged commit on `master` branch, after having passed all tests, is
automatically deployed (when build passes) to the **production platform**
(https://www.oeco-architectes.com, behind basic auth).


License
-------

Copyright (c) 2017, Alex Mercier and Oeco Architectes - All rights reserved.
