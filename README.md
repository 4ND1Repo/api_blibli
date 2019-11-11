##API for connect to blibli.com

Donate me please...
[Paypal](https://www.paypal.me/andifauji)

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
- [x] Product Collection
- [ ] Product Operation
- [ ] Product Discustion
- [ ] SAS
- [ ] Queue
- [ ] Obsolete API


---
####Cheatsheet

|   Type   | Name | Namespace | Class |
| -------- | -------- | ---- | ---|
|  Order Collection | Order List  | \Blibli\Orders | orderList() |
|  Order Collection | Order Detail | \Blibli\Orders | orderDetail() |
|  Order Collection | Download shipping label | \Blibli\Orders | orderDownloadShipping() |
|  Order Collection | Airway Bill Information  | \Blibli\Orders | orderAirwayBill() |
|  Order Collection | Combine Shipping List  | \Blibli\Orders | orderCombineShippingList() |
|  Order Collection | Returned Order List  | \Blibli\Orders | orderReturnList() |
|  Order Collection | Returned Order Detail  | \Blibli\Orders | orderReturnDetail() |
| Product Collection | Product List V2 | \Blibli\Products | productListV2() |
| Product Collection | Product Detail | \Blibli\Products | productDetail() |
| Product Collection | Category Tree | \Blibli\Products | productCategoryTree() |
| Product Collection | Category Attribute List | \Blibli\Products | productCategoryAttribute() |
| Product Collection | Brand List | \Blibli\Products | productBrand() |
| Product Collection | Pickup Point List | \Blibli\Products | productPickupPoint() |
| Product Collection | Product In Process | \Blibli\Products | productInProcess() |
| Product Collection | Rejected Product List | \Blibli\Products | productRejectList() |
| Product Collection | Rejected Product List by merchantSku | \Blibli\Products | productRejectListByMerchant() |
| Product Collection | Product History | \Blibli\Products | productHistory() |