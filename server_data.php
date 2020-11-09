<?php
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'nutrition';

// Table's primary key
$primaryKey = 'Id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => 'Item_Name', 'dt' => 0 ),
		array( 'db' => 'Rand_Images_Url', 'dt' => 1 ),
		array( 'db' => 'Total_Carbohydrate_amount', 'dt' => 2 ),
		array( 'db' => 'Total_Fat_amount', 'dt' => 3 ),
		array( 'db' => 'Protein_amount', 'dt' => 4 ),
		array( 'db' => 'Calories', 'dt' => 5 ),
		array( 'db' => 'Ingredients', 'dt' => 6 ),
		array( 'db' => 'Serving_Size', 'dt' => 7 ),
    array( 'db' => 'Brand_Name',  'dt' => 8 ),
    array( 'db' => 'Category',   'dt' => 9 ),
		array( 'db' => 'Upc_Number', 'dt' => 10 ),
);

// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'kroger',
    'host' => 'localhost'
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

?>
