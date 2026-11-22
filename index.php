<?php
include 'conexion.php';

$mensaje_exito = "";

// -------------------------------------------------------------
// 1. ACCIONES DE CREAR (INSERT) Y ACTUALIZAR (UPDATE)
// -------------------------------------------------------------
if (isset($_POST['guardar_chef'])) {
    $nombre = $_POST['nombre']; $bio = $_POST['bio'];
    $stmt = $conexion->prepare("INSERT INTO chefs (nombre, bio) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre, $bio); $stmt->execute(); $stmt->close();
    $mensaje_exito = "¡Chef registrado con éxito!";
}
if (isset($_POST['guardar_promo'])) {
    $titulo = $_POST['titulo']; $tag = $_POST['tag']; $precio = $_POST['precio']; $imagen = $_POST['imagen']; $desc = $_POST['desc'];
    $stmt = $conexion->prepare("INSERT INTO promos (titulo, tag, precio, imagen, descripcion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $titulo, $tag, $precio, $imagen, $desc); $stmt->execute(); $stmt->close();
    $mensaje_exito = "¡Promoción guardada con éxito!";
}
if (isset($_POST['guardar_opinion'])) {
    $cliente = $_POST['cliente']; $comentario = $_POST['comentario'];
    $stmt = $conexion->prepare("INSERT INTO opiniones (cliente, comentario) VALUES (?, ?)");
    $stmt->bind_param("ss", $cliente, $comentario); $stmt->execute(); $stmt->close();
    $mensaje_exito = "¡Opinión agregada con éxito!";
}
if (isset($_POST['guardar_especial'])) {
    $nombre = $_POST['nombre']; $precio = $_POST['precio']; $imagen = $_POST['imagen']; $desc = $_POST['desc'];
    $stmt = $conexion->prepare("INSERT INTO especiales (nombre, precio, imagen, descripcion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $nombre, $precio, $imagen, $desc); $stmt->execute(); $stmt->close();
    $mensaje_exito = "¡Especial guardado con éxito!";
}
if (isset($_POST['guardar_sucursal'])) {
    $nombre = $_POST['nombre']; $info = $_POST['info'];
    $stmt = $conexion->prepare("INSERT INTO sucursales (nombre, info) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre, $info); $stmt->execute(); $stmt->close();
    $mensaje_exito = "¡Sucursal registrada con éxito!";
}
if (isset($_POST['guardar_contacto'])) {
    $canal = $_POST['canal']; $info = $_POST['info'];
    $stmt = $conexion->prepare("INSERT INTO contacto (canal, info) VALUES (?, ?)");
    $stmt->bind_param("ss", $canal, $info); $stmt->execute(); $stmt->close();
    $mensaje_exito = "¡Canal de contacto agregado con éxito!";
}
if (isset($_POST['hacer_reserva'])) {
    $mesa = $_POST['mesa']; $nombre = $_POST['nombre']; $personas = $_POST['personas']; $fecha = $_POST['fecha'];
    $stmt = $conexion->prepare("INSERT INTO reservas (mesa, nombre, personas, fecha_hora) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $mesa, $nombre, $personas, $fecha); $stmt->execute(); $stmt->close();
    $mensaje_exito = "¡Reserva confirmada con éxito!";
}
if (isset($_POST['enviar_cuestionario'])) {
    $p1 = $_POST['p1']; $p2 = $_POST['p2']; $p3 = $_POST['p3']; $p4 = $_POST['p4']; $p5 = $_POST['p5'];
    $p6 = $_POST['p6']; $p7 = $_POST['p7']; $p8 = $_POST['p8']; $p9 = $_POST['p9']; $p10 = $_POST['p10'];
    $stmt = $conexion->prepare("INSERT INTO cuestionario_respuestas (p1, p2, p3, p4, p5, p6, p7, p8, p9, p10) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiiiiiiiii", $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10); $stmt->execute(); $stmt->close();
    $mensaje_exito = "¡Cuestionario guardado con éxito!";
}
if (isset($_POST['realizar_pedido'])) {
    $mesa = $_POST['mesa']; $metodo_pago = $_POST['metodo_pago']; $total = $_POST['total']; $folio = 'ORD-' . rand(1000, 9999);
    $stmt = $conexion->prepare("INSERT INTO pedidos (folio, mesa, metodo_pago, total, estado) VALUES (?, ?, ?, ?, 'En Proceso')");
    $stmt->bind_param("sssd", $folio, $mesa, $metodo_pago, $total); $stmt->execute(); $stmt->close();
    $mensaje_exito = "¡Pedido registrado con éxito! Folio: " . $folio;
}

// Cambiar estado del pedido desde cocina
if (isset($_GET['cambiar_estado']) && isset($_GET['id'])) {
    $id_pedido = $_GET['id'];
    $nuevo_estado = $_GET['cambiar_estado'];
    $stmt = $conexion->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $nuevo_estado, $id_pedido);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

// -------------------------------------------------------------
// 2. ACCIONES DE ELIMINAR (DELETE)
// -------------------------------------------------------------
if (isset($_GET['eliminar_chef'])) { $id = $_GET['eliminar_chef']; $conexion->query("DELETE FROM chefs WHERE id = $id"); header("Location: index.php"); exit(); }
if (isset($_GET['eliminar_promo'])) { $id = $_GET['eliminar_promo']; $conexion->query("DELETE FROM promos WHERE id = $id"); header("Location: index.php"); exit(); }
if (isset($_GET['eliminar_opinion'])) { $id = $_GET['eliminar_opinion']; $conexion->query("DELETE FROM opiniones WHERE id = $id"); header("Location: index.php"); exit(); }
if (isset($_GET['eliminar_especial'])) { $id = $_GET['eliminar_especial']; $conexion->query("DELETE FROM especiales WHERE id = $id"); header("Location: index.php"); exit(); }
if (isset($_GET['eliminar_sucursal'])) { $id = $_GET['eliminar_sucursal']; $conexion->query("DELETE FROM sucursales WHERE id = $id"); header("Location: index.php"); exit(); }
if (isset($_GET['eliminar_contacto'])) { $id = $_GET['eliminar_contacto']; $conexion->query("DELETE FROM contacto WHERE id = $id"); header("Location: index.php"); exit(); }
if (isset($_GET['eliminar_reserva'])) { $id = $_GET['eliminar_reserva']; $conexion->query("DELETE FROM reservas WHERE id = $id"); header("Location: index.php"); exit(); }

// -------------------------------------------------------------
// 3. CONSULTAS EN TIEMPO REAL (SELECT)
// -------------------------------------------------------------
$resultado_menu = $conexion->query("SELECT * FROM menu");
$resultado_chefs = $conexion->query("SELECT * FROM chefs");
$resultado_promos = $conexion->query("SELECT * FROM promos");
$resultado_opiniones = $conexion->query("SELECT * FROM opiniones");
$resultado_especiales = $conexion->query("SELECT * FROM especiales");
$resultado_sucursales = $conexion->query("SELECT * FROM sucursales");
$resultado_contacto = $conexion->query("SELECT * FROM contacto");
$resultado_reservas = $conexion->query("SELECT * FROM reservas ORDER BY id DESC");
$resultado_pedidos = $conexion->query("SELECT * FROM pedidos ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor Ofertin | Sistema y Restaurante</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        wine: { DEFAULT: '#991b1b', hover: '#7f1d1d', light: '#fef2f2' },
                        eco: { DEFAULT: '#15803d', light: '#f0fdf4' }
                    }
                }
            }
        }
    </script>
    <style>
        .vista-seccion { display: none; }
        .vista-seccion.active { display: block; }
        header {
            background-color: #991b1b;
            border-bottom: 4px solid #7f1d1d;
            padding: 24px 32px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            box-shadow: 0 4px 20px rgba(153, 27, 27, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header-top { display: flex; align-items: center; }
        .logo-container { display: flex; align-items: center; gap: 14px; }
        .logo-img { width: 55px; height: 55px; border-radius: 50%; object-fit: cover; border: 2px solid #ffffff; box-shadow: 0 3px 8px rgba(0,0,0,0.2); }
        .logo-text { font-size: 1.8rem; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; }
        .nav-tabs-row { display: flex; gap: 10px; overflow-x: auto; width: 100%; padding-bottom: 6px; scrollbar-width: thin; scrollbar-color: rgba(255, 255, 255, 0.4) transparent; }
        .nav-tabs-row::-webkit-scrollbar { height: 6px; }
        .nav-tabs-row::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.4); border-radius: 4px; }
        .tab-btn {
            background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.3); color: #ffffff;
            padding: 10px 18px; border-radius: 8px; cursor: pointer; font-weight: 700; font-size: 0.9rem; white-space: nowrap; transition: all 0.2s ease;
        }
        .tab-btn.active, .tab-btn:hover { background-color: #ffffff; color: #991b1b; border-color: #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
    </style>
</head>
<body class="h-full flex flex-col text-slate-800 bg-slate-50">

    <?php if (!empty($mensaje_exito)): ?>
    <div class="bg-emerald-600 text-white text-center py-3 px-4 font-bold text-sm z-50 shadow-md">
        <?= $mensaje_exito ?>
    </div>
    <?php endif; ?>

    <!-- ENCABEZADO EXPANDIDO EN DOS NIVELES -->
    <header>
        <div class="header-top">
            <div class="logo-container">
                <img src="logo.png" alt="Logo Sabor Ofertin" class="logo-img" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100'">
                <div>
                    <span class="logo-text">Sabor Ofertin</span>
                    <span class="text-[10px] font-semibold text-red-200 tracking-widest block uppercase">Sistema de Restaurante & POS Conectado a Cloud</span>
                </div>
            </div>
        </div>
        
        <div class="nav-tabs-row">
            <button class="tab-btn active" onclick="cambiarVista('menu', event)">🍽️ Menú & POS</button>
            <button class="tab-btn" onclick="cambiarVista('cocina', event)">👨‍🍳 Cocina</button>
            <button class="tab-btn" onclick="cambiarVista('promos', event)">🎉 Promos</button>
            <button class="tab-btn" onclick="cambiarVista('reservas', event)">📅 Reservas</button>
            <button class="tab-btn" onclick="cambiarVista('especiales', event)">⭐ Especiales</button>
            <button class="tab-btn" onclick="cambiarVista('chefs', event)">👨‍🍳 Chefs</button>
            <button class="tab-btn" onclick="cambiarVista('opiniones', event)">🏆 Opiniones</button>
            <button class="tab-btn" onclick="cambiarVista('sucursales', event)">📍 Sucursales</button>
            <button class="tab-btn" onclick="cambiarVista('contacto', event)">📞 Contacto</button>
            <button class="tab-btn" onclick="cambiarVista('cuestionario', event)">📊 Cuestionario</button>
            <button class="tab-btn" onclick="cambiarVista('sustentabilidad', event)">🌱 Sustentabilidad</button>
            <button class="tab-btn" onclick="cambiarVista('seccion', event)">📖 Sección & Multimedia</button>
        </div>
    </header>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="flex-grow max-w-7xl mx-auto px-4 py-8 w-full">
        
        <!-- 1. MENÚ & POS -->
        <section id="vista-menu" class="vista-seccion active bg-white rounded-2xl shadow-sm border border-slate-200 p-6 relative" style="overflow: visible !important;">
            
            <!-- MASCOTA EN EL ÁREA AMARILLA (SE MUEVE CON EL SCROLL) -->
            <div class="hidden xl:block" style="position: absolute; bottom: 30px; right: -220px; z-index: 10; pointer-events: none;">
                <img src="mascota.png" alt="Mascota Sabor Ofertin" onerror="this.src='logo.png'" style="width: 170px; height: auto; object-fit: contain; mix-blend-mode: multiply;">
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <!-- CABECERA DEL CATÁLOGO CON EL MENÚ DESPLEGABLE -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                        <h2 class="text-xl font-extrabold text-slate-900">Catálogo de Platillos</h2>
                        <select id="filtroCategoria" onchange="filtrarPlatillos()" class="px-3 py-1.5 border rounded-xl text-xs font-bold bg-slate-50 text-slate-700 shadow-sm">
                            <option value="todos">📂 Todas las Categorías</option>
                            <option value="bebida">🥤 Bebidas</option>
                            <option value="rapida">🍔 Comida Rápida</option>
                            <option value="platillo">🍲 Platillos / Ensaladas</option>
                            <option value="postre">🍰 Postres</option>
                        </select>
                    </div>

                    <div id="contenedorPlatillos" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-[600px] overflow-y-auto p-2">
                        <?php if ($resultado_menu && $resultado_menu->num_rows > 0): ?>
                            <?php while($row = $resultado_menu->fetch_assoc()): 
                                // Detectamos la categoría de la BD (si no existe, toma 'platillo' por defecto)
                                $cat_db = isset($row['categoria']) ? strtolower($row['categoria']) : 'platillo';
                            ?>
                            <div class="platillo-card border rounded-xl overflow-hidden shadow-sm bg-white flex flex-col justify-between" data-categoria="<?= $cat_db ?>">
                                <img src="<?= $row['imagen'] ?>" class="w-full h-28 object-cover" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400'">
                                <div class="p-3">
                                    <h3 class="font-bold text-xs text-slate-800"><?= $row['nombre'] ?></h3>
                                    <span class="text-wine font-extrabold text-sm block mt-1">$<?= number_format($row['precio'], 2) ?></span>
                                </div>
                                <button type="button" onclick="agregarAlCarrito('<?= addslashes($row['nombre']) ?>', <?= $row['precio'] ?>)" class="bg-wine text-white text-[10px] font-bold py-1.5 w-full hover:bg-wine-hover transition">+ Agregar</button>
                            </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="text-slate-500 italic col-span-full">No hay platillos registrados.</p>
                        <?php endif; ?>
                    </div>
                    <!-- Mensaje si no hay resultados en el filtro -->
                    <p id="sinResultados" class="text-slate-400 italic text-xs mt-4 hidden">No hay platillos en esta categoría o la base de datos no tiene asignada dicha categoría.</p>
                </div>

                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
                    <form method="POST" id="formPedido">
                        <h3 class="text-lg font-bold text-slate-900 mb-4 border-b pb-2">Tu Pedido Actual</h3>
                        
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-slate-600 mb-1">Mesa Asignada</label>
                            <select name="mesa" class="w-full px-3 py-2 border rounded-xl text-xs bg-white font-semibold">
                                <option value="Mesa 1 (Ventana)">Mesa 1 (Ventana)</option>
                                <option value="Mesa 2 (Centro)">Mesa 2 (Centro)</option>
                                <option value="Mesa 3 (Centro)">Mesa 3 (Centro)</option>
                                <option value="Mesa 4 (Terraza)">Mesa 4 (Terraza)</option>
                                <option value="Mesa 5 (Terraza)">Mesa 5 (Terraza)</option>
                                <option value="Mesa VIP">Mesa VIP</option>
                                <option value="Para Llevar">📦 Para Llevar</option>
                            </select>
                        </div>

                        <div id="listaCarrito" class="min-h-[120px] max-h-[180px] overflow-y-auto mb-4 border-b pb-2 text-xs text-slate-500 italic">
                            No hay platillos seleccionados.
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-slate-600 mb-1">Método de Pago</label>
                            <select name="metodo_pago" class="w-full px-3 py-2 border rounded-xl text-xs bg-white font-semibold">
                                <option value="Efectivo">💵 Efectivo</option>
                                <option value="Tarjeta de Crédito/Débito">💳 Tarjeta de Crédito / Débito</option>
                                <option value="Transferencia Bancaria">📱 Transferencia (SPEI)</option>
                            </select>
                        </div>

                        <input type="hidden" name="total" id="inputTotal" value="0">
                        
                        <div class="flex justify-between items-center text-base font-extrabold mb-4 border-t pt-3">
                            <span>Total:</span>
                            <span id="txtTotal" class="text-wine">$0.00</span>
                        </div>

                        <button type="submit" name="realizar_pedido" class="w-full bg-wine hover:bg-wine-hover text-white font-bold py-3 rounded-xl text-xs shadow-md transition">
                            Pagar y enviar a cocina
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- 2. COCINA -->
        <section id="vista-cocina" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">👨‍🍳 Monitor de Cocina (Control de Estados en Base de Datos)</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if ($resultado_pedidos && $resultado_pedidos->num_rows > 0): ?>
                    <?php while($row = $resultado_pedidos->fetch_assoc()): ?>
                    <div class="border-l-4 <?= $row['estado'] == 'Completado' ? 'border-emerald-600 bg-emerald-50/30' : 'border-orange-500 bg-slate-50' ?> p-5 rounded-xl shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <strong class="text-sm">Folio: <?= $row['folio'] ?></strong>
                                <span class="<?= $row['estado'] == 'Completado' ? 'bg-emerald-100 text-emerald-800' : 'bg-orange-100 text-orange-800' ?> text-[10px] font-bold px-2.5 py-0.5 rounded uppercase">
                                    <?= $row['estado'] ?>
                                </span>
                            </div>
                            <p class="text-xs text-slate-600">Mesa: <strong><?= $row['mesa'] ?></strong></p>
                            <p class="text-xs text-slate-600">Pago: <strong><?= $row['metodo_pago'] ?></strong></p>
                            <span class="text-wine font-extrabold text-sm block mt-3">Total: $<?= number_format($row['total'], 2) ?></span>
                        </div>
                        
                        <div class="mt-4 pt-3 border-t flex gap-2">
                            <?php if ($row['estado'] != 'Completado'): ?>
                                <a href="index.php?cambiar_estado=Completado&id=<?= $row['id'] ?>" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white text-center py-1.5 rounded-lg text-[11px] font-bold transition">
                                    ✅ Marcar Completado
                                </a>
                            <?php else: ?>
                                <a href="index.php?cambiar_estado=En Proceso&id=<?= $row['id'] ?>" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-center py-1.5 rounded-lg text-[11px] font-bold transition">
                                    🔄 Regresar a Proceso
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-slate-500 italic col-span-full">No hay pedidos registrados en la cocina.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- 3. PROMOS -->
        <section id="vista-promos" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">🎉 Promociones (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="titulo" placeholder="Título" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="text" name="tag" placeholder="Etiqueta (Ej. 2x1)" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="number" step="0.01" name="precio" placeholder="Precio ($)" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="text" name="imagen" placeholder="URL Imagen" required class="px-4 py-2 border rounded-xl text-xs md:col-span-3">
                <textarea name="desc" placeholder="Descripción" rows="2" required class="px-4 py-2 border rounded-xl text-xs md:col-span-3"></textarea>
                <button type="submit" name="guardar_promo" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Guardar Promoción</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php while($row = $resultado_promos->fetch_assoc()): ?>
                <div class="border rounded-xl overflow-hidden shadow-sm relative bg-white flex flex-col justify-between">
                    <a href="index.php?eliminar_promo=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2 py-1 rounded-lg text-xs font-bold z-10">🗑️</a>
                    <img src="<?= $row['imagen'] ?>" class="w-full h-40 object-cover" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500'">
                    <div class="p-6">
                        <h3 class="font-bold text-base"><?= $row['titulo'] ?></h3>
                        <p class="text-xs text-slate-500 mt-1"><?= $row['descripcion'] ?></p>
                        <span class="text-wine font-extrabold text-base block mt-4">$<?= number_format($row['precio'], 2) ?></span>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 4. RESERVAS -->
        <section id="vista-reservas" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">📅 Gestión y Reserva de Mesas (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-xs font-bold text-slate-600 uppercase mb-1">Mesa</label><input type="text" name="mesa" placeholder="Ej. Mesa 1" required class="w-full px-4 py-2 border rounded-xl text-xs"></div>
                <div><label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nombre Completo</label><input type="text" name="nombre" placeholder="Ej. Carlos Mendoza" required class="w-full px-4 py-2 border rounded-xl text-xs"></div>
                <div><label class="block text-xs font-bold text-slate-600 uppercase mb-1">Número de Personas</label><input type="number" name="personas" value="2" required class="w-full px-4 py-2 border rounded-xl text-xs"></div>
                <div><label class="block text-xs font-bold text-slate-600 uppercase mb-1">Fecha y Hora</label><input type="datetime-local" name="fecha" required class="w-full px-4 py-2 border rounded-xl text-xs"></div>
                <div class="md:col-span-2"><button type="submit" name="hacer_reserva" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow">Confirmar Reserva</button></div>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php while($row = $resultado_reservas->fetch_assoc()): ?>
                <div class="border p-4 rounded-xl shadow-sm relative bg-white">
                    <a href="index.php?eliminar_reserva=<?= $row['id'] ?>" onclick="return confirm('¿Cancelar?')" class="absolute top-3 right-3 bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">🗑️</a>
                    <h4 class="font-bold text-sm text-slate-900"><?= $row['mesa'] ?></h4>
                    <p class="text-xs text-slate-600 mt-1">A nombre de: <strong><?= $row['nombre'] ?></strong></p>
                    <p class="text-xs text-slate-600">Personas: <?= $row['personas'] ?></p>
                    <p class="text-xs text-slate-400 mt-2">Fecha: <?= $row['fecha_hora'] ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 5. ESPECIALES -->
        <section id="vista-especiales" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">⭐ Platillos Especiales (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="nombre" placeholder="Nombre" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="number" step="0.01" name="precio" placeholder="Precio ($)" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="text" name="imagen" placeholder="URL Imagen" required class="px-4 py-2 border rounded-xl text-xs md:col-span-2">
                <textarea name="desc" placeholder="Descripción" rows="2" required class="px-4 py-2 border rounded-xl text-xs md:col-span-2"></textarea>
                <button type="submit" name="guardar_especial" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Dar de Alta Especial</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php while($row = $resultado_especiales->fetch_assoc()): ?>
                <div class="border rounded-xl overflow-hidden shadow-sm relative bg-white flex flex-col justify-between">
                    <a href="index.php?eliminar_especial=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2 py-1 rounded-lg text-xs font-bold z-10">🗑️</a>
                    <img src="<?= $row['imagen'] ?>" class="w-full h-40 object-cover" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500'">
                    <div class="p-6">
                        <h3 class="font-bold text-base"><?= $row['nombre'] ?></h3>
                        <p class="text-xs text-slate-500 mt-1"><?= $row['descripcion'] ?></p>
                        <span class="text-wine font-extrabold text-base block mt-4">$<?= number_format($row['precio'], 2) ?></span>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 6. CHEFS -->
        <section id="vista-chefs" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">👨‍🍳 Chefs (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="nombre" placeholder="Nombre" required class="px-4 py-2 border rounded-xl text-xs">
                <textarea name="bio" rows="2" placeholder="Biografía" required class="px-4 py-2 border rounded-xl text-xs md:col-span-2"></textarea>
                <button type="submit" name="guardar_chef" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Guardar Chef</button>
            </form>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php while($row = $resultado_chefs->fetch_assoc()): ?>
                <div class="border rounded-xl p-6 shadow-sm relative bg-white">
                    <a href="index.php?eliminar_chef=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2.5 py-1 rounded-lg text-xs font-bold">🗑️</a>
                    <h3 class="font-bold text-base text-slate-900 mb-2"><?= $row['nombre'] ?></h3>
                    <p class="text-slate-600 text-xs"><?= $row['bio'] ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 7. OPINIONES -->
        <section id="vista-opiniones" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">🏆 Opiniones (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 gap-4">
                <input type="text" name="cliente" placeholder="Cliente" required class="px-4 py-2 border rounded-xl text-xs">
                <textarea name="comentario" placeholder="Comentario" rows="2" required class="px-4 py-2 border rounded-xl text-xs"></textarea>
                <button type="submit" name="guardar_opinion" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Agregar</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php while($row = $resultado_opiniones->fetch_assoc()): ?>
                <div class="border rounded-xl p-6 relative bg-white">
                    <a href="index.php?eliminar_opinion=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2 py-1 rounded-lg text-xs font-bold">🗑️</a>
                    <p class="text-xs text-slate-700 mb-4"><?= $row['comentario'] ?></p>
                    <span class="text-wine font-bold text-xs">- <?= $row['cliente'] ?></span>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 8. SUCURSALES -->
        <section id="vista-sucursales" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">📍 Sucursales (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 gap-4">
                <input type="text" name="nombre" placeholder="Sucursal" required class="px-4 py-2 border rounded-xl text-xs">
                <textarea name="info" placeholder="Info" rows="2" required class="px-4 py-2 border rounded-xl text-xs"></textarea>
                <button type="submit" name="guardar_sucursal" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Agregar</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php while($row = $resultado_sucursales->fetch_assoc()): ?>
                <div class="border rounded-xl p-6 relative bg-white">
                    <a href="index.php?eliminar_sucursal=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2 py-1 rounded-lg text-xs font-bold">🗑️</a>
                    <h3 class="font-bold text-base text-slate-900 mb-2"><?= $row['nombre'] ?></h3>
                    <p class="text-slate-600 text-xs"><?= $row['info'] ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 9. CONTACTO -->
        <section id="vista-contacto" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">📞 Contacto (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 gap-4">
                <input type="text" name="canal" placeholder="Canal" required class="px-4 py-2 border rounded-xl text-xs">
                <textarea name="info" placeholder="Detalle" rows="2" required class="px-4 py-2 border rounded-xl text-xs"></textarea>
                <button type="submit" name="guardar_contacto" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Agregar</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php while($row = $resultado_contacto->fetch_assoc()): ?>
                <div class="border rounded-xl p-6 relative bg-white">
                    <a href="index.php?eliminar_contacto=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2.5 py-1 rounded-lg text-xs font-bold">🗑️</a>
                    <h3 class="font-bold text-base text-slate-900 mb-2"><?= $row['canal'] ?></h3>
                    <p class="text-slate-600 text-xs"><?= $row['info'] ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 10. CUESTIONARIO -->
        <section id="vista-cuestionario" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">📊 Cuestionario de Satisfacción</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border flex flex-col gap-4">
                <?php for($i=1; $i<=10; $i++): ?>
                <div class="border-b pb-3">
                    <label class="block text-xs font-bold text-slate-700 mb-2"><?= $i ?>. ¿Cómo califica este aspecto de nuestro servicio (1 al 5)?</label>
                    <div class="flex gap-4 text-xs font-semibold">
                        <?php for($j=1; $j<=5; $j++): ?>
                        <label><input type="radio" name="p<?= $i ?>" value="<?= $j ?>" <?= $j==5?'checked':'' ?>> <?= $j ?></label>
                        <?php endfor; ?>
                    </div>
                </div>
                <?php endfor; ?>
                <button type="submit" name="enviar_cuestionario" class="bg-wine text-white font-bold px-6 py-2.5 rounded-xl text-xs shadow w-max">Enviar Cuestionario a DB</button>
            </form>
        </section>

        <!-- 11. SUSTENTABILIDAD -->
        <section id="vista-sustentabilidad" class="vista-seccion bg-gradient-to-br from-emerald-900 to-emerald-950 text-white rounded-2xl p-8 shadow-lg">
            <h2 class="text-2xl font-black mb-3">🌱 Compromiso de Sustentabilidad Sabor Ofertin</h2>
            <p class="text-emerald-100 text-xs md:text-sm max-w-3xl leading-relaxed">
                Operamos bajo estrictos estándares ecológicos: empaques 100% compostables de bagazo de caña, adquisición de insumos locales a menos de 60 km y transformación de aceite vegetal usado en biocombustible certificado.
            </p>
        </section>

        <!-- 12. SECCIÓN Y MULTIMEDIA -->
        <section id="vista-seccion" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-4">📖 Sección y Multimedia</h2>
            <p class="text-xs text-slate-500 mb-6">Selecciona una opción del menú desplegable para consultar nuestra filosofía institucional o contenido multimedia.</p>
            
            <div class="mb-6">
                <select id="seccionDropdown" onchange="mostrarSeccionSeleccionada(this.value)" class="px-4 py-2 border rounded-xl text-xs font-bold bg-slate-50 w-full max-w-sm">
                    <option value="">-- Selecciona una opción --</option>
                    <option value="mision">🎯 Nuestra Misión</option>
                    <option value="vision">🔭 Nuestra Visión</option>
                    <option value="multimedia">🎬 Contenido Multimedia (Video y Audio)</option>
                </select>
            </div>

            <div id="resultadoTextoSeccion" class="hidden p-6 bg-slate-50 border rounded-xl">
                <h3 id="tituloSeccionDinamica" class="text-base font-bold text-wine mb-3"></h3>
                <p id="textoSeccionDinamica" class="text-xs text-slate-700 leading-relaxed whitespace-pre-line"></p>
            </div>

            <div id="resultadoMultimedia" class="hidden grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div class="border p-4 rounded-xl">
                    <h3 class="font-bold text-sm mb-2">Video Institucional</h3>
                    <video controls class="w-full rounded-lg"><source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4"></video>
                </div>
                <div class="border p-4 rounded-xl">
                    <h3 class="font-bold text-sm mb-2">Audio Ambiental</h3>
                    <audio controls class="w-full mt-10"><source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg"></audio>
                </div>
            </div>
        </section>

    </main>

    <!-- Pie de página -->
    <footer class="bg-wine text-white py-6 border-t-4 border-red-900 mt-auto text-center text-xs">
        <p>&copy; 2026 Sabor Ofertin. Conectado a MySQL en Cloud.</p>
    </footer>

    <script>
        let carrito = {};

        function agregarAlCarrito(nombre, precio) {
            if (!carrito[nombre]) {
                carrito[nombre] = { precio: precio, cantidad: 0 };
            }
            carrito[nombre].cantidad += 1;
            actualizarPanelPOS();
        }

        function disminuirDelCarrito(nombre) {
            if (carrito[nombre]) {
                carrito[nombre].cantidad -= 1;
                if (carrito[nombre].cantidad <= 0) {
                    delete carrito[nombre];
                }
            }
            actualizarPanelPOS();
        }

        function eliminarDelCarrito(nombre) {
            if (carrito[nombre]) {
                delete carrito[nombre];
            }
            actualizarPanelPOS();
        }

        function actualizarPanelPOS() {
            const container = document.getElementById('listaCarrito');
            const keys = Object.keys(carrito);
            if (keys.length === 0) {
                container.innerHTML = "No hay platillos seleccionados.";
                document.getElementById('txtTotal').innerText = "$0.00";
                document.getElementById('inputTotal').value = 0;
                return;
            }

            let html = '';
            let total = 0;
            keys.forEach(nombre => {
                let item = carrito[nombre];
                let sub = item.precio * item.cantidad;
                total += sub;
                html += `
                    <div class="flex justify-between items-center mb-2 text-xs border-b pb-1">
                        <div>
                            <span class="font-bold">${item.cantidad}x ${nombre}</span>
                            <span class="text-wine font-semibold block">$${sub.toFixed(2)}</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <button type="button" onclick="disminuirDelCarrito('${nombre.replace(/'/g, "\\'")}')" class="bg-slate-200 hover:bg-slate-300 px-1.5 py-0.5 rounded font-bold text-[10px]" title="Quitar uno">-</button>
                            <button type="button" onclick="eliminarDelCarrito('${nombre.replace(/'/g, "\\'")}')" class="bg-red-100 hover:bg-red-200 text-red-700 px-1.5 py-0.5 rounded font-bold text-[10px]" title="Eliminar platillo">🗑️</button>
                        </div>
                    </div>`;
            });
            container.innerHTML = html;
            document.getElementById('txtTotal').innerText = `$${total.toFixed(2)}`;
            document.getElementById('inputTotal').value = total;
        }

        // Función mejorada y flexible para filtrar platillos
        function filtrarPlatillos() {
            const filtro = document.getElementById('filtroCategoria').value.toLowerCase();
            const tarjetas = document.querySelectorAll('.platillo-card');
            const mensajeVacio = document.getElementById('sinResultados');
            let visibles = 0;

            tarjetas.forEach(card => {
                const categoria = card.getAttribute('data-categoria').toLowerCase();
                
                if (filtro === 'todos' || categoria.includes(filtro)) {
                    card.style.display = 'flex';
                    visibles++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (visibles === 0) {
                mensajeVacio.classList.remove('hidden');
            } else {
                mensajeVacio.classList.add('hidden');
            }
        }

        function cambiarVista(idVista, event) {
            document.querySelectorAll('.vista-seccion').forEach(sec => sec.classList.remove('active'));
            document.getElementById('vista-' + idVista).classList.add('active');
            
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('bg-white', 'text-wine'));
            event.currentTarget.classList.add('bg-white', 'text-wine');
        }

        function mostrarSeccionSeleccionada(val) {
            const boxTexto = document.getElementById('resultadoTextoSeccion');
            const titulo = document.getElementById('tituloSeccionDinamica');
            const texto = document.getElementById('textoSeccionDinamica');
            const boxMedia = document.getElementById('resultadoMultimedia');

            boxTexto.classList.add('hidden');
            boxMedia.classList.add('hidden');

            if (val === 'mision') {
                boxTexto.classList.remove('hidden');
                titulo.innerText = "🎯 Nuestra Misión Institucional";
                texto.innerText = "En Sabor Ofertin, nuestra misión fundamental desde nuestra fundación en 1998 ha sido consolidarnos como un referente gastronómico de excelencia, ofreciendo a cada uno de nuestros comensales una experiencia culinaria excepcional que fusiona la más alta calidad, frescura y sabor tradicional con un servicio cálido y eficiente. Nos comprometemos rigurosamente a seleccionar ingredientes locales de óptima procedencia, apoyando de manera directa a los productores de la región y promoviendo prácticas sostenibles que minimicen nuestro impacto ambiental. Aspiramos a ser un espacio donde las familias, amigos y amantes de la buena comida puedan disfrutar de platillos elaborados con pasión, dedicación y estrictos estándares de higiene, garantizando siempre una relación calidad-precio justa que demuestre nuestro profundo agradecimiento a la comunidad que nos ha honrado con su preferencia a lo largo de más de dos décadas de trayectoria ininterrumpida.";
            } else if (val === 'vision') {
                boxTexto.classList.remove('hidden');
                titulo.innerText = "🔭 Nuestra Visión Estratégica";
                texto.innerText = "Nuestra visión para el futuro en Sabor Ofertin es expandir nuestro concepto culinario responsable e innovador a nuevos horizontes, posicionándonos firmemente como el restaurante líder indiscutible en la preferencia regional gracias a nuestra capacidad de adaptación, mejora continua y compromiso con la sustentabilidad ecológica. Proyectamos un crecimiento basado en la optimización de procesos mediante herramientas tecnológicas avanzadas —como nuestro sistema integral de gestión y POS digital—, manteniendo siempre el toque humano y artesanal que caracteriza a nuestros platillos estelares. Buscamos consolidar una red de alianzas sólidas con productores agroindustriales locales, fomentar el desarrollo profesional y humano de nuestro equipo de colaboradores, y establecernos como pioneros en la implementación de prácticas de economía circular, tales como el uso de empaques 100% compostables y la valorización de residuos orgánicos, garantizando así un legado de sabor, responsabilidad y bienestar para las futuras generaciones.";
            } else if (val === 'multimedia') {
                boxMedia.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
