# php-winecalculator

prepare products catalog based on php console command

## Table of Contents

- Installation
- Getting Started
- Result

## Installation

```bash
# installation commands
git clone https://github.com/padkan/php-winecalculator.git
cd php-winecalculator
composer install
```

## Getting Started

```bash
# console custom command WINE:catalog
# arguments path: input/products.json
php index.php WINE:catalog input/products.json
```

```bash
# run tests
 php ./vendor/phpunit/phpunit/phpunit
```

## Result

```bash
# result
+---------+---------------+-------------+---------+-------+
| SKU     | Package Price | Price/Liter | Bottles | Liter |
+---------+---------------+-------------+---------+-------+
| WINE001 | 62.2          | 15.95       | 6       | 3.9   |
| WINE002 | 89.9          | 7.13        | 18      | 12.6  |
| WINE003 | 29.9          | 2.05        | 21      | 14.6  |
| WINE004 | 129.9         | 8.57        | 23      | 15.15 |
| WINE005 | 29.9          | 1.72        | 29      | 17.4  |
+---------+---------------+-------------+---------+-------+
```
