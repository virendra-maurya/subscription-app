Install Steps
- clone this repo by 
``git clone git@github.com:virendra-maurya/subscription-app.git``
- composer install
- create database for this project
- run migration and seed command 
``php artisan migrate:fresh --seed``
- import postman collection Postman app
``./Subscription App.postman_collection.json``
- Set env variable for postman like 
example 
``base_url -> http://subscription-app.test/api/``
``test_website_sub_domain -> default``
