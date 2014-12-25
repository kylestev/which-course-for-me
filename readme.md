# Which Course For Me

## About

Which Course For Me started as a project for my CS 275, Introduction to Databases course at Oregon State.
Since I was already proficient in both MySQL and PHP, I decided to attempt something slightly more useful than
the [CRUD](https://en.wikipedia.org/wiki/Create,_read,_update_and_delete) final projects most of my peers made.

In short, this project scrapes the Oregon State University Course Catalog, and displays the information to users in a visually appealing manner. This project also provides a JSON REST API for others to consume. More details on that below.

Checkout the live deployment [here](https://which-course-for.me/).

## Notice

This project is under active development. Most features work, but the UI should be expected to change.

## Deploying

If you're feeling ambitious and want to get this setup on a dev environment follow these steps.

Please use [Laravel Homestead](http://laravel.com/docs/master/homestead) as your deployment environment to ensure your machine is provisioned in the way Laravel expects it to be.

`git clone https://github.com/kylestev/which-course-for-me` -- refer to the `Configure Your Shared Folders` section of the Laravel Homestead documentation to make nginx serve up content.

**Make sure to do the following after your VM is running and while inside your VM** (`homestead ssh`)

`cd which-course-for-me`

`cp .env.example .env`

Edit `.env` to match your environment's setup and credentials.

`php artisan migrate`

If you don't want to scrape OSU's Course Catalog, simply run:

`php artisan db:seed`

This will populate your database with fake data from the [Faker](https://github.com/fzaninotto/Faker) library. If you want to take a peek at how the database is seeded, look at `database/seeds/DatabaseSeeder.php`.

## Details

So what does it do?

It aggregates course information by scraping the Oregon State University Course Catalog. There are two main endpoints of this project:

### The Frontend

#### Screenshots

In a rush and can't deploy locally? Here are some screenshots of some of the pages available.

##### Site Index

<img src="https://i.imgur.com/FzktOld.png" />

##### Subjects Overview - Page 2

<img src="https://i.imgur.com/mIkpGVs.png" />

##### Drilling-down into CS courses

<img src="https://i.imgur.com/HWzbfNe.png" />

##### Drilling-down further into CS 271

<img src="https://i.imgur.com/SF7rGRC.png" />

### The REST API

The REST API allows programmers to access information about OSU courses, sections, instructors, and subjects through JSON encoded responses. This allows nearly any programming language access to this wealth of information in a streamlined and predictable fashion.

Every API route that returns a collection of resources supports pagination which allows clients to receive chunks of 25 elements at a time to iterate over all results.	

#### API Documentation

The docs are hosted on Apiary at [this address](http://docs.whichcourseforme.apiary.io/). You can try mock examples and see expected responses for different situations, including errors states.

