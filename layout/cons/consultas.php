<?php require("layout/config/db.php"); 

 // REALIZAR CONSULTA EMPLEADOS DASHBOARD.PHP
$sql = "SELECT 
    e.IDEmpleado, 
    e.RFC, 
    e.FechaRegistro, 
    c.Nombre,
    c.Correo,
    c.NumeroTel
FROM empleados e
INNER JOIN cuentas c ON c.IDCuenta = e.IDCuenta;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$empleados) {
}

// Realizar la consulta SQL Servicios DASHBOARD.PHP
$sql = "SELECT 
    s.IDServicio, 
    s.IDEmpleado, 
    s.IDCliente, 
    i.EstadoServicio, 
    i.CostoEstimado, 
    s.FechaInicial AS FechaInicio, 
    s.FechaFinal, 
    i.TipoServicio
FROM servicios s
INNER JOIN infoservicios i ON s.IDServicio = i.IDServicio;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$servicios) {
}

//REALIZAR CONSULTA DE CLIENTES DASHBOARD.PHP
$sql = "SELECT 
    cl.IDCliente,  
    cl.FechaRegistro, 
    cu.Nombre,
    cu.Correo,
    cu.NumeroTel
FROM clientes cl
INNER JOIN cuentas cu ON cu.IDCuenta = cl.IDCuenta;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$clientes) {
}

?>