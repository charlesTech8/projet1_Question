-- inscris (#id_author, nom_author, prenom_author, tel_autho, email_author, password_author, #id_cv, #id_img, #id_niveau, tmp)
-- image(id_img, lien_img)
-- niveau(id_niveau, lib_niveau)
-- post(id_post, #id_author, contenu_q_r, date_send, type_post, #id_img, #id_post_question)

CREATE DATABASE askAnsw;

USE askAnsw;

CREATE TABLE niveau (
    id_niveau INTEGER NOT NULL AUTO_INCREMENT,
    lib_niveau VARCHAR(100) NOT NULL,
    PRIMARY KEY( id_niveau )
);

CREATE TABLE inscris(
    id_author INTEGER NOT NULL AUTO_INCREMENT,
    nom_author VARCHAR(30) NOT NULL,
    prenom_author VARCHAR(30) NOT NULL,
    email_author VARCHAR(255) NOT NULL,
    password_author VARCHAR(50) NOT NULL,
    id_niveau INTEGER,
    tmp BIGINT(20) NOT NULL,
    PRIMARY KEY( id_author ),
    FOREIGN KEY( id_niveau ) REFERENCES niveau( id_niveau )
);

CREATE TABLE cv(
    id_cv INTEGER NOT NULL AUTO_INCREMENT,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    tel INTEGER NOT NULL,
    date_nais DATE NOT NULL,
    adresse VARCHAR(255),
    langue TEXT NOT NULL,
    profil TEXT,
    experience TEXT,
    competences TEXT,
    diplome TEXT,
    qualites TEXT,
    loisirs TEXT,
    id_author INTEGER NOT NULL,
    PRIMARY KEY(id_cv),
    FOREIGN KEY (id_author) REFERENCES inscris( id_author )
);

CREATE TABLE post(
    id_post INTEGER NOT NULL AUTO_INCREMENT,
    post_title TEXT,
    contenu_q_r TEXT,
    date_send DATE NOT NULL,
    type_post VARCHAR(20) NOT NULL,
    id_author INTEGER NOT NULL,
    FOREIGN KEY (id_author) REFERENCES inscris(id_author),
    PRIMARY KEY( id_post )
);

CREATE TABLE img(
    id_img INTEGER NOT NULL AUTO_INCREMENT,
    lien VARCHAR(255) NOT NULL,
    id_post INTEGER ,
    id_cv INTEGER ,
    PRIMARY KEY( id_img ),
    FOREIGN KEY (id_post) REFERENCES post (id_post),
    FOREIGN KEY (id_cv) REFERENCES cv ( id_cv )
);

ALTER TABLE post 
    ADD COLUMN id_post_question INTEGER;

ALTER TABLE post
  ADD CONSTRAINT post_id_post_question FOREIGN KEY ( id_post_question ) REFERENCES post ( id_post );