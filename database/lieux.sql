-- Crée la table des lieux et y ajoute les lieux de Cergy
-- À lancer avec : mysql -u urbanpulse -p urbanpulse < database/lieux.sql

DROP TABLE IF EXISTS lieux;

CREATE TABLE lieux (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    type VARCHAR(50) NOT NULL,
    quartier VARCHAR(80) NOT NULL,
    description TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO lieux (nom, type, quartier, description) VALUES
('Axe Majeur', 'Lieu d''intérêt', 'Cergy Saint-Christophe', 'Grande perspective monumentale qui descend vers l''Oise, avec les 12 Colonnes.'),
('Base de loisirs de Cergy-Pontoise', 'Sport', 'Cergy le Haut', 'Site de loisirs aquatiques et sportifs autour des étangs.'),
('Préfecture du Val-d''Oise', 'Administration', 'Cergy Préfecture', 'Bâtiment administratif du département, accessible en semaine.'),
('Centre commercial des 3 Fontaines', 'Commerce', 'Cergy Préfecture', 'Grand centre commercial avec boutiques et restaurants.'),
('Gare de Cergy-le-Haut', 'Transport', 'Cergy le Haut', 'Terminus du RER A, avec des lignes de bus vers toute l''agglomération.'),
('CY Tech', 'Enseignement', 'Cergy Préfecture', 'École d''ingénieurs de CY Cergy Paris Université.'),
('Parc François-Mitterrand', 'Lieu d''intérêt', 'Cergy Préfecture', 'Grand parc au cœur de Cergy, avec aires de jeux et espaces verts.');