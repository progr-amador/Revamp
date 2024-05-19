PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS MESSAGE_;
DROP TABLE IF EXISTS CHAT;
DROP TABLE IF EXISTS CART;
DROP TABLE IF EXISTS FAVORITES;
DROP TABLE IF EXISTS PHOTO;
DROP TABLE IF EXISTS RESERVED;
DROP TABLE IF EXISTS PRODUCT;
DROP TABLE IF EXISTS CATEGORY;
DROP TABLE IF EXISTS CONDITION;
DROP TABLE IF EXISTS BRAND;
DROP TABLE IF EXISTS USERS;
DROP TABLE IF EXISTS LOCATION_;

/*******************************************************************************
   Create Tables
********************************************************************************/

-- Creates a table for physical locations (optional)
CREATE TABLE LOCATION_ (
    locationID INTEGER PRIMARY KEY AUTOINCREMENT,
    locationName VARCHAR(255) NOT NULL
);

-- Creates a table for users
CREATE TABLE USERS (
    userID INTEGER PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    creationDate DATE NOT NULL,
    hashedPassword VARCHAR(255) NOT NULL,
    isAdmin BOOLEAN DEFAULT FALSE
);

-- Creates a table for product brands
CREATE TABLE BRAND (
    brandID INTEGER PRIMARY KEY AUTOINCREMENT,
    brandName VARCHAR(255) NOT NULL
);

-- Creates a table for product categories
CREATE TABLE CATEGORY (
    categoryID INTEGER PRIMARY KEY AUTOINCREMENT,
    categoryName VARCHAR(255) NOT NULL
);

-- Creates a table for product condition
CREATE TABLE CONDITION (
    conditionID INTEGER PRIMARY KEY AUTOINCREMENT,
    conditionName VARCHAR(255) NOT NULL
);

-- Creates a table for products
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

