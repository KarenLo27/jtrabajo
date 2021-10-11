<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
<form method="POST" action="" name="frm1">
    <table>
    <tr>
    <td colspan="2">..::PRODUCTOS::..</td>
    </tr>
    <tr>
    <td>Fecha de ingreso:</td>
    <td><input type="text" name="txt1" required></td>
    </tr>
    <tr>
    <td>Cantidad del producto:</td>
    <td><input type="text" name="txt2" required></td>
    </tr>
    <tr>
    <td>Precio unitario:</td>
    <td><input type="text" name="txt3" required></td>
    </tr>
    <tr>
    <td>Fecha de vencimiento</td>
    <td><input type="text" name="txt4" required></td>
    </tr>
    <tr>
    <td>Proveedor</td>
  <td><input type="text" name="txt5" required></td>
            <?php
            try{
                $sql1="SELECT * FROM productos";
                $resultado = $base->prepare($sql1);
                $resultado->execute(array());
          while ($consulta = $resultado->fetch(PDO::FETCH_ASSOC)) {
            ?> 
            <option value="<?php echo $consulta['id_productos'];?>"><?php echo $consulta['fecha_ingreso'];?></option>
            <?php
             }  
            }catch(Exeption $e){
                die('ALERTA - se produjo un error al intentar consutar la BD...'.$e->getMessage());
            }
            ?>
    </td>
    </tr>
   <td colspan="2">
    <input type="submit" name="btn1" value="Registrar"></td>
    </tr>
    </table>
    </form>
    <?php
    if (isset($_POST['btn1'])) {
        $vfecha_ingreso = $_POST['txt1'];
        $vcantidad_producto = $_POST['txt2'];
        $vprecio_unitario= $_POST['txt3'];
        $vfecha_vencimiento = $_POST['txt4'];
        $vproveedor = $_POST['txt5'];
        echo " $vfecha_ingreso -$vcantidad_producto - $vprecio_unitario - $vfecha_vencimiento - $vproveedor";
        
        try{
            $sql= "INSERT INTO productos(`id_productos`, `fecha_ingreso`, `cantidad_producto`, `precio_unitario`, `fecha_vencimiento`, `proveedor`) VALUES
             ('',:fecha_ingre,:cantidad_produc,:precio_unitar,:fecha_vencimien,:proveed)";
            $resultado = $base->prepare($sql);
            $resultado->execute(array(":fecha_ingre"=>$vfecha_ingreso,":cantidad_produc"=>$vcantidad_producto, ":precio_unitar"=>$vprecio_unitario,
             ":fecha_vencimien"=>$vfecha_vencimiento, ":proveed"=>$vproveedor));
            ?>
            <script language="javascript">window.alert('El Producto se registro con exito!!!')</script>
            <?php
        }catch(Exception $e){
            die('Error de conexion:  '.$e->getmessage());
        }
    }
    ?>
</body>
</html>