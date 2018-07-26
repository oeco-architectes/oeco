www.oeco-architectes.com
========================

> ŒCO Architectes website

[![Build Status](https://travis-ci.org/oeco-architectes/oeco.svg?branch=master)](https://travis-ci.org/oeco-architectes/oeco)

Setup
-----

- setup MySQL database: `sudo sudo database/development.sh`
- create config/local.php with MySQL credentials
- create apache virtual host with / as document root
- create `build.properties`:
```properties
# FTP Server Settings
ftp.server=ftp.oeco-architectes.com
ftp.user=...
ftp.password=...
ftp.dir=/www
```
- extract fonts:
```sh
ln -s fonts.tar.gz.bin css/fonts/fonts.tar.gz
tar -xf css/fonts/fonts.tar.gz -C css/fonts
```

Prerequisites
-------------

- Apache 2 Server with the following modules:
  - header
  - mime
  - rewrite

- PHP 5.3 with the following extensions:
  - gd

- MySQL 5

License
-------

© 2010-2018 Oeco Architectes. All rights reserved.
