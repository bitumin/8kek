# 8kek
## A Laravelian 9gag clone

I had some free hours during summer vacations and I thought: 

> Hey, let's just clone 9gag the Laravel way

This is the unpolished result out of it.

### Packages that I added in composer.json

* "laravel/framework" - Laravel 5.2, for obvious reasons 
* "intervention/image" - I was planning to manipulate the uploaded images with this package... Guess what, I didn't, but it's here nonetheless just in case
* "laravel/socialite" - Handle social login
* "greggilbert/recaptcha" - To try to avoid the spam in both sign ups and posting
* Plus several dev packages for the sake of rapid development/debugging: ide-helper, debug-bar, generators

### Actual developments

* Models and database: post and comments models, factories, seeders and table migrations
* Basic Requests and Controllers to handle post posting, post voting, registration, traditional and social login...
* Views: made some neat login and register views, a single layout, a pair of modals and two extra main views: home and post views
* Other resources: Some basic sass/css and javascript magic, plus the proper gulp tasks to build and publish the resulting minified files

### Contributing

To make this clone closer to a production cloned version of 9gag someone would have to invest some extra development time. And I don't think it's gonna be me.

Things that need some work:

* To finish the social login controllers
* User dashboard page to handle user data
* A good looking front-end
* A good comments system 
