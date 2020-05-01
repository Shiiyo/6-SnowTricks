# Projet6_SnowTricks

OpenClassrooms project as part of the PHP / Symfony application developer courses.
Using PHP 7.4.2 and Symfony 5.0.2

[![Maintainability](https://api.codeclimate.com/v1/badges/cd8b6e80ac40c7ff05c9/maintainability)](https://codeclimate.com/github/Shiiyo/6-SnowTricks/maintainability)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/1bec73de138f493b94352ceb64d44dbd)](https://www.codacy.com/manual/Shiiyo/Festival-des-Films-de-Plein-Air?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Shiiyo/Festival-des-Films-de-Plein-Air&amp;utm_campaign=Badge_Grade)

##Prerequisite
- PHP 7.4.2
- MySQL
- MAMP, WAMP or XAMPP depend of your OS
- Composer
- Node.js

##Install project
Run the command line: <br/>
<code>git clone https://github.com/Shiiyo/6-SnowTricks.git</code><br/>
<code>composer install</code><br/>
<code>yarn install</code><br/>
Config your database on the .env file and run:<br/>
<code>php bin/console doctrine:migrations:migrate</code><br/>
Then run this to generate fake data into the DB:<br/>
<code>php bin/console doctrine:fixtures:load</code><br/>
Lunch the server with:<br/>
<code>symfony run -d yarn encore dev --watch</code><br/>
<code>symfony server:start -d</code>

##Dependencies
- [WebPack Encore](https://github.com/symfony/webpack-encore) for assets management
- [bootstrap-sass](https://github.com/twbs/bootstrap-sass) Bootstrap SASS library
- [sass-loader](https://github.com/webpack-contrib/sass-loader) to compile your SCSS files to CSS
- [jQuery](https://github.com/jquery/jquery) autoloaded by WebPack Encore
Those dependencies are included in package.json