CREATE DATABASE shoes;

USE shoes;

CREATE TABLE stores (id serial PRIMARY KEY, store_name VARCHAR(255), location VARCHAR (255));

CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR(255));

CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, brand_id INT);
