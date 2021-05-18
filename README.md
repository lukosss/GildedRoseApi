# Introduction

I was given a task to create an API for Gilded Rose with Laravel. I used XAMPP for my database.

### Migrations

I started off by creating controllers and migration files for items and categories. In categories migration file all we
needed was id and name, in items migrations we needed to constrain a foreign id (id in category table) to the category of an item (category (integer) in items table)

### Models

In models Item and Controller I have set up fillable properties and hasMany hasOne relationships. 

### Resources

Resources were created to reduce the amount of unimportant data that we get from the database with API requests, 
such as 'created_at' and 'updated_at'.

### Routes

In routes, I have set up API routes that correspond to its controller methods and do the specified logic. 

### Controllers

In controllers all the required methods have been created for CRUD functionality and also validation was implemented. I was not quite sure about some requirements, so I made a couple of different variations for some methods.

## How to use this API

### Set up

- Clone the project from github ```git clone https://github.com/lukosss/GildedRoseApi.git```
- change directory to project folder, type in terminal ```cd GildedRoseApi```
- Install all the dependencies using composer ```composer install```
- Copy and paste .env.example file and rename it to .env, then replace all the information with Your database information and log-ins.
    - For example in XAMPP You will most likely just need to change the `DB_DATABASE=laravel` to Your database name.
    
- Once .env is set up, You need to migrate the database tables by typing in the terminal ```php artisan migrate``` (make sure You are in the project folder).
- Now generate an app key by typing in this command ```php artisan key:generate```
- Now You just need to start the server with ```php artisan serve``` command in the terminal. Now once the server is running You can start using this API. List of available API routes below.

### List of API routes

For this You will need an application like Postman to test these routes since there is no front-end for this app.
1. GET methods (get some or all of the items/ categories)
    1. ```http://127.0.0.1:8000/api/items``` - get an array of all the created items in the database.
    2. ```http://127.0.0.1:8000/api/categories``` - get an array of all the created categories in the database.
    3. ```http://127.0.0.1:8000/api/items/{categoryId}``` - get all the items that are of specified category by category <strong>ID</strong>. Replace ```{categoryId}``` with wanted category id (integer). E.g. ```/api/items/1```
    4. ```http://127.0.0.1:8000/api/category/{categoryName}``` - get all the items that are of specified category by category <strong>NAME</strong>. Replace ```{categoryName}``` with wanted category name (string, case-sensitive). E.g. ```/api/category/Aged Brie``` - space might need to be replaced with ```%20```.
    
2. POST methods (create an item or category)
    1. ```http://127.0.0.1:8000/api/item/store``` - create a new item, required parameters - category (int, must already be an existing category of this id already created), name (string, must always end in _item suffix), value(float, at least 10, no greater than 100), quality (int, at least -10, no greater than 50)
       e.g. for body:<br />
       {<br />
       &nbsp;&nbsp;&nbsp;&nbsp;"category": "1",<br />
       &nbsp;&nbsp;&nbsp;&nbsp;"name": "Stone pickaxe_item",<br />
       &nbsp;&nbsp;&nbsp;&nbsp;"value": 19.99,<br />
       &nbsp;&nbsp;&nbsp;&nbsp;"quality": 20,<br />
       }<br />
    2. ```http://127.0.0.1:8000/api/category/store``` - create a new category, required parameters - name (string, must be at least 5 symbols) e.g. for body:<br />
       {<br />
       &nbsp;&nbsp;&nbsp;&nbsp;"name": "Sulfuras",<br />
       }<br />
       
3. PUT methods (update an item or category)
    1. ```http://127.0.0.1:8000/api/item/{itemId}``` - update an item, parameters for the body are the same as in item creation, except that You only need to pass in the ones You want to change. Replace ```{itemId}``` with wanted item id (integer). E.g. ```/api/item/1```. E.g. for body:<br />
       {<br />
       &nbsp;&nbsp;&nbsp;&nbsp;"name": "ChangeOnlyName_item",<br />
       }<br />
    2. ```http://127.0.0.1:8000/api/category/{categoryId}``` - update a category, parameters for the body are the same as in category creation. Replace ```{categoryId}``` with wanted category id (integer). E.g. ```/api/category/3```

4. DELETE methods (delete an item, category or all the items from specified category)
    1. ```http://127.0.0.1:8000/api/item/{itemId}``` - delete an item of specified id. Replace ```{itemId}``` with wanted item id (integer). E.g. ```/api/item/2```.
    2. ```http://127.0.0.1:8000/api/category/{categoryId}``` - delete a category of specified id. Replace ```{categoryId}``` with wanted category id (integer). E.g. ```/api/category/2```.
    3. ```http://127.0.0.1:8000/api/category/deleteItemsFromCategoryName/{categoryName}``` - deletes all the items that have the specified category, in this case by a category <strong>NAME</strong> property. Replace ```{categoryName}``` with wanted category name (string, case sensitive). E.g. ```/api/category/deleteItemsFromCategoryName/Sulfuras```.
    4. ```http://127.0.0.1:8000/api/category/deleteItemsFromCategoryId/{categoryId}``` - deletes all the items that have the specified category, except this time route expects for a category <strong>ID</strong>. Replace ```{categoryId}``` with wanted category id (integer). E.g. ```/api/category/deleteItemsFromCategoryId/2```.
