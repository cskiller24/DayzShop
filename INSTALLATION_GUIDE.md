# Installation Guide

## Using XAMPP / Laragon

### Pre-requisites

1. PHP Latest Version 8.3
2. Composer
3. Web Server (Apache/Nginx/PHP Local Web Server using cli)
4. Database (MySQL)

- Luckily all the pre-requisites are installed in Laragon
- Install [Laragon](https://laragon.org/download/)
- You may need to install a latest php version in
  laragon, [here](https://forum.laragon.org/topic/166/tutorial-how-to-add-another-php-version) is the guide
- Install [composer](https://getcomposer.org/download/)

Once you open the laragon, open your command line and change directory to where the laragon is
installed `${LARAGON}/www/`

#### Installation Steps

1. Clone the app

```bash
$ git clone https://github.com/cskiller24/DayzShop dayzshop
```

2. Copy the environment file

```bash
$ cp .env.example .env
```

3. Inside the dayzshop app, install dependencies

```bash
$ composer install
```

4. Generate keys

```bash
$ php artisan key:generate
```

5. Run the migrations and seed the file

```bash
$ php artisan migrate:fresh --seed
```

6. Connect the storage to public

```bash
$ php artisan storage:link
```

7. Install npm dependencies

```bash
$ npm install
```

8. Run in development

```bash
$ npm run dev
```

9. On another terminal, serve the application

```bash
$ php artisan serve
```
