# Installation
1. Run composer install `composer install`
2. Run `php artisan key:generate` to generate the key application
3. Optional if you wanted to run `composer dumpautoload`
4. Copy **.env.example** to **.env**
5. Configure the **.env** file, such as **database**, **app**, and **mail** variables
6. Optional if you're not using any SMTP for verification just change the value **APP_SHOW_VERIFICATION_URL** the variable would help to show the verification URL instead of sending it to email.
7. Run npm install `npm install`
8. Run `npx mix watch` to compile JS and CSS.
9. Run database migration `php artisan migrate`
10. If you wanted to run Unittest `php artisan test`
11. Run seeder database `php artisan db:seed`
12. Run `php artisan serve` to serve the application.

# How to use
1. Open URL `http://localhost` on your browser
2. Application will redirect you to `/auth`
3. You could register a new account or use the one from the database seeder.
4. If you're registering a new account, make sure all the field is filled.
5. After registering you'll receive url for verification.
6. Verify your account, and then you'll be able to use the application.
7. Login to your account, and fill in the email and password field.
8. After login success you'll be redirected to the homepage.
9. To create a new transaction you can find the link on the footer card page.
10. Fill in the transaction information, and make sure your balance is no less than the transaction amount (if you choose to transact).
11. After finished creating a new transaction, you can confirm payment from the link on the header card page.
12. The popup will show if you want to confirm payment or not, if you confirm the transaction information will be changed, and in the meantime, the balance will change as well.