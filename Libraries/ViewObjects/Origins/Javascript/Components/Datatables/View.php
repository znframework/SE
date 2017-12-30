<?php
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

//--------------------------------------------------------------------------------------------------------
// Extract Vars
//--------------------------------------------------------------------------------------------------------
//
// @var string   $width      = '100%'
// @var array    $attributes = []
// @var string   $id         = 'datatable'
// @var string   $class      = 'table-striped table-bordered table-hover'
// @var callable $process    = NULL
// @var int      $length     = 100
// @var array    $properties = []
// @var array    $extensions = []
//
//--------------------------------------------------------------------------------------------------------
$serverSide = $properties['serverSide'] ?? NULL;

if( is_string($result) )
{
    $result = DB::get($result)->resultArray();
}

//--------------------------------------------------------------------------------------------------------
// Autoloader Extension
//--------------------------------------------------------------------------------------------------------
//
// @extension jquery
// @extension bootstrap
// @extension raphael
// @extension morris
//
//--------------------------------------------------------------------------------------------------------

$extensions = JC::extensions($extensions, ['jquery', 'datatables'], $autoloadExtensions);

//--------------------------------------------------------------------------------------------------------
// Server Side
//--------------------------------------------------------------------------------------------------------
//
// Server Side === FALSE
// Result Type
// [
//     ['column1' => 'data', 'columns2' => 'data'],
//     ['column1' => 'data', 'columns2' => 'data']
// ]
//
// Server Side === TRUE
// Result Type
// ['column1', 'columns2', ...]
//
//--------------------------------------------------------------------------------------------------------
if( empty($serverSide) )
{
    $columns = array_keys
    (
        ZN\DataTypes\Arrays\GetElement::first($result)
    );
}
else
{
    $columns = $result;

    foreach( $columns as $column )
    {
        $properties['columns'][] = ['data' => $column];
    }
}

//--------------------------------------------------------------------------------------------------------
// Available Extensions
//--------------------------------------------------------------------------------------------------------
//
// Internal/Config/ViewObjects
// 'cdn' =>
// [
//     script => [],
//     style  => []
// ]
//
//--------------------------------------------------------------------------------------------------------
if( ! empty($extensions) )
{
    Import::style(...$extensions);
}

//--------------------------------------------------------------------------------------------------------
// Datatable
//--------------------------------------------------------------------------------------------------------
//
// Datatable Structure
//
//--------------------------------------------------------------------------------------------------------
?>
<table width="<?php echo $width ?>" <?php echo Html::attributes($attributes)?> class="table <?php echo $class;?>" id="<?php echo $id?>">
    <thead>
        <tr>
            <?php foreach( $columns as $column ): ?>
            <th><?php echo $column ?></th>
            <?php endforeach; ?>
            <?php if( is_callable($process) ): ?>
            <th><?php echo ZN\IndividualStructures\Lang::select('ViewObjects', 'dbgrid:processLabel') ?></th>
            <?php endif; ?>
        </tr>
    </thead>
    <?php if( empty($serverSide) ): ?>
    <tbody>
        <?php foreach( $result as $key => $row ): ?>
        <tr>
            <?php foreach( $columns as $column ): ?>
            <td><?php echo ZN\Helpers\Limiter::word($row[$column] ?? '', $length) ?></td>
            <?php endforeach; ?>
            <?php if( is_callable($process) ): ?>
            <td><?php echo $process((object) $row, new Html); ?></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <?php endif; ?>
</table>

<?php
if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>

<script>
//--------------------------------------------------------------------------------------------------------
// Datatable Initialize
//--------------------------------------------------------------------------------------------------------
//
// Init Datatable With $properties
//
//--------------------------------------------------------------------------------------------------------
$(document).ready(function()
{
    $('#<?php echo $id ?>').DataTable(<?php echo ! empty($properties) ? json_encode($properties) : NULL?>);
});
</script>
