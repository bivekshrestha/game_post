
# Game Post

This is a simple app to create blog post and add comments on it.




## Project Setup

Duplicate/Download the project and run following commands.

```bash
  composer install
  npm install
  npm run build
```
Configure the database (MySQL is used during development) and run following commands to create database, tables and seed the database with dummy contents.

```bash
  symfony console doctrine:create:database
  symfony console make:migration
  symfony console doctrine:migrations:migrate
  symfony console doctrine:fixtures:load
```


    
## Running the App

To start the application serve run

```bash
  symfony server:start
```


## Command Line Interface

To list all the blog posts in the database run

```bash
  symfony console list-blog
```

