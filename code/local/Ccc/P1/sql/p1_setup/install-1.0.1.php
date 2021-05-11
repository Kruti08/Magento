<?php
// $installer = $this;
// $installer->startSetup();
// $table = $this->getConnection()->newTable($installer->getTable('ccc_p1/p1'))
//     ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER,
//         null, [
//             'identity' => true,
//             'unsigned' => true,
//             'nullable' => false,
//             'primaty' => true,
//         ], 'ID')
//     ->addColumn('firstname', Varien_Db_Ddl_Table::TYPE_TEXT,
//         null, [
//             'nullable' => false,
//         ], 'First Name')
//     ->addColumn('lastname', Varien_Db_Ddl_Table::TYPE_TEXT,
//         null, [
//             'nullable' => false,
//         ], 'Last Name');

//         $installer->getConnection()->createTable($table);
//         $installer->endSetup();
$this->startSetup();
$this->run("CREATE TABLE `ccc_p1` (
        id int NOT NULL AUTO_INCREMENT,
        lastname varchar(255) NOT NULL,
        firstname varchar(255),
        PRIMARY KEY (id)
    );");
$this->endSetup();