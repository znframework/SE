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
// Autoloader Extension
//--------------------------------------------------------------------------------------------------------
//
// @extension jquery
// @extension bootstrap
// @extension raphael
// @extension morris
//
//--------------------------------------------------------------------------------------------------------

$extensions = JC::extensions($extensions, ['jquery', 'select2'], $autoloadExtensions);

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

if( ! empty($multiple) )
{
    Form::multiple();
}

if( ! empty($table) )
{
    Form::table($table);
}

if( ! empty($query) )
{
    Form::query($query);
}

if( ! empty($class) )
{
    Form::class($class);
}

echo Form::id($id)->attr($attributes)->select($name, $data ?? [], $selected);

if( ! empty($extensions) )
{
    Import::script(...$extensions);
}
?>

<script>
$(function()
{
    $('#<?php echo $id ?>').select2(<?php echo ! empty($properties) ? json_encode($properties) : NULL?>);
});
</script>
