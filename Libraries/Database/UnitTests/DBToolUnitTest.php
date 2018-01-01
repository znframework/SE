<?php namespace ZN\Database;

class DBToolUnitTest extends \UnitTestController
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const unit =
    [
        'class'   => 'DBTool',
        'methods' =>
        [
            'listDatabases'    => [],
            'listTables'       => [],
            #'statusTables'     => ['*'],
            #'optimizeTables'   => ['*'],
            #'repairTables'     => ['*'],
            #'backup'           => []
        ]
    ];
}
