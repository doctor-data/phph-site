# PHP Hampshire

Website for www.phphants.co.uk.

For more information, visit us at [PHP Hampshire](http://phphants.co.uk).

[![Build Status](https://travis-ci.org/phphants/phph-site.svg?branch=master)](https://travis-ci.org/phphants/phph-site) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phphants/phph-site/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phphants/phph-site/?branch=master) [![Code Coverage](https://scrutinizer-ci.com/g/phphants/phph-site/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/phphants/phph-site/?branch=master) [![Latest Stable Version](https://poser.pugx.org/phphants/phph-site/v/stable)](https://packagist.org/packages/phphants/phph-site) [![License](https://poser.pugx.org/phphants/phph-site/license)](https://packagist.org/packages/phphants/phph-site)

## Installation

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

* yarn or npm
* php 7.2
* mysql or postgres
* composer

### Project setup

* Clone the repository `$ git clone git@github.com:phphants/phph-site.git`
* Run `$ composer install`
* You will need to configure the application by editing the `.env` file and configuring the database credentials
* Now create the database `$ php bin/console doctrine:schema:update --force`
* Load test data with `$ php bin/console doctrine:fixtures:load`
* You can then run the application using `$ php bin/console server:run`

### Asset building

* Run `$ yarn install`
* Then `$ yarn run watch` or `$ yarn run build`

