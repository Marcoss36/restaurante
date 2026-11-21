const express = require('express');
const mysql = require('mysql2/promise');
const cors = require('cors');
const path = require('path');

const app = express();
app.use(express.json());
app.use(cors());

// Servir los archivos estáticos (tu HTML, imágenes, etc. ubicados en la carpeta 'public')
app.use(express.static(path.join(__dirname, 'public')));

// Configuración de la conexión a MySQL (utiliza variables de entorno que provee Clever Cloud)
const pool = mysql.createPool({
    host: process.env.MYSQL_ADDON_HOST || 'localhost',
    user: process.env.MYSQL_ADDON_USER || 'root',
    password: process.env.MYSQL_ADDON_PASSWORD || '',
    database: process.env.MYSQL_ADDON_DB || 'sabor_ofertin',
    port: process.env.MYSQL_ADDON_PORT || 3306,
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// --- RUTAS DE EJEMPLO PARA LA API ---

// 1. Obtener todos los platillos del menú
app.get('/api/menu', async (req, res) => {
    try {
        const [rows] = await pool.query('SELECT * FROM menu');
        res.json(rows);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Error al obtener el menú' });
    }
});

// 2. Guardar un nuevo pedido en la base de datos
app.post('/api/pedidos', async (req, res) => {
    const { mesa, metodo_pago, total, items } = req.body;
    const connection = await pool.getConnection();
    try {
        await connection.beginTransaction();

        // Insertar cabecera del pedido
        const [pedidoResult] = await connection.query(
            'INSERT INTO pedidos (mesa, metodo_pago, total, estado) VALUES (?, ?, ?, ?)',
            [mesa, metodo_pago, total, 'En Proceso']
        );
        const pedidoId = pedidoResult.insertId;

        // Insertar cada platillo del pedido
        for (const item of items) {
            await connection.query(
                'INSERT INTO detalle_pedido (pedido_id, nombre_platillo, cantidad, precio_unitario) VALUES (?, ?, ?, ?)',
                [pedidoId, item.nombre, item.cantidad, item.precio]
            );
        }

        await connection.commit();
        res.json({ success: true, mensaje: 'Pedido registrado con éxito', pedidoId });
    } catch (error) {
        await connection.rollback();
        console.error(error);
        res.status(500).json({ error: 'Error al procesar el pedido' });
    } finally {
        connection.release();
    }
});

// Puerto de escucha (Clever Cloud asigna un puerto automáticamente mediante process.env.PORT)
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Servidor de Sabor Ofertin corriendo en el puerto ${PORT}`);
});