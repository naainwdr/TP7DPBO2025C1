CREATE DATABASE db_song;
USE db_song;

CREATE TABLE artist (
    artist_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    debut_year YEAR,
    country VARCHAR(50)
);

CREATE TABLE album (
    album_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    release_date DATE,
    artist_id INT,
    FOREIGN KEY (artist_id) REFERENCES artist(artist_id)
);

CREATE TABLE song (
    song_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    duration TIME,
    genre VARCHAR(50),
    album_id INT,
    FOREIGN KEY (album_id) REFERENCES album(album_id)
);

CREATE TABLE studio (
    studio_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    location VARCHAR(100)
);

CREATE TABLE recording (
    recording_id INT AUTO_INCREMENT PRIMARY KEY,
    song_id INT,
    studio_id INT,
    recording_date DATE,
    FOREIGN KEY (song_id) REFERENCES song(song_id),
    FOREIGN KEY (studio_id) REFERENCES studio(studio_id)
);
