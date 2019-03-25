$(function(){
  'use strict';
    $.ajax({
            type:"GET",
            url: url,
            success: function(data){
                renderLine(data);
            }
        });
    function renderLine(data) {
        new Morris.Line({
            element: 'morrisLine1',
            data: data,
            xkey: 'date',
            ykeys: ['users'],
            labels: ['Users'],
            lineColors: ['#14A0C1'],
            lineWidth: 2,
            ymax: 'auto 100',
            gridTextSize: 11,
            hideHover: 'auto',
            smooth: true,
            resize: true
        });
    }

});
