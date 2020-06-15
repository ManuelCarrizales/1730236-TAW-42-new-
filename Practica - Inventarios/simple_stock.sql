/*Creacion de base de datos*/
CREATE DATABASE simple_stock;
/*Utilizando la base de datos simple_stock*/
USE simple_stock;
/*Tabla para las categorias*/
CREATE TABLE categories(
    id_category INT AUTO_INCREMENT PRIMARY KEY,
    name_category VARCHAR(255),
    description_category VARCHAR(255),
    date_added datetime
);
/*Tabla para los usuarios*/
CREATE TABLE users(
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(20),
    lastname VARCHAR(20),
    user_name VARCHAR(64),
    user_password VARCHAR(255),
    user_email VARCHAR(64),
    date_added datetime
);
/*Tabla para los productos*/
CREATE TABLE products(
    id_product INT AUTO_INCREMENT PRIMARY KEY,
    code_producto char(20),
    name_product char(255),
    date_added datetime,
    price_product float(8,2),
    stock INT,
    id_category INT,
    FOREIGN KEY (id_category) REFERENCES categories (id_category)
);
/*Tabla para el historial*/
CREATE TABLE historial(
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(45),
    date datetime,
    note VARCHAR(255),
    reference VARCHAR(100),
    id_producto INT,
    user_id INT,
    FOREIGN KEY (id_producto) REFERENCES products (id_product),
    FOREIGN KEY (user_id) REFERENCES users (user_id)
);
