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
DROP TABLE IF EXISTS CONDITION;
DROP TABLE IF EXISTS BRAND;
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS LOCATION_;
DROP TABLE IF EXISTS RATING;

/*******************************************************************************
   Create Tables
********************************************************************************/

-- Create a table for physical locations (optional)
CREATE TABLE LOCATION_ (
    locationID INTEGER PRIMARY KEY AUTOINCREMENT,
    locationName VARCHAR(255) NOT NULL
);

-- Create a table for users
CREATE TABLE USERS (
    userID INTEGER PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
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
    brandID INTEGER PRIMARY KEY AUTOINCREMENT,
    brandName VARCHAR(255) NOT NULL
);

-- Create a table for product categories
CREATE TABLE CATEGORY (
    categoryID INTEGER PRIMARY KEY AUTOINCREMENT,
    categoryName VARCHAR(255) NOT NULL
);

-- Create a table for product condition
CREATE TABLE CONDITION (
    conditionID INTEGER PRIMARY KEY AUTOINCREMENT,
    conditionName VARCHAR(255) NOT NULL
);

-- Create a table for products
CREATE TABLE PRODUCT (
    productID INTEGER PRIMARY KEY AUTOINCREMENT,
    sellerID INT NOT NULL,
    brandID INT,
    categoryID INT,
    locationID INT,
    conditionID INT,
    title VARCHAR(60),
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY(sellerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(brandID) REFERENCES BRAND(brandID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(categoryID) REFERENCES CATEGORY(categoryID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(locationID) REFERENCES LOCATION_(locationID) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY(conditionID) REFERENCES CONDITION(conditionID) ON DELETE SET NULL ON UPDATE CASCADE
);

-- Create a table for photos associated with products
CREATE TABLE PHOTO (
    photoID INTEGER PRIMARY KEY AUTOINCREMENT,
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
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
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
INSERT INTO USERS (username, email, phoneNumber, creationDate, hashedPassword, address, isAdmin, locationID) VALUES
('FranciscoA', 'franciscompaf@gmail.com', '937222411', '2023-04-01', 'd604daee58908ad200df132f555bf67fb3f10686', 'Rua das Flores, Porto', TRUE, 13), -- pass: meusamigos
('AnaP', 'ana.pereira@example.com', '923456789', '2023-04-02', 'd604daee58908ad200df132f555bf67fb3f10686', 'Avenida Liberdade, Lisboa', FALSE, 11),
('MiguelC', 'miguel.correia@example.com', '934567890', '2023-04-03', 'd604daee58908ad200df132f555bf67fb3f10686', 'Praça do Comércio, Braga', FALSE, 3),
('SofiaG', 'sofia.gomes@example.com', '945678901', '2023-04-04', 'd604daee58908ad200df132f555bf67fb3f10686', 'Largo da Sé, Faro', FALSE, 8),
('RicardoR', 'ricardo.reis@example.com', '956789012', '2023-04-05', 'd604daee58908ad200df132f555bf67fb3f10686', 'Rua Major Ávila, Coimbra', FALSE, 6);

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


-- Insert statements for the CONDITION table
INSERT INTO CONDITION (conditionID, conditionName) VALUES
(1, 'Novo'),
(2, 'Como Novo'),
(3, 'Usado');


-- Insert statements for the PRODUCT table including titles
INSERT INTO PRODUCT (productID, sellerID, brandID, categoryID, locationID, conditionID, title, description, price) VALUES
(1, 1, 1, 1, 11, 2, 'iPhone 13, 128GB', 'Com alguns arranhões', 800.00),
(2, 2, 2, 1, 11, 3, 'Samsung Galaxy S21, 256GB', 'Alguns sinais de uso na parte frontal', 750.00),
(3, 1, 2, 2, 11, 1, 'Samsung Galaxy Tab S9, 256GB', 'Novo, ainda selado', 650.00),
(4, 3, 1, 3, 12, 1, 'Capa Protetora para iPhone 12 ', 'Em perfeitas condições, nunca usado.', 20.00),
(5, 2, 3, 1, 11, 2, 'Google Pixel 6, 128GB', 'Como novo.', 700.00),
(6, 4, 4, 2, 11, 1, 'Huawei MatePad Pro, 256GB', 'Conjunto completo com caneta e capa com teclado', 800.00),
(7, 3, 1, 3, 12, 1, 'Película de vidro para Iphone 13', 'Vidro temperado, grande durabilidade.', 15.00),
(8, 1, 5, 3, 11, 1, 'Capa para Xiaomi Redmi Note 10 ', 'Capa protetora, anti-quedas.', 10.00);


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
(1, 1, '../assets/products/iphone13.jpg'),
(2, 2, '../assets/products/samsung.jpg'),
(3, 3, '../assets/products/ipad.jpg'),
(4, 4, '../assets/products/13case.jpg'),
(5, 5, '../assets/products/pixel6.jpg'),
(6, 6, '../assets/products/huawei.jpg'),
(7, 7, '../assets/products/13screen.jpg'),
(8, 8, '../assets/products/redmicase.jpg');

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
(1, 1, 1, 'Olá, io Google Pixel 6 ainda está disponível?', '2023-04-01 08:30:00'),
(2, 1, 2, 'Sim, ainda está disponível. Precisa de saber mais detalhes?', '2023-04-01 08:45:00'),
(3, 2, 1, 'Pode fornecer mais detalhes sobre a película de vidro?', '2023-04-01 09:00:00'),
(4, 2, 3, 'Claro, é de vidro temperado, muito resistente e anti-riscos.', '2023-04-01 09:15:00'),
(5, 3, 2, 'Estou interessado no MatePad. Qual é o preço mais baixo que consegue fazer?', '2023-04-01 10:00:00'),
(6, 3, 4, 'COnsigo fazer por €750, com o teclado e com a caneta.', '2023-04-01 10:15:00');


