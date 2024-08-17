# Fakerphp Lorem Toneflix Images

[![Latest Version on Packagist](https://img.shields.io/packagist/v/toneflix-code/fakerphp-lorem-toneflix.svg?style=flat-square)](https://packagist.org/packages/toneflix-code/fakerphp-lorem-toneflix)
[![Total Downloads](https://img.shields.io/packagist/dt/toneflix-code/fakerphp-lorem-toneflix.svg?style=flat-square)](https://packagist.org/packages/toneflix-code/fakerphp-lorem-toneflix)

**[Fakerphp Lorem Toneflix Images](https://github.com/toneflix/fakerphp-lorem-toneflix)** is an alternative image provider for [fakerphp](https://github.com/fakerphp/faker) using images from **Lorem Toneflix**

## Installation

Install the package using composer:

```bash
composer require --dev toneflix-code/fakerphp-lorem-toneflix
```

## Usage

### Add Provider

```php
$faker = \Faker\Factory::create();
$faker->addProvider(new \ToneflixCode\FakerLoremToneflix\FakerLoremToneflixProvider($faker));
```

### Return Image URL

```php
$image = $faker->imageUrl();
```

### Set Category

```php
$image = $faker->imageUrl(category: 'avatar');
```

### Set Image Resolution

```php
$image = $faker->imageUrl(width: 800, height: 600);
```

### Pixelate

```php
$image = $faker->imageUrl(pixelate: 5);
```

### Greyscale

```php
$image = $faker->imageUrl(grey: true);
```

### Add Text

```php
$image = $faker->imageUrl(text: 'I Love You');
```

### Marshup

```php
$image = $faker->imageUrl(
    grey: true,
    text: 'I Love You',
    width: 800,
    height: 600,
    pixelate: 5,
    category: 'avatar'
);
```
