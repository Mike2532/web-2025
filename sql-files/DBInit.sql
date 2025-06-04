CREATE DATABASE IF NOT EXISTS 
    blog;

USE blog;

CREATE TABLE user (
    user_id CHAR(23) NOT NULL PRIMARY KEY,
    user_first_name VARCHAR(100) NOT NULL,
    user_last_name VARCHAR(100),
    user_status VARCHAR(255),
    user_email VARCHAR(300) NOT NULL UNIQUE,
    user_password VARCHAR(64) NOT NULL,
    user_avatar VARCHAR(260) DEFAULT 'media/static_media/empty_ava.jpeg'
);

CREATE TABLE post (
    post_id CHAR(23) NOT NULL PRIMARY KEY,
    post_author_id CHAR(23) NOT NULL,
    post_description MEDIUMTEXT,
    post_reactions INT UNSIGNED NOT NULL DEFAULT 0,
    post_when_posted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE image (
    owner_id CHAR(23) NOT NULL,
    image_name VARCHAR(260) NOT NULL,
    image_id CHAR(23) NOT NULL PRIMARY KEY
);