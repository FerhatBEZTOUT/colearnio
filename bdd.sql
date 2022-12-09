-- DROP DATABASE IF EXISTS colearnio;
-- ============ création de la bdd ========
-- CREATE DATABASE colearnio;

-- USE colearnio;

-- ========== Creation des tables ==============
DROP TABLE IF EXISTS envoyerMsg;
DROP TABLE IF EXISTS ChatRoomUsers;
DROP TABLE IF EXISTS dmndRejoindreRDV;
DROP TABLE IF EXISTS etreDansRDV;
DROP TABLE IF EXISTS suivre;
DROP TABLE IF EXISTS noterUser;
DROP TABLE IF EXISTS etreDispo;
DROP TABLE IF EXISTS chatRoom;
DROP TABLE IF EXISTS cours;
DROP TABLE IF EXISTS rdv;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS formation;
DROP TABLE IF EXISTS ville;


-- ---------------- formation ---------------
CREATE TABLE formation(
    idFormation INT AUTO_INCREMENT,
    nomFormation VARCHAR(50) NOT NULL,
    descFormation VARCHAR(50),

    CONSTRAINT pk_formation PRIMARY KEY(idFormation)

)ENGINE=INNODB;





-- ---------------- ville ---------------
create table ville (
    idVille INT AUTO_INCREMENT,
    nom_ville VARCHAR(100),
    
    CONSTRAINT pk_ville PRIMARY KEY(idVille)
    
    )ENGINE=INNODB;






-- ---------------- user ---------------
CREATE TABLE utilisateur(
    idUser INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    dateNaiss date,
    pseudo VARCHAR(60) NOT NULL,
    sexe CHAR(1),
    rue VARCHAR(50),
    codePost CHAR(5),
    telephone CHAR(10),
    ville INT,
    email VARCHAR(100) NOT NULL UNIQUE,
    mdp CHAR(60) NOT NULL,
    isValidMail BOOLEAN NOT NULL,
    cle CHAR(60) UNIQUE NOT NULL,
    niveau INT,
    dateTimeInscri DATETIME NOT NULL,
    isAdmin BOOLEAN DEFAULT FALSE NOT NULL,
    noteSite int,
    cmtrSite TEXT,
    formation INT,
    descripUser TEXT,

    CONSTRAINT pk_user PRIMARY KEY(idUser),
     CONSTRAINT fk_user_ville FOREIGN KEY(ville) REFERENCES ville(idVille),
    CONSTRAINT fk_user_formation FOREIGN KEY(formation) REFERENCES formation(idFormation)
    -- CONSTRAINT ck_dateInsrc CHECK (dateTimeInscri>=CURRENT_TIMESTAMP) (ne fonctionne pas sur alwaysdata)

)ENGINE=INNODB;


-- ---------------- rdv ---------------
CREATE TABLE rdv (
    idRdv INT AUTO_INCREMENT,
    dateRdv DATETIME NOT NULL,
    adresse VARCHAR(100),
	idCreateur INT NOT NULL,


    CONSTRAINT pk_rdv PRIMARY KEY (idRdv),
    -- CONSTRAINT ck_dateRdv CHECK (dateRdv>=CURRENT_DATE),
    CONSTRAINT fk_rdv_user FOREIGN KEY(idCreateur) REFERENCES utilisateur(idUser)

)ENGINE=INNODB;

-- ---------------- cours ---------------
CREATE TABLE cours(
    idCours INT AUTO_INCREMENT,
    intitule VARCHAR(50) NOT NULL,
    descCours TEXT,

    CONSTRAINT pk_cours PRIMARY KEY(idCours)

)ENGINE=INNODB;


-- ---------------- chatRoom ---------------
CREATE TABLE chatRoom(
    idChatRoom INT AUTO_INCREMENT,
    nomCR VARCHAR(50) NOT NULL,
    descCR TEXT,
    dateCreaCR DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idUser INT NOT NULL,

    CONSTRAINT pk_chatRoom PRIMARY KEY(idChatRoom),
    CONSTRAINT fk_chatRoom_utilisateur FOREIGN KEY(idUser) REFERENCES utilisateur(idUser) ON DELETE NO ACTION ON UPDATE CASCADE
    -- CONSTRAINT ck_dateCreaCR CHECK (dateCreaCR>=CURRENT_DATE)

)ENGINE=INNODB;





