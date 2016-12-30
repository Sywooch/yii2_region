<?php

?>

<script>
    $("#<?= $class ?>-<?= $parentID ?>").on("change", function () {
        $.pjax.reload("#<?= $class ?>-<?= $relID ?> div", {
            history: false,
            data: $(this).serialize(),
            type: 'POST',
            url: '<?= $relID ?>',

        });
    });
</script>

