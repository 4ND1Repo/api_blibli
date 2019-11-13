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

Notes :
- if POST data is raw format use this line for in your controller or script :
  ```php
  ...
    // for lumen/laravel
    $raw = json_decode(Request::getContent());
    $order::setBody($raw);

    // for php native
    $raw = json_decode(file_get_contents("php://input"));
    $order::setBody($raw);
    
  ...
  ```
---
####Ongoing Progress
---
- [x] Authentication
- [x] Order Collection
- [ ] Order Operation
- [x] Product Collection
- [ ] Product Operation
- [ ] Product Discussion
- [ ] SAS
- [x] Queue
- [ ] Obsolete API


---
####Cheatsheet

|   Type   | Name | Namespace | Class | Tested |
| ---- | ---- | ---------- | ----- | ------ |
|  Order Collection | Order List  | \Blibli\Orders | orderList() | v |
|  Order Collection | Order Detail | \Blibli\Orders | orderDetail() | v |
|  Order Collection | Download shipping label | \Blibli\Orders | orderDownloadShipping() | v |
|  Order Collection | Airway Bill Information  | \Blibli\Orders | orderAirwayBill() | v |
|  Order Collection | Combine Shipping List  | \Blibli\Orders | orderCombineShippingList() | v |
|  Order Collection | Returned Order List  | \Blibli\Orders | orderReturnList() | v |
|  Order Collection | Returned Order Detail  | \Blibli\Orders | orderReturnDetail() | v |
| Product Collection | Product List V2 | \Blibli\Products | productListV2() | v |
| Product Collection | Product Detail | \Blibli\Products | productDetail() | v |
| Product Collection | Category Tree | \Blibli\Products | productCategoryTree() | v |
| Product Collection | Category Attribute List | \Blibli\Products | productCategoryAttribute() | v |
| Product Collection | Brand List | \Blibli\Products | productBrand() | v |
| Product Collection | Pickup Point List | \Blibli\Products | productPickupPoint() | v |
| Product Collection | Product In Process | \Blibli\Products | productInProcess() | v |
| Product Collection | Rejected Product List | \Blibli\Products | productRejectList() | v |
| Product Collection | Rejected Product List by merchantSku | \Blibli\Products | productRejectListByMerchant() | v |
| Product Collection | Product History | \Blibli\Products | productHistory() | v |
| Queue Collection | Queue List | \Blibli\Queues | queueList() | v |
| Queue Collection | Queue Detail | \Blibli\Queues | queueDetail() | v |
| Self Approval Service | Request Token for SAS | \Blibli\Sas | sasReqToken() | x |
| Self Approval Service | Order Creation Service | \Blibli\Sas | sasCreateOrder() | x |
| Self Approval Service | Order Approval Service | \Blibli\Sas | sasApprovalOrder() | x |
| Self Approval Service | Product Approval Service by Product Code | \Blibli\Sas | sasApprovalProductByCode() | x |
| Self Approval Service | Product Approval Service by Product Name | \Blibli\Sas | sasApprovalProductByName() | x |
| Obsolete API | Queue Status | \Blibli\Queues | queueStatus() | v |