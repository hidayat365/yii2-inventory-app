-- MariaDB dump 10.17  Distrib 10.4.8-MariaDB, for osx10.10 (x86_64)
--
-- Host: 127.0.0.1    Database: inventory
-- ------------------------------------------------------
-- Server version	5.7.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


--
-- Table structure for table locations
--
DROP TABLE IF EXISTS locations;
CREATE TABLE locations (
  id int NOT NULL AUTO_INCREMENT,
  code varchar(50) NOT NULL,
  name varchar(100) NOT NULL,
  address text,
  PRIMARY KEY (id),
  UNIQUE KEY uk_code (code)
);


--
-- Table structure for table warehouses
--
DROP TABLE IF EXISTS warehouses;
CREATE TABLE warehouses (
  id int NOT NULL AUTO_INCREMENT,
  code varchar(50) NOT NULL,
  name varchar(100) NOT NULL,
  location_id int NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_code (code),
  CONSTRAINT fk_warehouses_locations 
    FOREIGN KEY (location_id) REFERENCES locations (id) ON UPDATE CASCADE
);


--
-- Table structure for table item_types
--
DROP TABLE IF EXISTS item_types;
CREATE TABLE item_types (
  id int NOT NULL AUTO_INCREMENT,
  code varchar(50) NOT NULL,
  name varchar(100) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_code (code)
);


--
-- Table structure for table items
--
DROP TABLE IF EXISTS items;
CREATE TABLE items (
  id int NOT NULL AUTO_INCREMENT,
  code varchar(50) NOT NULL,
  name varchar(100) NOT NULL,
  type_id int NOT NULL,
  specification text,
  PRIMARY KEY (id),
  UNIQUE KEY uk_code (code),
  CONSTRAINT fk_items_types 
    FOREIGN KEY (type_id) REFERENCES item_types (id) ON UPDATE CASCADE
);


--
-- Table structure for table item_inventories
--
DROP TABLE IF EXISTS item_inventories;
CREATE TABLE item_inventories (
  id int NOT NULL AUTO_INCREMENT,
  item_id int NOT NULL,
  warehouse_id int NOT NULL,
  quantity decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (id),
  CONSTRAINT fk_item_inventories_items 
    FOREIGN KEY (item_id) REFERENCES items (id) ON UPDATE CASCADE,
  CONSTRAINT fk_item_inventories_warehouses 
    FOREIGN KEY (warehouse_id) REFERENCES warehouses (id) ON UPDATE CASCADE
);


--
-- Table structure for table transaction_types
--
DROP TABLE IF EXISTS transaction_types;
CREATE TABLE transaction_types (
  id int NOT NULL AUTO_INCREMENT,
  code varchar(50) NOT NULL,
  name varchar(100) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_code (code)
);


--
-- Table structure for table transactions
--
DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (
  id int NOT NULL AUTO_INCREMENT,
  code varchar(50) NOT NULL,
  date int NOT NULL DEFAULT '0',
  type_id int NOT NULL,
  warehouse_id int NOT NULL,
  remarks text,
  PRIMARY KEY (id),
  UNIQUE KEY uk_code (code),
  CONSTRAINT fk_transactions_types 
    FOREIGN KEY (type_id) REFERENCES transaction_types (id) ON UPDATE CASCADE,
  CONSTRAINT fk_transactions_warehouses 
    FOREIGN KEY (warehouse_id) REFERENCES warehouses (id) ON UPDATE CASCADE
);


--
-- Table structure for table transaction_details
--
DROP TABLE IF EXISTS transaction_details;
CREATE TABLE transaction_details (
  id int NOT NULL AUTO_INCREMENT,
  trans_id int NOT NULL,
  item_id int NOT NULL,
  quantity decimal(15,2) NOT NULL DEFAULT '0.00',
  remarks text,
  PRIMARY KEY (id),
  CONSTRAINT fk_transaction_details_items 
    FOREIGN KEY (item_id) REFERENCES items (id) ON UPDATE CASCADE,
  CONSTRAINT fk_transaction_details_transactions 
    FOREIGN KEY (trans_id) REFERENCES transactions (id) ON UPDATE CASCADE
);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-31 17:47:07
