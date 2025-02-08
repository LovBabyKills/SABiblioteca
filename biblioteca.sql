USE biblioteca;

CREATE TABLE autori (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    data_nascita DATE NOT NULL
);

CREATE TABLE libri (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(50) NOT NULL,
    anno_pubblicazione YEAR NOT NULL,
    id_autore int NOT NULL,
    FOREIGN KEY(id_autore) REFERENCES autori(id)
);

CREATE TABLE utenti (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cognome VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL
);

CREATE TABLE prestiti (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_utente INT NOT NULL,
    id_libro INT NOT NULL,
    data_prestito DATE NOT NULL,
    data_restituzione DATE NULL,
    FOREIGN KEY(id_utente) REFERENCES utenti(id),
    FOREIGN KEY(id_libro) REFERENCES libri(id)
);