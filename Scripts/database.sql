CREATE DATABASE IF NOT EXISTS MoviePass;

USE MoviePass;

CREATE TABLE IF NOT EXISTS movies (
    id int,
    title varchar(30),
    popularity float,
    vote_count int,
    video boolean,
    poster_path varchar(50),
    adult boolean,
    backdrop_path varchar(50),
    original_language varchar(50),
    original_title varchar(30),
    vote_average float,
    overview varchar(100),
    CONSTRAINT pk_movies PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS genres(
    id int,
    name varchar(30) NOT NULL,
    CONSTRAINT pk_genres PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS moviesgenres(
    movieId int NOT NULL,
    genreId int NOT NULL,
    CONSTRAINT fk_moviesgenres_movies FOREIGN KEY (movieId) REFERENCES movies(id) ON DELETE CASCADE,
    CONSTRAINT fk_moviesgenres_genres FOREIGN KEY (genreId) REFERENCES genres(id) ON DELETE CASCADE
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
    name varchar(30) NOT NULL,
    totalCapacity int,
    address varchar(30) NOT NULL,
    ticketValue int,
    enable boolean,
    CONSTRAINT unq_name_address UNIQUE (name, address),
    CONSTRAINT pk_cinemas PRIMARY KEY (id)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS movieshow(
    id int AUTO_INCREMENT,
    movieId int,
    cinemaId int,
    showDate date,
    CONSTRAINT pk_shows PRIMARY KEY (id),
    CONSTRAINT fk_movieshow_movies FOREIGN KEY (movieId) REFERENCES movies(id) ON DELETE CASCADE,
    CONSTRAINT fk_movieshow_cinemas FOREIGN KEY (cinemaId) REFERENCES cinemas(id) ON DELETE CASCADE,
    CONSTRAINT unq_movie_cinema_date UNIQUE (movieId, cinemaId, showDate)
)Engine=InnoDB;