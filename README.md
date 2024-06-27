# Revamp

## Contributors

- [*Alexandre Ramos*](https://github.com/progr-amador) [*up202208028*@fe.up.pt](mailto:up202208028@fe.up.pt)
- [*Francisco Afonso*](https://github.com/franciscoafons0) [*up202208115*@fe.up.pt](mailto:up202208115@fe.up.pt)

## Install Instructions

    git clone git@github.com:progr-amador/Revamp.git
    sqlite database/database.db < database/database.sql
    php -S localhost:9000

## Screenshots

![home](docs/home.png)
![profile](docs/profile.png)
![chat](docs/chat.png)

## Implemented Features

**General**

- [x] Register a new account.
- [x] Log in and out.
- [x] Edit their profile, including their name, username, password, and email.

**Sellers**

- [x] List new items, providing details such as category, brand, model, size, and condition, along with images.
- [x] Track and manage their listed items.
- [x] Respond to inquiries from buyers regarding their items and add further information if needed.
- [x] Print shipping forms for items that have been sold.

**Buyers**

- [x] Browse items using filters like category, price, and condition.
- [x] Engage with sellers to ask questions or negotiate prices.
- [x] Add items to a wishlist or shopping cart.
- [x] Proceed to checkout with their shopping cart (simulate payment process).

**Admins**

- [x] Elevate a user to admin status.
- [x] Introduce new item categories, sizes, conditions, and other pertinent entities.
- [x] Oversee and ensure the smooth operation of the entire system.

**Security**

- [x] SQL injection.
- [x] Cross-Site Scripting (XSS).
- [x] Cross-Site Request Forgery (CSRF).

**Password Storage Mechanism**: hash_password&verify_password