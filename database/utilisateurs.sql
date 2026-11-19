-- création de la table des utilisateurs

DROP TABLE IF EXISTS utilisateurs;

CREATE TABLE utilisateurs(
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(200) UNIQUE NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT 'simple',
    date_inscription DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;