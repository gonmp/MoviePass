CREATE DATABASE IF NOT EXISTS MoviePass;

USE MoviePass;

CREATE TABLE IF NOT EXISTS movies (
    id int,
    title varchar(100),
    popularity float,
    vote_count int,
    video boolean,
    poster_path varchar(100),
    adult boolean,
    backdrop_path varchar(100),
    original_language varchar(100),
    original_title varchar(100),
    vote_average float,
    overview varchar(2000),
    duration time,
    CONSTRAINT pk_movies PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS genres(
    id int,
    name varchar(50) NOT NULL,
    CONSTRAINT pk_genres PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS moviesgenres(
    movieId int NOT NULL,
    genreId int NOT NULL,
    CONSTRAINT fk_moviesgenres_movies FOREIGN KEY (movieId) REFERENCES movies(id) ON DELETE CASCADE,
    CONSTRAINT fk_moviesgenres_genres FOREIGN KEY (genreId) REFERENCES genres(id) ON DELETE CASCADE,
    CONSTRAINT unq_moviesgenres UNIQUE (movieId, genreId)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS users(
    id int AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    admin boolean NOT NULL,
    CONSTRAINT unq_name UNIQUE (name),
    CONSTRAINT pk_users PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS cinemas(
    id int AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    totalCapacity int,
    address varchar(50) NOT NULL,
    ticketValue int,
    enable boolean,
    CONSTRAINT unq_name_address UNIQUE (name, address),
    CONSTRAINT pk_cinemas PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS rooms(
    id INT AUTO_INCREMENT NOT NULL,
    cinemaId INT NOT NULL,
    capacity INT NOT NULL,
    ticketValue INT,
    name varchar(100),
    constraint pk_roomId PRIMARY KEY (id),
    constraint fk_cinemaId FOREIGN KEY (cinemaId) references cinemas(id) ON DELETE CASCADE,
    CONSTRAINT unq_cinemaId_name UNIQUE (cinemaId, name)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS movieshow(
    id int AUTO_INCREMENT,
    movieId int,
    roomId int,
    showDate datetime,
    CONSTRAINT pk_shows PRIMARY KEY (id),
    CONSTRAINT fk_movieshow_movies FOREIGN KEY (movieId) REFERENCES movies(id) ON DELETE CASCADE,
    CONSTRAINT fk_movieshow_rooms FOREIGN KEY (roomId) REFERENCES rooms(id) ON DELETE CASCADE,
    CONSTRAINT unq_movie_cinema_date UNIQUE (movieId, roomId, showDate)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS purchases(
    id INT AUTO_INCREMENT NOT NULL,
    userId INT NOT NULL,
    total INT NOT NULL,
    discount INT,
    purchaseDate datetime,
    constraint pk_purchaseId PRIMARY KEY (id),
    constraint fk_userId FOREIGN KEY (userId) references users(id) ON DELETE CASCADE
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS tickets
(   id INT AUTO_INCREMENT NOT NULL,
    idMovieShow INT NOT NULL,
    qr VARCHAR(150),
    purchaseId INT NOT NULL,
    constraint pk_idTicket PRIMARY KEY (id),
    constraint fk_purchaseId FOREIGN KEY (purchaseId) REFERENCES purchases(id) ON DELETE CASCADE,
    constraint fk_idMovieShow FOREIGN KEY (idMovieShow) references movieshow(id) ON DELETE CASCADE
)Engine=InnoDB;