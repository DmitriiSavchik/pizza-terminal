CREATE DATABASE pizza_order;

USE pizza_order;

CREATE TABLE pizzas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL
);

CREATE TABLE sizes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE sauces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_sauces INT NOT NULL,
    id_pizzas INT NOT NULL,
    id_sizes INT NOT NULL,
    summary FLOAT NOT NULL,
    FOREIGN KEY (id_pizzas) REFERENCES pizzas(id),
    FOREIGN KEY (id_sauces) REFERENCES sauces(id),
    FOREIGN KEY (id_sizes) REFERENCES sizes(id)
);

INSERT INTO pizzas (name, price) VALUES
('Пепперони', 10),
('Деревенская', 9),
('Гавайская', 8),
('Грибная', 7);

INSERT INTO sizes (name, price) VALUES
(21, 10),
(26, 13),
(31, 16),
(45, 20);

INSERT INTO sauces (name, price) VALUES
('сырный', 3),
('кисло-сладкий', 2),
('чесночный' 3,),
('барбекю', 2);