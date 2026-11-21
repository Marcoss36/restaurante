<?php
include 'conexion.php';

$mensaje_exito = "";

// Procesar pedido enviado desde el POS
if (isset($_POST['realizar_pedido'])) {
    $mesa = $_POST['mesa'];
    $metodo_pago = $_POST['metodo_pago'];
    $total = $_POST['total'];
    $folio = 'ORD-' . rand(1000, 9999);

    $stmt = $conexion->prepare("INSERT INTO pedidos (folio, mesa, metodo_pago, total, estado) VALUES (?, ?, ?, ?, 'En Proceso')");
    $stmt->bind_param("sssd", $folio, $mesa, $metodo_pago, $total);
    if ($stmt->execute()) {
        $mensaje_exito = "¡Pedido registrado con éxito! Folio asignado: " . $folio;
    }
    $stmt->close();
}

// Consultar el menú desde la base de datos
$resultado_menu = $conexion->query("SELECT * FROM menu");
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
</head>
<body class="h-full flex flex-col text-slate-800 bg-slate-50">

    <?php if (!empty($mensaje_exito)): ?>
    <div class="bg-emerald-600 text-white text-center py-3 px-4 font-bold text-sm z-50 shadow-md">
        <?= $mensaje_exito ?>
    </div>
    <?php endif; ?>

    <!-- Encabezado Institucional -->
    <header class="bg-wine border-b-4 border-red-900 shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-3">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100" alt="Logo" class="w-12 h-12 rounded-full border-2 border-white object-cover shadow">
                <div>
                    <span class="text-xl font-extrabold text-white tracking-tight block">Sabor Ofertin</span>
                    <span class="text-[10px] font-semibold text-red-200 tracking-widest block uppercase">Sistema de Restaurante & POS</span>
                </div>
            </div>
            <nav class="flex space-x-2 text-xs font-semibold">
                <a href="#menu" class="bg-white/15 hover:bg-white text-white hover:text-wine px-4 py-2 rounded-lg transition">🍽️ Menú PHP/MySQL</a>
                <a href="#sustentabilidad" class="bg-white/15 hover:bg-white text-white hover:text-wine px-4 py-2 rounded-lg transition">🌱 Sustentabilidad</a>
            </nav>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">
        
        <!-- Sección Menú -->
        <section id="menu" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-10">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 border-b pb-4">
                <h2 class="text-xl font-extrabold text-slate-900">Catálogo de Platillos (Conectado a Base de Datos)</h2>
                <input type="text" id="searchInput" placeholder="Buscar platillo..." oninput="filtrarPlatillos()" class="px-4 py-2 border rounded-xl text-xs w-full md:w-72 focus:outline-none focus:border-wine">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6" id="menuGrid">
                <?php if ($resultado_menu && $resultado_menu->num_rows > 0): ?>
                    <?php while($row = $resultado_menu->fetch_assoc()): ?>
                    <div class="menu-card bg-white border rounded-xl overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between" data-nombre="<?= strtolower($row['nombre']) ?>">
                        <div>
                            <img src="<?= $row['imagen'] ?>" alt="<?= $row['nombre'] ?>" class="w-full h-36 object-cover">
                            <div class="p-4">
                                <span class="text-[10px] font-bold text-slate-400 uppercase"><?= $row['categoria'] ?></span>
                                <h3 class="font-bold text-sm text-slate-800 mt-1"><?= $row['nombre'] ?></h3>
                            </div>
                        </div>
                        <div class="p-4 pt-0 flex justify-between items-center border-t border-slate-100 mt-2">
                            <span class="text-wine font-extrabold text-base">$<?= number_format($row['precio'], 2) ?></span>
                            <button onclick="agregarOrden('<?= $row['nombre'] ?>', <?= $row['precio'] ?>)" class="bg-wine text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-wine-hover transition">+ Agregar</button>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-slate-500 italic col-span-full text-center py-8">No hay platillos registrados en la tabla 'menu' de tu base de datos XAMPP.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Sección Sustentabilidad -->
        <section id="sustentabilidad" class="bg-gradient-to-br from-emerald-900 to-emerald-950 text-white rounded-2xl p-8 shadow-lg mb-10">
            <h2 class="text-2xl font-black mb-3">🌱 Compromiso de Sustentabilidad Sabor Ofertin</h2>
            <p class="text-emerald-100 text-xs md:text-sm max-w-3xl leading-relaxed">
                Operamos bajo estrictos estándares ecológicos: empaques 100% compostables de bagazo de caña, adquisición de insumos locales a menos de 60 km y transformación de aceite vegetal usado en biocombustible certificado.
            </p>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-wine text-white py-6 border-t-4 border-red-900 mt-auto text-center text-xs">
        <p>&copy; 2026 Sabor Ofertin. Sistema en PHP / MySQL / XAMPP.</p>
    </footer>

    <script>
        function filtrarPlatillos() {
            let filter = document.getElementById('searchInput').value.toLowerCase();
            let cards = document.querySelectorAll('.menu-card');
            cards.forEach(card => {
                let nombre = card.getAttribute('data-nombre');
                card.style.display = nombre.includes(filter) ? 'flex' : 'none';
            });
        }

        function agregarOrden(nombre, precio) {
            alert(`Platillo agregado al ticket: ${nombre} ($${precio.toFixed(2)})`);
        }
    </script>
</body>
</html>