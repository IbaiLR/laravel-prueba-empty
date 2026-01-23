php artisan make:migration create_tasks_table

En el archivo generado, verás que el método up usa Schema::table en lugar de Schema::create. Así debes dejarlo para cumplir con el esquema del examen:

php artisan make:migration add_extra_fields_to_users_table --table=users