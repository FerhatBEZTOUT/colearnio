DROP DATABASE IF EXISTS colearnio;
-- ============ création de la bdd ========
CREATE DATABASE colearnio;

USE colearnio;

-- ========== Creation des tables ==============
-- ---------------- rdv ---------------
CREATE TABLE rdv (
    idRdv INT AUTO_INCREMENT,
    dateRdv DATE NOT NULL,
    rueRdv VARCHAR(50) NOT NULL,
    villeRdv VARCHAR(50) NOT NULL,
    codePostRdv VARCHAR(50) NOT NULL,
	
    CONSTRAINT pk_rdv PRIMARY KEY (idRdv),
    CONSTRAINT ck_dateRdv CHECK (dateRdv>=CURRENT_DATE)

);



-- ---------------- niveau ---------------
CREATE TABLE niveau(
    idNiveau INT AUTO_INCREMENT,
    nomNiveau VARCHAR(50) NOT NULL,
    ordre INT NOT NULL,

    CONSTRAINT pk_niveau PRIMARY KEY (idNiveau)
    
);



-- ---------------- formation ---------------
CREATE TABLE formation(
    idFormation INT AUTO_INCREMENT,
    nomFormation VARCHAR(50) NOT NULL,
    adresse VARCHAR(60),

    CONSTRAINT pk_formation PRIMARY KEY(idFormation)

);


-- ---------------- user ---------------
CREATE TABLE user(
    idUser INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    dateNaiss date NOT NULL,
    rue VARCHAR(50),
    codePost CHAR(5),
    ville VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mdp VARCHAR(128) NOT NULL, -- On choisira CHAR(N) quand on aura décidé quel hash utiliser
    validemail BOOLEAN NOT NULL,
    cle BOOLEAN UNIQUE NOT NULL,
    idFormation INT,
    idNiveau INT,

    CONSTRAINT pk_user PRIMARY KEY(idUser),
    CONSTRAINT fk_user_formation FOREIGN KEY(idFormation) REFERENCES Formation(idFormation) ON UPDATE CASCADE,
    CONSTRAINT fk_user_niveau FOREIGN KEY(idNiveau) REFERENCES Niveau(idNiveau) ON UPDATE CASCADE

);




-- ---------------- cours ---------------
CREATE TABLE cours(
    idCours INT AUTO_INCREMENT,
    intitule VARCHAR(50) NOT NULL,
    idNiveau INT NOT NULL,

    CONSTRAINT pk_cours PRIMARY KEY(idCours),
    CONSTRAINT fk_cours_niveau FOREIGN KEY(idNiveau) REFERENCES niveau(idNiveau) ON UPDATE CASCADE

);


-- ---------------- message ---------------
CREATE TABLE message(
    idEmetteur INT,
    idRecepteur INT,
    msg TEXT NOT NULL,
    dateMsg DATE NOT NULL,

    CONSTRAINT pk_message PRIMARY KEY(idEmetteur,idRecepteur),
    CONSTRAINT fk_message_user_1 FOREIGN KEY(idEmetteur) REFERENCES user(idUser) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT fk_message_user_2 FOREIGN KEY(idRecepteur) REFERENCES user(idUser) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT ck_idUsers CHECK (idEmetteur != idRecepteur)

);

-- ---------------- PrendreRDV ---------------
CREATE TABLE prendreRDV(
    idRdv INT,
    idUser INT,

    CONSTRAINT pk_prendreRDV PRIMARY KEY(idRDV,idUser),
    CONSTRAINT fk_prendreRDV_rdv FOREIGN KEY(idRDV) REFERENCES rdv(idRDV) ON DELETE CASCADE ON UPDATE CASCADE,
     CONSTRAINT fk_prendreRDV_USER FOREIGN KEY(idUser) REFERENCES user(idUser) ON DELETE CASCADE ON UPDATE CASCADE
);

-- ---------------- etreDispo ---------------
CREATE TABLE etreDispo(
    idUser INT,
    idCours INT,
    dateDeb DATE NOT NULL,
    dateFin DATE NOT NULL,
    typeDispo ENUM ('presentiel','distanciel','both') NOT NULL,

    CONSTRAINT pk_etreDispo PRIMARY KEY(idUser, idCours),
    CONSTRAINT ck_dateDeb CHECK (dateDeb>=CURRENT_DATE),
    CONSTRAINT ck_dateDeb CHECK (dateFin>=dateDeb),
    CONSTRAINT fk_etreDispo_USER FOREIGN KEY(idUser) REFERENCES user(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_etreDispo_cours FOREIGN KEY(idCours) REFERENCES cours(idCours) ON DELETE CASCADE ON UPDATE CASCADE
);

