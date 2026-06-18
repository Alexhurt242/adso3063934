CREATE DATABASE IF NOT EXISTS NWA
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE NWA;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    birthdate DATE NULL,
    gender VARCHAR(40) NULL,
    email VARCHAR(180) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    location VARCHAR(120) NULL,
    listened_tracks_count INT UNSIGNED NOT NULL DEFAULT 0,
    member_since DATE NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE user_settings (
    user_id BIGINT UNSIGNED PRIMARY KEY,
    dark_theme BOOLEAN NOT NULL DEFAULT TRUE,
    background_music BOOLEAN NOT NULL DEFAULT FALSE,
    neon_system BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_settings_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);

CREATE TABLE artists (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    stage_name VARCHAR(120) NOT NULL,
    real_name VARCHAR(160) NULL,
    biography TEXT NULL,
    image_path VARCHAR(255) NULL,
    border_color VARCHAR(20) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE albums (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(160) NOT NULL,
    release_date DATE NULL,
    cover_path VARCHAR(255) NULL,
    description TEXT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE album_artist (
    album_id BIGINT UNSIGNED NOT NULL,
    artist_id BIGINT UNSIGNED NOT NULL,
    PRIMARY KEY (album_id, artist_id),
    CONSTRAINT fk_album_artist_album
        FOREIGN KEY (album_id) REFERENCES albums(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_album_artist_artist
        FOREIGN KEY (artist_id) REFERENCES artists(id)
        ON DELETE CASCADE
);

CREATE TABLE songs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(160) NOT NULL,
    album_id BIGINT UNSIGNED NULL,
    artist_id BIGINT UNSIGNED NULL,
    release_year YEAR NULL,
    cover_path VARCHAR(255) NULL,
    duration_seconds SMALLINT UNSIGNED NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_songs_album
        FOREIGN KEY (album_id) REFERENCES albums(id)
        ON DELETE SET NULL,
    CONSTRAINT fk_songs_artist
        FOREIGN KEY (artist_id) REFERENCES artists(id)
        ON DELETE SET NULL
);

CREATE TABLE story_chapters (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(160) NOT NULL,
    subtitle VARCHAR(180) NULL,
    chapter_number TINYINT UNSIGNED NOT NULL,
    content TEXT NOT NULL,
    image_path VARCHAR(255) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE user_song_plays (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    song_id BIGINT UNSIGNED NOT NULL,
    played_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_song_plays_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_user_song_plays_song
        FOREIGN KEY (song_id) REFERENCES songs(id)
        ON DELETE CASCADE
);

CREATE TABLE user_favorites (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    song_id BIGINT UNSIGNED NULL,
    album_id BIGINT UNSIGNED NULL,
    artist_id BIGINT UNSIGNED NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_user_favorites_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_user_favorites_song
        FOREIGN KEY (song_id) REFERENCES songs(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_user_favorites_album
        FOREIGN KEY (album_id) REFERENCES albums(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_user_favorites_artist
        FOREIGN KEY (artist_id) REFERENCES artists(id)
        ON DELETE CASCADE
);

INSERT INTO artists (stage_name, real_name, biography, image_path, border_color) VALUES
('Eazy-E', 'Eric Lynn Wright', 'Rapper, producer and manager from Compton. Known as a key figure in N.W.A.', 'img/Frame 1.png', '#ff1b13'),
('Ice Cube', 'O''Shea Jackson Sr.', 'Rapper, songwriter and actor. Member of N.W.A. during its most influential years.', 'img/Frame 1.png', '#334cff'),
('DJ Yella', 'Antoine Carraby', 'DJ, producer and member of N.W.A.', 'img/Frame 1.png', '#f4d7b5'),
('Dr. Dre', 'Andre Romelle Young', 'Rapper, producer and cofounder of a sound that shaped West Coast hip hop.', 'img/Frame 1.png', '#30ff34'),
('MC Ren', 'Lorenzo Jerald Patterson', 'Rapper and lyricist from Compton, member of N.W.A.', 'img/Frame 1.png', '#b020ff'),
('Arabian Prince', 'Kim Renard Nazel', 'Rapper, producer and early member of N.W.A.', 'img/Frame 1.png', '#ffea00'),
('N.W.A', 'Niggaz Wit Attitudes', 'Hip hop group from Compton, California.', 'img/Rectangle 68.png', '#e1261c');

INSERT INTO albums (title, release_date, cover_path, description) VALUES
('Straight Outta Compton', '1988-08-08', 'img/Rectangle 68.png', 'Debut studio album and central release shown in the app.'),
('Niggaz4Life', '1991-05-28', 'img/Frame 1.png', 'Album listed in the music screen.'),
('Next Friday OST', '1999-12-07', 'img/Frame 1.png', 'Soundtrack referenced by the song list.'),
('Greatest Hits', NULL, 'img/Frame 1.png', 'Compilation album displayed in the carousel.');

INSERT INTO album_artist (album_id, artist_id) VALUES
(1, 7),
(2, 7),
(3, 7),
(4, 7);

INSERT INTO songs (title, album_id, artist_id, release_year, cover_path) VALUES
('Straight Outta Compton', 1, 7, 1988, 'img/Rectangle 68.png'),
('Fuck tha Police', 1, 7, 1988, 'img/Frame 6.png'),
('Gangsta Gangsta', 1, 7, 1988, 'img/Frame 6.png'),
('Express Yourself', 1, 7, 1988, 'img/Frame 6.png'),
('Alwayz Into Somethin', 2, 7, 1991, 'img/Frame 6.png'),
('Chin Check', 3, 7, 1999, 'img/Frame 6.png');

INSERT INTO story_chapters (title, subtitle, chapter_number, content, image_path) VALUES
('El Origen de un Mito', 'Compton, California - 1987', 1, 'A finales de los anos 80, las calles de Compton vieron nacer al grupo mas peligroso del mundo. Su sonido crudo y directo cambio la industria musical.', 'img/Frame 5.png'),
('La Censura y el Exito', 'Impacto cultural', 2, 'El grupo enfrento censura, polemica y exito masivo, conectando con una generacion que queria ser escuchada.', 'img/Frame 5.png'),
('El Quiebre y el Legado', 'Legado musical', 3, 'Aunque el grupo se separo, sus integrantes dejaron una huella permanente en el hip hop y la cultura popular.', 'img/Frame 5.png');

INSERT INTO users (name, birthdate, gender, email, password_hash, location, listened_tracks_count, member_since) VALUES
('ComptonUser_88', '2004-10-01', NULL, 'eazy_fan@gamenextjs.com', '$2y$10$example.hash.for.prototype', 'Los Angeles, CA', 1482, '2024-10-01');

INSERT INTO user_settings (user_id, dark_theme, background_music, neon_system) VALUES
(1, TRUE, FALSE, FALSE);

INSERT INTO user_favorites (user_id, song_id, album_id, artist_id) VALUES
(1, 4, 1, 7);
