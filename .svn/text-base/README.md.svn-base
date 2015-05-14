ZF2 Tutorial With Doctrine2
===========================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2 & Doctrine2.


Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use composer to install dependencies:

    cd my/project/dir
    git clone git://github.com/dollyaswin/zf2-tutorial.git
    cd zf2-tutorial
    php composer.phar install

Using Git submodules
--------------------
Alternatively, you can install using native git submodules:

    git clone git://github.com/dollyaswin/zf2-tutorial.git --recursive

Virtual Host
------------
Afterwards, set up a virtual host to point to the public/ directory of the
project and you should be ready to go!

Local Configuration
-------------------
Zend Framework 2’s ModuleManager merges all the configuration from each module’s module.config.php file and then merges in the files in config/autoload (*.global.php and then *.local.php files). We’ll add our database configuration information to global.php which you should commit to your version control system. You can use local.php (outside of git) to store the credentials for your database if you want to
So, just copy local.php.dist to local.php, then change the return value to this:

    return array(
        'doctrine' => array(
            'connection' => array(
                'orm_default' => array(
                    'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                    'params' => array(
                        'host'     => 'YOUR HOST HERE',
                        'port'     => 'YOUR PORT HERE',
                        'user'     => 'YOUR USERNAME HERE',
                        'password' => 'YOUR PASSWORD HERE',
                        'dbname'   => 'YOUR DATABASE HERE',
                    )
                )
            )
        )
    );

Database
--------
We are going to use MySQL, via PHP’s PDO driver, so create a database, and use data/db/album.sql to create the album table with some data in it.

