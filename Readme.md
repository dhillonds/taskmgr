********************
Project: Task Manager (taskmgr)
Author: Damanjeet Singh Dhillon
Date: March 31st 2025
********************
Instructions to run this taskmgr program:
- Use this laravel folder with the dependencies in composer file in a current version laravel environment
- Create a database in your mysql named 'taskmgr'
- Update .env file with the database connection variables
- Run php artisan migrate to run the migrations provided inside the folder
- Run php artisan db:seed --class=ProjectsSeeder
- Run php artisan serve command and run the application

Note: This was setup using Laravel Herd initially so there is some extra css or code that was thrown initially.
If the routing doesn't work for localhost system try url "http://taskmgr.test/" fix the hosts file in /etc/hosts this was setup by the Laravel Herd software initially for my sister
