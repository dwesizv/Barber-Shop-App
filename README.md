<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## BarberShop
<br>
<p>Creating the app:</p>
<pre>composer create-project laravel/laravel barberApp</pre>

<br>
<p>Create the database and its administrator user. Configure the environment settings in .env.</p>

<br>
<p>Creating model, controller, migration and resource methods</p>
<pre>php artisan make:model --migration --controller --resource Peinado</pre>

<br>
<p>Table schema:</p>
<pre>Schema::create('peinado', function (Blueprint $table) {
    $table->id();
    $table->string('author', 60);
    $table->string('name', 100)->unique();
    $table->string('hair', 20);
    $table->text('description');
    $table->decimal('price', 8, 2);
    $table->string('image', 100)->unique();
    $table->timestamps();
    $table->unique(['author', 'price']);
});</pre>

<br>
<p>Model:</p>
<pre>protected $table = 'peinado';
protected $fillable = ['author', 'name', 'hair', 'description', 'price', 'image'];</pre>

<br>
<p>Guardar cambios en git</p>
<pre>git add .
git commit -m 'Mensaje commit'
git push --set-upstream origin master
</pre>