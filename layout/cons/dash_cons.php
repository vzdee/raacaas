<?php 

//CONSULTAS EN DASHBOARD.PHP
$sql = "SELECT 
u.IDUsuario, 
u.Nombre, 
u.Apellido, 
u.Correo, 
u.Telefono, 
u.FechaRegistro, 
e.RFC
FROM Usuario u
JOIN Empleado e ON u.IDUsuario = e.IDEmpleado;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$empleados) {
}

// Realizar la consulta SQL Servicios DASHBOARD.PHP
$sql = "SELECT 
    s.IDServicio,
    ts.NombreServicio AS TipoServicio,
    s.FechaInicio,
    s.FechaFinal,
    s.CostoEstimado,
    se.IDEmpleado,
    sc.IDCliente
FROM Servicio s
JOIN TipoServicio ts ON s.IDTipoServicio = ts.IDTipoServicio
JOIN Servicio_Empleado se ON s.IDServicio = se.IDServicio
JOIN Servicio_Cliente sc ON s.IDServicio = sc.IDServicio;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$servicios = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$servicios) {
}

//REALIZAR CONSULTA DE CLIENTES DASHBOARD.PHP
$sql = "SELECT 
u.IDUsuario, 
u.Nombre,
u.Apellido, 
u.Correo, 
u.Telefono,
u.FechaRegistro
FROM Usuario u
JOIN Cliente c ON u.IDUsuario = c.IDCliente;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$clientes) {
}

?>