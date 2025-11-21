# Laravel Commands Cheat Sheet

This note contains common Laravel commands for creating files, migrations, and other operations, with a focus on Filament, Breeze, and Livewire.

## General Laravel Commands

### Creating Models, Controllers, and Migrations
- Create a model: `php artisan make:model ModelName`
- Create a model with migration: `php artisan make:model ModelName -m`
- Create a controller: `php artisan make:controller ControllerName`
- Create a resource controller: `php artisan make:controller ControllerName --resource`
- Create a migration: `php artisan make:migration migration_name`
- Create a seeder: `php artisan make:seeder SeederName`
- Create a factory: `php artisan make:factory FactoryName`

### Database Operations
- Run migrations: `php artisan migrate`
- Rollback last migration: `php artisan migrate:rollback`
- Refresh migrations (rollback and run again): `php artisan migrate:refresh`
- Reset migrations: `php artisan migrate:reset`
- Seed database: `php artisan db:seed`
- Migrate and seed: `php artisan migrate --seed`

### Other Useful Commands
- Create middleware: `php artisan make:middleware MiddlewareName`
- Create request: `php artisan make:request RequestName`
- Create event: `php artisan make:event EventName`
- Create listener: `php artisan make:listener ListenerName`
- Create job: `php artisan make:job JobName`
- Create mail: `php artisan make:mail MailName`
- Create notification: `php artisan make:notification NotificationName`

## Filament Commands

Filament is a Laravel admin panel builder.

### Creating Resources
- Create a Filament resource: `php artisan make:filament-resource ResourceName`
- Create a Filament resource for a model: `php artisan make:filament-resource ResourceName --model=ModelName`
- Create a simple Filament resource: `php artisan make:filament-resource ResourceName --simple`

### Creating Pages
- Create a Filament page: `php artisan make:filament-page PageName`
- Create a custom Filament page: `php artisan make:filament-page PageName --resource=ResourceName`

### Other Filament Commands
- Install Filament: `php artisan filament:install`
- Create a Filament user: `php artisan make:filament-user`
- Create a Filament widget: `php artisan make:filament-widget WidgetName`
- Create a Filament form: `php artisan make:filament-form FormName`

## Breeze Commands

Laravel Breeze provides simple authentication scaffolding.

### Installation and Setup
- Install Breeze: `php artisan breeze:install`
- Install Breeze with Blade: `php artisan breeze:install blade`
- Install Breeze with React: `php artisan breeze:install react`
- Install Breeze with Vue: `php artisan breeze:install vue`
- Install Breeze with API: `php artisan breeze:install api`

### Publishing Assets
- Publish Breeze config: `php artisan vendor:publish --tag=breeze-config`
- Publish Breeze views: `php artisan vendor:publish --tag=breeze-views`

## Livewire Commands

Livewire is a full-stack framework for Laravel.

### Creating Components
- Create a Livewire component: `php artisan make:livewire ComponentName`
- Create a Livewire component in a subdirectory: `php artisan make:livewire Subdirectory/ComponentName`
- Create an inline Livewire component: `php artisan make:livewire ComponentName --inline`

### Publishing Assets
- Publish Livewire config: `php artisan vendor:publish --tag=livewire-config`
- Publish Livewire views: `php artisan vendor:publish --tag=livewire-views`

## Combined Commands for Common Tasks

### Creating a Complete CRUD with Filament
1. Create model with migration: `php artisan make:model Post -m`
2. Create Filament resource: `php artisan make:filament-resource PostResource --model=Post`

### Setting up Authentication with Breeze
1. Install Breeze: `php artisan breeze:install`
2. Run migrations: `php artisan migrate`
3. Build assets: `npm install && npm run build`

### Creating a Livewire Component
1. Create component: `php artisan make:livewire Counter`
2. Add to a Blade view: `@livewire('counter')`

## Additional Tips
- Always run `composer dump-autoload` after creating new classes
- Use `php artisan list` to see all available commands
- Use `php artisan help command-name` for detailed help on a specific command
- For development, use `php artisan serve` to start the local server
- Build assets with `npm run dev` or `npm run build`
