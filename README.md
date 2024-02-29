PageableBundle
==============

This bundle adds a method 'getPage' to a Doctrine repository that paginates the result of a query.
It provides also the methods 'add' and 'remove'.


Installation
------------

Open a command console, enter your project directory and execute:

```console
$ composer require pportelette/pageable-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    Pportelette\PageableBundle\PportelettePageableBundle::class => ['all' => true],
];
```

Usage
-----

From a doctrine repository:

```php
// src/Repository/MyRepository.php
use Pportelette\PageableBundle\Repository\AbstractRepository;
use Pportelette\PageableBundle\Model\Pageable;

class MyRepository extends AbstractRepository
{
    public function getAllPaginated(int $page): Pageable {
        $queryBuilder = $this->createQueryBuilder('e');

        $nbPerPage = 50;

        return $this->getPage(
            $queryBuilder,
            $page,
            $nbPerPage
        );
    }
}
```

That's it!

The third parameter is optional and is '30' by default.
It is possible to change the default value by adding a configuration file:

```yaml
# config/packages/pportelette_pageable.yaml
pportelette_pageable:
  default:
    nb_per_page: 50
```
