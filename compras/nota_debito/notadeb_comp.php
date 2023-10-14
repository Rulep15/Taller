<?php
session_start();
require '../../conexion.php';
$idpedido = $_REQUEST['videbito'];
$compradetalle = consultas::get_datos("SELECT * FROM v_detalle_compras WHERE id_compra = $idpedido");
?>
<div id="detalles_fact" class="box-body no-padding">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <?php
        
        if (!empty($compradetalle)) {
            ?>
            <div class="table-responsive">
                <table class="table col-lg-12 col-md-12 col-xs-12 table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Producto</th>
                            <th class="text-center">Deposito</th>
                            <th class="text-center">Cantidad</th> 
                            <th class="text-center">Precio</th> 
                            <th class="text-center">subtotal</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compradetalle AS $dtc) { ?>
                            <tr>
                                <td class="text-center" id="prod"> <?php echo $dtc['pro_descri']; ?></td>
                                <td class="text-center" id="depo"> <?php echo $dtc['dep_descri']; ?></td>
                                <td class="text-center" id="canti"> <?php echo $dtc['cantidad']; ?></td>
                                <td class="text-center" id="precio"> <?php echo $dtc['precio_unit']; ?></td>
                                <td class="text-center" id="subtotal"> <?php echo $dtc['subtotal']; ?></td>
                           </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-danger flat">
                <span class="glyphicon glyphicon-info-sign"></span> La Nota de Debito no tiene detalles...
            </div>
        <?php } ?>
    </div>
</div>