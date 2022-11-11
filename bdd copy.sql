DROP DATABASE IF EXISTS colearnio;
-- ============ création de la bdd ========
CREATE DATABASE colearnio;

USE colearnio;

-- ========== Creation des tables ==============

-- ---------------- formation ---------------
CREATE TABLE formation(
    idFormation INT AUTO_INCREMENT,
    nomFormation VARCHAR(50) NOT NULL,
    descFormation VARCHAR(50),

    CONSTRAINT pk_formation PRIMARY KEY(idFormation)

);


-- ---------------- user ---------------
CREATE TABLE utilisateur(
    idUser INT AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    dateNaiss date,
    pseudo VARCHAR(60) NOT NULL,
    rue VARCHAR(50),
    codePost CHAR(5),
    ville VARCHAR(50),
    email VARCHAR(100) NOT NULL UNIQUE,
    mdp CHAR(60) NOT NULL,
    isValidMail BOOLEAN NOT NULL,
    cle CHAR(60) UNIQUE NOT NULL,
    niveau INT,
    dateTimeInscri DATETIME NOT NULL,
    isAdmin BOOLEAN DEFAULT FALSE,
    noteSite int,
    cmtrSite TEXT,


    CONSTRAINT pk_user PRIMARY KEY(idUser),
    CONSTRAINT ck_dateInsrc CHECK (dateTimeInscri>=CURRENT_DATE)

);


-- ---------------- rdv ---------------
CREATE TABLE rdv (
    idRdv INT AUTO_INCREMENT,
    dateRdv DATETIME NOT NULL,
    adresse VARCHAR(60),
	idCreateur INT NOT NULL,


    CONSTRAINT pk_rdv PRIMARY KEY (idRdv),
    CONSTRAINT ck_dateRdv CHECK (dateRdv>=CURRENT_DATE),
    CONSTRAINT fk_rdv_user FOREIGN KEY(idCreateur) REFERENCES utilisateur(idUser)

);

-- ---------------- cours ---------------
CREATE TABLE cours(
    idCours INT AUTO_INCREMENT,
    intitule VARCHAR(50) NOT NULL,
    descCours TEXT,

    CONSTRAINT pk_cours PRIMARY KEY(idCours)

);


-- ---------------- chatRoom ---------------
CREATE TABLE chatRoom(
    idChatRoom INT AUTO_INCREMENT,
    nomCR VARCHAR(50) NOT NULL,
    descCR TEXT,
    dateCreaCR DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idUser INT NOT NULL,

    CONSTRAINT pk_chatRoom PRIMARY KEY(idChatRoom),
    CONSTRAINT fk_chatRoom_utilisateur FOREIGN KEY(idUser) REFERENCES utilisateur(idUser) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT ck_dateCreaCR CHECK (dateCreaCR>=CURRENT_DATE)

);



-- ---------------- etreDispo ---------------
CREATE TABLE etreDispo(
    idUser INT,
    idCours INT,
    dateDeb DATE NOT NULL,
    dateFin DATE NOT NULL,
    typeDispo ENUM ('presentiel','distanciel','both') NOT NULL,
    enDuo BOOLEAN NOT NULL DEFAULT FALSE,

    CONSTRAINT pk_etreDispo PRIMARY KEY(idUser, idCours),
    CONSTRAINT ck_dateDeb CHECK (dateDeb>=CURRENT_DATE),
    CONSTRAINT ck_dateDeb CHECK (dateFin>=dateDeb),
    CONSTRAINT fk_etreDispo_USER FOREIGN KEY(idUser) REFERENCES user(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_etreDispo_cours FOREIGN KEY(idCours) REFERENCES cours(idCours) ON DELETE CASCADE ON UPDATE CASCADE
);


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
    
    
);


CREATE TABLE suivre(
    idUser INT,
    idFormation INT,

    CONSTRAINT pk_suivre PRIMARY KEY(idUser,idFormation),
    CONSTRAINT fk_suivre_user FOREIGN KEY (idUser) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_suivre_formation FOREIGN KEY(idFormation) REFERENCES formation(idFormation) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE etreDansRDV (
    idUser INT,
    idRDV INT,

    CONSTRAINT pk_etreDansRDV PRIMARY KEY(idUser,idRDV),
    CONSTRAINT fk_etreDansRDV_user FOREIGN KEY (idUser) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_etreDansRDV_rdv FOREIGN KEY(idRDV) REFERENCES rdv(idRDV) ON DELETE CASCADE ON UPDATE CASCADE

);


CREATE TABLE dmndRejoindreRDV(
    idDemandeur INT,
    idDemandee  INT,
    idRDV INT,
    dateDmnd DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,

    CONSTRAINT pk_dmndRejoindreRDV PRIMARY KEY(idDemandeur,idDemandee,idRDV),
    CONSTRAINT fk_dmndRDV_user1 FOREIGN KEY(idDemandeur) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_dmndRDV_user2 FOREIGN KEY(idDemandee) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_dmndRDV_rdv FOREIGN KEY(idRDV) REFERENCES rdv(idRDV) ON DELETE CASCADE ON UPDATE CASCADE
    

);


CREATE TABLE ChatRoomUsers(
    idUser INT,
    idChatRoom INT,

    CONSTRAINT pk_chatroomusers PRIMARY KEY(idUser,idChatRoom),
     CONSTRAINT fk_ChatRoomUsers_user FOREIGN KEY (idUser) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_ChatRoomUsers_chatRoom FOREIGN KEY(idChatRoom) REFERENCES chatRoom(idChatRoom) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE envoyerMsg(
    idUser INT,
    idChatRoom INT,
    msg TEXT NOT NULL,
    dateEnvoi DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT pk_envoyerMsg PRIMARY KEY(idUser,idChatRoom,dateEnvoi),
    CONSTRAINT fk_envoyerMsg_user FOREIGN KEY (idUser) REFERENCES utilisateur(idUser) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_envoyerMsg_chatRoom FOREIGN KEY(idChatRoom) REFERENCES chatRoom(idChatRoom) ON DELETE CASCADE ON UPDATE CASCADE
);