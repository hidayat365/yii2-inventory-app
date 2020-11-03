delimiter $$

drop trigger if exists trg_items_after_insert$$
-- -----------------------------
-- items after insert trigger
-- -----------------------------
create trigger trg_items_after_insert
after insert on items
for each row
begin
    insert into item_inventories (item_id, warehouse_id)
    select new.id, w.id from warehouses w;
end$$


drop trigger if exists trg_warehouses_after_insert$$
-- -----------------------------
-- warehouses after insert trigger
-- -----------------------------
create trigger trg_warehouses_after_insert
after insert on warehouses
for each row
begin
    insert into item_inventories (item_id, warehouse_id)
    select i.id, new.id from items i;
end$$


drop trigger if exists trg_transaction_details_after_insert$$
-- -----------------------------
-- after insert trigger
-- -----------------------------
create trigger trg_transaction_details_after_insert
after insert on transaction_details
for each row
begin
  -- -----------------------------
  -- ambil jenis transaksi
  -- -----------------------------
  declare tipe varchar(20);
  declare wh int;
  set tipe = (
    select tt.code
      from transactions tr
      join transaction_types tt on tr.type_id=tt.id
      where tr.id = new.trans_id
  ) ;
  set wh = (
    select tr.warehouse_id
      from transactions tr
      where tr.id = new.trans_id
  ) ;
  -- -----------------------------
  -- update sesuai jenis transaksi
  -- -----------------------------
  update item_inventories
    set quantity
        = quantity
        + case when tipe = 'IN' then new.quantity
               when tipe = 'OUT' then -new.quantity
               else 0 end
    where item_id = new.item_id 
    and warehouse_id = wh ;
end$$


drop trigger if exists trg_transaction_details_after_update$$
-- -----------------------------
-- after update trigger
-- -----------------------------
create trigger trg_transaction_details_after_update
after update on transaction_details
for each row
begin
  -- -----------------------------
  -- ambil jenis transaksi
  -- -----------------------------
  declare tipe varchar(20);
  declare wh int;
  set tipe = (
    select tt.code
      from transactions tr
      join transaction_types tt on tr.type_id=tt.id
      where tr.id = old.trans_id
  ) ;
  set wh = (
    select tr.warehouse_id
      from transactions tr
      where tr.id = new.trans_id
  ) ;
  -- -----------------------------
  -- update sesuai jenis transaksi
  -- => kurangi dengan old quantity
  -- -----------------------------
  update item_inventories
    set quantity
        = quantity
        + case when tipe='IN' then -old.quantity
               when tipe='OUT' then old.quantity
               else 0 end
    where item_id = old.item_id
    and warehouse_id = wh ;
  -- -----------------------------
  -- update sesuai jenis transaksi
  -- => tambahkan dengan new quantity
  -- -----------------------------
  update item_inventories
    set quantity
        = quantity
        + case when tipe='IN' then new.quantity
               when tipe='OUT' then -new.quantity
               else 0 end
    where item_id = new.item_id
    and warehouse_id = wh ;
end$$


drop trigger if exists trg_transaction_details_after_delete$$
-- -----------------------------
-- after delete trigger
-- -----------------------------
create trigger trg_transaction_details_after_delete
after delete on transaction_details
for each row
begin
  -- -----------------------------
  -- ambil jenis transaksi
  -- -----------------------------
  declare tipe varchar(20);
  declare wh int;
  set tipe = (
    select tt.code
      from transactions tr
      join transaction_types tt on tr.type_id=tt.id
      where tr.id = old.trans_id
  ) ;
  set wh = (
    select tr.warehouse_id
      from transactions tr
      where tr.id = old.trans_id
  ) ;
  -- -----------------------------
  -- update sesuai jenis transaksi
  -- -----------------------------
  update item_inventories
    set quantity
        = quantity
        + case when tipe='IN' then -old.quantity
               when tipe='OUT' then old.quantity
               else 0 end
    where item_id = old.item_id
    and warehouse_id = wh ;
end$$
 
delimiter ;
