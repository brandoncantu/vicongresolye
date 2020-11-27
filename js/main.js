(function(){
    "use strict";

    var regalo = document.getElementById('regalo');
    
    const formulario = document.querySelector('#registroNews');
    

    function newsEmail(e){
        e.preventDefault();
        // llamado a ajax
        const mail = document.querySelector('#email-news').value;
        // crear el objeto
        const xhr = new XMLHttpRequest();

        const datos = new FormData();
        datos.append('email', mail);


        // abrir la conexion
        xhr.open('POST', 'modelos/modelo-newletter.php', true);

        // pasar los datos
        xhr.onload = function() {
            if(this.status === 200) {
                console.log((xhr.responseText)); 
                // leemos la respuesta de PHP
                const respuesta = JSON.parse( xhr.responseText);
                if(respuesta.respuesta == 'correcto')
                //mostrar notificacion
                    alert('Se suscribió correctamente');
                }else{
                    alert('Hubo un error al suscribirse');
            }

        }
        // enviar los datos
        xhr.send(datos);
        document.querySelector('#myModal').style.display='none';
    }

    if(document.getElementById('mapa')){
        var map = L.map('mapa').setView([25.726051, -100.379312], 17);
 
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
 
        L.marker([25.726051, -100.379312]).addTo(map)
        .bindPopup('VI Congreso LyE<br> Boletos ya disponibles.')
        .openPopup();

        eventListeners();

        function eventListeners(){
            formulario.addEventListener('submit', newsEmail);
        }
        var modal = document.getElementById("myModal");
        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        // When the user clicks the button, open the modal 
        btn.onclick = function() {
        modal.style.display = "block";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
            modal.style.display = "none";
            }
        }

    }
    
    document.addEventListener('DOMContentLoaded', function(){

        //REGISTRO//////////////////////////////////////////////////////////////
        //DATOS USUARIO
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');
        //CAMPOS PASES
        var pase_dia = document.getElementById('pase_dia');
        var pase_todo = document.getElementById('pase_todo');
        var pase_dos = document.getElementById('pase_dos');

        //BOTONES DIVS
        var calcular = document.getElementById('calcular');
        var btnRegistro = document.getElementById('btnRegistro');
        var lista_productos = document.getElementById('lista-productos');
        var suma = document.getElementById('suma-total');

        //EXTRAS
        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas');

        if(document.getElementById('calcular')){

        btnRegistro.disabled = true;

        calcular.addEventListener('click', CalcularMontos);
        pase_dia.addEventListener('blur', MostrarDias);
        pase_dos.addEventListener('blur', MostrarDias);
        pase_todo.addEventListener('blur', MostrarDias);
        nombre.addEventListener('blur', ValidarCampos);
        apellido.addEventListener('blur', ValidarCampos);
        email.addEventListener('blur', ValidarCampos);

        $("#nombre").keypress(function(event) {
            var character = String.fromCharCode(event.keyCode);
            return BloquearNumerosyEsp(character);     
        });
        $("#apellido").keypress(function(event) {
            var character = String.fromCharCode(event.keyCode);
            return BloquearNumerosyEsp(character);     
        });
        
        function BloquearNumerosyEsp(str) {
            return !/[~`!@#$%\^&*()1234567890+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
        }

        //Validar Datos
        function ValidarCampos(){  
            var validado = false;        
            if(this.id == "nombre"){
                if(this.value != '' || this.value.length >0){
                    $('#campo-nombre').removeClass('has-error');
                    this.style.border = '1px solid #ccc';
                    document.getElementById('help-block-nombre').innerHTML = "";
                    validado = true;
                }else{
                    $('#campo-nombre').addClass('has-error');
                    document.getElementById('help-block-nombre').innerHTML = "Introduzca nombre";
                    this.style.border = '1px solid red'; 
                    validado = false;    
                }
            }
            if(this.id == "apellido"){
                if(this.value != '' || this.value.length >0){
                    $('#campo-apellido').removeClass('has-error');
                    this.style.border = '1px solid #ccc';
                    document.getElementById('help-block-apellido').innerHTML = "";
                    validado = true;
                }else{
                    $('#campo-apellido').addClass('has-error');
                    document.getElementById('help-block-apellido').innerHTML = "Introduzca apellido";
                    this.style.border = '1px solid red'; 
                    validado = false;    
                }
            }
            if(this.id == "email"){
                if(this.value.includes("@") && (this.value != '' || this.value.length >0)){
                    $('#campo-email').removeClass('has-error');
                    this.style.border = '1px solid #ccc';
                    document.getElementById('help-block-email').innerHTML = "";
                    validado = true;
                }else{
                    $('#campo-email').addClass('has-error');
                    document.getElementById('help-block-email').innerHTML = "Introduzca email valido";
                    this.style.border = '1px solid red'; 
                    validado = false;    
                }
            }
            return validado;
        }

        function CalcularMontos(event){
            event.preventDefault();

            if(regalo.value == ''){
                alert("Debes elegir un regalo");
                regalo.focus();
            }else if((pase_dia.value==""||pase_dia.value==0) && (pase_dos.value==""||pase_dos.value==0) && (pase_todo.value==""||pase_todo.value==0)){
                alert("Debes elegir un pase");
                pase_dia.focus();
                pase_dos.focus();
                pase_todo.focus();
            }else{
                var boletoDia = parseInt(pase_dia.value, 10) || 0,
                    boleto2Dias = parseInt(pase_dos.value, 10) || 0,
                    boletoCompleto = parseInt(pase_todo.value, 10) || 0,
                    cantCamisas = parseInt(camisas.value, 10) || 0,
                    cantEtiquetas = parseInt(etiquetas.value, 10) || 0;

                var totalPagar = (boletoDia * 30) + (boleto2Dias * 45) + (boletoCompleto * 50) + ((cantCamisas * 10)*.93) + (cantEtiquetas * 2);
                var listaProductos = [];

                if(boletoDia == 1){listaProductos.push( boletoDia + " Pase por día.");}
                else{if(boletoDia > 1){listaProductos.push( boletoDia + " Pases por día.");}}
                if(boleto2Dias == 1){listaProductos.push( boleto2Dias + " Pase por 2 dias.");}
                else{ if(boleto2Dias > 1){listaProductos.push( boleto2Dias + " Pases por 2 dias.");}}
                if(boletoCompleto == 1){listaProductos.push( boletoCompleto + " Pase completo.");}
                else{if(boletoCompleto > 1){listaProductos.push( boletoCompleto + " Pases completos.");}}
                if(cantEtiquetas == 1){listaProductos.push( cantEtiquetas + " Paquete de Stickers.");}
                else{if(cantEtiquetas > 1){listaProductos.push( cantEtiquetas + " Paquetes de Stickers.");}}
                if(cantCamisas == 1){listaProductos.push( cantCamisas + " Camisa.");}
                else{if(cantCamisas > 1){listaProductos.push( cantCamisas + " Camisas.");}}

                lista_productos.style.display = 'block';
                lista_productos.innerHTML = '';

                for(var i=0; i<listaProductos.length; i++){
                    lista_productos.innerHTML += listaProductos[i] + "</br>";
                }
                suma.innerHTML = "$ " + totalPagar.toFixed(2);
                btnRegistro.disabled = false;
                document.getElementById('total_pedido').value = totalPagar;

            }
        }


        function MostrarDias(event){

            var boletoDia = parseInt(pase_dia.value, 10) || 0,
                boleto2Dias = parseInt(pase_dos.value, 10) || 0,
                boletoCompleto = parseInt(pase_todo.value, 10) || 0;
            var diasElegidos = [];
            document.getElementById('viernes').style.display = 'none';
            document.getElementById('sabado').style.display = 'none';
            document.getElementById('domingo').style.display = 'none';

            if(boletoDia > 0){diasElegidos.push('viernes');}
            if(boleto2Dias > 0){diasElegidos.push('viernes','sabado');}
            if(boletoCompleto > 0){diasElegidos.push('viernes','sabado','domingo');}

            for(var i=0; i<diasElegidos.length;i++){
                document.getElementById(diasElegidos[i]).style.display = 'block';
            }
        }

        //VALIDAR CAMPOS ANTES DE ENVIAR FORMULARIO
        $(function(){
            $('.submit').on('submit', function(event){
                var campo = "";
                if(nombre.value.length<=0 || apellido.value.length<=0 || email.value.length<=0){
                event.preventDefault();
                event.stopPropagation();
                if(nombre.value.length<=0){
                    $('#campo-nombre').addClass('has-error');
                    document.getElementById('help-block-nombre').innerHTML = "Introduzca nombre";
                    campo = campo + "Nombre ";
                }
                if(apellido.value.length<=0){
                    $('#campo-apellido').addClass('has-error');
                    document.getElementById('help-block-apellido').innerHTML = "Introduzca apellido";
                    campo = campo + "Apellido ";
                }
                if(email.value.length<=0){
                    $('#campo-email').addClass('has-error');
                    document.getElementById('help-block-email').innerHTML = "Introduzca email";
                    campo = campo + "Email ";                
                }
                alert(campo+"obligatorio.");
               }
            });
        });
    }

    if(document.getElementById('num-cont1')){
    document.getElementById('num-cont1').innerHTML="4";
    document.getElementById('num-cont2').innerHTML="9";    
    document.getElementById('num-cont3').innerHTML="3";
    document.getElementById('num-cont4').innerHTML="6";
    }


    });
})();



$(function(){
 
    //Pestañas
    if ($(".pag-index")[0]){
        document.title = "Home"; 
    }
    if ($(".pag-conferencia")[0]){
        document.title = "Conferencia"; 
    }
    if ($(".pag-calendario")[0]){
        document.title = "Calendario"; 
    }
    if ($(".pag-invitados")[0]){
        document.title = "Invitados"; 
    }
    if ($(".pag-registro")[0]){
        document.title = "Reservaciones"; 
    }
    if ($(".pag-validar-registro")[0]){
        document.title = "Registro"; 
    }

    //MENU Fijo
    var windowHeight = $(window).height();
    var menuHeight = $('.barra').innerHeight();

    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll > windowHeight){
            $('.barra').addClass('fixed');
            $('body').css({'margin-top': + menuHeight+'px'});
            //console.log(scroll);
        }else{
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top': '0px'});
        }

    });

    //Activos
    if ($(".pag-conferencia")[0]){
        $('.navegacion-principal a:first').addClass('activo');
    }
    if ($(".pag-calendario")[0]){
        $('.navegacion-principal a:nth-child(2)').addClass('activo');
    }
    if ($(".pag-invitados")[0]){
        $('.navegacion-principal a:nth-child(3)').addClass('activo');
    }
    if ($(".pag-registro")[0]){
        $('.navegacion-principal a:nth-child(4)').addClass('activo-1');
    }
 

    //Menu movil
    $('.menu-movil').on('click', function(){
        console.log('click menu');
        $('.navegacion-principal').slideToggle();
        $('.menu-movil span:first ').slideToggle();
        $('.menu-movil span:nth-child(3) ').slideToggle();
    });

    //Programa de Conferencias
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').on('click', function(){
        $('.menu-programa a').removeClass('activo');
        $(this).addClass('activo');
        $('.ocultar').hide();
        var enlace = $(this).attr('href');
        $(enlace).fadeIn(1000);
        return false;
    });

    //Animacion Numero
    if ($(".pag-index")[0]){
    var waypoint = new Waypoint({
        element: document.getElementById('contador-parallax'),
        handler: function(direction) {
            //alert('Waypoint element id: ' + this.element.id);
            $('.resumen-evento li:nth-child(1) p').animateNumber({number: 4}, 1200);
            $('.resumen-evento li:nth-child(2) p').animateNumber({number: 15}, 1600);
            $('.resumen-evento li:nth-child(3) p').animateNumber({number: 3}, 1000);
            $('.resumen-evento li:nth-child(4) p').animateNumber({number: 9}, 1500);
        },
        offset: '25%'
      });
    }
    
    //Countdown
    $('.cuenta-regresiva').countdown('2021/05/05 09:00:00', function(e){
        $('#dias').html(e.strftime('%D'));
        $('#hora').html(e.strftime('%H'));
        $('#minut').html(e.strftime('%M'));
        $('#seg').html(e.strftime('%S'));
    });

    //Calendario effecto
    var cont1=0, cont2=0,cont3= 0;
    $('i.fas.fa-caret-up.cal-arrow:first').on('click', function(){
        var degrees= 180;
        cont1= cont1+1;
        $(this).parent().parent().children('.line-dia').slideToggle();
        if(cont1%2){ degrees = 180; } else { degrees = 0;}
        $(this).animate({  borderSpacing: degrees }, {
            step: function(now,fx) {
              $(this).css('-webkit-transform','rotate('+now+'deg)'); 
              $(this).css('-moz-transform','rotate('+now+'deg)');
              $(this).css('transform','rotate('+now+'deg)');
              $(this).css('transform-origin',' center');
            },
            duration:'.3s'
        },'linear');
    });

    $('i.fas.fa-caret-up.cal-arrow:nth(1)').on('click', function(){
        var degrees= 180;
        cont2= cont2+1;
        $(this).parent().parent().children('.line-dia').slideToggle();
        if(cont2%2){ degrees = 180; } else { degrees = 0;}
        $(this).animate({  borderSpacing: degrees }, {
            step: function(now,fx) {
              $(this).css('-webkit-transform','rotate('+now+'deg)'); 
              $(this).css('-moz-transform','rotate('+now+'deg)');
              $(this).css('transform','rotate('+now+'deg)');
            },
            duration:'.3s'
        },'linear');
    });

    $('i.fas.fa-caret-up.cal-arrow:last').on('click', function(){
        var degrees= 180;
        cont3= cont3+1;
        $(this).parent().parent().children('.line-dia').slideToggle();
        if(cont3%2){ degrees = 180; } else { degrees = 0;}
        $(this).animate({  borderSpacing: degrees }, {
            step: function(now,fx) {
              $(this).css('-webkit-transform','rotate('+now+'deg)'); 
              $(this).css('-moz-transform','rotate('+now+'deg)');
              $(this).css('transform','rotate('+now+'deg)');
            },
            duration:'.3s'
        },'linear');
    });

    //INVITADOS
    if ($(".pag-invitados")[0]){
        $('.invitado-info').colorbox({inline:true, width:"50%"});
    }

});