-- CREATE BD
-- Project designer

CREATE TABLE Utilisateur (
	id_utilisateur INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nom_utilisateur VARCHAR(256) NOT NULL,
	prenom_utilisateur VARCHAR(256) NOT NULL,
	pseudo_utilisateur VARCHAR(256) NOT NULL,
	mdp_utilisateur VARCHAR(256) NOT NULL,
	mail_utilsateur VARCHAR(256) NOT NULL
);

CREATE TABLE Projet (
	id_projet INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nom_projet VARCHAR(256) NOT NULL,
)

CREATE TABLE Accede(
	id_projet PRIMARY KEY,
	id_utilisateur PRIMARY KEY,
	est_admin INT NOT NULL,
	est_moderateur INT NOT NULL,
	FOREIGN KEY (id_projet) REFERENCES projet(id_projet),
	FOREIGN KEY (id_utilisateur) REFERENCES projet(id_utilisateur)
)

CREATE TABLE Diagramme(
	id_diagramme INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_projet,
	nom_diagramme VARCHAR(256) NOT NULL,
	FOREIGN KEY (id_projet) REFERENCES projet(id_projet)
)


CREATE TABLE Tag(
	id_tag INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_diagramme,
	texte_tag VARCHAR(32) NOT NULL,
	pos_x_tag FLOAT(32, 32),
	pos_y_tag FLOAT(32, 32),
	couleur_tag VARCHAR(256),
	FOREIGN KEY (id_diagramme) REFERENCES diagramme(id_diagramme)
)

CREATE TABLE Branche(
	id_diagramme PRIMARY KEY,
	id_branche INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nom_branche VARCHAR(255) NOT NULL,
	FOREIGN KEY (id_diagramme) REFERENCES diagramme(id_diagramme)
);