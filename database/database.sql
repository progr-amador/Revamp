PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS MESSAGE_;
DROP TABLE IF EXISTS CHAT;
DROP TABLE IF EXISTS CART;
DROP TABLE IF EXISTS FAVORITES;
DROP TABLE IF EXISTS SHIPPING_PRODUCT;
DROP TABLE IF EXISTS SHIPPING;
DROP TABLE IF EXISTS PHOTO;
DROP TABLE IF EXISTS PRODUCT;
DROP TABLE IF EXISTS CATEGORY;
DROP TABLE IF EXISTS BRAND;
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS LOCATION_;
DROP TABLE IF EXISTS RATING;

/*******************************************************************************
   Create Tables
********************************************************************************/

-- Create a table for physical locations (optional)
CREATE TABLE LOCATION_ (
    locationID INT PRIMARY KEY,
    locationName VARCHAR(255) NOT NULL
);

-- Create a table for users
CREATE TABLE USERS (
    userID INT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phoneNumber VARCHAR(20),
    creationDate DATE NOT NULL,
    hashedPassword VARCHAR(255) NOT NULL,
    address TEXT,
    locationID INT,
    isAdmin BOOLEAN DEFAULT FALSE,
    FOREIGN KEY(locationID) REFERENCES LOCATION_(locationID) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Create a table for product brands
CREATE TABLE BRAND (
    brandID INT PRIMARY KEY,
    brandName VARCHAR(255) NOT NULL
);

-- Create a table for product categories
CREATE TABLE CATEGORY (
    categoryID INT PRIMARY KEY,
    categoryName VARCHAR(255) NOT NULL
);

-- Create a table for products
CREATE TABLE PRODUCT (
    productID INT PRIMARY KEY,
    sellerID INT NOT NULL,
    brandID INT,
    categoryID INT NOT NULL,
    locationID INT,
    title VARCHAR(60),
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    condition VARCHAR(50), -- New, Like New, Used, etc.
    FOREIGN KEY(sellerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(brandID) REFERENCES BRAND(brandID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(categoryID) REFERENCES CATEGORY(categoryID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(locationID) REFERENCES LOCATION_(locationID) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Create a table for photos associated with products
CREATE TABLE PHOTO (
    photoID INT PRIMARY KEY,
    productID INT NOT NULL,
    photoURL VARCHAR(255) NOT NULL,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create a table for ratings given by users to products
CREATE TABLE RATING (
    ratedID INT,
    raterID INT,
    score INT CHECK (score >= 1 AND score <= 5),
    PRIMARY KEY(ratedID, raterID),
    FOREIGN KEY(ratedID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(raterID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create a table for shipping information
CREATE TABLE SHIPPING (
    shippingID INT PRIMARY KEY,
    sellerID INT NOT NULL,    
    buyerID INT NOT NULL,
    weight INT NOT NULL,
    FOREIGN KEY(sellerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(buyerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create a table for chats between buyers and sellers
CREATE TABLE CHAT (
    chatID INT PRIMARY KEY,
    buyerID INT NOT NULL,    
    sellerID INT NOT NULL,
    productID INT NOT NULL,
    FOREIGN KEY(buyerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(sellerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Create a table for messages within chats
CREATE TABLE MESSAGE_ (
    messageID INT PRIMARY KEY,    
    chatID INT NOT NULL,
    senderID INT NOT NULL,
    messageText TEXT NOT NULL,
    messageDate DATE NOT NULL,
    FOREIGN KEY(chatID) REFERENCES CHAT(chatID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(senderID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create a table for managing shipping details linked to products
CREATE TABLE SHIPPING_PRODUCT (
    shippingID INT,
    productID INT,
    PRIMARY KEY(shippingID, productID),
    FOREIGN KEY(shippingID) REFERENCES SHIPPING(shippingID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create a table for carts
CREATE TABLE CART (
    buyerID INT,
    productID INT,
    quantity INT DEFAULT 1,
    PRIMARY KEY(buyerID, productID),
    FOREIGN KEY(buyerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create a table for favorite products
CREATE TABLE FAVORITES (
    buyerID INT,
    productID INT,
    PRIMARY KEY(buyerID, productID),
    FOREIGN KEY(buyerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
);


/*******************************************************************************
   Populate Tables
********************************************************************************/
-- Insert statements for the LOCATION_ table
INSERT INTO LOCATION_ (locationID, locationName) VALUES
(1, 'Aveiro'),
(2, 'Beja'),
(3, 'Braga'),
(4, 'Bragança'),
(5, 'Castelo Branco'),
(6, 'Coimbra'),
(7, 'Évora'),
(8, 'Faro'),
(9, 'Guarda'),
(10, 'Leiria'),
(11, 'Lisboa'),
(12, 'Portalegre'),
(13, 'Porto'),
(14, 'Santarém'),
(15, 'Setúbal'),
(16, 'Viana do Castelo'),
(17, 'Vila Real'),
(18, 'Viseu'),
(19, 'Açores'),
(20, 'Madeira');

-- Insert statements for the USER_ table
INSERT INTO USERS (userID, username, email, phoneNumber, creationDate, hashedPassword, address, isAdmin, locationID) VALUES
(1, 'FranciscoA', 'franciscompaf@gmail.com', '937222411', '2023-04-01', 'Ltw_2024', 'Rua das Flores, Porto', TRUE, 13),
(2, 'AnaP', 'ana.pereira@example.com', '923456789', '2023-04-02', 'hashed_password_here', 'Avenida Liberdade, Lisboa', FALSE, 11),
(3, 'MiguelC', 'miguel.correia@example.com', '934567890', '2023-04-03', 'hashed_password_here', 'Praça do Comércio, Braga', FALSE, 3),
(4, 'SofiaG', 'sofia.gomes@example.com', '945678901', '2023-04-04', 'hashed_password_here', 'Largo da Sé, Faro', FALSE, 8),
(5, 'RicardoR', 'ricardo.reis@example.com', '956789012', '2023-04-05', 'hashed_password_here', 'Rua Major Ávila, Coimbra', FALSE, 6);

INSERT INTO BRAND (brandID, brandName) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Google'),
(4, 'Huawei'),
(5, 'Xiaomi'),
(6, 'OnePlus'),
(7, 'Sony'),
(8, 'LG'),
(9, 'Nokia'),
(10, 'Motorola'),
(11, 'Lenovo'),
(12, 'Asus'),
(13, 'Acer'),
(14, 'HTC'),
(15, 'Oppo'),
(16, 'Vivo'),
(17, 'Realme'),
(18, 'Blackberry'),
(19, 'Nothing'),
(20, 'TCL'),
(21, 'ZTE'),
(22, 'Meizu'),
(23, 'Honor'),
(24, 'Poco'),
(25, 'Tecno');

-- Insert statements for the CATEGORY table
INSERT INTO CATEGORY (categoryID, categoryName) VALUES
(1, 'Telemóveis'),
(2, 'Tablets'),
(3, 'Capas e Películas'),
(4, 'Carregadores e Cabos'),
(5, 'Power Banks');



-- Insert statements for the PRODUCT table including titles
INSERT INTO PRODUCT (productID, sellerID, brandID, categoryID, locationID, title, description, price, condition) VALUES
(1, 1, 1, 1, 11, 'iPhone 13, 128GB', 'A few little scratches on the back.', 800.00, 'Like New'),
(2, 2, 2, 1, 11, 'Samsung Galaxy S21, 256GB', 'Minor signs of use on the screen.', 750.00, 'Used'),
(3, 1, 2, 2, 11, 'Samsung Galaxy Tab S9, 256GB', 'Brand new, sealed in box.', 650.00, 'New'),
(4, 3, 1, 3, 12, 'iPhone 12 Protective Case', 'Perfect condition, never used.', 20.00, 'New'),
(5, 2, 3, 1, 11, 'Google Pixel 6, 128GB', 'Mint condition, barely used with original packaging.', 700.00, 'Like New'),
(6, 4, 4, 2, 11, 'Huawei MatePad Pro, 256GB', 'Full set, no scratches, with keyboard and stylus.', 800.00, 'New'),
(7, 3, 1, 3, 12, 'iPhone 13 Screen Protector', 'Tempered glass, high durability, anti-scratch.', 15.00, 'New'),
(8, 1, 5, 3, 11, 'Xiaomi Redmi Note 10 Case', 'Silicone case, shock-proof, with grip handle.', 10.00, 'New');



-- Insert statements for the RATING table
INSERT INTO RATING (ratedID, raterID, score) VALUES
(1, 3, 5),  -- User 3 rates User 1 with a score of 5
(2, 1, 4);  -- User 1 rates User 2 with a score of 4


-- Insert statements for the SHIPPING table
INSERT INTO SHIPPING (shippingID, sellerID, buyerID, weight) VALUES
(1, 1, 3, 500),
(2, 2, 1, 300);

-- Insert statements for the PHOTO table
INSERT INTO PHOTO (photoID, productID, photoURL) VALUES
(1, 1, 'https://cdn.discordapp.com/attachments/951794689353351169/1236395312285880442/iphone13-min.jpg?ex=6637da5d&is=663688dd&hm=6e423cc5f092d20f90b3ca61c817d061954829d1412e226cea2253cd9524811a&'),
(2, 2, 'https://cdn.discordapp.com/attachments/951794689353351169/1236395313212821565/samsung-min.jpg?ex=6637da5d&is=663688dd&hm=d959c293bdd7473fcb4e27f479c7945755d937a2ec37fa50c0192d16cfc7669f&'),
(3, 3, 'https://cdn.discordapp.com/attachments/951794689353351169/1236395311476248707/ipad-min.jpg?ex=6637da5d&is=663688dd&hm=de014e96489d203e9debe9fa4e08e18417569433161f6ed9525c9ff6bcbbe50d&'),
(4, 4, 'https://cdn.discordapp.com/attachments/951794689353351169/1236395310587056158/13case-min.jpg?ex=6637da5d&is=663688dd&hm=f2a5c55645e207ef86d0dff28ff430cf5386a212b9a9f4be4d09b805a2ab8e73&'),
(5, 5, 'https://cdn.discordapp.com/attachments/951794689353351169/1236395312621555752/pixel6-min.jpg?ex=6637da5d&is=663688dd&hm=181ffd133ea70c0864abc4cea03ddb69d4c275082cf8bb43d6c4c3aeededb835&'),
(6, 6, 'https://cdn.discordapp.com/attachments/951794689353351169/1236395311111606343/huawei-min.jpg?ex=6637da5d&is=663688dd&hm=b369a3e554ece6df2c2bd150698339a18fc7a26157c50b99ad4a5365f198fc1d&'),
(7, 7, 'https://cdn.discordapp.com/attachments/951794689353351169/1236395310847234120/13screen-min.jpg?ex=6637da5d&is=663688dd&hm=b72df26fc19d99595b4975187fbe6a515c0c5e1b7fb1d66805adef2723bdb9da&'),
(8, 8, 'https://cdn.discordapp.com/attachments/951794689353351169/1236395312927477770/redmicase-min.jpg?ex=6637da5d&is=663688dd&hm=6bbe33b9403593ba92bdd898c0e061c1428bc24939e4afa08fbbfc8e11304dfb&');

-- Insert statements for the FAVORITES table
INSERT INTO FAVORITES (buyerID, productID) VALUES
(3,4),
(4,7),
(5,6);

-- Insert statements for the CART table
INSERT INTO CART (buyerID, productID, quantity) VALUES
(1, 5, 1),  -- Buyer 1 adds 1 Google Pixel 6 to their cart
(1, 7, 2),  -- Buyer 1 adds 2 iPhone 13 Screen Protectors to their cart
(2, 6, 1),  -- Buyer 2 adds 1 Huawei MatePad Pro to their cart
(3, 8, 3),  -- Buyer 3 adds 3 Xiaomi Redmi Note 10 Cases to their cart
(4, 1, 1),  -- Buyer 4 adds 1 iPhone 13 to their cart
(5, 3, 1);  -- Buyer 5 adds 1 Samsung Galaxy Tab S6 to their cart

-- Insert statements for the CHAT table
INSERT INTO CHAT (chatID, buyerID, sellerID, productID) VALUES
(1, 1, 2, 5),  -- Chat session about the Google Pixel 6 between Buyer 1 and Seller 2
(2, 1, 3, 7),  -- Chat session about the iPhone 13 Screen Protector between Buyer 1 and Seller 3
(3, 2, 4, 6);  -- Chat session about the Huawei MatePad Pro between Buyer 2 and Seller 4

-- Insert statements for the MESSAGE_ table
INSERT INTO MESSAGE_ (messageID, chatID, senderID, messageText, messageDate) VALUES
(1, 1, 1, 'Hello, is the Google Pixel 6 still available?', '2023-04-01 08:30:00'),
(2, 1, 2, 'Yes, it is still available. Would you like more details?', '2023-04-01 08:45:00'),
(3, 2, 1, 'Can you provide more details about the screen protector?', '2023-04-01 09:00:00'),
(4, 2, 3, 'Sure, it is tempered glass, very durable and scratch-resistant.', '2023-04-01 09:15:00'),
(5, 3, 2, 'I am interested in the MatePad. What is the lowest price you can offer?', '2023-04-01 10:00:00'),
(6, 3, 4, 'I can offer it for €750, including the keyboard and stylus.', '2023-04-01 10:15:00');


