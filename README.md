# Laravel Eloquent Status Bit
[![Laravel](https://img.shields.io/badge/Laravel-~5.2-orange.svg?style=flat-square)](http://laravel.com)
[![License](http://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)

## Installation

#### Composer

Add this to your composer.json file, in the require object:

```javascript
"baytek/laravel-statusbit": "dev-master"
```

After that, run composer install to install the package.

## Configuration

#### Model Setup

Next, add the `StatusBit` trait to each of your statusable model definition:

```php
use Baytek\Laravel\StatusBit\Statusable;

class Post extends Eloquent
{
    use Statusable;
}
```