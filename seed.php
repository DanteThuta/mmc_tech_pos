<?php
require 'init.php';

//category
query('delete from category');
query(
    'alter table category auto_increment = 1'
);

$cat = ['Hat','Shirt','Electric','Drink'];
foreach ($cat as $c){
    query(
        'insert into category (slug,name) values (?,?)',
        [slug($c),$c]
    );
}

Echo "success Category";
