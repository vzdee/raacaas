<?php
// Obtener el rol del usuario
$rol = $usuario["TipoUsuario"];

// Consulta de servicios según el rol del usuario
try {
    if ($rol == "Cliente") {
        $sqlServicios = "SELECT 
    s.IDServicio,
    u_cliente.Nombre AS NombreCliente,
    u_empleado.Nombre AS NombreEmpleado,
    ts.NombreServicio AS TipoServicio,
    s.CostoEstimado,
    s.FechaInicio,
    s.FechaFinal
    FROM servicio s
    JOIN servicio_cliente sc ON s.IDServicio = sc.IDServicio
    JOIN cliente c ON sc.IDCliente = c.IDCliente
    JOIN usuario u_cliente ON c.IDCliente = u_cliente.IDUsuario
    JOIN servicio_empleado se ON s.IDServicio = se.IDServicio
    JOIN empleado e ON se.IDEmpleado = e.IDEmpleado
    JOIN usuario u_empleado ON e.IDEmpleado = u_empleado.IDUsuario
    JOIN tiposervicio ts ON s.IDTipoServicio = ts.IDTipoServicio
    WHERE c.IDCliente = :idCuenta";
;
    } elseif ($rol == "Empleado") {
        $sqlServicios = "SELECT 
    s.IDServicio,
    u_cliente.Nombre AS NombreCliente,
    u_empleado.Nombre AS NombreEmpleado,
    ts.NombreServicio AS TipoServicio,
    s.CostoEstimado,
    s.FechaInicio,
    s.FechaFinal
    FROM servicio s
    JOIN servicio_cliente sc ON s.IDServicio = sc.IDServicio
    JOIN cliente c ON sc.IDCliente = c.IDCliente
    JOIN usuario u_cliente ON c.IDCliente = u_cliente.IDUsuario
    JOIN servicio_empleado se ON s.IDServicio = se.IDServicio
    JOIN empleado e ON se.IDEmpleado = e.IDEmpleado
    JOIN usuario u_empleado ON e.IDEmpleado = u_empleado.IDUsuario
    JOIN tiposervicio ts ON s.IDTipoServicio = ts.IDTipoServicio
    WHERE e.IDEmpleado = :idCuenta";


    } else { // Admin puede ver todos los servicios
        $sqlServicios = "SELECT 
    s.IDServicio,
    u_cliente.Nombre AS NombreCliente,
    c.IDCliente,
    u_empleado.Nombre AS NombreEmpleado,
    e.IDEmpleado,
    ts.NombreServicio AS TipoServicio,
    s.CostoEstimado,
    s.FechaInicio,
    s.FechaFinal
    FROM servicio s
    JOIN servicio_cliente sc ON s.IDServicio = sc.IDServicio
    JOIN cliente c ON sc.IDCliente = c.IDCliente
    JOIN usuario u_cliente ON c.IDCliente = u_cliente.IDUsuario
    JOIN servicio_empleado se ON s.IDServicio = se.IDServicio
    JOIN empleado e ON se.IDEmpleado = e.IDEmpleado
    JOIN usuario u_empleado ON e.IDEmpleado = u_empleado.IDUsuario
    JOIN tiposervicio ts ON s.IDTipoServicio = ts.IDTipoServicio";
    
    
    }

    $stmtServicios = $conn->prepare($sqlServicios);
    // Solo vincula el parámetro si el usuario NO es Admin
    if ($rol != "Admin") {
        $stmtServicios->bindParam(':idCuenta', $IDCuenta, PDO::PARAM_INT);
    }
    $stmtServicios->execute();
    $servicios = $stmtServicios->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Error al obtener los servicio: " . $e->getMessage());
}


?>