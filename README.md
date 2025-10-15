<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## BarberShop

<p>Creating the app:</p>

<code>composer create-project laravel/laravel barberApp</code>

<p>
Create the database and its administrator user. Configure the environment settings in .env.
</p>

<p>Creating model, controller, migration and resource methods</p>

<code>php artisan make:model --migration --controller --resource Peinado</code>

<p>Table schema:</p>

<code<pre>>Schema::create('peinado', function (Blueprint $table) {
            $table->id();
            $table->string('author', 60);
            $table->string('name', 100)->unique();
            $table->string('hair', 20);
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('image', 100)->unique();
            $table->timestamps();
            $table->unique(['author', 'price']);
        });</pre></code>

<p>Model:</p>

<code>protected $table = 'peinado';
    protected $fillable = ['author', 'name', 'hair', 'description', 'price', 'image'];</code>