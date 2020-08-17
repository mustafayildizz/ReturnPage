# Symfony Return Page Application
### Intro
This application aims to create a return page for any e-commerce website. It developed in Symfony and uses MySQL as database. 
Users can any return operation for any product that order. All return operation stores in MySQL. Admin can see all return request at any time. 
### To deploy
- First thing first create a database that any name you want. 
- Secondly create all table and migrate. To see which table is have to create, go to end of this page.
- Finally run server using following command
```console
symfony server:start
```

## All tables and properties that have to create
To create neccessary tables, run these commands:
```console
CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(51) NOT NULL, phone VARCHAR(20) NOT NULL, country VARCHAR(50) DEFAULT NULL, street_adress VARCHAR(255) DEFAULT NULL, postcode VARCHAR(25) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
```
```console
CREATE TABLE refund (id INT AUTO_INCREMENT NOT NULL, order_code VARCHAR(20) NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, country VARCHAR(25) DEFAULT NULL, street_address VARCHAR(255) NOT NULL, postcode VARCHAR(15) NOT NULL, city VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, phone VARCHAR(50) NOT NULL, credit_card_number VARCHAR(100) NOT NULL, order_detail LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
```

If you have any question or problem feel free to [contact](m.gokhan.yildiz@gmail.com) me!
