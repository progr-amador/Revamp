PRAGMA foreign_keys=ON;

DROP TABLE IF EXISTS USER;
DROP TABLE IF EXISTS BUYER;
DROP TABLE IF EXISTS SELLER;
DROP TABLE IF EXISTS ADMIN_;
DROP TABLE IF EXISTS CHAT;
DROP TABLE IF EXISTS MESSAGE_;
DROP TABLE IF EXISTS SHIPPING;
DROP TABLE IF EXISTS PRODUCT;
DROP TABLE IF EXISTS BRAND;
DROP TABLE IF EXISTS CATEGORY;
DROP TABLE IF EXISTS LOCATION_;
DROP TABLE IF EXISTS USER_LOCATION;
DROP TABLE IF EXISTS CART;


CREATE TABLE USER (
    userID INT,
    userame TEXT,
    email TEXT,
    phoneNumber INT,
    reputation INT,
    PRIMARY KEY(userID)
);

CREATE TABLE BUYER (
    buyerID INT,
    PRIMARY KEY(buyerID),
    FOREIGN KEY(buyerID) REFERENCES USER(userID)
);

CREATE TABLE SELLER (
    sellerID INT,
    PRIMARY KEY(sellerID),
    FOREIGN KEY(sellerID) REFERENCES USER(userID)
);

CREATE TABLE ADMIN_ (
    adminID INT,
    PRIMARY KEY(adminID),
    FOREIGN KEY(adminID) REFERENCES USER(userID) 
);

CREATE TABLE CHAT (
    chatID INT,
    buyerID INT,    
    sellerID INT,
    productID INT,
    PRIMARY KEY(chatID),
    UNIQUE(buyerID, sellerID, productID),
    FOREIGN KEY(buyerID) REFERENCES BUYER(buyerID)
    FOREIGN KEY(sellerID) REFERENCES SELLER(sellerID)
    FOREIGN KEY(productID) REFERENCES PRODUCT(productID)

);

CREATE TABLE MESSAGE_ (
    messageID INT,    
    chatID INT,
    date_ DATE,
    size_ INT,
    status_ INT, -- 0(SENT) 1(RECEIVED) 2(READ)
    type_ TEXT, -- IMAGE, TEXT, AUDIO, VIDEO, ETC
    content TEXT,
    PRIMARY KEY(messageID),
    FOREIGN KEY(chatID) REFERENCES CHAT(chatID)
);

CREATE TABLE SHIPPING (
    sellerID INT,    
    productID INT,
    addressBuyer TEXT,
    product TEXT,
    nomePosicao TEXT,
    PRIMARY KEY(idJogador),
    FOREIGN KEY(idJogador) REFERENCES PESSOA(idPessoa) ON DELETE CASCADE ON UPDATE RESTRICT,
    FOREIGN KEY(nomePosicao) REFERENCES POSICAO(nomePosicao) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE PRODUCT (
    idPresidente INT,
    PRIMARY KEY(idPresidente),
    FOREIGN KEY(idPresidente) REFERENCES PESSOA(idPessoa) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE BRAND (
    idTreinador INT,
    taticaPref TEXT,
    PRIMARY KEY(idTreinador),
    FOREIGN KEY(idTreinador) REFERENCES PESSOA(idPessoa) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE CATEGORY (
    nomeZona TEXT,
    PRIMARY KEY(nomeZona)
);

CREATE TABLE LOCATION_ (
    nomeEquipa TEXT,
    nSocios INT,
    anoForm INT,
    nomeZona TEXT,
    PRIMARY KEY(nomeEquipa),
    FOREIGN KEY(nomeZona) REFERENCES ZONA_PORTUGAL(nomeZona) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE USER_LOCATION (
    nomeEstadio TEXT,
    capacidade INT,
    anoInau INT,
    relvado TEXT,
    nomeZona TEXT,
    PRIMARY KEY(nomeEstadio),
    FOREIGN KEY(nomeZona) REFERENCES ZONA_PORTUGAL(nomeZona) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE CART (
    nomeEstadio TEXT,
    capacidade INT,
    anoInau INT,
    relvado TEXT,
    nomeZona TEXT,
    PRIMARY KEY(nomeEstadio),
    FOREIGN KEY(nomeZona) REFERENCES ZONA_PORTUGAL(nomeZona) ON DELETE CASCADE ON UPDATE CASCADE
);


---------------------------------------------------------------------------------------------------------


CREATE TABLE SELLER (
    idPessoa INT,
    nomePais TEXT,
    PRIMARY KEY(idPessoa, nomePais),
    FOREIGN KEY(idPessoa) REFERENCES PESSOA(idPessoa) ON DELETE CASCADE ON UPDATE RESTRICT,
    FOREIGN KEY(nomePais) REFERENCES PAIS(nomePais) ON DELETE CASCADE ON UPDATE CASCADE
);

