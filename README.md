# Online shopping platform basket API application.

***Domain Languages:***
1. Customer.
2. Marketeer (Sales person).
3. Basket.

***Basket API consists of:***
1. Customer can add products.
2. Customer can delete products.
3. Customer can increment products.
4. Marketeer person can list all the user's baskets (including previous which are checkout) and items.
4. Some errors are also handled such trying to remove an item which does not exist in the basket.

***Technical Notes:***
1. To demonstrate Domain Driven Design approach; I treated Customer's Basket as a Model of a domain. By this
   everything
   is segregated to its own folder `models/Basket`. Although, for such small projects DDD is
   over engineering.
2. There are around eight testcases written, yet some are missing.
3. Some functionality can be more furnish.
4. PHP 8.0 is now a standard for this project.
4. Laravel 8, Sanctum and Jetstream is used.

***Setting UP***
1. Get the clone and checkout to `solved` branch.
2. Run `vendor/bin/sail up -d` to build and run images.
2. Run `vendor/bin/sail composer install` if needed and make sure `.env` is present.
2. Run `vendor/bin/sail artisan migrate`.
3. Run `vendor/bin/sail test models/Basket/Tests` to run the tests.

***Notes:***
1. As `CustomerBasket` object is acting as a singleton and carrying all the necessary task of managing user's basket
   features. It is possible in near future it will grow. Therefore, all the features can be extracted to its own
   independent class and `CustomerBasket` will act as a Facade.
2. API url is segregated by user's realm. for example `api/customer/basket` and `api/marketeer/basket`. Here
   customer and marketeer act as a realm so when the application is loaded it will load all necessary stuff for
   user's realm. For example please check `Basket/Middleware/CustomerMiddleware` which gets loaded only for customer's
   realm.
3. Some core domain features are extracted to its root application. `/app` folder is treated as the primary
   part of the domain and all the models will inherit it.
4. There is no UI to test customer's basket features.
