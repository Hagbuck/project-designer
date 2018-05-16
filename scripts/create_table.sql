-- CREATE BD
-- Project designer

CREATE TABLE Utilisateur (
	id_utilisateur INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nom_utilisateur VARCHAR(256) NOT NULL,
	prenom_utilisateur VARCHAR(256) NOT NULL,
	pseudo_utilisateur VARCHAR(256) NOT NULL,
	mdp_utilisateur VARCHAR(256) NOT NULL,
	mail_utilisateur VARCHAR(256) NOT NULL
);

CREATE TABLE Projet (
	id_projet INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nom_projet VARCHAR(256) NOT NULL,
	date_creation_projet DATE NOT NULL
);

CREATE TABLE Accede(
	id_projet INTEGER NOT NULL,
	id_utilisateur INTEGER NOT NULL,
	est_admin INT NOT NULL,
	est_moderateur INT NOT NULL,
	FOREIGN KEY (id_projet) REFERENCES Projet(id_projet),
	FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur),
	PRIMARY KEY(id_projet, id_utilisateur)
);

CREATE TABLE Diagramme(
	id_diagramme INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_projet INTEGER NOT NULL,
	nom_diagramme VARCHAR(256) NOT NULL,
	FOREIGN KEY (id_projet) REFERENCES Projet(id_projet)
);


CREATE TABLE Tag(
	id_tag INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_diagramme INTEGER NOT NULL,
	texte_tag VARCHAR(32) NOT NULL,
	pos_x_tag FLOAT(10, 10),
	pos_y_tag FLOAT(10, 10),
	couleur_tag VARCHAR(256),
	FOREIGN KEY (id_diagramme) REFERENCES Diagramme(id_diagramme)
);

CREATE TABLE Branche(
	id_diagramme INTEGER NOT NULL,
	id_branche INTEGER NOT NULL AUTO_INCREMENT,
	nom_branche VARCHAR(255) NOT NULL,
	FOREIGN KEY (id_diagramme) REFERENCES Diagramme(id_diagramme),
    PRIMARY KEY (id_diagramme, id_branche)
);