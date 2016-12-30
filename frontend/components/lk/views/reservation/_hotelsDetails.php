<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 24.12.16
 * Time: 10:02
 */

?>
<input type="hidden" id="lkorder-tour_info_id" name="LkOrder[tour_info_id]" value="<?= $tour_info_id ?>"/>
<div class="container-fluid">
    <div class="row">
        <table class="table">
            <tbody>
            <tr>
                <td>
                    <strong>Количество номеров в отеле:</strong>
                </td>
                <td>
                    <strong><?= $allCount ?></strong>
                </td>
            </tr>
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $typeRooms,
                'itemView' => '_typeCountRooms',

                'layout' => "{pager}\n{summary}\n{items}\n{pager}",
                'summary' => '',

                'emptyText' => '<p>Список пуст</p>',
                'emptyTextOptions' => [
                    'tag' => 'p'
                ],

                'pager' => [
                    'firstPageLabel' => 'Первая',
                    'lastPageLabel' => 'Последняя',
                    'nextPageLabel' => 'Следующая',
                    'prevPageLabel' => 'Предыдущая',
                    'maxButtonCount' => 5,
                ],
            ]);
            ?>

            <!--<tr>
                <td>
                    Количество свободных номеров:
                </td>
                <td>
                    <?= $allCount ?>
                </td>
            </tr>-->
            </tbody>

        </table>
    </div>
</div>
