#Development for website Xirvana

Developed using Angular framework, PHP backend with ORM Propel to connect MySQL database.

##Update database schema
Upon change of database scheme , run command: 
- php composer.phar dump-autoload
- sql:build
- sql:insert

Basic functions supported by the website:
1. user registration
2. show approved calendar events
3. registered users can send booking/consultation request