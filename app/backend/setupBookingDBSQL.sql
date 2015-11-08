create database xirvana_booking;
use xirvana_booking;

create table Users (
	email 	VARCHAR(255) PRIMARY KEY,
	name 	VARCHAR(255) NOT NULL
);


-- check DB
show tables;
desc Users;
select * from Users;

-- reset DB
truncate table Users;