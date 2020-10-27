CREATE DATABASE IF NOT EXISTS MoviePass;

USE MoviePass;

CREATE TABLE IF NOT EXISTS Movies (
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
);

CREATE TABLE IF NOT EXISTS Genres(
    id int,
    name varchar(30),
    CONSTRAINT pk_genres PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS MoviesGenres(
    movieId int,
    genreId int,
    CONSTRAINT pk_moviesgenres PRIMARY KEY (movieId, genreId),
    CONSTRAINT fk_movies FOREIGN KEY (movieId) REFERENCES Movies(id) ON DELETE CASCADE,
    CONSTRAINT fk_genres FOREIGN KEY (genreId) REFERENCES Genres(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Users(
    id int AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    password varchar(50),
    admin boolean,
    CONSTRAINT unq_name UNIQUE (name),
    CONSTRAINT pk_users PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS Cinema(
    id int AUTO_INCREMENT,
    name varchar(30) NOT NULL,
    totalCapacity int,
    address varchar(30) NOT NULL,
    ticketValue int,
    enable boolean,
    CONSTRAINT unq_name_address UNIQUE (name, address),
    CONSTRAINT pk_cinemas PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS MovieShow(
    id int AUTO_INCREMENT,
    movieId int,
    cinemaId int,
    showDate date,
    CONSTRAINT pk_shows PRIMARY KEY (id),
    CONSTRAINT fk_movies FOREIGN KEY (movieId) REFERENCES Movies(id) ON DELETE CASCADE,
    CONSTRAINT fk_cinema FOREIGN KEY (cinemaId) REFERENCES Cinemas(id) ON DELETE CASCADE,
    CONSTRAINT unq_movie_cinema_date UNIQUE (movieId, cinemaId, showDate)
);