-- Creates a table for photos associated with products
CREATE TABLE PHOTO (
    photoID INTEGER PRIMARY KEY AUTOINCREMENT,
    productID INT NOT NULL,
    photoURL VARCHAR(255) NOT NULL,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Creates a table for reserved products
CREATE TABLE RESERVED (
    productID INT NOT NULL,
    name VARCHAR(250) NOT NULL,
    district VARCHAR(100) NOT NULL,
    street VARCHAR(100) NOT NULL,
    door VARCHAR(10) NOT NULL,
    localidade VARCHAR(100) NOT NULL,
    postalCode VARCHAR(10) NOT NULL,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Creates a table for chats between buyers and sellers
CREATE TABLE CHAT (
    chatID INTEGER PRIMARY KEY AUTOINCREMENT,
    buyerID INT NOT NULL,    
    sellerID INT NOT NULL,
    productID INT NOT NULL,
    UNIQUE (buyerID, sellerID, productID),
    FOREIGN KEY(buyerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(sellerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Creates a table for messages within chats
CREATE TABLE MESSAGE_ (
    messageID INTEGER PRIMARY KEY AUTOINCREMENT,    
    chatID INT NOT NULL,
    senderID INT NOT NULL,
    messageText TEXT NOT NULL,
    messageDate DATE NOT NULL,
    FOREIGN KEY(chatID) REFERENCES CHAT(chatID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(senderID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Creates a table for carts
CREATE TABLE CART (
    buyerID INT,
    productID INT,
    quantity INT DEFAULT 1,
    PRIMARY KEY(buyerID, productID),
    FOREIGN KEY(buyerID) REFERENCES USERS(userID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Creates a table for favorite products
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
(1,'FranciscoA', 'franciscompaf@gmail.com', '2023-04-01', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', TRUE), -- pass: meusamigos
(2,'AnaP', 'ana.pereira@example.com', '2023-04-02', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', FALSE),
(3,'MiguelC', 'miguel.correia@example.com', '2023-04-03', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', FALSE),
(4,'SofiaG', 'sofia.gomes@example.com', '2023-04-04', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', FALSE),
(5,'RicardoR', 'ricardo.reis@example.com', '2023-04-05', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', FALSE),
(6,'CarlaM', 'carla.mendes@example.com', '2023-04-06', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', TRUE),
(7,'PedroL', 'pedro.lima@example.com', '2023-04-07', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', FALSE),
(8,'JoanaF', 'joana.ferreira@example.com', '2023-04-08', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', TRUE),
(9,'LuisN', 'luis.nunes@example.com', '2023-04-09', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', TRUE),
(10,'MartaS', 'marta.silva@example.com', '2023-04-10', '$2y$10$KWJxiEhWrbAWzge8I3SmG.niaUc2S2yVgrMYZ4d.Um9TeZ0OFTKvG', FALSE);

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
(1, 3, 1, 3, 12, 1, 'Capa Magsafe iPhone 15 Pro', 'Esta é uma capa Magsafe de alta qualidade projetada especificamente para o iPhone 15 Pro. Feita com materiais duráveis e resistentes, oferece proteção máxima contra quedas e arranhões. Sua compatibilidade com o sistema de carregamento Magsafe garante uma experiência conveniente e sem fios. Nunca usada, está em perfeitas condições.', 25.00), --capas
(2, 2, 2, 1, 11, 3, 'Samsung Galaxy S21 FE Preto', 'Este Samsung Galaxy S21 FE na cor preta é uma excelente opção para quem procura um smartphone poderoso e elegante. Equipado com um processador rápido e uma tela vibrante, oferece uma experiência de visualização imersiva. Apesar de apresentar alguns sinais de uso na parte frontal, está completamente funcional. Possui 6GB de RAM e 128GB de armazenamento para todas as suas necessidades de aplicativos e mídia.', 400.00), --telemovel
(3, 1, 2, 2, 11, 1, 'Samsung Galaxy Tab S9', 'Este tablet Samsung Galaxy Tab S9 é a escolha perfeita para produtividade e entretenimento. Com uma impressionante tela de alta resolução e um processador rápido, oferece uma experiência de uso suave e fluida. Ainda selado na embalagem original, possui 256GB de armazenamento para todos os seus aplicativos, fotos e vídeos. Ideal para quem busca um dispositivo novo e de alta qualidade.', 650.00), --tablet
(4, 3, 1, 3, 12, 1, 'Capa iPhone 12 Preta', 'Esta elegante capa para iPhone 12 na cor preta é feita de material resistente para proteger o seu dispositivo contra danos causados por quedas e arranhões. Nunca usada, está em condições impecáveis. Seu design fino e leve não adiciona volume ao seu telefone, mantendo-o confortável de segurar e fácil de transportar.', 20.00), --capas
(5, 2, 3, 1, 11, 2, 'Google Pixel 8 Hazel', 'O Google Pixel 8 na cor Hazel é um smartphone que combina estilo e desempenho. Com uma câmera de alta qualidade e recursos avançados de inteligência artificial, captura fotos e vídeos incríveis em qualquer condição de iluminação. Este dispositivo está praticamente novo, oferecendo uma experiência semelhante à de um produto recém-saído da caixa. Perfeito para quem busca um telefone excepcional para fotografia e multitarefa.', 600.00),  --telemovel
(6, 4, 4, 2, 11, 1, 'Huawei MatePad Pro', 'O Huawei MatePad Pro é mais do que apenas um tablet, é uma ferramenta versátil para produtividade e criatividade. Este conjunto completo inclui uma caneta e uma capa com teclado, transformando-o em uma estação de trabalho portátil. Sua tela grande e vibrante é perfeita para assistir a vídeos ou fazer anotações. Nunca usado, está pronto para desbloquear todo o seu potencial.', 800.00), --tablet
(7, 1, 1, 1, 11, 2, 'iPhone 13 Branco', 'Este iPhone 13 na cor branca é uma escolha popular para entusiastas de tecnologia. Apesar de alguns arranhões, funciona perfeitamente. Com um design elegante e recursos avançados, como uma câmera de alta resolução e um processador rápido, oferece uma experiência premium. Ideal para quem busca um iPhone confiável a um preço acessível.', 700.00), --telemovel --capas 
(8, 3, 1, 3, 12, 1, 'Capa iPhone XS Azul', 'Esta capa para iPhone XS na cor azul é uma maneira elegante de proteger o seu dispositivo contra danos diários. Feita de material durável, esta capa nunca foi usada e está em perfeitas condições. Seu design fino e leve não compromete a portabilidade do seu telefone.', 20.00), --capas
(9, 7, 5, 2, 11, 2, 'Redmi Pad SE Gray', 'Este tablet Redmi Pad SE na cor cinza é uma excelente escolha para quem procura um dispositivo versátil para trabalho e entretenimento. Com 6GB de RAM e 128GB de armazenamento, oferece um desempenho sólido e amplo espaço para seus aplicativos e arquivos. Praticamente novo, este tablet está pronto para ser o seu companheiro digital em todas as atividades do dia a dia.', 200.00), --tablet
(10, 6, 5, 2, 9, 1, 'Xiaomi Pad 6 Champagne', 'Este tablet Xiaomi Pad 6 na cor champagne é novo, ainda está selado na embalagem original. Com 8GB de RAM e 256GB de armazenamento, oferece desempenho de ponta e amplo espaço para todos os seus aplicativos e mídia. Seu design elegante e tela grande o tornam perfeito para produtividade e entretenimento.', 379.00), --tablet
(11, 5, 6, 1, 2, 1, 'OnePlus 12R Azul', 'O OnePlus 12R na cor azul é um smartphone de alta qualidade com especificações poderosas. Com 16GB de RAM e 256GB de armazenamento, oferece desempenho excepcional para multitarefa e armazenamento amplo para todos os seus arquivos e aplicativos. Este dispositivo está novo, ainda selado na embalagem original, pronto para oferecer uma experiência premium.', 600.00), --telemovel
(12, 5, 6, 1, 2, 1, 'OnePlus CE 3 Lite Lima', 'O OnePlus CE 3 Lite na cor lima é uma opção acessível para quem busca um smartphone com bom desempenho e design moderno. Com 8GB de RAM e 128GB de armazenamento, oferece um equilíbrio entre preço e desempenho. Este dispositivo está novo, ainda selado na embalagem original, pronto para ser seu parceiro digital do dia a dia.', 220.00), --telemovel
(13, 8, 4, 1, 5, 3, 'Huawei P50 Pocket Dourado', 'O Huawei P50 Pocket na cor dourada é um smartphone compacto com especificações poderosas. Apesar de alguns sinais de uso, está totalmente funcional, com 12GB de RAM e 512GB de armazenamento. Capture fotos e vídeos incríveis com sua câmera de alta resolução e desfrute de um desempenho excepcional em todas as suas tarefas diárias.', 500.00), --telemovel
(14, 3, 1, 3, 12, 1, 'Capa iPhone 12 Azul', 'Esta elegante capa para iPhone 12 na cor azul é uma escolha perfeita para quem busca proteção e estilo. Nunca usada, está em perfeitas condições. Adicione um toque de cor ao seu dispositivo e proteja-o contra danos causados por quedas e arranhões.', 20.00), --capas
(15, 3, 1, 3, 12, 1, 'Capa iPhone 12 Branca', 'Esta capa para iPhone 12 na cor branca é uma maneira elegante de proteger o seu dispositivo. Nunca usada, está em perfeitas condições. Seu design fino e leve mantém o seu telefone seguro sem adicionar volume.', 20.00), --capas
(16, 3, 1, 3, 12, 1, 'Capa iPhone 12 Pro Rosa', 'Esta capa para iPhone 12 Pro na cor rosa é uma escolha elegante e funcional para proteger o seu dispositivo. Nunca usada, está em perfeitas condições. Adicione um toque de cor e estilo ao seu iPhone sem comprometer sua proteção.', 20.00), --capas
(17, 3, 1, 3, 12, 1, 'Capa iPhone 15 Azul Claro', 'Esta capa para iPhone 15 na cor azul claro é uma maneira elegante de proteger o seu dispositivo. Nunca usada, está em perfeitas condições. Adicione estilo e proteção ao seu iPhone com esta capa de qualidade.', 20.00), --capas
(18, 3, 1, 3, 12, 1, 'Capa iPhone SE Vermelha', 'Esta capa para iPhone SE na cor vermelha é uma escolha vibrante para proteger o seu dispositivo. Nunca usada, está em perfeitas condições. Adicione um toque de cor e estilo ao seu iPhone com esta capa de qualidade.', 20.00), --capas
(19, 5, 6, 1, 2, 1, 'Samsung A55 Navy', 'O Samsung A55 na cor navy é um smartphone de alta qualidade com um design elegante e especificações sólidas. Com 8GB de RAM e 128GB de armazenamento, oferece desempenho rápido e amplo espaço para todos os seus aplicativos e mídia. Novo e ainda selado na embalagem original, está pronto para ser seu companheiro digital diário.', 400.00), --telemovel
(20, 5, 6, 1, 2, 1, 'Samsung A35 Ice', 'O Samsung A35 na cor ice é um smartphone novo e moderno, ainda selado na embalagem original. Com 6GB de RAM e 128GB de armazenamento, oferece um desempenho confiável e espaço suficiente para todos os seus aplicativos e fotos. Seu design elegante e tela vibrante fazem dele uma excelente escolha para usuários exigentes.', 330.00), --telemovel
(21, 10, 2, 4, 7, 3, 'Powerbank Samsung Bege', 'Este powerbank Samsung na cor bege é uma opção prática para carregar seus dispositivos em movimento. Usado várias vezes, possui uma capacidade de 10000mAh para várias recargas. Pequeno e portátil, é perfeito para viagens e uso diário.', 25.00),
(22, 2, 5, 4, 10, 1, 'Powerbank Xiaomi Azul', 'Este powerbank Xiaomi na cor azul é novo, ainda selado na embalagem original. Com uma capacidade de 10000mAh, oferece energia suficiente para carregar seus dispositivos várias vezes. Compacto e leve, é ideal para uso em viagens ou emergências.', 25.00),
(23, 2, 5, 4, 10, 1, 'Powerbank Xiaomi Wireless', 'Este powerbank Xiaomi wireless é uma opção conveniente para carregar seus dispositivos sem fio. Novo e ainda selado na embalagem original, possui uma capacidade de 10000mAh para várias recargas. Compatível com dispositivos habilitados para carregamento sem fio, oferece uma solução de energia sem complicações.', 30.00),
(24, 8, 5, 4, 7, 2, 'Powerbank Xiaomi Azul', 'Este powerbank Xiaomi na cor azul possui uma caixa aberta, mas nunca foi usado. Com uma capacidade de 10000mAh, oferece energia confiável para recarregar seus dispositivos. Compacto e leve, é perfeito para manter seus dispositivos carregados em movimento.', 19.00);


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


