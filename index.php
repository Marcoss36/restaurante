<?php
include 'conexion.php';

$mensaje_exito = "";

// -------------------------------------------------------------
// 1. ACCIONES DE CREAR (INSERT)
// -------------------------------------------------------------
if (isset($_POST['guardar_chef'])) {
    $nombre = $_POST['nombre'];
    $bio = $_POST['bio'];
    $stmt = $conexion->prepare("INSERT INTO chefs (nombre, bio) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre, $bio);
    if ($stmt->execute()) { $mensaje_exito = "¡Chef registrado con éxito!"; }
    $stmt->close();
}

if (isset($_POST['guardar_promo'])) {
    $titulo = $_POST['titulo'];
    $tag = $_POST['tag'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $desc = $_POST['desc'];
    $stmt = $conexion->prepare("INSERT INTO promos (titulo, tag, precio, imagen, descripcion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $titulo, $tag, $precio, $imagen, $desc);
    if ($stmt->execute()) { $mensaje_exito = "¡Promoción guardada con éxito!"; }
    $stmt->close();
}

if (isset($_POST['guardar_opinion'])) {
    $cliente = $_POST['cliente'];
    $comentario = $_POST['comentario'];
    $stmt = $conexion->prepare("INSERT INTO opiniones (cliente, comentario) VALUES (?, ?)");
    $stmt->bind_param("ss", $cliente, $comentario);
    if ($stmt->execute()) { $mensaje_exito = "¡Opinión agregada con éxito!"; }
    $stmt->close();
}

if (isset($_POST['guardar_especial'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $desc = $_POST['desc'];
    $stmt = $conexion->prepare("INSERT INTO especiales (nombre, precio, imagen, descripcion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $nombre, $precio, $imagen, $desc);
    if ($stmt->execute()) { $mensaje_exito = "¡Platillo especial guardado con éxito!"; }
    $stmt->close();
}

if (isset($_POST['guardar_sucursal'])) {
    $nombre = $_POST['nombre'];
    $info = $_POST['info'];
    $stmt = $conexion->prepare("INSERT INTO sucursales (nombre, info) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre, $info);
    if ($stmt->execute()) { $mensaje_exito = "¡Sucursal registrada con éxito!"; }
    $stmt->close();
}

if (isset($_POST['guardar_contacto'])) {
    $canal = $_POST['canal'];
    $info = $_POST['info'];
    $stmt = $conexion->prepare("INSERT INTO contacto (canal, info) VALUES (?, ?)");
    $stmt->bind_param("ss", $canal, $info);
    if ($stmt->execute()) { $mensaje_exito = "¡Canal de contacto agregado con éxito!"; }
    $stmt->close();
}

if (isset($_POST['hacer_reserva'])) {
    $mesa = $_POST['mesa'];
    $nombre = $_POST['nombre'];
    $personas = $_POST['personas'];
    $fecha = $_POST['fecha'];
    $stmt = $conexion->prepare("INSERT INTO reservas (mesa, nombre, personas, fecha_hora) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $mesa, $nombre, $personas, $fecha);
    if ($stmt->execute()) { $mensaje_exito = "¡Reserva de mesa confirmada con éxito!"; }
    $stmt->close();
}

if (isset($_POST['enviar_cuestionario'])) {
    $p1 = $_POST['p1']; $p2 = $_POST['p2']; $p3 = $_POST['p3']; $p4 = $_POST['p4']; $p5 = $_POST['p5'];
    $p6 = $_POST['p6']; $p7 = $_POST['p7']; $p8 = $_POST['p8']; $p9 = $_POST['p9']; $p10 = $_POST['p10'];
    $stmt = $conexion->prepare("INSERT INTO cuestionario_respuestas (p1, p2, p3, p4, p5, p6, p7, p8, p9, p10) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("iiiiiiiiii", $p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10);
    if ($stmt->execute()) { $mensaje_exito = "¡Muchas gracias por completar el cuestionario!"; }
    $stmt->close();
}

// -------------------------------------------------------------
// 2. ACCIONES DE ELIMINAR (DELETE)
// -------------------------------------------------------------
if (isset($_GET['eliminar_chef'])) {
    $id = $_GET['eliminar_chef'];
    $stmt = $conexion->prepare("DELETE FROM chefs WHERE id = ?"); $stmt->bind_param("i", $id); $stmt->execute();
    header("Location: index.php"); exit();
}
if (isset($_GET['eliminar_promo'])) {
    $id = $_GET['eliminar_promo'];
    $stmt = $conexion->prepare("DELETE FROM promos WHERE id = ?"); $stmt->bind_param("i", $id); $stmt->execute();
    header("Location: index.php"); exit();
}
if (isset($_GET['eliminar_opinion'])) {
    $id = $_GET['eliminar_opinion'];
    $stmt = $conexion->prepare("DELETE FROM opiniones WHERE id = ?"); $stmt->bind_param("i", $id); $stmt->execute();
    header("Location: index.php"); exit();
}
if (isset($_GET['eliminar_especial'])) {
    $id = $_GET['eliminar_especial'];
    $stmt = $conexion->prepare("DELETE FROM especiales WHERE id = ?"); $stmt->bind_param("i", $id); $stmt->execute();
    header("Location: index.php"); exit();
}
if (isset($_GET['eliminar_sucursal'])) {
    $id = $_GET['eliminar_sucursal'];
    $stmt = $conexion->prepare("DELETE FROM sucursales WHERE id = ?"); $stmt->bind_param("i", $id); $stmt->execute();
    header("Location: index.php"); exit();
}
if (isset($_GET['eliminar_contacto'])) {
    $id = $_GET['eliminar_contacto'];
    $stmt = $conexion->prepare("DELETE FROM contacto WHERE id = ?"); $stmt->bind_param("i", $id); $stmt->execute();
    header("Location: index.php"); exit();
}
if (isset($_GET['eliminar_reserva'])) {
    $id = $_GET['eliminar_reserva'];
    $stmt = $conexion->prepare("DELETE FROM reservas WHERE id = ?"); $stmt->bind_param("i", $id); $stmt->execute();
    header("Location: index.php"); exit();
}

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
    </style>
</head>
<body class="h-full flex flex-col text-slate-800 bg-slate-50">

    <?php if (!empty($mensaje_exito)): ?>
    <div class="bg-emerald-600 text-white text-center py-3 px-4 font-bold text-sm z-50 shadow-md">
        <?= $mensaje_exito ?>
    </div>
    <?php endif; ?>

    <!-- Encabezado de Navegación -->
    <header class="bg-wine border-b-4 border-red-900 shadow-lg sticky top-0 z-40 p-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-3">
                <img src="logo.png" alt="Logo" class="w-12 h-12 rounded-full border-2 border-white object-cover shadow" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100'">
                <div>
                    <span class="text-xl font-extrabold text-white tracking-tight block">Sabor Ofertin</span>
                    <span class="text-[10px] font-semibold text-red-200 tracking-widest block uppercase">Conectado a Clever Cloud</span>
                </div>
            </div>
            <nav class="flex flex-wrap gap-2 text-xs font-semibold">
                <button onclick="cambiarVista('menu')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition active">🍽️ Menú</button>
                <button onclick="cambiarVista('cocina')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">👨‍🍳 Cocina</button>
                <button onclick="cambiarVista('promos')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">🎉 Promos</button>
                <button onclick="cambiarVista('reservas')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">📅 Reservas</button>
                <button onclick="cambiarVista('especiales')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">⭐ Especiales</button>
                <button onclick="cambiarVista('chefs')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">👨‍🍳 Chefs</button>
                <button onclick="cambiarVista('opiniones')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">🏆 Opiniones</button>
                <button onclick="cambiarVista('sucursales')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">📍 Sucursales</button>
                <button onclick="cambiarVista('contacto')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">📞 Contacto</button>
                <button onclick="cambiarVista('cuestionario')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">📊 Cuestionario</button>
                <button onclick="cambiarVista('sustentabilidad')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">🌱 Sustentabilidad</button>
                <button onclick="cambiarVista('multimedia')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">🎬 Multimedia</button>
            </nav>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="flex-grow max-w-7xl mx-auto px-4 py-8 w-full">
        
        <!-- 1. MENÚ -->
        <section id="vista-menu" class="vista-seccion active bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">Catálogo de Platillos (Base de Datos Remota)</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <?php if ($resultado_menu && $resultado_menu->num_rows > 0): ?>
                    <?php while($row = $resultado_menu->fetch_assoc()): ?>
                    <div class="border rounded-xl overflow-hidden shadow-sm bg-white flex flex-col justify-between">
                        <div>
                            <img src="<?= $row['imagen'] ?>" class="w-full h-36 object-cover" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400'">
                            <div class="p-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase"><?= $row['categoria'] ?></span>
                                <h3 class="font-bold text-sm text-slate-800 mt-1"><?= $row['nombre'] ?></h3>
                            </div>
                        </div>
                        <div class="p-4 pt-0 flex justify-between items-center border-t border-slate-100 mt-2">
                            <span class="text-wine font-extrabold text-base">$<?= number_format($row['precio'], 2) ?></span>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-slate-500 italic col-span-full text-center py-8">No hay platillos en la base de datos.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- 2. COCINA -->
        <section id="vista-cocina" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">👨‍🍳 Monitor de Cocina (Pedidos en Base de Datos)</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php while($row = $resultado_pedidos->fetch_assoc()): ?>
                <div class="border-l-4 border-wine bg-slate-50 p-5 rounded-xl shadow-sm">
                    <div class="flex justify-between items-center mb-2">
                        <strong class="text-sm">Folio: <?= $row['folio'] ?></strong>
                        <span class="bg-orange-100 text-orange-800 text-[10px] font-bold px-2 py-0.5 rounded uppercase"><?= $row['estado'] ?></span>
                    </div>
                    <p class="text-xs text-slate-600">Mesa: <strong><?= $row['mesa'] ?></strong></p>
                    <p class="text-xs text-slate-600">Pago: <strong><?= $row['metodo_pago'] ?></strong></p>
                    <span class="text-wine font-extrabold text-sm block mt-3">Total: $<?= number_format($row['total'], 2) ?></span>
                </div>
                <?php endwhile; ?>
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

        <!-- 4. RESERVAS (NUEVO) -->
        <section id="vista-reservas" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">📅 Gestión y Reserva de Mesas (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Mesa</label>
                    <input type="text" name="mesa" placeholder="Ej. Mesa 1 (Ventana)" required class="w-full px-4 py-2 border rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nombre Completo</label>
                    <input type="text" name="nombre" placeholder="Ej. Carlos Mendoza" required class="w-full px-4 py-2 border rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Número de Personas</label>
                    <input type="number" name="personas" value="2" required class="w-full px-4 py-2 border rounded-xl text-xs">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Fecha y Hora</label>
                    <input type="datetime-local" name="fecha" required class="w-full px-4 py-2 border rounded-xl text-xs">
                </div>
                <div class="md:col-span-2">
                    <button type="submit" name="hacer_reserva" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow">Confirmar Reserva</button>
                </div>
            </form>

            <h3 class="font-bold text-sm text-slate-700 mb-4">Reservas Activas Registradas:</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php while($row = $resultado_reservas->fetch_assoc()): ?>
                <div class="border p-4 rounded-xl shadow-sm relative bg-white">
                    <a href="index.php?eliminar_reserva=<?= $row['id'] ?>" onclick="return confirm('¿Cancelar reserva?')" class="absolute top-3 right-3 bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">🗑️</a>
                    <h4 class="font-bold text-sm text-slate-900"><?= $row['mesa'] ?></h4>
                    <p class="text-xs text-slate-600 mt-1">A nombre de: <strong><?= $row['nombre'] ?></strong></p>
                    <p class="text-xs text-slate-600">Personas: <?= $row['personas'] ?></p>
                    <p class="text-xs text-slate-400 mt-2">Fecha: <?= $row['fecha_hora'] ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 5. ESPECIALES (NUEVO) -->
        <section id="vista-especiales" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">⭐ Platillos Especiales del Chef (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="nombre" placeholder="Nombre del platillo" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="number" step="0.01" name="precio" placeholder="Precio ($)" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="text" name="imagen" placeholder="URL de Imagen" required class="px-4 py-2 border rounded-xl text-xs md:col-span-2">
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
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">👨‍🍳 Gestión de Chefs (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="nombre" placeholder="Nombre del Chef" required class="px-4 py-2 border rounded-xl text-xs">
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
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">🏆 Opiniones de Clientes (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 gap-4">
                <input type="text" name="cliente" placeholder="Nombre del Cliente" required class="px-4 py-2 border rounded-xl text-xs">
                <textarea name="comentario" placeholder="Comentario" rows="2" required class="px-4 py-2 border rounded-xl text-xs"></textarea>
                <button type="submit" name="guardar_opinion" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Agregar Opinión</button>
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

        <!-- 8. SUCURSALES (NUEVO) -->
        <section id="vista-sucursales" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">📍 Sucursales (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 gap-4">
                <input type="text" name="nombre" placeholder="Nombre de la Sucursal" required class="px-4 py-2 border rounded-xl text-xs">
                <textarea name="info" placeholder="Dirección y Teléfono" rows="2" required class="px-4 py-2 border rounded-xl text-xs"></textarea>
                <button type="submit" name="guardar_sucursal" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Agregar Sucursal</button>
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

        <!-- 9. CONTACTO (NUEVO) -->
        <section id="vista-contacto" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">📞 Contacto (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 gap-4">
                <input type="text" name="canal" placeholder="Canal o Departamento" required class="px-4 py-2 border rounded-xl text-xs">
                <textarea name="info" placeholder="Información de contacto" rows="2" required class="px-4 py-2 border rounded-xl text-xs"></textarea>
                <button type="submit" name="guardar_contacto" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Agregar Canal</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php while($row = $resultado_contacto->fetch_assoc()): ?>
                <div class="border rounded-xl p-6 relative bg-white">
                    <a href="index.php?eliminar_contacto=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2 py-1 rounded-lg text-xs font-bold">🗑️</a>
                    <h3 class="font-bold text-base text-slate-900 mb-2"><?= $row['canal'] ?></h3>
                    <p class="text-slate-600 text-xs"><?= $row['info'] ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 10. CUESTIONARIO (NUEVO) -->
        <section id="vista-cuestionario" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">📊 Cuestionario de Satisfacción (Guardado en DB)</h2>
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

        <!-- 12. MULTIMEDIA -->
        <section id="vista-multimedia" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">🎬 Contenido Multimedia</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
        <p>&copy; 2026 Sabor Ofertin. Conectado a MySQL en Clever Cloud.</p>
    </footer>

    <script>
        function cambiarVista(idVista) {
            document.querySelectorAll('.vista-seccion').forEach(sec => sec.classList.remove('active'));
            document.getElementById('vista-' + idVista).classList.add('active');
            
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('bg-white', 'text-wine'));
            event.currentTarget.classList.add('bg-white', 'text-wine');
        }
    </script>
</body>
</html>
