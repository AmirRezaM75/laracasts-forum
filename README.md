# Laracasts forum clone
A laracasts forum clone website developed using the [Laravel](https://laravel.com) and [Vue.js](https://vuejs.org).
> Designed by [Tuds](https://twitter.com/tudssss) and all design rights reserved for [Laracasts](https://laracasts.com/discuss). Yes, all of them. That means icons, css and profile images.
  
## Installation
1) Clone this repo
    ``` 
    git clone https://github.com/amirrezam75/laracasts_forum
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
    
    ``SCOUT_DRIVER=meilisearch``
    
    ``ADMIN_EMAIL=admin@example.com``
    
    ``php artisan key:generate``
    
4) Run [Redis](https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-redis-on-ubuntu-18-04)
5) Run [Meilisearch](https://github.com/meilisearch/MeiliSearch)
6) Prepare database
    ```
    php artisanb migrate --seed
    ```
7) Run
    ```
    php artisan serve
    ```
   
## Screenshots

![screencapture](https://i.postimg.cc/9Q9KKK3P/screencapture-localhost-8000-threads-envoyer-1-2021-04-24-20-00-09.png)

## Contributing

Contributions, issues, and feature requests are welcome! 🤝

Feel free to check the [issues page](https://github.com/amirrezam75/laracasts_forum/issues).
