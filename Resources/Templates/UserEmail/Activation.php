<?php Import::style('bootstrap'); ?>

<table class="table table-bordered">
    <tr>
        <th><?php echo ZN\Language\Lang::select('IndividualStructures', 'user:activationProcess')?></th>
    </tr>

    <tr>
        <td>
            <a href="<?php echo $url.'user/'.$user.'/pass/'.$pass; ?>"> <?php echo ZN\Language\Lang::select('IndividualStructures', 'user:activation')?> </a>
        </td>
    </tr>
</pre>

