Oeco Architectes website
========================

Requirements
------------

- [PHP] CLI (see required version in [composer.json])
- [Composer]
- [NodeJS] with NPM ([NVM] setup recommended)

### MacOS

Installation instructions:

```bash
# PHP & Composer
brew install php composer

# NVM and NodeJS
brew install nvm
nvm install node # latest
```

### Linux/Unix

Use your regular package manager whenever possible. Otherwise, refer to [PHP], [Composer] and [NodeJS] documentations.

### Windows

Download and install:

- [PHP for Windows]
- [Composer for Windows]
- [Latest Node.JS]

Development environment
-----------------------

### Development installation

```bash
# Install Composer dependencies, and initialize development environment
composer create-project
```

### Run tests

TODO

### Start a local server

Run in two separate terminals:

```bash
# Start HTTP server
composer start
```

```bash
# Build client-side assets and watch for changes
composer watch
```

Production environment
----------------------

### Server requirements

- Any **HTTP server** ([Apache] recommended)
- [PHP] module (see required version in [composer.json]) with the following extensions:
  - TODO

### Production installation

```bash
# Install Composer runtime dependencies only
composer install --no-dev
```

### Build production assets

```bash
composer build # Optimize Composer autoloader, and generate public/{css,fonts,js} assets.
```

### Server setup

Serve `public/` directory.

Continuous Integration
----------------------

TODO

License
-------

Copyright © 2018 Alex Mercier and Oeco Architectes. All rights reserved.

[PHP]: http://php.net/
[Composer]: https://getcomposer.org/
[NodeJS]: https://nodejs.org/en/
[NVM]: https://github.com/creationix/nvm
[PHP for Windows]: https://windows.php.net/download
[Composer for Windows]: https://getcomposer.org/Composer-Setup.exe
[Latest Node.JS]: https://nodejs.org/en/download/current/
[Apache]: https://www.apache.org/
[composer.json]: composer.json
