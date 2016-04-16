#Development for website Xirvana

Developed using Angular framework, PHP backend with ORM Propel to connect MySQL database.

##Update database schema
Upon change of database scheme, run command: 
- php composer.phar dump-autoload
- vendor/bin/propel sql:build
- vendor/bin/propel sql:insert

##Generate Model Classes
- vendor/bin/propel model:build

##Runtime Connection Settings
- vendor/bin/propel config:convert


#Basic functions supported by the website:
1. user registration