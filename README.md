# Mailchimpie

It is a small application built with Laravel and Tailwindcss, it allows you to manage your Mailchimp audience by creating subscribers, edit them, delete them and view them all in a list.

It is also possible to sync Mailchimp with an imported CSV file.


## Installation

Clone the project on whatever folder you want.
`git clone https://github.com/macmowl/mailchimpie.git`

Install nodejs dependencies
`npm install`

Install Composer packages
`composer require`

Initiate the sqlite db
`php artisan migrate`

Rename (or duplicate) the .env.example in .env and fill the 3 mailchimps variables. Mailchimp server is the usXX in the mailchip dashboard URL.

`npm run watch` in case you want to see your css changes.

Start your project with
`php artisan serve`

If everything's fine, you should see the app on port 8000 of localhost.

## Tech
- Laravel
- Tailwindcss
- brian2694/laravel-toastr
- mailchimp/marketing
- spatie/laravel-newsletter

