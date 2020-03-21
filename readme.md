# Covermanager TEST

Configure:
--
First, create sql schema, tables and relations with examples, this file ../sql/tables.sql

Second, in apache server with php 5^ installed, copy all files in folder "covermanager" if not exist make the folder
 (In apache server configure cors for all method and host access)

Third, change connection string in file ../class/DBConnection.php and set the mysql connection variables

Fourth, access the api in this example with postman or other client:

- url / path / api / entity / function / resource
- http://localhost/covermanager/api/expedient/create (create expedient POST METHOD)
- http://localhost/covermanager/api/expedient/delete/{id} (delete with id one expedient GET METHOD)
- http://localhost/covermanager/api/expedient/read (get all expedient GET METHOD)
- http://localhost/covermanager/api/expedient/read/{id} (get with id one expedient GET METHOD)
- http://localhost/covermanager/api/expedient/update/{id} (update with id one expedient POST METHOD)

This example is BASIC CRUD

Entities:

- expedient (this is expedient witn studient relation)
- student (this is student profile)
- subject (this is subject with expedient relation)
- telephone (this is telephone with studient relation)

Front (ANGULAR 9)
--
In folder ../front installed angular 9 lib, with bootstrap components

Only configure file ../front/src/app/api.services.ts var apiURL set with url api endpoint

For more information visit angular.io for scallfolding, building or other
