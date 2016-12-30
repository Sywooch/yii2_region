<?php
/**
 * Created by PhpStorm.
 * User: kirsanov_av
 * Date: 04.08.16
 * Time: 9:50
 */

$this->registerJs('
    $("#choose-country").on("change", function() {
        $.pjax.reload("#choose-gethotelsinfo div div.col-sm-6", {
            history: false,
            data: $(this).serialize(),
            type: \'POST\',
            url: \'gethotelsinfo\',
        });
    });
');

if (!$model->isNewRecord) {
    $this->registerJs('
        $("#choose-hotels_info_id").on("change", function() {
            $.pjax.reload("#pjax-hotelspricing-hotelsinfo div div.col-sm-6", {
                history: false,
                data: $(this).serialize(),
                type: \'POST\',
                url: \'getappartment\',
            });
        });'
    );

    $this->registerJs('
        $(function(){
        $(document).on(\'click\', \'[data-toggle=reroute]\', function(e) {
            e.preventDefault();
            var action = $(this).attr(\'href\');
            $.pjax.reload(\'#pjax-hotels-pay-period\', {
                    history: false,
                    data: $(\'#hotels-pay-period_UpdatePjax input, select\').serialize(),
                    type: \'POST\',
                    url: action,
                    success: function(data){
                        $(\'.result\').html(data);
                    },
                    error: function(xhr, str){
                        alert(\'Возникла ошибка: \' + xhr.responseCode);
                    }
                });
            });
        });
    ');

    $this->registerJs("
    
        function pay_update(){
            $.pjax.reload('#pjax-hotels-pay-period', {
                history: false,
                data: $('#hotels-pay-period_UpdatePjax input, select').serialize(),
                type: 'POST',
                url: '" . \yii\helpers\Url::toRoute(['hotels-pay-period/update', 'hotels_pricing_id' => $model->id]) . "',
                success: function(data){
                    $('.result').html(data);
                },
                error: function(xhr, str){
                    alert('Возникла ошибка: ' + xhr.responseCode);
                  }
            });
        };
    ", yii\web\View::POS_END);
}
