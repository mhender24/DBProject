drop table orders;
drop table book;
drop table reviews;
drop table users;
drop table order_contents;

create table book(
ISBN varchar(14),
title varchar(100),
author varchar(100),
publisher varchar(100),
price decimal(5,2),
genre varchar(15) check (genre = "Fantasy" or genre = "Adventure" or genre = "Fiction" or genre = "Horror"),
Primary Key(ISBN)
);

create table reviews(
ISBN varchar(14),
review_number varchar(100),
review_txt varchar(250),
primary key(ISBN, review_number),
foreign key(ISBN) references book(ISBN)
);

create table users(
user_name varchar(20),
pin varchar(20),
fname varchar(20),
lname varchar(20),
address varchar(100),
city varchar(20),
state varchar(3),
zip varchar(6),
CCtype varchar(20),
CCnum varchar(17),
CCexp int,
primary key(user_name)
);

create table orders(
order_number varchar(10),
user_name varchar(20),
date date,
primary key(order_number),
foreign key(user_name) references users(user_name)
);

create table order_contents(
order_number varchar(10),
ISBN varchar(14),
quantity int,
primary key(order_number, ISBN),
foreign key(ISBN) references book(ISBN),
foreign key(order_number) references orders(order_number)
);