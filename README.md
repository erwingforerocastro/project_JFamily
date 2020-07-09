<div align="center">
  <a target="_blank" href="https://laravel.com/">
    <img src="./logo.svg" alt=laravel" width="150" height="150">
  </a>
</div>

<div align="center">

# Simple project JFamily

**Ejemplo simple de laravel para el manejo de usuarios y sus familias**

Erwing FC @ 2019
</div>

# Laravel

## Project setup
```
composer install
```

### migrate databases
```
php artisan migrate
```

### Run seeds
```
php artisan db:seed
```

## Factory users (run before `php artisan tinker`)
```
$users = factory(App\User::class, 3)->make();
```

### Run 
```
php artisan test
```

### activate server
```
php artisan serve
```


### References
See [Laravel installation](https://laravel.com/docs/5.7).

------------------------------------------------------------------------------------------------------------------------------------------------------
