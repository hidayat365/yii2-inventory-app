--
-- Denormalized view of transactions data
--
CREATE OR REPLACE
    VIEW inventory_cards as
SELECT t.id AS trans_id
, t.code AS trans_code
, t.date AS trans_date
, a.id AS detail_id, a.item_id AS item_id
, w.code AS warehouse_code, w.name AS warehouse_name
, b.code AS item_code, b.name AS item_name
, CASE
    WHEN t.type_id=1 THEN a.quantity
    WHEN t.type_id=2 THEN -a.quantity
    ELSE 0 END
  AS quantity
, trim(concat(t.remarks,' - ',a.remarks)) AS remarks
FROM transactions t
JOIN transaction_details a ON t.id = a.trans_id
JOIN items b ON a.item_id = b.id
JOIN warehouses w ON w.id = t.warehouse_id;

--
-- inventory stock card query
-- only work on mysql database
--
SELECT trans_code
, from_unixtime(trans_date) trans_date
, warehouse_name
, item_name
, quantity
, @sal := @sal + quantity AS saldo
FROM inventory_cards
JOIN ( SELECT @sal:=0 ) v
WHERE item_code = 'RM01'
AND warehouse_code = 'IDW01'
ORDER BY trans_date, trans_id;

--
-- inventory stock card query
-- works on database which support window function
--
select trans_code
, from_unixtime(trans_date) trans_date
, warehouse_name
, item_name
, quantity
, sum(quantity) over(
    partition by warehouse_code, item_code
    order by trans_date) saldo
from inventory_cards ic
where item_code = 'RM01'
and warehouse_code = 'IDW01'
order by trans_date, trans_id;

