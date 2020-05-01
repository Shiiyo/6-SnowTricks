# Projet6_SnowTricks

OpenClassrooms project as part of the PHP / Symfony application developer courses.
Using PHP 7.4.2 and Symfony 5.0.2

[![Maintainability](https://api.codeclimate.com/v1/badges/cd8b6e80ac40c7ff05c9/maintainability)](https://codeclimate.com/github/Shiiyo/6-SnowTricks/maintainability)

##Install project
Run the command line: <br/>
<code>composer install</code><br/>
<code>yarn install</code><br/>
Config your database on the .env file and run:<br/>
<code>php bin/console doctrine:migrations:migrate</code><br/>
Then run this to generate fake data into the DB:<br/>
<code>php bin/console doctrine:fixtures:load</code>
