$(document).ready(function () {
    $('.date').mask('00/00/0000');
    $('.cod_barras').mask('00000.00000 00000.000000 00000.000000 0 00000000000000');
    $('.num_doc').mask('0000');
    $('.cpf').mask('000.000.000-00', { reverse: true });
    $('.cep').mask('00000-000');
    $('.cnpj').mask('00.000.000/0000-00', { reverse: true });
    $('.money').mask('000.000.000.000.000,00')

    $('.cod_barras').keydown(function (event) {

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            event.preventDefault();

            $.get($(this).data('url') + '/' + $(this).val(), function (data, status) {
                $("#dt_vencimento").val(data['dt_vencimento']);
                $("#valor_documento").val(data['valor_doc']);
            });
        }
    });

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
