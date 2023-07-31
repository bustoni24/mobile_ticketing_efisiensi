<?php if($countTrx > 0) { ?>
       /*  var vaTimeLimitNow = <?php //echo $dateDisplay['js_now']; ?>;
        var vaTimeLimitEnd = <?php //echo $dateDisplay['js_end']; ?>;

        var vaTimeLimitSisaDefault = vaTimeLimitEnd - vaTimeLimitNow;
        var vaTimeLimitInterval; */
        $('.timeLimit').each(function(){
            var jsNow = $(this).attr('data-now');
            var jsEnd = $(this).attr('data-end');

            vaTimeLimitFunction(jsNow, jsEnd, $(this));
        });


        function vaTimeLimitFunction(vaTimeLimitNow, vaTimeLimitEnd, parent) {
            if (parent === "undefined")
                return false;
            
            var vaTimeLimitSisaDefault = vaTimeLimitEnd - vaTimeLimitNow;
            var vaTimeLimitInterval;

            var vaTimeLimitSisa = vaTimeLimitSisaDefault;
            var vaTimeLimitSisaHour = Math.floor(vaTimeLimitSisa / 86400);
            vaTimeLimitSisa = vaTimeLimitSisa % 86400;
            vaTimeLimitSisaHour = (parseInt(vaTimeLimitSisaHour) * 24) + parseInt(Math.floor(vaTimeLimitSisa / 3600));
            vaTimeLimitSisa = vaTimeLimitSisa % 3600;
            parent.find('.timeLimitHour').html(pad(vaTimeLimitSisaHour, 2));
            parent.find('.timeLimitMinute').html(pad(Math.floor(vaTimeLimitSisa / 60), 2));
            vaTimeLimitSisa = vaTimeLimitSisa % 60;
            parent.find('.timeLimitSecond').html(pad(Math.floor(vaTimeLimitSisa), 2));

            vaTimeLimitSisaDefault -= 1;
            if(vaTimeLimitSisaDefault > 0) {
                setTimeout(function () {
                    vaTimeLimitFunction(vaTimeLimitNow, vaTimeLimitEnd, parent);
                }, 1000);
            } else {
                // clearTimeout(vaTimeLimitInterval);
            }
        }
    <?php } ?>

    function pad (str, max) {
        str = str.toString();
        return str.length < max ? pad("0" + str, max) : str;
    }