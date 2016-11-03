Linkfloyd PHP
=============

## Installation

* Install PHP >= 7.0


    apt-get install php7.0 php7.0-mbstring php7.0-mcrypt php7.0-pdo # and other things that i dont know yet
    
* Check requirements satisfied

    
    php bin/symfony_requirements     
    
* Download composer


    https://getcomposer.org/download/
    
* Install Symfony dependencies    


    composer install

* To Run migrations


    php bin/console doctrine:migrations:migrate
    
* Load sample data


    php bin/console doctrine:fixtures:load
    
    
## Frontend JS-CSS Dependencis

I'm currenty using Laravel's [Elixir](https://laravel.com/docs/5.3/elixir) for combine scripts and stylesheets.

Elixir is really easy to use and understand. But since i'm not FE developer,
i'm open for your suggestions.

To compile scripts, simple run these commands:

    npm install -g bower gulp

    npm install # install package.json dependencies
    
    bower install # installs bower.json dependencies
    
    gulp #runs elixir for one time
    
    gulp watch #watches your js/css file changes as sync

