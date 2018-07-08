#!/usr/bin/env bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Create user in MySQL/MariaDB.
mysql_create_user() {
  if [ "$#" = 1 ]
  then
    mysql -ve "CREATE USER '$1'@'localhost'"
  elif [ "$#" = 2 ]
  then
    mysql -ve "CREATE USER '$1'@'localhost' IDENTIFIED BY '$2'"
  else
    echo "Usage: mysql_create_user USER [PASSWORD]" >&2
    return 1
  fi
}

# Delete user from MySQL/MariaDB
mysql_drop_user() {
  if [ -z "$1" ]
  then
    echo "Usage: mysql_drop_user USER" >&2
    return 1
  fi
  mysql -ve "DROP USER '$1'@'localhost';"
}

# Create new database in MySQL/MariaDB.
mysql_create_db() {
  if [ -z "$1" ]
  then
    echo "Usage: mysql_create_db DATABASE" >&2
    return 1
  fi
  mysql -ve "CREATE DATABASE IF NOT EXISTS $1"
}

# Drop database in MySQL/MariaDB.
mysql_drop_db() {
  if [ -z "$1" ]
  then
    echo "Usage: mysql_drop_db DATABASE" >&2
    return 1
  fi
  mysql -ve "DROP DATABASE IF EXISTS $1"
}

# Grant all permissions for user for given database.
mysql_grant_db() {
  if [ -z "$2" ]
  then
    echo "Usage: mysql_grand_db USER DATABASE" >&2
    return 1
  fi
  mysql -ve "GRANT ALL ON $2.* TO '$1'@'localhost'"
  mysql -ve "FLUSH PRIVILEGES"
}

# Show current user permissions.
mysql_show_grants() {
  if [ -z "$1" ]
  then
    echo "Usage: mysql_show-grants USER" >&2
    return 1
  fi
  mysql -ve "SHOW GRANTS FOR '$1'@'localhost'"
}

mysql_drop_db oeco_dev
mysql_drop_user oeco_dev

mysql_create_user oeco_dev
mysql_create_db oeco_dev
mysql_grant_db oeco_dev oeco_dev
mysql_show_grants oeco_dev
mysql -vv --init-command 'SET SESSION FOREIGN_KEY_CHECKS=0;' -u oeco_dev oeco_dev < "$DIR/database-structure.sql"
mysql -vv --init-command 'SET SESSION FOREIGN_KEY_CHECKS=0;' -u oeco_dev oeco_dev < "$DIR/database-data.sql"
