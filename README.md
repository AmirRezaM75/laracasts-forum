# Laracasts forum clone
A laracasts forum clone website developed using [Laravel](https://laravel.com) and [Vue.js](https://vuejs.org).
> Designed by [Tuds](https://twitter.com/tudssss) and all design rights belongs to [Laracasts](https://laracasts.com/discuss). Yes, all of them. That means icons, css and profile images.
  
## Installation
1) Clone this repo
    ``` 
    git clone git@github.com:AmirRezaM75/laracasts_forum.git && cd laracasts_forum
    ```
2) Install the project dependencies
    ```
    composer install && npm install
    ```
3) Create a copy of your **.env** file
    ```
    cp .env.example .env
    ```
    Configure your database credentials
    
    Configure SMTP
    > Email verification required during registration
    
    Configure Redis
    > Thread's visits stores in redis
    
    ``SCOUT_DRIVER=meilisearch``
    
    ``ADMIN_EMAIL=admin@example.com``
    
    ``php artisan key:generate``
    
4) Run [Redis](https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-redis-on-ubuntu-18-04)
5) Run [Meilisearch](https://github.com/meilisearch/MeiliSearch)
6) Prepare database
    ```
    php artisan migrate --seed
    ```
7) Update Meilisearch ranking orders and searchable field
   ```
   php artisan scout:setting
   ```
   Or reset to default:
   ```
   php artisan scout:setting -d
   ```
   
8) Create purifier cache directory
   ```
   php artisan vendor:publish --provider="Stevebauman\Purify\PurifyServiceProvider"
   ```
   
9) Link storage
    ```
    php artisan storage:link
    ```

10) Run
    ```
    php artisan serve
    ```
   
## Screenshots

![Laracasts Forum Clone](/storage/screenshot.png?raw=true "Laracasts Forum Clone")

## Contributing

Contributions, issues, and feature requests are welcome! 🤝

Feel free to check the [issues page](https://github.com/amirrezam75/laracasts_forum/issues).
