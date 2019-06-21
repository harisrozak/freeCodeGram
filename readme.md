# freeCodeGram

A Laravel application that implemented from Coder's Tape's tutorial

Visit the youtube tutorial video here: https://www.youtube.com/watch?v=ImtZ5yENzgE

## Develompment notes

`#1` Install composer globally
- open https://getcomposer.org
- install it on yourr machine
- next make it available to run globally on your machine
- type "composer" on your command line to test

`#2` Install nodejs
- open https://nodejs.org
- download and install it yo your machine
- type "node -v" on your command line to test
- type "npm -v" on your command line to test

`#3` Install laravel
- open https://laravel.com
- go to documentation > installation section
- install using "via laravel installer"
- type "laravel" on your command line to test 
- after that if nothing happen, fix the $PATH

`#4` Install the laravel
- type "laravel new freeCodeGram" to install new Laravel instance
- type "cd freeCodeGram" to enter the installed folder app
- type "php artisan serve" to start the app

`#5` Initial development steps
- make sure your console has entered the app location
- type "php artisan make:auth" to add the auth module
- type "npm install" to get the laravel 3rd dependencies
- type "npm run dev" to compile the larevel 3rd dependencies
- re-type the "npm run dev" to finish the compiling (laravel-mix)

`#6` Database
- make sure your console has entered the app location
- type "vim database/database.sqlite" to create an empty sqlite file
- press esq and then type ":wq" to exit the vim
- type "php artisan migrate" to deploy initial tables (auth module tables)
- open ".env" file and then change the "DB_CONNECTION" to sqlite
- remove the rest of "DB_*" string because we dont need it when using sqlite
- restart the "php artisan serve" after change the ".env" file

`#7` Changing the frontend
- the templating files (.blade.php) are located on "/resources/views/" 
- the styling files are located on "/resources/sass/"
- type "npm run dev" to compile your modified sass files

`#8` Application controllers
- the app controllers are located on "/app/Http/Controllers/"
- type "php artisan make:controller SampleController" to add new controller

`#9` Application database migrate
- the database migration files are located on "/database/migrations/"
- once we changed these files, we are need to redeploy the database 
- type "php artisan migrate:fresh" to redeploy the database 
- the above command will also dropped all tables, so becareful
- type "php artisan tinker" to interact with your app
- one example of tinker command is "User::all()", and type "exit" to end
- type "\App\Sample::truncate();" with tinker to erase all data on current model

`#10` Routes
- the app routes files are located on "/routes/"
- the best practice of route naming is using "RESTful Resource Controllers" rule
- https://laravel.com/docs/5.1/controllers#restful-resource-controllers

`#11` Application model
- the app routes files are located on "/app/"
- type "php artisan make:model Sample -m" to create a model
- the "-m" argument will also create a migration file for this model
- edit the migration file on folder "/database/migrations/"
- type "php artisan migrate" to apply the new migration file to the database

`#12` Image storage
- type "php artisan storage:link" to make the file storage accessible to public

`#13` Adding external library for handle the image resizing
- type "composer require intervention/image" to to add the library
- use this namespace on your page "Intervention\Image\Facades\Image"

`#14` Access Policy
- type "php artisan make:policy SamplePolicy -m Sample" to make a policy to a controller

`#15` Command to create a migration pivot table (many-to-many)
- php artisan make:migration creates_profile_user_pivot_table --create profile_user
- the names are sorted alphabeticaly, so its begin with [p]rofile instead of [u]ser

`#16` Laravel telescope
- type "composer require laravel/telescope" to add the module
- type "php artisan telescope:install" to install the module
- type "php artisan migrate" to deploy the modules table
- visit the telescope app via "yourapp/telescope" on your browser url 

`#17` Email on laravel
- using mailtrap.io to receive the email / fake mailbox
- type "php artisan make:mail SampleUserEmail -m emails.sample-email"
- setup the mailtrap.io credential on .env
- re-start the "php artisan serve" to apply the new .env settings

`#18` Create symlink on server with php
- create a .php file on the server
- inside the file, type "<?php symlink('/home/haris.com/harisweb/storage/app/public', '/home/haris.com/public_html/storage')"
- run the .php file on the browser