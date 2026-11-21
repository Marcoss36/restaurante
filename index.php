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

// Procesar pedido desde el POS
if (isset($_POST['realizar_pedido'])) {
    $mesa = $_POST['mesa'];
    $metodo_pago = $_POST['metodo_pago'];
    $total = $_POST['total'];
    $folio = 'ORD-' . rand(1000, 9999);

    $stmt = $conexion->prepare("INSERT INTO pedidos (folio, mesa, metodo_pago, total, estado) VALUES (?, ?, ?, ?, 'En Proceso')");
    $stmt->bind_param("sssd", $folio, $mesa, $metodo_pago, $total);
    if ($stmt->execute()) {
        $mensaje_exito = "¡Pedido registrado con éxito! Folio: " . $folio;
    }
    $stmt->close();
}

// -------------------------------------------------------------
// 2. ACCIONES DE ELIMINAR (DELETE)
// -------------------------------------------------------------
if (isset($_GET['eliminar_chef'])) {
    $id = $_GET['eliminar_chef'];
    $stmt = $conexion->prepare("DELETE FROM chefs WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

if (isset($_GET['eliminar_promo'])) {
    $id = $_GET['eliminar_promo'];
    $stmt = $conexion->prepare("DELETE FROM promos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

if (isset($_GET['eliminar_opinion'])) {
    $id = $_GET['eliminar_opinion'];
    $stmt = $conexion->prepare("DELETE FROM opiniones WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
    exit();
}

// -------------------------------------------------------------
// 3. CONSULTAS EN TIEMPO REAL (SELECT)
// -------------------------------------------------------------
$resultado_menu = $conexion->query("SELECT * FROM menu");
$resultado_chefs = $conexion->query("SELECT * FROM chefs");
$resultado_promos = $conexion->query("SELECT * FROM promos");
$resultado_opiniones = $conexion->query("SELECT * FROM opiniones");
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
                <button onclick="cambiarVista('chefs')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">👨‍🍳 Chefs</button>
                <button onclick="cambiarVista('opiniones')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">🏆 Opiniones</button>
                <button onclick="cambiarVista('sustentabilidad')" class="tab-btn bg-white/15 hover:bg-white text-white hover:text-wine px-3 py-2 rounded-lg transition">🌱 Sustentabilidad</button>
            </nav>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="flex-grow max-w-7xl mx-auto px-4 py-8 w-full">
        
        <!-- 1. VISTA MENÚ -->
        <section id="vista-menu" class="vista-seccion active bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">Catálogo de Platillos (Base de Datos Remota)</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <?php if ($resultado_menu && $resultado_menu->num_rows > 0): ?>
                    <?php while($row = $resultado_menu->fetch_assoc()): ?>
                    <div class="border rounded-xl overflow-hidden shadow-sm flex flex-col justify-between bg-white">
                        <div>
                            <img src="<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>" class="w-full h-36 object-cover" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400'">
                            <div class="p-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase"><?= $row['categoria'] ?></span>
                                <h3 class="font-bold text-sm text-slate-800 mt-1"><?= $row['nombre'] ?></h3>
                            </div>
                        </div>
                        <div class="p-4 pt-0 flex justify-between items-center border-t border-slate-100 mt-2">
                            <span class="text-wine font-extrabold text-base">$<?= number_format($row['precio'], 2) ?></span>
                            <span class="text-xs text-slate-400">ID: <?= $row['id'] ?></span>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-slate-500 italic col-span-full text-center py-8">No hay platillos en la base de datos.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- 2. VISTA CHEFS -->
        <section id="vista-chefs" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">👨‍🍳 Gestión de Chefs (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nombre del Chef</label>
                    <input type="text" name="nombre" required class="w-full px-4 py-2 border rounded-xl text-xs">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Biografía</label>
                    <textarea name="bio" rows="2" required class="w-full px-4 py-2 border rounded-xl text-xs"></textarea>
                </div>
                <div class="md:col-span-2">
                    <button type="submit" name="guardar_chef" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow hover:bg-wine-hover transition">➕ Guardar Chef</button>
                </div>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php while($row = $resultado_chefs->fetch_assoc()): ?>
                <div class="border rounded-xl p-6 shadow-sm relative bg-white flex flex-col justify-between">
                    <a href="index.php?eliminar_chef=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar este chef?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2.5 py-1 rounded-lg text-xs font-bold">🗑️ Eliminar</a>
                    <div>
                        <h3 class="font-bold text-base text-slate-900 mb-2"><?= $row['nombre'] ?></h3>
                        <p class="text-slate-600 text-xs"><?= $row['bio'] ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 3. VISTA PROMOS -->
        <section id="vista-promos" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">🎉 Gestión de Promociones (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="titulo" placeholder="Título de la promo" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="text" name="tag" placeholder="Etiqueta (Ej. 2x1)" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="number" step="0.01" name="precio" placeholder="Precio ($)" required class="px-4 py-2 border rounded-xl text-xs">
                <input type="text" name="imagen" placeholder="URL de Imagen" required class="px-4 py-2 border rounded-xl text-xs md:col-span-3">
                <textarea name="desc" placeholder="Descripción" rows="2" required class="px-4 py-2 border rounded-xl text-xs md:col-span-3"></textarea>
                <div class="md:col-span-3"><button type="submit" name="guardar_promo" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow">➕ Guardar Promoción</button></div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php while($row = $resultado_promos->fetch_assoc()): ?>
                <div class="border rounded-xl overflow-hidden shadow-sm relative bg-white flex flex-col justify-between">
                    <a href="index.php?eliminar_promo=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar promo?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2 py-1 rounded-lg text-xs font-bold z-10">🗑️</a>
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

        <!-- 4. VISTA OPINIONES -->
        <section id="vista-opiniones" class="vista-seccion bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h2 class="text-xl font-extrabold text-slate-900 mb-6">🏆 Opiniones de Clientes (Base de Datos)</h2>
            <form method="POST" class="bg-slate-50 p-6 rounded-xl border mb-8 grid grid-cols-1 gap-4">
                <input type="text" name="cliente" placeholder="Nombre del Cliente" required class="px-4 py-2 border rounded-xl text-xs">
                <textarea name="comentario" placeholder="Comentario o reseña" rows="2" required class="px-4 py-2 border rounded-xl text-xs"></textarea>
                <button type="submit" name="guardar_opinion" class="bg-wine text-white font-bold px-6 py-2 rounded-xl text-xs shadow w-max">➕ Agregar Opinión</button>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php while($row = $resultado_opiniones->fetch_assoc()): ?>
                <div class="border rounded-xl p-6 relative bg-white flex flex-col justify-between">
                    <a href="index.php?eliminar_opinion=<?= $row['id'] ?>" onclick="return confirm('¿Eliminar opinión?')" class="absolute top-4 right-4 bg-red-100 text-red-700 px-2 py-1 rounded-lg text-xs font-bold">🗑️</a>
                    <p class="text-xs text-slate-700 mb-4"><?= $row['comentario'] ?></p>
                    <span class="text-wine font-bold text-xs">- <?= $row['cliente'] ?></span>
                </div>
                <?php endwhile; ?>
            </div>
        </section>

        <!-- 5. VISTA COCINA / PEDIDOS -->
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

        <!-- 6. VISTA SUSTENTABILIDAD -->
        <section id="vista-sustentabilidad" class="vista-seccion bg-gradient-to-br from-emerald-900 to-emerald-950 text-white rounded-2xl p-8 shadow-lg">
            <h2 class="text-2xl font-black mb-3">🌱 Compromiso de Sustentabilidad Sabor Ofertin</h2>
            <p class="text-emerald-100 text-xs md:text-sm max-w-3xl leading-relaxed">
                Operamos bajo estrictos estándares ecológicos: empaques 100% compostables de bagazo de caña, adquisición de insumos locales a menos de 60 km y transformación de aceite vegetal usado en biocombustible certificado.
            </p>
        </section>

    </main>

    <!-- Pie de página -->
    <footer class="bg-wine text-white py-6 border-t-4 border-red-900 mt-auto text-center text-xs">
        <p>&copy; 2026 Sabor Ofertin. Sistema conectado con MySQL en Clever Cloud.</p>
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
