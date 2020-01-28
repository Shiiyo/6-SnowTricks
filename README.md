# Projet6_SnowTricks

OpenClassrooms project as part of the PHP / Symfony application developer courses.
Using PHP 7.2.10 and Symfony 5.0.2

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/3d0e1ef5329145f7a0a4324709ecf965)](https://www.codacy.com/manual/Shiiyo/6-SnowTricks?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Shiiyo/6-SnowTricks&amp;utm_campaign=Badge_Grade)

##Install project
Run the command line: <br/>
<code>composer install</code><br/>
Config your database on the .env file and run:<br/>
<code>php bin/console doctrine:migrations:migrate</code><br/>
Then run this to generate fake data into the DB:<br/>
<code>php bin/console doctrine:fixtures:load</code>