<script src="<?=base_url()?>js/lib/listadoProductos.js"></script>

<table id="reporte">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Producto</th>
            <th scope="col">Costo</th>
            <th scope="col">Descripción</th>
            <th scope="col">Vendidos</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($productos as $producto) { ?>
            <tr>
                <th scope="row"><?=$producto->idproducto?></th>
                <th scope="row"><?=$producto->nombre?></th>
                <td scope="row">$<?=number_format($producto->precio,2,".",",")?></td>
                <td scope="row"><?=$producto->descripcion?></td>
                <td scope="row">8</td>
                <td scope="row">
                    <div style="width:80px;" class="ui-widget icon-collection">
                        <div class="ui-state-default ui-corner-all boton boton20">
                            <span class="ui-icon ui-icon-trash" onclick="eliminarProducto(<?=$producto->idproducto?>)">Eliminar</span>
                        </div>
                        <div class="ui-state-default ui-corner-all boton boton20">
                            <span class="ui-icon ui-icon-pencil" onclick="editarProducto(<?=$producto->idproducto?>)">Editar</span>
                        </div>
                    </div>
                </td>
            </tr>
        <? } ?>
    </tbody>
</table>