# nplesa/activityLog

Laravel 12 package that logs all HTTP requests and model operations.

## Installation

composer require nplesa/activitylog
php artisan migrate

## Usage

Use the trait in your model:

use Nplesa\\ActivityLog\\Traits\\LogsActivity;

class Post extends Model {
    use LogsActivity;
}

## License

MIT
