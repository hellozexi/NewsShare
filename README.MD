# news site

## team members

* Jason Zhu, 467138
* Zexi Liu, 467319

## docker compose

There are two container for this project, the php-apache web server and the mysql database.

An instance is running in <http://ec2-52-14-93-16.us-east-2.compute.amazonaws.com:9000/>. That is, the 80 port of web container is mapped to 9000 port of the host machine, the EC2 instance.

* the web server container is built via a Dockerfile under the root dir
    1. builds from FROM php:5.6-apache
    2. install mysql connection tools
    3. copy public_html/ into /var/www/html of the container

* the mysql container is built via a Dockerfile under the db/ dir
    1. it built from mysql:5.7.22
    2. initialize the database using db/init.sql, which defines the database schema

run following command if you edit some code and want to test:
```bash
docker-compose down
docker-compose build
docker-compose up
```

## Additiona Details

1. Users can delete and edit their story and articles in their own main page
2. the search bar is on the right top of the main page
3. test codes under /private/tests are now forbidden

## Creative Portion

1. create a user main page where users can find all news they post
2. create a user main page where users can find all comments they post
3. if you login, you can search all stories written by a user by his email

## structure of the dir

Php files for back-end logic and database are under /private dir and it's Forbidden.

```
.
├── README>MD
└── public_html
    ├── img
    └── private
        ├── User.php
        └── ...

```

## todo-list
the todo list is powered by a extension of vscode called Todo+
<https://marketplace.visualstudio.com/items?itemName=fabiospampinato.vscode-todo-plus>
