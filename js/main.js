var IndexPage = (function() {
    var total = 0;

    function toFixed(value, precision) {
        precision = precision || 0;
        var power = Math.pow(10, precision),
            absValue = Math.abs(Math.round(value * power)),
            result = (value < 0 ? '-' : '') + String(Math.floor(absValue / power));

        if (precision > 0) {
            var fraction = String(absValue % power),
                padding = new Array(Math.max(precision - fraction.length, 0) + 1).join('0');
            result += '.' + padding + fraction;
        }
        return result;
    }

    return {
        paid: function() {
            var $form_paid = $('#form_paid'),
                $service_id = $('#service_id');

            $('.paid').on('click', function() {
                var $this = $(this);
                $service_id.val($this.data('service_id'));
                $form_paid.submit();
            })
        },
        additional: function() {
            var $amount_value = $('.total .value');
            $('.btn').on('click', function() {
                var $this = $(this);
                total += +$this.data('amount');

                $amount_value.html(toFixed(total, 2))

            })
        }
    }
})();

$(document).ready(function() {
    IndexPage.paid();
    IndexPage.additional();
});
