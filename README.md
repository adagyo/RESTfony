RESTfony
=========

A test project to build a REST service with Symfony2 framework.

Requirements / Install guide on Fedora 20
-------------------------------------------

* Nginx >= 1.4.7
  * yum install nginx
  * PHP >= 5.5.0
    * yum install php-fpm
* PHP modules:
  * php-intl
  * php-pdo
  * php-pgsql
  * php-mbstring
  * php-apc
* Composer
  * curl -sS https://getcomposer.org/installer | php 
  * sudo mv composer.phar /usr/local/bin/composer
* Symfony >= 2.5.x
  * composer create-project symfony/framework-standard-edition {PATH/} "2.5.*"
