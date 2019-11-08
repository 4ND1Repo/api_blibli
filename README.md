###API for connect to blibli.com
Donate me please [PAYPAL](https://www.paypal.me/andifauji)

Requirement :
* Laravel/Lumen/Symfony
* Composer
* Apache/Nginx
* PHP version ^5.3

Using :
Open CLI client and navigate to laravel/lumen/symfony

example:
```
$ composer require kedaisayur/blibli
```
Add some variable in **.env** file like this :
```ENV
...

BLIBLI_ENV=[production|staging]
BLIBLI_SECRETKEY=[FROM MTA API Documentation]
BLIBLI_MERCHANTID=[FROM MTA profile]
BLIBLI_CLIENTID_USERNAME=[FROM MTA API Documentation]
BLIBLI_CLIENTID_PASSWORD=[FROM MTA API Documentation]
BLIBLI_CHANNELID=[FROM MTA API Documentation]
BLIBLI_USERNAME=[USER MTA Login]
BLIBLI_PASSWORD=[PASSWORD MTA Login]

...
```

Example Code(Lumen) :
```php
<?php

namespace ...;

use Blibli\Orders;
...

public function order(Request $r){
	// create new class order
	$order = new Order();
    $order::setBody([
    	...
        array of option in API Documentation
        ...
    ]);
    // getting result
    $result = $order::orderList();

    return response()->json($result,200);
}

```
---
####Ongoing Progress
---
- [x] Authentication
- [x] Order Collection
- [ ] Order Operation
- [ ] Product Collection
- [ ] Product Operation
- [ ] Product Discustion
- [ ] SAS
- [ ] Queue
- [ ] Obsolete API