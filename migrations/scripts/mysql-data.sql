--
-- Data for table locations
--
INSERT INTO `locations` VALUES (1,'ID','Indonesia',NULL);
INSERT INTO `locations` VALUES (2,'MY','Malaysia',NULL);
INSERT INTO `locations` VALUES (3,'SA','Saudi Arabia',NULL);

--
-- Data for table warehouses
--
INSERT INTO `warehouses` VALUES (1,'IDW01','Raw Material ID',1);
INSERT INTO `warehouses` VALUES (2,'IDW02','Finished Goods ID',1);
INSERT INTO `warehouses` VALUES (3,'MYW01','Raw Material MY',2);
INSERT INTO `warehouses` VALUES (4,'MYW02','Finished Goods MY',2);
INSERT INTO `warehouses` VALUES (5,'SAW01','Raw Material SA',3);
INSERT INTO `warehouses` VALUES (6,'SAW02','Finished Goods SA',3);

--
-- Data for table item_types
--
INSERT INTO `item_types` VALUES (1,'RM','Raw Material');
INSERT INTO `item_types` VALUES (2,'FG','Finished Goods');

--
-- Data for table items
--
INSERT INTO `items` VALUES (1,'RM01','Habbatussauda',1,'Habbatussauda Super');
INSERT INTO `items` VALUES (2,'RM02','Minyak Zaitun',1,'Minyak Zaitun Bubuk');
INSERT INTO `items` VALUES (3,'RM03','Madu Hutan Asli',1,'Madu Super Plus Propolis');
INSERT INTO `items` VALUES (4,'FG01','Habbat+ Zaitun Softgel',2,'Habbatussauda Super plus Minyak Zaitun Softgel');
INSERT INTO `items` VALUES (5,'FG02','Madu++ Barokah',2,'Madu++ Propolis, Habbatussauda, dan Minyak Zaitun');

--
-- Data for table transaction_types
--
INSERT INTO `transaction_types` VALUES (1,'IN','Barang Masuk');
INSERT INTO `transaction_types` VALUES (2,'OUT','Barang Keluar');

--
-- Raw Material data for table transactions
--
insert into transactions (`id`, `type_id`, `code`, `date`, `warehouse_id`, `remarks`)
  values (1, 1, 'RM.00001/2020', unix_timestamp('2020-01-10'), 1, 'Penerimaan Bahan Baku') ;
insert into transactions (`id`, `type_id`, `code`, `date`, `warehouse_id`, `remarks`)
  values (2, 2, 'RM.00002/2020', unix_timestamp('2020-01-12'), 1, 'Pengeluaran Bahan Baku') ;

--
-- Raw Material data for table transaction_details
--
insert into transaction_details (trans_id, item_id, quantity, remarks)
  values (1, 1, 20, 'Penerimaan Bahan Baku 1');
insert into transaction_details (trans_id, item_id, quantity, remarks)
  values (1, 2, 30, 'Penerimaan Bahan Baku 2');
insert into transaction_details (trans_id, item_id, quantity, remarks)
  values (1, 3, 30, 'Penerimaan Bahan Baku 3');

insert into transaction_details (trans_id, item_id, quantity, remarks)
  values (2, 1, 5, 'Pengeluaran Bahan Baku 1');
insert into transaction_details (trans_id, item_id, quantity, remarks)
  values (2, 2, 10, 'Pengeluaran Bahan Baku 2');

--
-- Finished Goods data for table transactions
--
insert into transactions (`id`, `type_id`, `code`, `date`, `warehouse_id`, `remarks`)
  values (3, 1, 'FG.00001/2020', unix_timestamp('2020-01-14'), 2, 'Penerimaan Barang Jadi') ;
insert into transactions (`id`, `type_id`, `code`, `date`, `warehouse_id`, `remarks`)
  values (4, 2, 'FG.00002/2020', unix_timestamp('2020-01-26'), 2, 'Pengeluaran Barang Jadi') ;

--
-- Raw Material data for table transaction_details
--
insert into transaction_details (trans_id, item_id, quantity, remarks)
  values (3, 4, 20, 'Penerimaan Barang Jadi 1');
insert into transaction_details (trans_id, item_id, quantity, remarks)
  values (3, 5, 15, 'Penerimaan Barang Jadi 2');

insert into transaction_details (trans_id, item_id, quantity, remarks)
  values (4, 4, 10, 'Pengeluaran Barang Jadi 1');
insert into transaction_details (trans_id, item_id, quantity, remarks)
  values (4, 5, 10, 'Pengeluaran Barang Jadi 2');
