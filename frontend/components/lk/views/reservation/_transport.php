<?php


?>

<div class="container-fluid">
    <div class="row">
        <table class="table">
            <tbody>
            <tr>
                <td>
                    Стоимость одного места в транспорте:
                </td>
                <td>
                    <?php
                    echo $transPrice[0]->price; ?> руб.
                </td>
            </tr>
            <tr>
                <td>
                    Количество свободных мест в транспорте:
                </td>
                <td>
                    <?= $transSeats ?>
                </td>
            </tr>
            </tbody>

        </table>
    </div>
</div>
