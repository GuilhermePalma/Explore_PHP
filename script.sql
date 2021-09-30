DROP DATABASE IF EXISTS crud_php;
CREATE DATABASE crud_php;
use crud_php;

CREATE TABLE IF NOT EXISTS user (
  id_user INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(80) NOT NULL,
  email VARCHAR(120) NOT NULL,
  PRIMARY KEY(id_user)
);

INSERT INTO `user`(name, email) VALUES
("Gabriel", "gabriel@gmeil.com"),
("Juliana", "juliana@gmeil.com"),
("Fernanda", "fernanda@gmeil.com"),
("Ruan", "ruan@gmeil.com"),
("Irole", "irole@gmeil.com"),
("Olisse", "olisse@gmeil.com");

SELECT * FROM user;