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
    creationDate DATE NOT NULL,
    hashedPassword VARCHAR(255) NOT NULL,
    isAdmin BOOLEAN DEFAULT FALSE
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
    reserved BOOLEAN DEFAULT FALSE,
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

-- Create a table for chats between buyers and sellers
CREATE TABLE CHAT (
    chatID INTEGER PRIMARY KEY AUTOINCREMENT,
    buyerID INT NOT NULL,    
    sellerID INT NOT NULL,
    productID INT NOT NULL,
    FOREIGN KEY(buyerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(sellerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create a table for messages within chats
CREATE TABLE MESSAGE_ (
    messageID INTEGER PRIMARY KEY AUTOINCREMENT,    
    chatID INT NOT NULL,
    senderID INT NOT NULL,
    messageText TEXT NOT NULL,
    messageDate DATE NOT NULL,
    FOREIGN KEY(chatID) REFERENCES CHAT(chatID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(senderID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE
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
INSERT INTO USERS (userID, username, email, creationDate, hashedPassword, isAdmin) VALUES
(1,'FranciscoA', 'franciscompaf@gmail.com', '2023-04-01', 'd604daee58908ad200df132f555bf67fb3f10686', TRUE), -- pass: meusamigos
(2,'AnaP', 'ana.pereira@example.com', '2023-04-02', 'd604daee58908ad200df132f555bf67fb3f10686', FALSE),
(3,'MiguelC', 'miguel.correia@example.com', '2023-04-03', 'd604daee58908ad200df132f555bf67fb3f10686', FALSE),
(4,'SofiaG', 'sofia.gomes@example.com', '2023-04-04', 'd604daee58908ad200df132f555bf67fb3f10686', FALSE),
(5,'RicardoR', 'ricardo.reis@example.com', '2023-04-05', 'd604daee58908ad200df132f555bf67fb3f10686', FALSE),
(6,'CarlaM', 'carla.mendes@example.com', '2023-04-06', 'd604daee58908ad200df132f555bf67fb3f10686', TRUE),
(7,'PedroL', 'pedro.lima@example.com', '2023-04-07', 'd604daee58908ad200df132f555bf67fb3f10686', FALSE),
(8,'JoanaF', 'joana.ferreira@example.com', '2023-04-08', 'd604daee58908ad200df132f555bf67fb3f10686', TRUE),
(9,'LuisN', 'luis.nunes@example.com', '2023-04-09', 'd604daee58908ad200df132f555bf67fb3f10686', TRUE),
(10,'MartaS', 'marta.silva@example.com', '2023-04-10', 'd604daee58908ad200df132f555bf67fb3f10686', FALSE);

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
(25, 'Outra');

-- Insert statements for the CATEGORY table
INSERT INTO CATEGORY (categoryID, categoryName) VALUES
(1, 'Telemóveis'),
(2, 'Tablets'),
(3, 'Capas'),
(4, 'Power Banks');


-- Insert statements for the CONDITION table
INSERT INTO CONDITION (conditionID, conditionName) VALUES
(1, 'Novo'),
(2, 'Como Novo'),
(3, 'Usado');


-- Insert statements for the PRODUCT table including titles
INSERT INTO PRODUCT (productID, sellerID, brandID, categoryID, locationID, conditionID, title, description, price) VALUES
(1, 3, 1, 3, 12, 1, 'Capa Magsafe iPhone 15 Pro', 'Em perfeitas condições, nunca usado.', 25.00), --capas
(2, 2, 2, 1, 11, 3, 'Samsung Galaxy S21 FE Preto', 'Alguns sinais de uso na parte frontal. 6GB/128GB', 400.00), --telemovel
(3, 1, 2, 2, 11, 1, 'Samsung Galaxy Tab S9', 'Novo, ainda selado, 256GB.', 650.00), --tablet
(4, 3, 1, 3, 12, 1, 'Capa iPhone 12 Preta', 'Em perfeitas condições, nunca usado.', 20.00), --capas
(5, 2, 3, 1, 11, 2, 'Google Pixel 8 Hazel', 'Como novo.', 600.00),  --telemovel
(6, 4, 4, 2, 11, 1, 'Huawei MatePad Pro', 'Conjunto completo com caneta e capa com teclado', 800.00), --tablet
(7, 1, 1, 1, 11, 2, 'iPhone 13 Branco', 'Com alguns arranhões', 700.00), --telemovel --capas 
(8, 3, 1, 3, 12, 1, 'Capa iPhone XS Azul', 'Em perfeitas condições, nunca usado.', 20.00), --capas
(9, 7, 5, 2, 11, 2, 'Redmi Pad SE Gray ', 'Como novo. 6GB de Ram e 128GB de armazenamento.', 200.00), --tablet
(10, 6, 5, 2, 9, 1, 'Xiaomi Pad 6 Champagne', 'Novo, ainda selado. 8GB/256GB. ', 379.00), --tablet
(11, 5, 6, 1, 2, 1, 'OnePlus 12R Azul', 'Novo, ainda selado. 16GB/256GB.', 600.00), --telemovel
(12, 5, 6, 1, 2, 1, 'OnePlus CE 3 Lite Lima', 'Novo, ainda selado. 8GB/128GB', 220.00), --telemovel
(13, 8, 4, 1, 5, 3, 'Huawei P50 Pocket Dourado', 'Alguns sinais de uso. 12GB/512GB', 500.00), --telemovel
(14, 3, 1, 3, 12, 1, 'Capa iPhone 12 Azul', 'Em perfeitas condições, nunca usado.', 20.00), --capas
(15, 3, 1, 3, 12, 1, 'Capa iPhone 12 Branca', 'Em perfeitas condições, nunca usado.', 20.00), --capas
(16, 3, 1, 3, 12, 1, 'Capa iPhone 12 Pro Rosa', 'Em perfeitas condições, nunca usado.', 20.00), --capas
(17, 3, 1, 3, 12, 1, 'Capa iPhone 15 Azul Claro', 'Em perfeitas condições, nunca usado.', 20.00), --capas
(18, 3, 1, 3, 12, 1, 'Capa iPhone SE Vermelha', 'Em perfeitas condições, nunca usado.', 20.00), --capas
(19, 5, 6, 1, 2, 1, 'Samsung A55 Navy', 'Novo, ainda selado. 8GB/128GB', 400.00), --telemovel
(20, 5, 6, 1, 2, 1, 'Samsung A35 Ice', 'Novo, ainda selado. 6GB/128GB', 330.00), --telemovel
(21, 10, 2, 4, 7, 3, 'Powerbank Samsung Bege', 'Usada várias vezes, 10000mAh', 25.00),
(22, 2, 5, 4, 10, 1, 'Powerbank Xiaomi Azul', 'Nova, ainda selada. 10000mAh', 25.00),
(23, 2, 5, 4, 10, 1, 'Powerbank Xiaomi Wireless', 'Nova, ainda selada. 10000mAh', 30.00),
(24, 8, 5, 4, 7, 2, 'Powerbank Xiaomi Azul', 'Caixa aberta, mas não foi usada. 10000mAh', 19.00);



-- Insert statements for the PHOTO table
INSERT INTO PHOTO (photoID, productID, photoURL) VALUES
(1, 1, '../assets/products/magsafecase.jpg'),
(2, 2, '../assets/products/samsung.jpg'),
(3, 3, '../assets/products/ipad.jpg'),
(4, 4, '../assets/products/13case.jpg'),
(5, 5, '../assets/products/pixel6.jpg'),
(6, 6, '../assets/products/huawei.jpg'),
(7, 7, '../assets/products/iphone13.jpg'),
(8,8, '../assets/products/xscase.jpg'),
(9, 9, '../assets/products/redmipad1.jpg'),
(10,9, '../assets/products/redmipad2.jpg'),
(11,10, '../assets/products/xiaomipad1.jpg'),
(12,10, '../assets/products/xiaomipad2.jpg'),
(13,11, '../assets/products/oneplus12r1.jpg'),
(14,11, '../assets/products/oneplus12r2.jpg'),
(15,12, '../assets/products/oneplusnord1.jpg'),
(16,13, '../assets/products/p50pocket1.jpg'),
(17,13, '../assets/products/p50pocket2.jpg'),
(18,14, '../assets/products/12case3.jpg'),
(19,15, '../assets/products/12case2.jpg'),
(20,16, '../assets/products/12procase.jpg'),
(21,17, '../assets/products/15case.jpg'),
(22,18, '../assets/products/secase.jpg'),
(23,19, '../assets/products/a55_navy.jpg'),
(24,20, '../assets/products/a35_ice.jpg'),
(25,21, '../assets/products/powerbanksam.jpg'),
(26,22, '../assets/products/powerbankxiaomi1.jpg'),
(27,23, '../assets/products/powerbankxiaomi2.jpg'),
(28,24, '../assets/products/powerbankxiaomi3.jpg');

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