-- ---------------- etreDispo ---------------
CREATE TABLE etreDispo(
    idUser INT,
    idCours INT,
    idVille INT,
    dateDeb DATE NOT NULL,
    dateFin DATE NOT NULL,
    typeDispo ENUM ('presentiel','distanciel','both') NOT NULL,
    enDuo BOOLEAN NOT NULL DEFAULT FALSE,
    motivation VARCHAR(255),

    CONSTRAINT pk_etreDispo PRIMARY KEY(idUser, idCours, idVille, dateDeb),
    -- CONSTRAINT ck_dateDeb CHECK (dateDeb>=CURRENT_DATE),
    CONSTRAINT ck_dateDeb CHECK (dateFin>=dateDeb),
    CONSTRAINT fk_etreDispo_user FOREIGN KEY(idUser) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_etreDispo_ville FOREIGN KEY(idVille) REFERENCES ville(idVille) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_etreDispo_cours FOREIGN KEY(idCours) REFERENCES cours(idCours) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=INNODB;


-- ---------------- noterUser ---------------
CREATE TABLE noterUser(
    idNoteur INT,
    idNoted INT,
    dateCmnt DATETIME,
    cmnt TEXT,
    note int,

    CONSTRAINT pk_noterUser PRIMARY KEY(idNoteur, idNoted),
    CONSTRAINT fk_noterUser_user1 FOREIGN KEY(idNoteur) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_noterUser_user2 FOREIGN KEY(idNoted) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT ck_ids CHECK (idNoted<>idNoteur),
    CONSTRAINT ck_note CHECK (note>0 AND note<=5),
    CONSTRAINT ck_cmnt CHECK (length(cmnt)>0)
    
    
)ENGINE=INNODB;


-- ---------------- suivre (formation) ---------------
CREATE TABLE suivre(
    idUser INT,
    idFormation INT,

    CONSTRAINT pk_suivre PRIMARY KEY(idUser,idFormation),
    CONSTRAINT fk_suivre_user FOREIGN KEY (idUser) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_suivre_formation FOREIGN KEY(idFormation) REFERENCES formation(idFormation) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=INNODB;


-- ---------------- etreDansRDV ---------------
CREATE TABLE etreDansRDV (
    idUser INT,
    idRDV INT,

    CONSTRAINT pk_etreDansRDV PRIMARY KEY(idUser,idRDV),
    CONSTRAINT fk_etreDansRDV_user FOREIGN KEY (idUser) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_etreDansRDV_rdv FOREIGN KEY(idRDV) REFERENCES rdv(idRDV) ON DELETE CASCADE ON UPDATE CASCADE

)ENGINE=INNODB;


-- ---------------- demander rejoindre RDV ---------------
CREATE TABLE dmndRejoindreRDV(
    idDemandeur INT,
    idDemandee  INT,
    idRDV INT,
    dateDmnd DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,

    CONSTRAINT pk_dmndRejoindreRDV PRIMARY KEY(idDemandeur,idDemandee,idRDV),
    CONSTRAINT fk_dmndRDV_user1 FOREIGN KEY(idDemandeur) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_dmndRDV_user2 FOREIGN KEY(idDemandee) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_dmndRDV_rdv FOREIGN KEY(idRDV) REFERENCES rdv(idRDV) ON DELETE CASCADE ON UPDATE CASCADE
    

)ENGINE=INNODB;


-- ---------------- chatRoom users ---------------

CREATE TABLE ChatRoomUsers(
    idUser INT,
    idChatRoom INT,

    CONSTRAINT pk_chatroomusers PRIMARY KEY(idUser,idChatRoom),
     CONSTRAINT fk_ChatRoomUsers_user FOREIGN KEY (idUser) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_ChatRoomUsers_chatRoom FOREIGN KEY(idChatRoom) REFERENCES chatRoom(idChatRoom) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=INNODB;


-- ---------------- envoyer msg ---------------
CREATE TABLE envoyerMsg(
    idUser INT,
    idChatRoom INT,
    msg TEXT NOT NULL,
    dateEnvoi DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT pk_envoyerMsg PRIMARY KEY(idUser,idChatRoom,dateEnvoi),
    CONSTRAINT fk_envoyerMsg_user FOREIGN KEY (idUser) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_envoyerMsg_chatRoom FOREIGN KEY(idChatRoom) REFERENCES chatRoom(idChatRoom) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=INNODB;





-- Insertion de villes =============================================

INSERT INTO ville(nom_ville) VALUES("Paris");
INSERT INTO ville(nom_ville) VALUES("Marseille");
INSERT INTO ville(nom_ville) VALUES("Lyon");
INSERT INTO ville(nom_ville) VALUES("Toulouse");
INSERT INTO ville(nom_ville) VALUES("Nice");
INSERT INTO ville(nom_ville) VALUES("Nantes");
INSERT INTO ville(nom_ville) VALUES("Strasbourg");
INSERT INTO ville(nom_ville) VALUES("Montpellier");
INSERT INTO ville(nom_ville) VALUES("Bordeaux");
INSERT INTO ville(nom_ville) VALUES("Lille");
INSERT INTO ville(nom_ville) VALUES("Rennes");
INSERT INTO ville(nom_ville) VALUES("Reims");
INSERT INTO ville(nom_ville) VALUES("Le Havre");
INSERT INTO ville(nom_ville) VALUES("Saint-Étienne");
INSERT INTO ville(nom_ville) VALUES("Toulon");
INSERT INTO ville(nom_ville) VALUES("Grenoble");
INSERT INTO ville(nom_ville) VALUES("Angers");
INSERT INTO ville(nom_ville) VALUES("Dijon");
INSERT INTO ville(nom_ville) VALUES("Brest");
INSERT INTO ville(nom_ville) VALUES("Le Mans");
INSERT INTO ville(nom_ville) VALUES("Nîmes");
INSERT INTO ville(nom_ville) VALUES("Aix-en-Provence");
INSERT INTO ville(nom_ville) VALUES("Clermont-Ferrand");
INSERT INTO ville(nom_ville) VALUES("Tours");
INSERT INTO ville(nom_ville) VALUES("Amiens");
INSERT INTO ville(nom_ville) VALUES("Limoges");
INSERT INTO ville(nom_ville) VALUES("Villeurbanne");
INSERT INTO ville(nom_ville) VALUES("Metz");
INSERT INTO ville(nom_ville) VALUES("Besançon");
INSERT INTO ville(nom_ville) VALUES("Perpignan");
INSERT INTO ville(nom_ville) VALUES("Orléans");
INSERT INTO ville(nom_ville) VALUES("Caen");
INSERT INTO ville(nom_ville) VALUES("Mulhouse");
INSERT INTO ville(nom_ville) VALUES("Boulogne-Billancourt");
INSERT INTO ville(nom_ville) VALUES("Rouen");
INSERT INTO ville(nom_ville) VALUES("Nancy");
INSERT INTO ville(nom_ville) VALUES("Argenteuil");
INSERT INTO ville(nom_ville) VALUES("Montreuil");
INSERT INTO ville(nom_ville) VALUES("Saint-Denis");
INSERT INTO ville(nom_ville) VALUES("Roubaix");
INSERT INTO ville(nom_ville) VALUES("Avignon");
INSERT INTO ville(nom_ville) VALUES("Tourcoing");
INSERT INTO ville(nom_ville) VALUES("Poitiers");
INSERT INTO ville(nom_ville) VALUES("Nanterre");
INSERT INTO ville(nom_ville) VALUES("Créteil");
INSERT INTO ville(nom_ville) VALUES("Versailles");
INSERT INTO ville(nom_ville) VALUES("Pau");
INSERT INTO ville(nom_ville) VALUES("Courbevoie");
INSERT INTO ville(nom_ville) VALUES("Vitry-sur-Seine");
INSERT INTO ville(nom_ville) VALUES("Asnières-sur-Seine");
INSERT INTO ville(nom_ville) VALUES("Colombes");
INSERT INTO ville(nom_ville) VALUES("Aulnay-sous-Bois");
INSERT INTO ville(nom_ville) VALUES("La Rochelle");
INSERT INTO ville(nom_ville) VALUES("Rueil-Malmaison");
INSERT INTO ville(nom_ville) VALUES("Antibes");
INSERT INTO ville(nom_ville) VALUES("Saint-Maur-des-Fossés");
INSERT INTO ville(nom_ville) VALUES("Calais");
INSERT INTO ville(nom_ville) VALUES("Champigny-sur-Marne");
INSERT INTO ville(nom_ville) VALUES("Aubervilliers");
INSERT INTO ville(nom_ville) VALUES("Béziers");
INSERT INTO ville(nom_ville) VALUES("Bourges");
INSERT INTO ville(nom_ville) VALUES("Cannes");
INSERT INTO ville(nom_ville) VALUES("Saint-Nazaire");
INSERT INTO ville(nom_ville) VALUES("Dunkerque");
INSERT INTO ville(nom_ville) VALUES("Quimper");
INSERT INTO ville(nom_ville) VALUES("Valence");
INSERT INTO ville(nom_ville) VALUES("Colmar");
INSERT INTO ville(nom_ville) VALUES("Drancy");
INSERT INTO ville(nom_ville) VALUES("Mérignac");
INSERT INTO ville(nom_ville) VALUES("Ajaccio");
INSERT INTO ville(nom_ville) VALUES("Levallois-Perret");
INSERT INTO ville(nom_ville) VALUES("Troyes");
INSERT INTO ville(nom_ville) VALUES("Neuilly-sur-Seine");
INSERT INTO ville(nom_ville) VALUES("Issy-les-Moulineaux");
INSERT INTO ville(nom_ville) VALUES("Villeneuve-d'Ascq");
INSERT INTO ville(nom_ville) VALUES("Noisy-le-Grand");
INSERT INTO ville(nom_ville) VALUES("Antony");
INSERT INTO ville(nom_ville) VALUES("Niort");
INSERT INTO ville(nom_ville) VALUES("Lorient");
INSERT INTO ville(nom_ville) VALUES("Sarcelles");
INSERT INTO ville(nom_ville) VALUES("Chambéry");
INSERT INTO ville(nom_ville) VALUES("Saint-Quentin");
INSERT INTO ville(nom_ville) VALUES("Pessac");
INSERT INTO ville(nom_ville) VALUES("Vénissieux");
INSERT INTO ville(nom_ville) VALUES("Cergy");
INSERT INTO ville(nom_ville) VALUES("La Seyne-sur-Mer");
INSERT INTO ville(nom_ville) VALUES("Clichy");
INSERT INTO ville(nom_ville) VALUES("Beauvais");
INSERT INTO ville(nom_ville) VALUES("Cholet");
INSERT INTO ville(nom_ville) VALUES("Hyères");
INSERT INTO ville(nom_ville) VALUES("Ivry-sur-Seine");
INSERT INTO ville(nom_ville) VALUES("Montauban");
INSERT INTO ville(nom_ville) VALUES("Vannes");
INSERT INTO ville(nom_ville) VALUES("La Roche-sur-Yon");
INSERT INTO ville(nom_ville) VALUES("Charleville-Mézières");
INSERT INTO ville(nom_ville) VALUES("Pantin");
INSERT INTO ville(nom_ville) VALUES("Laval");
INSERT INTO ville(nom_ville) VALUES("Maisons-Alfort");
INSERT INTO ville(nom_ville) VALUES("Bondy");
INSERT INTO ville(nom_ville) VALUES("Évry");





-- Insertion de cours ========================================
INSERT INTO cours(intitule, descCours) VALUES ("Base de données","Une base de données est un ensemble d'informations qui est organisé de manière à être facilement accessible, géré et mis à jour.");
INSERT INTO cours(intitule, descCours) VALUES ("Algorithmique 1","Notions de base de l'algorithmique");
INSERT INTO cours(intitule, descCours) VALUES ("Analyse 1","Cours de mathématique destiné aux premiers années licence math");
INSERT INTO cours(intitule, descCours) VALUES ("Géographie",NULL);
INSERT INTO cours(intitule, descCours) VALUES ("Histoire",NULL);


-- Insertion de disponibilité =======================================
INSERT INTO etreDispo VALUES (1,1,1,'2022-12-08','2022-12-20','both',DEFAULT);
INSERT INTO etreDispo VALUES (1,2,1,'2022-12-10','2022-12-20','both',DEFAULT);
INSERT INTO etreDispo VALUES (2,1,2,'2022-12-08','2022-12-12','both',DEFAULT);
INSERT INTO etreDispo VALUES (2,1,1,'2022-12-13','2022-12-18','both',DEFAULT);