#Evangelizer 
[![StyleCI](https://styleci.io/repos/47891772/shield)](https://styleci.io/repos/47891772) [![Build Status](https://travis-ci.org/andela-gjames/Evangelizers.svg?branch=develop)](https://travis-ci.org/andela-gjames/Evangelizers)

This application ranks github users, based on their level of contribution or number of  personal online repositories.
Each user can belong to one of 4 Categories

* Baby Evangelist
* Junior Evangelist
* Associate Evangelist and
* Senior Evangelist

##Installation
From the root of the dirctory
* Run composer install: This will run all dependencies required by the application


##Usage

```php
    require("vendor/autoload.php");
    use C3P0\App\GithubClient;
    use C3P0\App\EvangelistStatus;

    $github_client  =   new GithubClient();
    $evangelist     =   new EvangelistStatus('laravel', $github_client);

    $evangelist->getStatus();

```