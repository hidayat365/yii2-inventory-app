<?php

use yii\db\Migration;

/**
 * Class m201106_084246_create_inventory_triggers
 */
class m201106_084246_create_inventory_triggers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // -----------------------------
        // items after insert trigger
        // -----------------------------
        $trigger = <<< SQL
            create trigger trg_items_after_insert
            after insert on items
            for each row
            begin
                insert into item_inventories (item_id, warehouse_id)
                select new.id, w.id from warehouses w;
            end;
        SQL;
        $this->execute("drop trigger if exists trg_items_after_insert");
        $this->execute($trigger);

        // -----------------------------
        // warehouses after insert trigger
        // -----------------------------
        $trigger = <<< SQL
            create trigger trg_warehouses_after_insert
            after insert on warehouses
            for each row
            begin
                insert into item_inventories (item_id, warehouse_id)
                select i.id, new.id from items i;
            end;
        SQL;
        $this->execute("drop trigger if exists trg_warehouses_after_insert");
        $this->execute($trigger);

        // -----------------------------
        // after insert trigger
        // -----------------------------
        $trigger = <<< SQL
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
            end;
        SQL;
        $this->execute("drop trigger if exists trg_transaction_details_after_insert");
        $this->execute($trigger);

        // -----------------------------
        // after update trigger
        // -----------------------------
        $trigger = <<< SQL
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
            end;
        SQL;
        $this->execute("drop trigger if exists trg_transaction_details_after_update");
        $this->execute($trigger);

        // -----------------------------
        // after delete trigger
        // -----------------------------
        $trigger = <<< SQL
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
            end;
        SQL;
        $this->execute("drop trigger if exists trg_transaction_details_after_delete");
        $this->execute($trigger);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
