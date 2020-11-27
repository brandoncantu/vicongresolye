<?php require_once('includes/templates/header.php') ?>

    <section class="seccion contenedor pag-registro">
        <h2>Registro de Usuarios</h2>
        <form id="registro" class="registro submit" action="pagar.php" method="post">
            <div id="datos_usuario" class="registro caja clearfix">
                <div class="campo form-group" id="campo-nombre">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" class="form-control"></input>
                    <span class="help-block" id="help-block-nombre"></span>
                </div>
                <!--CampoNombre-->
                <div class="campo form-group" id="campo-apellido">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" class="form-control"></input>
                    <span class="help-block" id="help-block-apellido"></span>
                </div>
                <!--CampoAombre-->
                <div class="campo form-group" id="campo-email">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" placeholder="Tu Email" class="form-control"></input>
                    <span class="help-block" id="help-block-email" ></span>
                </div>
                <!--Campoemail-->
            </div>
            <!--DatosUsuario-->

            <div id="paquetes" class="paquetes">
                <h3>ELige los boletos</h3>
                <ul class="lista-precios clearfix">
                    <li>
                        <div class="tabla-precio">
                            <h3>Pase por día</h3>
                            <p class="numero">$30</p>
                            <ul>
                                <li><i class="fa fa-check"></i>Bocadillos gratis</li>
                                <li><i class="fa fa-check"></i>Todas las Conferencias</li>
                                <li><i class="fa fa-check"></i>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_dia">Boletos Deseados:</label>
                                <input type="number" class="form-control" name="boletos[un_dia][cantidad]" id="pase_dia" size="3" min="0" placeholder="0">
                                <input type="hidden" value="30" name="boletos[un_dia][precio]">
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="tabla-precio">
                            <h3>Todos los Dias</h3>
                            <p class="numero">$50</p>
                            <ul>
                                <li><i class="fa fa-check"></i>Bocadillos gratis</li>
                                <li><i class="fa fa-check"></i>Todas las Conferencias</li>
                                <li><i class="fa fa-check"></i>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_todo">Boletos Deseados:</label>
                                <input type="number" class="form-control" name="boletos[completo][cantidad]" id="pase_todo" size="3" min="0" placeholder="0">
                                <input type="hidden" value="50" name="boletos[completo][precio]">
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="tabla-precio">
                            <h3>Pase por 2 Dias</h3>
                            <p class="numero">$45</p>
                            <ul>
                                <li><i class="fa fa-check"></i>Bocadillos gratis</li>
                                <li><i class="fa fa-check"></i>Todas las Conferencias</li>
                                <li><i class="fa fa-check"></i>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_dos">Boletos Deseados:</label>
                                <input type="number" class="form-control" name="boletos[dos_dias][cantidad]" id="pase_dos" size="3" min="0" placeholder="0">
                                <input type="hidden" value="45" name="boletos[dos_dias][precio]">
                            </div>
                        </div>
                    </li>
                </ul>
                <!--lista precios-->
            </div>
            <div id="eventos" class="eventos clearfix">
                <h3>Elige tus talleres</h3>
                <div class="caja">
                    <div id="viernes" class="contenido-dia clearfix">
                        <h4>Viernes</h4>                       
                            <?php
                            require 'includes/templates/funciones/funciones.php';
                            getEventos('2021-05-05');
                            ?>
                    </div>
                    <!--#viernes-->
                    <div id="sabado" class="contenido-dia clearfix">
                    <h4>Sabado</h4>                       
                            <?php
                            getEventos('2021-05-06');
                            ?>
                    </div>
                    <!--#sabado-->
                    <div id="domingo" class="contenido-dia clearfix">
                    <h4>Domingo</h4>                       
                            <?php
                            getEventos('2021-05-07');
                            ?>
                    </div>
                    <!--#domingo-->
                </div>
                <!--.caja-->
            </div>
            <!--#eventos-->
            <div id="resumen" class="resumen">
                <h2>Pago y Extras</h2>
                <div class="caja clearfix">
                    <div class="extras">
                        <div class="orden">
                            <label for="camisa_evento">Camisa del Evento $10 <small>(7% off)</small></label>
                            <input type="number" class="form-control" name="pedido_extra[camisas][cantidad]" min="0" id="camisa_evento" size="3" placeholder="0">
                            <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                        </div><!--orden-->
                        <div class="orden">
                            <label for="etiquetas">Stickers paquete de 5 $2 <small>(CSS, HTML5, CHROME, JS...)</small></label>
                            <input type="number" class="form-control" name="pedido_extra[sticker][cantidad]" min="0" id="etiquetas" size="3" placeholder="0">
                            <input type="hidden" value="2" name="pedido_extra[sticker][precio]">
                        </div><!--orden-->
                        <div class="orden">
                            <label for="regalo">Regalo:</label>
                            <select id="regalo" name="regalo" class="form-control" required>
                                <option value="">Seleccione un regalo</option>
                                <option value="1">Sticker</option>
                                <option value="2">Pulsera</option>
                                <option value="3">Pluma</option>
                            </select>
                        </div><!--orden-->
                        <input type="button" id="calcular" class="button" value="Calcular">
                    </div><!--extras-->

                    <div class="total">
                        <p>Resumen</p>
                        <div id="lista-productos">

                        </div><!--lista-prod-->
                        <p>Total:</p>
                        <div id="suma-total">

                        </div><!--suma-total-->
                        <input type="hidden" name="total_pedido" id="total_pedido" >
                        <input type="submit" name="submit" id="btnRegistro" class="button" value="Pagar">
                    </div><!--total-->
                </div><!--caja-->
            </div><!--resumen-->
        </form>
    </section>

    <?php require_once('includes/templates/footer.php') ?>
