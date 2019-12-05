$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#nav-top').toggleClass('nav-expand');
        $('#content').toggleClass('nav-expand')
    });

    $("button.check").click(function () {
        var ids = [];
        $.each($("input[class='chk']:checked"), function () {
            ids.push($(this).val());
        });

        $("#id_contas").val(ids);
    });
    console.log(document.URL);

    var links = $('.side-link').children();
    $.each(links, function (key, value) {
        console.log(value.href);
        if (value.href == document.URL) {
            $(this).addClass('active-link');
        } else {
            $(this).removeClass('active-link');
        }
    });
});


var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
        datasets: [{
            data: [1533, 2134, 1848, 2400, 2348, 2409, 1203],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: false
                }
            }]
        },
        legend: {
            display: false,
        }
    }
});
