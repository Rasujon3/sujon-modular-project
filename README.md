## Laravel Module based migration Commands

* php artisan make:migration create_products_table --path=app/Modules/**_~~Product~~_**/Database/Migrations
* php artisan migrate --path="app/Modules/**_~~Product~~_**/Database/Migrations"
