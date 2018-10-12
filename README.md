# Laravel Telegram Bot

<img src="https://github.styleci.io/repos/123873859/shield"/>

### Installation

Clone the project and then do 

```sh
$ composer install
```

It will install the dependencies and then edit your `.env` file

```sh
DB_DATABASE=YOUR_DATABASE_NAME
DB_USERNAME=YOUR_USERNAME
DB_PASSWORD=YOUR_PASSWORD

TELEGRAM_CHAT_ID=YOUR_TELEGRAM_CHAT_ID
TELEGRAM_SECRET=YOUR_TELEGRAM_BOT_SECRET
```

After editing your `.env` file do the following

```sh
$ php artisan key:generate
$ php artisan config:cache
$ php artisan migrate
```

This will set the application key, clears the application cache and then migrates the necessary files. Thats it! 

Now you can go ahead and register yourself to use the application :)
