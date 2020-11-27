$(document).ready(function () {
    $('.sidebar-menu').tree()

    $('#registros').DataTable({
      'paging'      : true,
      'pageLength'  : 10,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'language'    : {
          paginate: {
              next: 'Siguiente',
              previous: 'Anterior',
              first: 'Primero',
              las: 'Último'
          },
          info: 'Mostrando _START_ a _END_  de _TOTAL_ resultados',
          emptyTable: 'No hay registros',
          infoEmpty: '0 de 0 resultados',
          search: 'Buscar:'
      }
    });

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      showMeridian: false,
      showSeconds: true

    })

    // LINE CHART
    if(document.getElementById('line-chart')){
      $.getJSON('servicio-registrados.php', function(data){
      var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: data,
        // data: [
        //   {y: '2011 Q1', item1: 2666},
        //   {y: '2011 Q2', item1: 2778},
        //   {y: '2011 Q3', item1: 4912},
        //   {y: '2011 Q4', item1: 3767},
        //   {y: '2012 Q1', item1: 6810},
        //   {y: '2012 Q2', item1: 5670},
        //   {y: '2012 Q3', item1: 4820},
        //   {y: '2012 Q4', item1: 15073},
        //   {y: '2013 Q1', item1: 10687},
        //   {y: '2013 Q2', item1: 8432}
        // ],
        xkey: 'fecha',
        ykeys: ['cantidad'],
        labels: ['Boletos'],
        lineColors: ['#3c8dbc'],
        hideHover: 'auto'
      });
    });
  }

  })