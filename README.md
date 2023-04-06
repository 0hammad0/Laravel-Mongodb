<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<h1>Install the package via Composer:</h1>
    $ composer require jenssegers/mongodb

<h1>Laravel</h1>
In case your Laravel version does NOT autoload the packages, add the service provider to config/app.php:
    Jenssegers\Mongodb\MongodbServiceProvider::class,

<h1>Database Testing</h1>
To reset the database after each test, add:
    use Illuminate\Foundation\Testing\DatabaseMigrations;
Also inside each test classes, add:
    use DatabaseMigrations;
    
<h1>Configuration</h1>
To configure a new MongoDB connection, add a new connection entry to config/database.php:
    'mongodb' => [
    'driver' => 'mongodb',
    'dsn' => env('DB_DSN'),
    'database' => env('DB_DATABASE', 'homestead'),
],

<h1>Extending the base model</h1>
This package includes a MongoDB enabled Eloquent class that you can use to define models for corresponding collections.

    use Jenssegers\Mongodb\Eloquent\Model;
    class Book extends Model
    {
        //
    }
