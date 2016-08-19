<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 07.08.16
 * Time: 12:22
 */

?>

<script>
    function addRow <?= $class ?>() {
        var data = $('#choose-<?= $relID?> :dropDownList').serializeArray();
        data.push({name: '_action', value: 'choose'});
        $.ajax({
            type: 'POST',
            url: '<?php echo Url::to(['choose-' . $relID]); ?>',
            data: data,
            success: function (data) {
                $('#choose-<?= $relID?>').html(data);
            }
        });
    }
    function delRow <?= $class ?>(id) {
        $('#add-<?= $relID?> tr[data-key=' + id + ']').remove();
    }
</script>
