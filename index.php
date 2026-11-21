<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabor Ofertin | Sistema y Restaurante</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --accent: #991b1b; /* Rojo vino profundo y sofisticado */
            --accent-hover: #7f1d1d;
            --accent-light: #fef2f2;
            --eco-green: #15803d;
            --eco-light: #f0fdf4;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.1);
            --shadow-md: 0 10px 15px -3px rgba(153, 27, 27, 0.06), 0 4px 6px -4px rgba(153, 27, 27, 0.04);
            --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
        }

        * {
            box-sizing: border-box;
            transition: background-color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* Encabezado extendido hacia abajo en dos niveles */
        header {
            background-color: var(--accent);
            border-bottom: 3px solid #7f1d1d;
            padding: 20px 32px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            box-shadow: 0 4px 20px rgba(153, 27, 27, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Fila Superior: Logo y Nombre */
        .header-top {
            display: flex;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ffffff;
            background-color: white;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 800;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        /* Fila Inferior: Todos los apartados abajo del logo en una sola línea con scroll horizontal */
        .nav-tabs-row {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            width: 100%;
            padding-bottom: 4px;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.4) transparent;
        }

        .nav-tabs-row::-webkit-scrollbar {
            height: 5px;
        }

        .nav-tabs-row::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 4px;
        }

        .tab-btn {
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            padding: 9px 16px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .tab-btn.active, .tab-btn:hover {
            background-color: #ffffff;
            color: var(--accent);
            border-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Contenedor Principal */
        .wrapper {
            flex: 1;
            max-width: 1400px;
            width: 95%;
            margin: 36px auto;
        }

        .panel {
            background-color: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .panel-header {
            padding: 24px 28px;
            border-bottom: 1px solid var(--border);
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .dropdown-filter {
            padding: 10px 16px;
            background-color: var(--bg-main);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-main);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            outline: none;
        }

        .dropdown-filter:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(153, 27, 27, 0.1);
        }

        .search-bar {
            width: 100%;
            padding: 12px 16px;
            background-color: var(--bg-main);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-main);
            font-size: 0.95rem;
            outline: none;
        }

        .search-bar:focus {
            border-color: var(--accent);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(153, 27, 27, 0.1);
        }

        .content-area {
            padding: 32px;
        }

        /* POS y Menú Layout */
        .pos-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 28px;
            padding: 28px;
            background-color: #fafbfc;
            align-items: start;
        }

        @media (max-width: 1024px) {
            .pos-layout {
                grid-template-columns: 1fr;
            }
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .menu-card {
            background-color: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            position: relative;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent);
        }

        .menu-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            background-color: #f1f5f9;
        }

        .menu-card-body {
            padding: 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .menu-card h4 {
            margin: 0 0 6px 0;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-main);
            line-height: 1.4;
        }

        .menu-card .price {
            color: var(--accent);
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .add-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(153, 27, 27, 0.3);
        }

        /* Panel Lateral POS */
        .pos-sidebar {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            gap: 18px;
            position: sticky;
            top: 140px;
        }

        .pos-sidebar h3 {
            margin: 0;
            color: var(--text-main);
            font-size: 1.15rem;
            font-weight: 700;
            border-bottom: 2px solid var(--border);
            padding-bottom: 12px;
        }

        .pos-items-list {
            max-height: 260px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding-right: 4px;
        }

        .pos-item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }

        .pos-controls {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pos-controls button {
            background: var(--bg-main);
            border: 1px solid var(--border);
            color: var(--accent);
            width: 26px;
            height: 26px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .pos-controls button:hover {
            background: var(--accent-light);
            border-color: var(--accent);
        }

        .pos-summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 1.25rem;
            font-weight: 800;
            border-top: 1px solid var(--border);
            padding-top: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .form-group select, .form-group input, .form-group textarea {
            padding: 11px 14px;
            background-color: var(--bg-main);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            color: var(--text-main);
            font-size: 0.95rem;
            outline: none;
            font-family: inherit;
        }

        .form-group select:focus, .form-group input:focus, .form-group textarea:focus {
            border-color: var(--accent);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(153, 27, 27, 0.1);
        }

        .btn-action {
            width: 100%;
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 12px;
            border-radius: var(--radius-sm);
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(153, 27, 27, 0.3);
        }

        .btn-action:hover {
            background-color: var(--accent-hover);
            transform: translateY(-1px);
        }

        /* Secciones Administrativas & Tarjetas Dinámicas */
        .admin-box {
            background: #ffffff;
            border: 1px solid var(--border);
            padding: 24px;
            border-radius: var(--radius-md);
            margin-bottom: 28px;
            box-shadow: var(--shadow-sm);
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            align-items: end;
        }

        .dinamic-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            padding: 8px 0;
        }

        .promo-card, .admin-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .promo-card:hover, .admin-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent);
        }

        .promo-header-img {
            width: 100%;
            height: 190px;
            object-fit: cover;
        }

        .promo-tag {
            position: absolute;
            top: 14px;
            left: 14px;
            background: var(--accent);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
        }

        .promo-body, .admin-card {
            padding: 22px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            justify-content: space-between;
            gap: 14px;
        }

        .promo-body h3, .admin-card h3 {
            margin: 0 0 6px 0;
            color: var(--text-main);
            font-size: 1.15rem;
            font-weight: 700;
        }

        .promo-body p, .admin-card p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.93rem;
            line-height: 1.5;
        }

        .promo-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border);
            padding-top: 14px;
            margin-top: auto;
            gap: 10px;
        }

        .promo-price {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--accent);
        }

        .promo-actions {
            display: flex;
            gap: 8px;
        }

        .btn-claim-promo {
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-claim-promo:hover {
            background-color: var(--accent-hover);
        }

        .btn-delete, .btn-delete-card {
            background-color: #fee2e2;
            color: #b91c1c;
            border: none;
            padding: 8px 12px;
            border-radius: var(--radius-sm);
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-delete:hover, .btn-delete-card:hover {
            background-color: #fca5a5;
            color: #7f1d1d;
        }

        .btn-delete-card {
            position: absolute;
            top: 14px;
            right: 14px;
            padding: 6px 10px;
        }

        /* Mapa de Reservas */
        .reserva-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 28px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .reserva-layout {
                grid-template-columns: 1fr;
            }
        }

        .cinema-screen {
            background: var(--accent);
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: var(--radius-sm);
            font-weight: 700;
            letter-spacing: 2px;
            font-size: 0.8rem;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(153, 27, 27, 0.2);
        }

        .mesas-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .mesa-seat {
            background: #ffffff;
            border: 2px solid var(--border);
            border-radius: var(--radius-md);
            padding: 18px 12px;
            text-align: center;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            box-shadow: var(--shadow-sm);
            position: relative;
        }

        .mesa-seat.disponible {
            border-color: #16a34a;
            background: #f0fdf4;
        }

        .mesa-seat.disponible:hover {
            background: #dcfce7;
            transform: translateY(-2px);
        }

        .mesa-seat.ocupada {
            border-color: #dc2626;
            background: #fef2f2;
        }

        .mesa-seat.ocupada:hover {
            background: #fee2e2;
            transform: translateY(-2px);
        }

        .mesa-seat.seleccionada {
            border-color: var(--accent);
            background: var(--accent-light);
            box-shadow: 0 0 0 3px rgba(153, 27, 27, 0.15);
        }

        .mesa-icon {
            font-size: 1.6rem;
        }

        .mesa-nombre {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .mesa-estado {
            font-size: 0.72rem;
            font-weight: 700;
        }

        .disponible .mesa-estado { color: #16a34a; }
        .ocupada .mesa-estado { color: #dc2626; }
        .seleccionada .mesa-estado { color: var(--accent); }

        .btn-delete-mesa {
            position: absolute;
            top: 6px;
            right: 6px;
            background: #e2e8f0;
            color: #64748b;
            border: none;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            font-size: 0.75rem;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-delete-mesa:hover {
            background: #dc2626;
            color: white;
        }

        .cinema-legend {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-top: 16px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .legend-box {
            width: 14px;
            height: 14px;
            border-radius: 4px;
        }

        /* Cocina Grid */
        .kitchen-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .kitchen-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-left: 5px solid var(--accent);
            border-radius: var(--radius-md);
            padding: 22px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            box-shadow: var(--shadow-sm);
        }

        .kitchen-card.listo {
            border-left-color: #16a34a;
            background: #f0fdf4;
        }

        .kitchen-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            padding-bottom: 10px;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
        }

        .status-proceso {
            background: #ffedd5;
            color: #c2410c;
        }

        .status-listo {
            background: #dcfce7;
            color: #15803d;
        }

        .btn-status {
            background: var(--accent);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-weight: 700;
            font-size: 0.82rem;
        }

        .btn-status:hover {
            background: var(--accent-hover);
        }

        /* Cuestionario Satisfacción */
        .survey-container {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 32px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .survey-question {
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .survey-question label {
            font-weight: 700;
            color: var(--text-main);
            font-size: 0.98rem;
        }

        .survey-options {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .survey-options label {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Sección Sustentabilidad */
        .eco-banner {
            background: linear-gradient(135deg, #14532d 0%, #166534 100%);
            color: #ffffff;
            padding: 32px;
            border-radius: var(--radius-md);
            margin-bottom: 28px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            box-shadow: 0 10px 20px rgba(21, 128, 61, 0.15);
        }

        .eco-banner h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 800;
        }

        .eco-banner p {
            margin: 0;
            color: #dcfce7;
            font-size: 0.98rem;
            line-height: 1.6;
            max-width: 850px;
        }

        .eco-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .eco-metric-card {
            background: var(--eco-light);
            border: 1px solid #bbf7d0;
            border-radius: var(--radius-md);
            padding: 20px;
            text-align: center;
        }

        .eco-metric-card .metric-val {
            font-size: 2rem;
            font-weight: 800;
            color: var(--eco-green);
            display: block;
        }

        .eco-metric-card .metric-label {
            font-size: 0.88rem;
            font-weight: 700;
            color: #166534;
            margin-top: 4px;
            display: block;
        }

        .eco-metric-card small {
            color: #15803d;
            font-size: 0.78rem;
            display: block;
            margin-top: 6px;
        }

        .eco-evidence-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .eco-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-top: 4px solid var(--eco-green);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .eco-badge {
            align-self: flex-start;
            background: #dcfce7;
            color: #166534;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 800;
        }

        .eco-card h4 {
            margin: 0;
            font-size: 1.1rem;
            color: var(--text-main);
        }

        .eco-card p {
            margin: 0;
            font-size: 0.92rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .eco-proof {
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px dashed #cbd5e1;
            font-size: 0.82rem;
            color: #15803d;
            font-weight: 600;
        }

        /* Sección Multimedia Estilos */
        .media-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-top: 20px;
        }

        @media (max-width: 900px) {
            .media-container {
                grid-template-columns: 1fr;
            }
        }

        .media-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .media-card h3 {
            margin: 0;
            color: var(--accent);
            font-size: 1.15rem;
        }

        .media-card video, .media-card audio {
            width: 100%;
            border-radius: var(--radius-sm);
            outline: none;
        }

        .empty-state {
            text-align: center;
            color: var(--text-muted);
            margin: 40px 0;
            font-style: italic;
            font-size: 0.95rem;
        }

        /* Pie de página */
        footer {
            background-color: var(--accent);
            color: #f1f5f9;
            padding: 48px 24px 24px 24px;
            margin-top: 60px;
            font-size: 0.9rem;
            border-top: 3px solid #7f1d1d;
            box-shadow: 0 -4px 20px rgba(153, 27, 27, 0.3);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 32px;
            margin-bottom: 32px;
        }

        .footer-section h4 {
            color: #ffffff;
            margin-bottom: 12px;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .footer-section p {
            color: #f1f5f9;
            margin: 0;
            line-height: 1.6;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 0 auto;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 20px;
            text-align: center;
            font-size: 0.85rem;
            color: #f8fafc;
        }
    </style>
</head>
<body>

<!-- ENCABEZADO: Fila superior con logo y abajo todos los apartados -->
<header>
    <!-- Fila 1: Logo y Nombre del Restaurante -->
    <div class="header-top">
        <div class="logo-container">
            <img src="logo.png" alt="Logo Sabor Ofertin" class="logo-img" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=100'">
            <span class="logo">Sabor Ofertin</span>
        </div>
    </div>
    
    <!-- Fila 2: Todos los apartados abajo del logo -->
    <div class="nav-tabs-row">
        <button class="tab-btn active" onclick="cambiarVista('menu')">🍽️ Menú</button>
        <button class="tab-btn" onclick="cambiarVista('cocina')">👨‍🍳 Cocina (<span id="kitchenCount">0</span>)</button>
        <button class="tab-btn" onclick="cambiarVista('promos')">🎉 Promos</button>
        <button class="tab-btn" onclick="cambiarVista('reservas')">📅 Reservas</button>
        <button class="tab-btn" onclick="cambiarVista('especiales')">⭐ Especiales</button>
        <button class="tab-btn" onclick="cambiarVista('chefs')">👨‍🍳 Chefs</button>
        <button class="tab-btn" onclick="cambiarVista('opiniones')">🏆 Opiniones</button>
        <button class="tab-btn" onclick="cambiarVista('sucursales')">📍 Sucursales</button>
        <button class="tab-btn" onclick="cambiarVista('contacto')">📞 Contacto</button>
        <button class="tab-btn" onclick="cambiarVista('cuestionario')">📊 Cuestionario</button>
        <button class="tab-btn" onclick="cambiarVista('sustentabilidad')">🌱 Sustentabilidad</button>
        <button class="tab-btn" onclick="cambiarVista('seccion')">📖 Sección y Multimedia</button>
    </div>
</header>

<!-- CONTENIDO PRINCIPAL -->
<div class="wrapper">
    <div class="panel">
        <!-- Vista Menú -->
        <div id="vistaMenu" style="display: flex; flex-direction: column;">
            <div class="panel-header">
                <h2>Catálogo de Platillos Exclusivos</h2>
                <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                    <select id="categoriaDropdown" class="dropdown-filter" onchange="filtrarPorDropdown(this.value)">
                        <option value="Todos">📁 Todas las Categorías</option>
                        <option value="Entradas">Entradas</option>
                        <option value="Comida Rápida">Comida Rápida</option>
                        <option value="Italiana">Italiana</option>
                        <option value="Carnes">Carnes</option>
                        <option value="Postres">Postres</option>
                        <option value="Bebidas">Bebidas</option>
                    </select>
                    <input type="text" id="searchInput" class="search-bar" placeholder="Buscar platillo por nombre..." oninput="renderMenu()" style="width: 240px;">
                </div>
            </div>
            
            <div class="pos-layout">
                <div class="menu-grid" id="menuGrid"></div>

                <div class="pos-sidebar">
                    <h3>Tu Pedido Actual</h3>
                    
                    <div class="form-group">
                        <label>Mesa Asignada</label>
                        <select id="mesaPedido" class="dropdown-filter" style="width: 100%;">
                            <option value="Mesa 1">Mesa 1 (Ventana)</option>
                            <option value="Mesa 2">Mesa 2 (Centro)</option>
                            <option value="Mesa 3">Mesa 3 (Centro)</option>
                            <option value="Mesa 4">Mesa 4 (Terraza)</option>
                            <option value="Mesa 5">Mesa 5 (Terraza)</option>
                            <option value="Mesa VIP">Mesa VIP</option>
                            <option value="Para Llevar">📦 Para Llevar</option>
                        </select>
                    </div>

                    <div class="pos-items-list" id="posItemsList">
                        <p class="empty-state" style="margin: 20px 0; font-size: 0.9rem;">No hay platillos seleccionados.</p>
                    </div>

                    <div class="form-group">
                        <label>Método de Pago</label>
                        <select id="metodoPago" class="dropdown-filter" style="width: 100%;">
                            <option value="Efectivo">💵 Efectivo</option>
                            <option value="Tarjeta de Crédito/Débito">💳 Tarjeta de Crédito / Débito</option>
                            <option value="Transferencia Bancaria">📱 Transferencia (SPEI)</option>
                        </select>
                    </div>

                    <div class="pos-summary-row">
                        <span>Total:</span>
                        <span id="posTotal" style="color: var(--accent);">$0.00</span>
                    </div>

                    <button class="btn-action" onclick="confirmarPagoYEnviar()">Pagar y enviar a cocina</button>
                </div>
            </div>
        </div>

        <!-- Vista Cocina -->
        <div id="vistaCocina" style="display: none;" class="content-area">
            <h2>👨‍🍳 Monitor de Cocina - Pedidos Activos</h2>
            <div id="kitchenContent"></div>
        </div>

        <!-- Vista Promociones -->
        <div id="vistaPromos" style="display: none;" class="content-area">
            <h2>🎉 Promociones Especiales de la Semana</h2>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Administra las ofertas vigentes o crea nuevas promociones.</p>
            
            <div class="admin-box">
                <div class="form-group" style="margin:0;"><label>Título de la Promo</label><input type="text" id="nuevaPromoTitulo" placeholder="Ej. Combo Especial"></div>
                <div class="form-group" style="margin:0;"><label>Etiqueta / Badge</label><input type="text" id="nuevaPromoTag" placeholder="Ej. 2x1"></div>
                <div class="form-group" style="margin:0;"><label>Precio ($)</label><input type="number" id="nuevaPromoPrecio" placeholder="150.00"></div>
                <div class="form-group" style="margin:0;"><label>URL de Imagen</label><input type="text" id="nuevaPromoImg" placeholder="https://..."></div>
                <div class="form-group" style="grid-column: 1/-1; margin:0;"><label>Descripción</label><textarea id="nuevaPromoDesc" rows="2" placeholder="Detalles..."></textarea></div>
                <div style="grid-column: 1/-1;"><button class="btn-action" onclick="darDeAltaPromocion()">➕ Dar de Alta Promoción</button></div>
            </div>
            <div class="dinamic-grid" id="promosContainer"></div>
        </div>

        <!-- Vista Reservas -->
        <div id="vistaReservas" style="display: none;" class="content-area">
            <h2>📅 Gestión y Reserva de Mesas</h2>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Haz clic en una mesa disponible para reservar o en una reservada para liberarla.</p>
            
            <div class="admin-box">
                <div class="form-group" style="margin:0;"><label>Nombre de la Mesa</label><input type="text" id="nuevaMesaNombre" placeholder="Ej. Mesa 6"></div>
                <div class="form-group" style="margin:0;"><label>Tipo / Capacidad</label><input type="text" id="nuevaMesaTipo" placeholder="Ej. Terraza (6 Pers.)"></div>
                <div class="form-group" style="margin:0;"><label>Estado Inicial</label>
                    <select id="nuevaMesaEstado" class="dropdown-filter" style="width:100%;">
                        <option value="disponible">🟢 Disponible</option>
                        <option value="ocupada">🔴 Ocupada</option>
                    </select>
                </div>
                <div style="grid-column: 1/-1;"><button class="btn-action" onclick="darDeAltaMesa()">➕ Dar de Alta Mesa</button></div>
            </div>

            <div class="reserva-layout">
                <div>
                    <div class="cinema-screen">ENTRADA PRINCIPAL / ZONA DE ACCESO</div>
                    <div class="mesas-grid" id="mapaMesasGrid"></div>
                    <div class="cinema-legend">
                        <div class="legend-item"><div class="legend-box" style="background: #f0fdf4; border: 2px solid #16a34a;"></div> Disponible</div>
                        <div class="legend-item"><div class="legend-box" style="background: #fef2f2; border: 2px solid #dc2626;"></div> Ocupada</div>
                        <div class="legend-item"><div class="legend-box" style="background: var(--accent-light); border: 2px solid var(--accent);"></div> Seleccionada</div>
                    </div>
                </div>
                <div class="form-container" style="background: #ffffff; border: 1px solid var(--border); padding: 24px; border-radius: var(--radius-md); box-shadow: var(--shadow-sm); display: flex; flex-direction: column; gap: 16px;">
                    <h3 style="margin: 0; color: var(--text-main); font-size: 1.15rem; font-weight: 700;">Detalles de la Reserva</h3>
                    <div class="form-group"><label>Mesa Seleccionada</label><input type="text" id="resMesaSeleccionada" readonly placeholder="Haz clic en una mesa..." style="background: #f1f5f9; font-weight: bold; color: var(--accent);"></div>
                    <div class="form-group"><label>Nombre Completo</label><input type="text" id="resNombre" placeholder="Ej. Carlos Mendoza"></div>
                    <div class="form-group"><label>Número de Personas</label>
                        <select id="resPersonas" class="dropdown-filter" style="width:100%;">
                            <option value="2">2 Personas</option>
                            <option value="4">4 Personas</option>
                            <option value="6">6 Personas</option>
                            <option value="10">10+ Personas (VIP)</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Fecha y Hora</label><input type="datetime-local" id="resFecha"></div>
                    <button class="btn-action" onclick="confirmarReservaMesa()">Confirmar Reserva</button>
                </div>
            </div>
        </div>

        <!-- Vista Especiales -->
        <div id="vistaEspeciales" style="display: none;" class="content-area">
            <h2>⭐ Platillos Especiales del Chef</h2>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Administra los platillos estelares del restaurante.</p>
            
            <div class="admin-box">
                <div class="form-group" style="margin:0;"><label>Nombre del Platillo</label><input type="text" id="nuevoEspecialNombre" placeholder="Ej. Tomahawk"></div>
                <div class="form-group" style="margin:0;"><label>Precio ($)</label><input type="number" id="nuevoEspecialPrecio" placeholder="350.00"></div>
                <div class="form-group" style="margin:0;"><label>URL de Imagen</label><input type="text" id="nuevoEspecialImg" placeholder="https://..."></div>
                <div class="form-group" style="grid-column: 1/-1; margin:0;"><label>Descripción</label><textarea id="nuevoEspecialDesc" rows="2" placeholder="Detalles..."></textarea></div>
                <div style="grid-column: 1/-1;"><button class="btn-action" onclick="darDeAltaEspecial()">➕ Dar de Alta Especial</button></div>
            </div>
            <div class="dinamic-grid" id="especialesContainer"></div>
        </div>

        <!-- Vista Chefs -->
        <div id="vistaChefs" style="display: none;" class="content-area">
            <h2>👨‍🍳 Nuestros Chefs Ejecutivos</h2>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Agrega o da de baja a los miembros del equipo culinario.</p>
            
            <div class="admin-box">
                <div class="form-group" style="margin:0;"><label>Nombre del Chef</label><input type="text" id="nuevoChefNombre" placeholder="Ej. Chef Roberto"></div>
                <div class="form-group" style="grid-column: 1/-1; margin:0;"><label>Biografía / Especialidad</label><textarea id="nuevoChefBio" rows="2" placeholder="Especialista en..."></textarea></div>
                <div style="grid-column: 1/-1;"><button class="btn-action" onclick="darDeAltaChef()">➕ Dar de Alta Chef</button></div>
            </div>
            <div class="dinamic-grid" id="chefsContainer"></div>
        </div>

        <!-- Vista Opiniones -->
        <div id="vistaOpiniones" style="display: none;" class="content-area">
            <h2>🏆 Opiniones de Nuestros Clientes</h2>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Administra los testimonios y reseñas mostradas.</p>
            
            <div class="admin-box">
                <div class="form-group" style="margin:0;"><label>Cliente / Autor</label><input type="text" id="nuevaOpCliente" placeholder="Ej. Andrea Gómez"></div>
                <div class="form-group" style="grid-column: 1/-1; margin:0;"><label>Comentario</label><textarea id="nuevaOpComentario" rows="2" placeholder="⭐⭐⭐⭐⭐ Excelente lugar..."></textarea></div>
                <div style="grid-column: 1/-1;"><button class="btn-action" onclick="darDeAltaOpinion()">➕ Dar de Alta Opinión</button></div>
            </div>
            <div class="dinamic-grid" id="opinionesContainer"></div>
        </div>

        <!-- Vista Sucursales -->
        <div id="vistaSucursales" style="display: none;" class="content-area">
            <h2>📍 Nuestras Sucursales</h2>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Gestiona las ubicaciones y datos de contacto de las sucursales.</p>
            
            <div class="admin-box">
                <div class="form-group" style="margin:0;"><label>Nombre de la Sucursal</label><input type="text" id="nuevaSucursalNombre" placeholder="Ej. Sucursal Sur"></div>
                <div class="form-group" style="grid-column: 1/-1; margin:0;"><label>Dirección y Teléfono</label><textarea id="nuevaSucursalInfo" rows="2" placeholder="Av. Sur #45, Tel: 555-9999"></textarea></div>
                <div style="grid-column: 1/-1;"><button class="btn-action" onclick="darDeAltaSucursal()">➕ Dar de Alta Sucursal</button></div>
            </div>
            <div class="dinamic-grid" id="sucursalesContainer"></div>
        </div>

        <!-- Vista Contacto -->
        <div id="vistaContacto" style="display: none;" class="content-area">
            <h2>📞 Canales y Mensajes de Contacto</h2>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Administra los buzones o canales de atención directa.</p>
            
            <div class="admin-box">
                <div class="form-group" style="margin:0;"><label>Canal / Departamento</label><input type="text" id="nuevoContactoCanal" placeholder="Ej. Soporte VIP"></div>
                <div class="form-group" style="grid-column: 1/-1; margin:0;"><label>Descripción / Detalle</label><textarea id="nuevoContactoInfo" rows="2" placeholder="Correo o teléfono exclusivo..."></textarea></div>
                <div style="grid-column: 1/-1;"><button class="btn-action" onclick="darDeAltaContacto()">➕ Dar de Alta Canal</button></div>
            </div>
            <div class="dinamic-grid" id="contactoContainer"></div>
        </div>

        <!-- Vista Cuestionario de Satisfacción -->
        <div id="vistaCuestionario" style="display: none;" class="content-area">
            <h2>📊 Cuestionario de Satisfacción (10 Preguntas)</h2>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Ayúdanos a evaluar tu experiencia respondiendo este breve cuestionario del 1 al 5 (1 = Malo, 5 = Excelente).</p>
            
            <div class="survey-container">
                <div class="survey-question">
                    <label>1. ¿Cómo califica la frescura y calidad de los alimentos?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p1" value="1"> 1</label>
                        <label><input type="radio" name="p1" value="2"> 2</label>
                        <label><input type="radio" name="p1" value="3"> 3</label>
                        <label><input type="radio" name="p1" value="4"> 4</label>
                        <label><input type="radio" name="p1" value="5" checked> 5</label>
                    </div>
                </div>
                <div class="survey-question">
                    <label>2. ¿Qué tan rápido fue el tiempo de atención y servicio en mesa?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p2" value="1"> 1</label>
                        <label><input type="radio" name="p2" value="2"> 2</label>
                        <label><input type="radio" name="p2" value="3"> 3</label>
                        <label><input type="radio" name="p2" value="4"> 4</label>
                        <label><input type="radio" name="p2" value="5" checked> 5</label>
                    </div>
                </div>
                <div class="survey-question">
                    <label>3. ¿Cómo evalúa la amabilidad y atención del personal?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p3" value="1"> 1</label>
                        <label><input type="radio" name="p3" value="2"> 2</label>
                        <label><input type="radio" name="p3" value="3"> 3</label>
                        <label><input type="radio" name="p3" value="4"> 4</label>
                        <label><input type="radio" name="p3" value="5" checked> 5</label>
                    </div>
                </div>
                <div class="survey-question">
                    <label>4. ¿Qué tan limpio y ordenado encontró el establecimiento y los sanitarios?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p4" value="1"> 1</label>
                        <label><input type="radio" name="p4" value="2"> 2</label>
                        <label><input type="radio" name="p4" value="3"> 3</label>
                        <label><input type="radio" name="p4" value="4"> 4</label>
                        <label><input type="radio" name="p4" value="5" checked> 5</label>
                    </div>
                </div>
                <div class="survey-question">
                    <label>5. ¿Cómo califica el ambiente general (música, iluminación, comodidad)?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p5" value="1"> 1</label>
                        <label><input type="radio" name="p5" value="2"> 2</label>
                        <label><input type="radio" name="p5" value="3"> 3</label>
                        <label><input type="radio" name="p5" value="4"> 4</label>
                        <label><input type="radio" name="p5" value="5" checked> 5</label>
                    </div>
                </div>
                <div class="survey-question">
                    <label>6. ¿Qué tan satisfecho está con la variedad y opciones del menú?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p6" value="1"> 1</label>
                        <label><input type="radio" name="p6" value="2"> 2</label>
                        <label><input type="radio" name="p6" value="3"> 3</label>
                        <label><input type="radio" name="p6" value="4"> 4</label>
                        <label><input type="radio" name="p6" value="5" checked> 5</label>
                    </div>
                </div>
                <div class="survey-question">
                    <label>7. ¿Cómo califica la relación calidad-precio de los platillos?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p7" value="1"> 1</label>
                        <label><input type="radio" name="p7" value="2"> 2</label>
                        <label><input type="radio" name="p7" value="3"> 3</label>
                        <label><input type="radio" name="p7" value="4"> 4</label>
                        <label><input type="radio" name="p7" value="5" checked> 5</label>
                    </div>
                </div>
                <div class="survey-question">
                    <label>8. ¿Qué tan fácil y cómodo fue el proceso de reserva de mesa?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p8" value="1"> 1</label>
                        <label><input type="radio" name="p8" value="2"> 2</label>
                        <label><input type="radio" name="p8" value="3"> 3</label>
                        <label><input type="radio" name="p8" value="4"> 4</label>
                        <label><input type="radio" name="p8" value="5" checked> 5</label>
                    </div>
                </div>
                <div class="survey-question">
                    <label>9. ¿Recomendaría Sabor Ofertin a sus familiares y amigos?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p9" value="1"> 1</label>
                        <label><input type="radio" name="p9" value="2"> 2</label>
                        <label><input type="radio" name="p9" value="3"> 3</label>
                        <label><input type="radio" name="p9" value="4"> 4</label>
                        <label><input type="radio" name="p9" value="5" checked> 5</label>
                    </div>
                </div>
                <div class="survey-question">
                    <label>10. ¿Cómo califica su experiencia general en Sabor Ofertin el día de hoy?</label>
                    <div class="survey-options">
                        <label><input type="radio" name="p10" value="1"> 1</label>
                        <label><input type="radio" name="p10" value="2"> 2</label>
                        <label><input type="radio" name="p10" value="3"> 3</label>
                        <label><input type="radio" name="p10" value="4"> 4</label>
                        <label><input type="radio" name="p10" value="5" checked> 5</label>
                    </div>
                </div>
                <button class="btn-action" onclick="alert('¡Muchas gracias por completar el cuestionario! Tus respuestas han sido registradas con éxito.')">Enviar Cuestionario</button>
            </div>
        </div>

        <!-- Vista Sustentabilidad -->
        <div id="vistaSustentabilidad" style="display: none;" class="content-area">
            <h2>🌱 Compromiso y Evidencia de Sustentabilidad</h2>
            <p style="color: var(--text-muted); margin-bottom: 24px;">En Sabor Ofertin creemos en la gastronomía responsable. Aquí presentamos acciones reales, verificables y medibles de nuestro impacto ambiental y social.</p>

            <div class="eco-banner">
                <h3>🌍 Gastronomía Consciente: Del Campo Local a tu Mesa</h3>
                <p>No hacemos promesas vacías: auditamos trimestralmente nuestra cadena de suministro, eliminamos plásticos de un solo uso y trabajamos directamente con productores agrícolas de la región para reducir nuestra huella de carbono.</p>
            </div>

            <!-- Indicadores Reales -->
            <div class="eco-metrics">
                <div class="eco-metric-card">
                    <span class="metric-val">100%</span>
                    <span class="metric-label">Empaques Compostables</span>
                    <small>Cero unicel y cero bolsas plásticas en pedidos para llevar.</small>
                </div>
                <div class="eco-metric-card">
                    <span class="metric-val">78%</span>
                    <span class="metric-label">Insumos Kilómetro Cero</span>
                    <small>Vegetales y lácteos adquiridos a menos de 60 km de distancia.</small>
                </div>
                <div class="eco-metric-card">
                    <span class="metric-val">320 L</span>
                    <span class="metric-label">Aceite Reciclado / Mes</span>
                    <small>Transformado en biodiésel certificado mediante recolección autorizada.</small>
                </div>
                <div class="eco-metric-card">
                    <span class="metric-val">-40%</span>
                    <span class="metric-label">Ahorro Hídrico en Cocina</span>
                    <small>Válvulas economizadoras y lavado por lotes de alta eficiencia.</small>
                </div>
            </div>

            <!-- Evidencia de Prácticas Ecológicas -->
            <div class="eco-evidence-grid">
                <div class="eco-card">
                    <span class="eco-badge">📦 Cero Plásticos</span>
                    <h4>Empaques de Bagazo de Caña y Fécula de Maíz</h4>
                    <p>Todos nuestros contenedores para llevar, cubiertos y popotes están fabricados con residuos agroindustriales 100% biodegradables que se reintegran a la tierra en menos de 90 días.</p>
                    <div class="eco-proof">✔ Evidencia: Certificación ASTM D6400 de compostabilidad en todos nuestros lotes de empaque.</div>
                </div>

                <div class="eco-card">
                    <span class="eco-badge">🚜 Comercio Justo Local</span>
                    <h4>Alianza con Productores de la Región</h4>
                    <p>Compramos directamente sin intermediarios a 14 familias agricultoras locales de Atlixco y Cholula, garantizando frescura diaria, precios justos para el campo y menor emisión por transporte.</p>
                    <div class="eco-proof">✔ Evidencia: Trazabilidad abierta de cosecha semanal exhibida en nuestra pizarra de sucursal.</div>
                </div>

                <div class="eco-card">
                    <span class="eco-badge">♻️ Economía Circular</span>
                    <h4>Recolección de Aceite Vegetal Usado</h4>
                    <p>Ninguna gota de aceite de cocina llega al drenaje. Almacenamos el aceite quemado en tambos sellados que son recolectados quincenalmente para producir biocombustible limpio.</p>
                    <div class="eco-proof">✔ Evidencia: Manifiesto ambiental folio #BIO-2026-894 emitido por planta recicladora autorizada.</div>
                </div>

                <div class="eco-card">
                    <span class="eco-badge">🌿 Cero Desperdicio</span>
                    <h4>Compostaje Orgánico y Donación Alimentaria</h4>
                    <p>Separamos el 100% de los residuos orgánicos de preparación para convertirlos en abono que regresa a los huertos de nuestros proveedores. Los excedentes aptos se donan diariamente a comedores comunitarios.</p>
                    <div class="eco-proof">✔ Evidencia: Más de 1,400 kg de composta entregada en el último semestre.</div>
                </div>
            </div>
        </div>

        <!-- Vista Sección y Multimedia con Menú Desplegable -->
        <div id="vistaSeccion" style="display: none;" class="content-area">
            <h2>📖 Sección y Multimedia</h2>
            <p style="color: var(--text-muted); margin-bottom: 20px;">Selecciona una opción en el menú desplegable para ver la Misión, la Visión o el contenido multimedia de Sabor Ofertín.</p>
            
            <div style="margin-bottom: 28px;">
                <label style="display: block; font-weight: 700; margin-bottom: 8px;">Selecciona una opción:</label>
                <select id="seccionDropdown" class="dropdown-filter" onchange="mostrarSeccionSeleccionada(this.value)" style="width: 100%; max-width: 450px;">
                    <option value="">-- Elige una sección --</option>
                    <option value="mision">🎯 Nuestra Misión</option>
                    <option value="vision">🔭 Nuestra Visión</option>
                    <option value="multimedia">🎬 Contenido Multimedia (Video y Audio)</option>
                </select>
            </div>

            <!-- Contenedor para Misión o Visión -->
            <div id="resultadoTextoSeccion" style="margin-top: 16px; padding: 24px; background: #fafbfc; border: 1px solid var(--border); border-radius: var(--radius-md); display: none;">
                <h3 id="tituloSeccionDinamica" style="margin: 0 0 12px 0; color: var(--accent); font-size: 1.25rem;"></h3>
                <p id="textoSeccionDinamica" style="margin: 0; color: var(--text-main); line-height: 1.7; white-space: pre-line;"></p>
            </div>

            <!-- Contenedor para Multimedia -->
            <div id="resultadoMultimedia" style="display: none; margin-top: 20px;">
                <div class="media-container">
                    <div class="media-card">
                        <h3>🎥 Video Institucional del Restaurante</h3>
                        <p style="color: var(--text-muted); font-size: 0.9rem; margin:0;">Conoce la historia y el proceso detrás de nuestros platillos.</p>
                        <video controls poster="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600">
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                            Tu navegador no soporta la reproducción de video.
                        </video>
                    </div>
                    <div class="media-card">
                        <h3>🎵 Audio Ambiental / Podcast Sabor Ofertin</h3>
                        <p style="color: var(--text-muted); font-size: 0.9rem; margin:0;">Escucha nuestra selección musical relajante para acompañar tu comida.</p>
                        <audio controls style="width: 100%; margin-top: 20px;">
                            <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
                            Tu navegador no soporta la reproducción de audio.
                        </audio>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PIE DE PÁGINA -->
<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h4>Sabor Ofertin</h4>
            <p>Ofreciendo la mejor experiencia culinaria desde 1998.</p>
        </div>
        <div class="footer-section">
            <h4>📍 Horarios</h4>
            <p>Lunes a Jueves: 1:00 PM - 10:00 PM<br>Viernes a Domingo: 1:00 PM - 11:30 PM</p>
        </div>
        <div class="footer-section">
            <h4>📞 Contacto</h4>
            <p>Teléfono: +52 (55) 1234-5678<br>Email: contacto@saborofertin.com</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 Sabor Ofertin. Todos los derechos reservados.</p>
    </div>
</footer>

<script>
    const menu = [
        { id: 1, nombre: "Ensalada César", precio: 85.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400" },
        { id: 2, nombre: "Ensalada Griega", precio: 90.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1540420773420-3366772f4999?w=400" },
        { id: 3, nombre: "Sopa de Pollo con Verduras", precio: 75.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1547592166-23ac45744acd?w=400" },
        { id: 4, nombre: "Crema de Champiñones", precio: 80.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1546549032-9571cd6b27df?w=400" },
        { id: 5, nombre: "Crema de Tomate", precio: 75.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1547592180-85f173990554?w=400" },
        { id: 6, nombre: "Consomé de Res", precio: 85.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1547592166-23ac45744acd?w=400" },
        { id: 7, nombre: "Sopa de Tortilla", precio: 85.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1547592166-23ac45744acd?w=400" },
        { id: 8, nombre: "Alitas de Pollo BBQ", precio: 120.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1527477396000-e27163b481c2?w=400" },
        { id: 9, nombre: "Alitas Picantes Buffalo", precio: 120.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400" },
        { id: 10, nombre: "Dedos de Queso Empanizados", precio: 95.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1531749668082-d499ec22d73c?w=400" },
        { id: 11, nombre: "Aros de Cebolla", precio: 70.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1639024471283-03518883512d?w=400" },
        { id: 12, nombre: "Nachos con Queso y Jalapeños", precio: 110.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1513456852971-30c0b8199d4d?w=400" },
        { id: 13, nombre: "Guacamole con Totopos", precio: 95.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=400" },
        { id: 14, nombre: "Brochetas de Queso Panela", precio: 100.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400" },
        { id: 15, nombre: "Tostadas de Tinga de Pollo", precio: 105.00, categoria: "Entradas", imagen: "https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=400" },
        { id: 16, nombre: "Hamburguesa Clásica con Queso", precio: 135.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400" },
        { id: 17, nombre: "Hamburguesa Doble Tocino", precio: 165.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=400" },
        { id: 18, nombre: "Hamburguesa Pollo Crispy", precio: 140.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1606755962773-d324e0a13086?w=400" },
        { id: 19, nombre: "Hamburguesa Vegetariana", precio: 130.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1525059696034-4967a8e1dca2?w=400" },
        { id: 20, nombre: "Hot Dog Tradicional", precio: 65.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1619740455993-9e612b1af08a?w=400" },
        { id: 21, nombre: "Hot Dog Tocino y Queso", precio: 80.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1619740455993-9e612b1af08a?w=400" },
        { id: 22, nombre: "Papas Fritas Clásicas", precio: 55.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400" },
        { id: 23, nombre: "Papas Gajo con Especias", precio: 70.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1585109649139-366815a0d713?w=400" },
        { id: 24, nombre: "Papas Locas Cheddar", precio: 95.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1585109649139-366815a0d713?w=400" },
        { id: 25, nombre: "Sándwich Club", precio: 125.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1528735602780-2552fd46c7af?w=400" },
        { id: 26, nombre: "Sándwich Pollo a la Plancha", precio: 115.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1528735602780-2552fd46c7af?w=400" },
        { id: 27, nombre: "Tacos al Pastor (4 pzas)", precio: 90.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?w=400" },
        { id: 28, nombre: "Tacos de Bistec", precio: 110.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=400" },
        { id: 29, nombre: "Tacos de Pescado Estilo Baja", precio: 120.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?w=400" },
        { id: 30, nombre: "Quesadillas de Queso (3 pzas)", precio: 85.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1618040996373-792f58b0d6e2?w=400" },
        { id: 31, nombre: "Burrito de Pollo o Res", precio: 130.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1626700051175-6818013e1d4f?w=400" },
        { id: 32, nombre: "Sincronizadas Jamón y Queso", precio: 85.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1626700051175-6818013e1d4f?w=400" },
        { id: 33, nombre: "Boneless Salsa Búfalo", precio: 130.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1608039829572-78524f79c4c7?w=400" },
        { id: 34, nombre: "Nuggets de Pollo con Papas", precio: 95.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1562967914-608f82629710?w=400" },
        { id: 35, nombre: "Tenders de Pollo Crujientes", precio: 110.00, categoria: "Comida Rápida", imagen: "https://images.unsplash.com/photo-1562967914-608f82629710?w=400" },
        { id: 36, nombre: "Pizza Pepperoni", precio: 180.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1628840042765-356cda07504e?w=400" },
        { id: 37, nombre: "Pizza Hawaiana", precio: 180.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=400" },
        { id: 38, nombre: "Pizza Napolitana", precio: 190.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1604382355076-af4b0eb60143?w=400" },
        { id: 39, nombre: "Pizza Cuatro Quesos", precio: 210.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1513104890138-7c749659a591?w=400" },
        { id: 40, nombre: "Pizza Vegetariana", precio: 185.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=400" },
        { id: 41, nombre: "Espagueti a la Boloñesa", precio: 145.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1621996346565-e3d5d6281298?w=400" },
        { id: 42, nombre: "Espagueti a la Carbonara", precio: 155.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1612874742237-6526221588e3?w=400" },
        { id: 43, nombre: "Lasaña de Carne", precio: 175.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1574894709920-11b28e7367e3?w=400" },
        { id: 44, nombre: "Lasaña Vegetariana", precio: 165.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1574894709920-11b28e7367e3?w=400" },
        { id: 45, nombre: "Fettuccine Alfredo con Pollo", precio: 170.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1645112411341-6c4fd023714a?w=400" },
        { id: 46, nombre: "Ñoquis al Pomodoro", precio: 150.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1551183053-bf91a1d81141?w=400" },
        { id: 47, nombre: "Ravioles Rellenos de Queso", precio: 160.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1587740898874-f1e133c1f688?w=400" },
        { id: 48, nombre: "Pollo a la Parmesana", precio: 190.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1604908176997-125f2596f3a8?w=400" },
        { id: 49, nombre: "Milanesa de Res con Guarnición", precio: 180.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1558030006-450675393462?w=400" },
        { id: 50, nombre: "Milanesa de Pollo Empanizada", precio: 165.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1604908176997-125f2596f3a8?w=400" },
        { id: 51, nombre: "Chuleta de Cerdo a la Plancha", precio: 170.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1432139555190-58524dae6a55?w=400" },
        { id: 52, nombre: "Costillas BBQ", precio: 220.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1544025162-d76694265947?w=400" },
        { id: 53, nombre: "Arroz con Pollo Peruano", precio: 150.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1516714435131-44d6b64dc6a2?w=400" },
        { id: 54, nombre: "Lomo Saltado", precio: 210.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1534422298391-e4f8c172dddb?w=400" },
        { id: 55, nombre: "Tacos Dorados de Pollo (Flautas)", precio: 110.00, categoria: "Italiana", imagen: "https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=400" },
        { id: 56, nombre: "Filete Mignon con Puré", precio: 280.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1558030006-450675393462?w=400" },
        { id: 57, nombre: "Corte Ribeye (300g)", precio: 350.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1603048588665-791ca8aea617?w=400" },
        { id: 58, nombre: "Corte New York (300g)", precio: 330.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1544025162-d76694265947?w=400" },
        { id: 59, nombre: "Arrachera Asada con Guacamole", precio: 260.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1544025162-d76694265947?w=400" },
        { id: 60, nombre: "Fajitas de Res", precio: 210.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1539136788836-5699e78bfc75?w=400" },
        { id: 61, nombre: "Fajitas de Pollo", precio: 185.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1539136788836-5699e78bfc75?w=400" },
        { id: 62, nombre: "Fajitas Mixtas", precio: 230.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1539136788836-5699e78bfc75?w=400" },
        { id: 63, nombre: "Camarones al Ajillo", precio: 240.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1565680314868-6f4b149b068d?w=400" },
        { id: 64, nombre: "Camarones Empanizados", precio: 230.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1565680314868-6f4b149b068d?w=400" },
        { id: 65, nombre: "Pescado a la Plancha con Arroz", precio: 195.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=400" },
        { id: 66, nombre: "Pescado Frito (Mojarra)", precio: 210.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1519708227418-c8fd9a32b7a2?w=400" },
        { id: 67, nombre: "Salmón a la Mantequilla", precio: 290.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1467003909585-2f8a72700288?w=400" },
        { id: 68, nombre: "Ceviche de Pescado", precio: 170.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1535400255456-984231445d2d?w=400" },
        { id: 69, nombre: "Coctel de Camarón", precio: 195.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1565680314868-6f4b149b068d?w=400" },
        { id: 70, nombre: "Pulpo a la Gallega", precio: 310.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1544025162-d76694265947?w=400" },
        { id: 71, nombre: "Tostadas de Ceviche", precio: 140.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1535400255456-984231445d2d?w=400" },
        { id: 72, nombre: "Arroz a la Marinera", precio: 220.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1516714435131-44d6b64dc6a2?w=400" },
        { id: 73, nombre: "Sopa de Mariscos", precio: 230.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1547592166-23ac45744acd?w=400" },
        { id: 74, nombre: "Brochetas de Camarón", precio: 250.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400" },
        { id: 75, nombre: "Pechuga Rellena de Espinaca", precio: 195.00, categoria: "Carnes", imagen: "https://images.unsplash.com/photo-1604908176997-125f2596f3a8?w=400" },
        { id: 76, nombre: "Pastel de Chocolate", precio: 85.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=400" },
        { id: 77, nombre: "Pay de Limón", precio: 70.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1519869325930-281384150729?w=400" },
        { id: 78, nombre: "Cheesecake Frutos Rojos", precio: 95.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1533134242443-d4fd215305ad?w=400" },
        { id: 79, nombre: "Flan Napolitano", precio: 70.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1527224857830-43a7acc85260?w=400" },
        { id: 80, nombre: "Tiramisú", precio: 100.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=400" },
        { id: 81, nombre: "Tres Leches", precio: 80.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?w=400" },
        { id: 82, nombre: "Brownie con Helado", precio: 95.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=400" },
        { id: 83, nombre: "Waffle con Chocolate y Fresa", precio: 105.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1562376552-0d160a2f238d?w=400" },
        { id: 84, nombre: "Crepas Dulces Cajeta/Nutella", precio: 95.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1519676867240-f03562e64548?w=400" },
        { id: 85, nombre: "Helado de Vainilla", precio: 55.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1560008511-11c63416e52d?w=400" },
        { id: 86, nombre: "Helado de Chocolate", precio: 55.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1560008511-11c63416e52d?w=400" },
        { id: 87, nombre: "Helado de Fresa", precio: 55.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1560008511-11c63416e52d?w=400" },
        { id: 88, nombre: "Banana Split", precio: 110.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1560008511-11c63416e52d?w=400" },
        { id: 89, nombre: "Churros con Chocolate", precio: 75.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1624371414361-e670fff49bc8?w=400" },
        { id: 90, nombre: "Gelatina de Mosaico", precio: 50.00, categoria: "Postres", imagen: "https://images.unsplash.com/photo-1527224857830-43a7acc85260?w=400" },
        { id: 91, nombre: "Agua de Horchata", precio: 45.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1541658016709-82535e94bc69?w=400" },
        { id: 92, nombre: "Agua de Jamaica", precio: 45.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400" },
        { id: 93, nombre: "Agua de Limón con Chía", precio: 45.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=400" },
        { id: 94, nombre: "Refresco de Cola (Lata)", precio: 40.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1622483767028-3f66f32aef97?w=400" },
        { id: 95, nombre: "Refresco de Sabor", precio: 40.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1622483767028-3f66f32aef97?w=400" },
        { id: 96, nombre: "Iced Tea", precio: 50.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400" },
        { id: 97, nombre: "Limonada Mineral", precio: 55.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=400" },
        { id: 98, nombre: "Naranjada Natural", precio: 55.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1613478223719-2ab802602423?w=400" },
        { id: 99, nombre: "Malteada de Chocolate", precio: 85.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=400" },
        { id: 100, nombre: "Café Americano / Espresso", precio: 45.00, categoria: "Bebidas", imagen: "https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=400" }
    ];

    let categoriaActiva = "Todos";
    let carrito = {}; 
    let pedidosCocina = [];

    let listaPromociones = [
        { id: 1, titulo: "Combo Familiar Sabor Ofertin", tag: "¡Más Vendido!", precio: 29.99, imagen: "https://images.unsplash.com/photo-1513104890138-7c749659a591?w=500", desc: "Incluye 2 Pizzas Napolitanas grandes, 1 Espagueti a la Boloñesa y 1 Refresco familiar de 2L." },
        { id: 2, titulo: "Martes de Alitas 2x1", tag: "Martes 2x1", precio: 120.00, imagen: "https://images.unsplash.com/photo-1527477396000-e27163b481c2?w=500", desc: "Disfruta al 2x1 en todas nuestras órdenes de alitas Buffalo y BBQ." }
    ];

    let listaEspeciales = [
        { id: 1, nombre: "Corte Tomahawk Reserva Especial", precio: 480.00, imagen: "https://images.unsplash.com/photo-1558030006-450675393462?w=500", desc: "Un corte prémium de 1.2 kg madurado en seco." }
    ];

    let listaChefs = [
        { id: 1, nombre: "Chef Marco Antonio", bio: "Especialista en cocina internacional y alta cocina italiana con más de 20 años de trayectoria." },
        { id: 2, nombre: "Chef Sofía Valdés", bio: "Encargada de la repostería fina y la innovación de nuevos sabores dulces desde el año 2010." }
    ];

    let listaOpiniones = [
        { id: 1, cliente: "Andrea Gómez", comentario: "⭐⭐⭐⭐⭐ El mejor lugar para comer en familia. La comida siempre está fresca." },
        { id: 2, cliente: "Luis Fernando R.", comentario: "⭐⭐⭐⭐⭐ Las pastas y las pizzas tienen un sabor auténtico increíble. ¡Totalmente recomendado!" }
    ];

    let listaSucursales = [
        { id: 1, nombre: "Sucursal Centro Histórico", info: "Av. Principal #123, Col. Centro | Tel: 555-0192" },
        { id: 2, nombre: "Sucursal Norte (Plaza Mayor)", info: "Blvd. Norte #4500, Local 12 | Tel: 555-8392" }
    ];

    let listaContacto = [
        { id: 1, canal: "Atención General", info: "Teléfono: +52 (55) 1234-5678" },
        { id: 2, canal: "Correo Electrónico", info: "contacto@saborofertin.com" }
    ];

    let mesasRestaurante = [
        { id: "Mesa 1", tipo: "Ventana (2 Pers.)", estado: "disponible" },
        { id: "Mesa 2", tipo: "Centro (4 Pers.)", estado: "ocupada" },
        { id: "Mesa 3", tipo: "Centro (4 Pers.)", estado: "disponible" },
        { id: "Mesa 4", tipo: "Terraza (6 Pers.)", estado: "disponible" },
        { id: "Mesa 5", tipo: "Terraza (6 Pers.)", estado: "ocupada" },
        { id: "Mesa VIP", tipo: "Zona VIP (10 Pers.)", estado: "disponible" }
    ];
    let mesaSeleccionadaParaReserva = null;

    function cambiarVista(vista) {
        const vistas = ['menu', 'cocina', 'promos', 'reservas', 'especiales', 'chefs', 'opiniones', 'sucursales', 'contacto', 'cuestionario', 'sustentabilidad', 'seccion'];
        vistas.forEach(v => {
            const el = document.getElementById('vista' + v.charAt(0).toUpperCase() + v.slice(1));
            if (el) el.style.display = (v === vista) ? (v === 'menu' ? 'flex' : 'block') : 'none';
        });
        
        const botones = document.querySelectorAll('.tab-btn');
        botones.forEach((btn, idx) => {
            btn.classList.toggle('active', vistas[idx] === vista);
        });

        if (vista === 'cocina') renderCocina();
        else if (vista === 'reservas') renderMapaMesas();
        else if (vista === 'promos') renderPromociones();
        else if (vista === 'especiales') renderEspeciales();
        else if (vista === 'chefs') renderChefs();
        else if (vista === 'opiniones') renderOpiniones();
        else if (vista === 'sucursales') renderSucursales();
        else if (vista === 'contacto') renderContacto();
    }

    function renderMenu() {
        const grid = document.getElementById('menuGrid');
        const busqueda = document.getElementById('searchInput').value.toLowerCase();
        grid.innerHTML = '';

        const filtrados = menu.filter(item => {
            const coincideCategoria = categoriaActiva === "Todos" || item.categoria === categoriaActiva;
            const coincideBusqueda = item.nombre.toLowerCase().includes(busqueda);
            return coincideCategoria && coincideBusqueda;
        });

        if (filtrados.length === 0) {
            grid.innerHTML = `<p class="empty-state" style="grid-column: 1/-1;">No se encontraron platillos.</p>`;
            return;
        }

        filtrados.forEach(item => {
            const card = document.createElement('div');
            card.className = 'menu-card';
            card.onclick = () => agregarAlCarrito(item.id, item.nombre, item.precio);
            card.innerHTML = `
                <div class="add-badge">+</div>
                <img src="${item.imagen}" alt="${item.nombre}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400'">
                <div class="menu-card-body">
                    <div>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">${item.categoria}</span>
                        <h4>${item.nombre}</h4>
                    </div>
                    <div class="price">$${item.precio.toFixed(2)}</div>
                </div>
            `;
            grid.appendChild(card);
        });
    }

    function filtrarPorDropdown(cat) {
        categoriaActiva = cat;
        document.getElementById('categoriaDropdown').value = cat;
        renderMenu();
    }

    function mostrarSeccionSeleccionada(val) {
        const boxTexto = document.getElementById('resultadoTextoSeccion');
        const titulo = document.getElementById('tituloSeccionDinamica');
        const texto = document.getElementById('textoSeccionDinamica');
        const boxMedia = document.getElementById('resultadoMultimedia');

        if (!val) {
            boxTexto.style.display = 'none';
            boxMedia.style.display = 'none';
            return;
        }

        if (val === 'mision') {
            boxTexto.style.display = 'block';
            boxMedia.style.display = 'none';
            titulo.innerText = "🎯 Nuestra Misión";
            texto.innerText = "Brindar una experiencia gastronómica excepcional que fusione la creatividad y las técnicas culinarias contemporáneas con ingredientes frescos y precios accesibles. Nos dedicamos a ofrecer platillos de alta calidad y sabor casero que conquisten el paladar de nuestros clientes, demostrando que la buena cocina y el talento joven están al alcance de todos.";
        } else if (val === 'vision') {
            boxTexto.style.display = 'block';
            boxMedia.style.display = 'none';
            titulo.innerText = "🔭 Nuestra Visión";
            texto.innerText = "Consolidarnos como el restaurante referente de la zona por nuestra innovadora propuesta culinaria y nuestra excelente relación calidad-precio. Aspiramos a crecer de manera sostenible, convirtiendo a Sabor Ofertín en una marca reconocida por su calidez, originalidad y compromiso con la satisfacción de cada comensal, impulsando al mismo tiempo el desarrollo del talento gastronómico local.";
        } else if (val === 'multimedia') {
            boxTexto.style.display = 'none';
            boxMedia.style.display = 'block';
        }
    }

    function agregarAlCarrito(id, nombre, precio) {
        const key = id ? 'id_' + id : 'item_' + nombre;
        if (!carrito[key]) {
            carrito[key] = { nombre: nombre, precio: precio, cantidad: 0 };
        }
        carrito[key].cantidad += 1;
        actualizarPanelPOS();
    }

    function actualizarCantidadPOS(key, delta) {
        if (carrito[key]) {
            carrito[key].cantidad += delta;
            if (carrito[key].cantidad <= 0) delete carrito[key];
        }
        actualizarPanelPOS();
    }

    function actualizarPanelPOS() {
        const container = document.getElementById('posItemsList');
        const keys = Object.keys(carrito);

        if (keys.length === 0) {
            container.innerHTML = `<p class="empty-state" style="margin: 20px 0; font-size: 0.9rem;">No hay platillos seleccionados.</p>`;
            document.getElementById('posTotal').innerText = '$0.00';
            return;
        }

        let itemsHTML = '';
        let total = 0;

        keys.forEach(key => {
            const item = carrito[key];
            const sub = item.precio * item.cantidad;
            total += sub;

            itemsHTML += `
                <div class="pos-item-row">
                    <div>
                        <strong>${item.nombre}</strong><br>
                        <small style="color: var(--text-muted);">$${item.precio.toFixed(2)} c/u · $${sub.toFixed(2)}</small>
                    </div>
                    <div class="pos-controls">
                        <button onclick="actualizarCantidadPOS('${key}', -1)">-</button>
                        <span>${item.cantidad}</span>
                        <button onclick="actualizarCantidadPOS('${key}', 1)">+</button>
                    </div>
                </div>
            `;
        });

        container.innerHTML = itemsHTML;
        document.getElementById('posTotal').innerText = `$${total.toFixed(2)}`;
    }

    function actualizarContadorCocina() {
        document.getElementById('kitchenCount').innerText = pedidosCocina.length;
    }

    function confirmarPagoYEnviar() {
        const keys = Object.keys(carrito);
        if (keys.length === 0) {
            alert("Selecciona al menos un platillo o promoción para realizar el pedido.");
            return;
        }

        const mesa = document.getElementById('mesaPedido').value;
        const metodoPago = document.getElementById('metodoPago').value;
        
        let total = 0;
        let itemsPedido = keys.map(key => {
            const item = carrito[key];
            total += item.precio * item.cantidad;
            return { nombre: item.nombre, cantidad: item.cantidad };
        });

        const nuevoPedido = {
            id: Date.now().toString().slice(-4),
            mesa: mesa,
            items: itemsPedido,
            total: total,
            metodoPago: metodoPago,
            estado: 'En Proceso'
        };

        pedidosCocina.unshift(nuevoPedido);
        actualizarContadorCocina();

        alert(`¡Pago procesado con éxito (${metodoPago})! Pedido #${nuevoPedido.id} enviado a cocina.`);
        carrito = {};
        actualizarPanelPOS();
        cambiarVista('cocina');
    }

    function renderPromociones() {
        const container = document.getElementById('promosContainer');
        container.innerHTML = '';
        if (listaPromociones.length === 0) {
            container.innerHTML = `<p class="empty-state" style="grid-column: 1/-1;">No hay promociones disponibles.</p>`;
            return;
        }
        listaPromociones.forEach(promo => {
            const card = document.createElement('div');
            card.className = 'promo-card';
            card.innerHTML = `
                <div class="promo-tag">${promo.tag}</div>
                <img src="${promo.imagen}" alt="${promo.titulo}" class="promo-header-img" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500'">
                <div class="promo-body">
                    <div><h3>${promo.titulo}</h3><p>${promo.desc}</p></div>
                    <div class="promo-footer">
                        <span class="promo-price">$${promo.precio.toFixed(2)}</span>
                        <div class="promo-actions">
                            <button class="btn-claim-promo" onclick="agregarAlCarrito(null, '${promo.titulo}', ${promo.precio})">Ordenar</button>
                            <button class="btn-delete" onclick="darDeBajaPromocion(${promo.id})">🗑️ Eliminar</button>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });
    }

    function darDeAltaPromocion() {
        const titulo = document.getElementById('nuevaPromoTitulo').value;
        const tag = document.getElementById('nuevaPromoTag').value || 'Especial';
        const precio = parseFloat(document.getElementById('nuevaPromoPrecio').value);
        let imagen = document.getElementById('nuevaPromoImg').value || "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500";
        const desc = document.getElementById('nuevaPromoDesc').value;

        if (!titulo || isNaN(precio) || !desc) {
            alert("Completa los campos obligatorios de la promoción.");
            return;
        }
        listaPromociones.unshift({ id: Date.now(), titulo, tag, precio, imagen, desc });
        renderPromociones();
        document.getElementById('nuevaPromoTitulo').value = '';
        document.getElementById('nuevaPromoTag').value = '';
        document.getElementById('nuevaPromoPrecio').value = '';
        document.getElementById('nuevaPromoImg').value = '';
        document.getElementById('nuevaPromoDesc').value = '';
    }

    function darDeBajaPromocion(id) {
        listaPromociones = listaPromociones.filter(p => p.id !== id);
        renderPromociones();
    }

    function renderEspeciales() {
        const container = document.getElementById('especialesContainer');
        container.innerHTML = '';
        if (listaEspeciales.length === 0) {
            container.innerHTML = `<p class="empty-state" style="grid-column: 1/-1;">No hay platillos especiales.</p>`;
            return;
        }
        listaEspeciales.forEach(esp => {
            const card = document.createElement('div');
            card.className = 'promo-card';
            card.innerHTML = `
                <div class="promo-tag">⭐ Chef</div>
                <img src="${esp.imagen}" alt="${esp.nombre}" class="promo-header-img" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500'">
                <div class="promo-body">
                    <div><h3>${esp.nombre}</h3><p>${esp.desc}</p></div>
                    <div class="promo-footer">
                        <span class="promo-price">$${esp.precio.toFixed(2)}</span>
                        <div class="promo-actions">
                            <button class="btn-claim-promo" onclick="agregarAlCarrito(null, '${esp.nombre}', ${esp.precio})">Ordenar</button>
                            <button class="btn-delete" onclick="darDeBajaEspecial(${esp.id})">🗑️ Eliminar</button>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(card);
        });
    }

    function darDeAltaEspecial() {
        const nombre = document.getElementById('nuevoEspecialNombre').value;
        const precio = parseFloat(document.getElementById('nuevoEspecialPrecio').value);
        let imagen = document.getElementById('nuevoEspecialImg').value || "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500";
        const desc = document.getElementById('nuevoEspecialDesc').value;

        if (!nombre || isNaN(precio) || !desc) {
            alert("Completa los campos obligatorios del especial.");
            return;
        }
        listaEspeciales.unshift({ id: Date.now(), nombre, precio, imagen, desc });
        renderEspeciales();
        document.getElementById('nuevoEspecialNombre').value = '';
        document.getElementById('nuevoEspecialPrecio').value = '';
        document.getElementById('nuevoEspecialImg').value = '';
        document.getElementById('nuevoEspecialDesc').value = '';
    }

    function darDeBajaEspecial(id) {
        listaEspeciales = listaEspeciales.filter(e => e.id !== id);
        renderEspeciales();
    }

    function renderChefs() {
        const container = document.getElementById('chefsContainer');
        container.innerHTML = '';
        if (listaChefs.length === 0) {
            container.innerHTML = `<p class="empty-state" style="grid-column: 1/-1;">No hay chefs registrados.</p>`;
            return;
        }
        listaChefs.forEach((chef, index) => {
            const card = document.createElement('div');
            card.className = 'admin-card';
            card.innerHTML = `
                <button class="btn-delete-card" onclick="darDeBajaChef(${index})">🗑️ Eliminar</button>
                <h3>${chef.nombre}</h3>
                <p>${chef.bio}</p>
            `;
            container.appendChild(card);
        });
    }

    function darDeAltaChef() {
        const nombre = document.getElementById('nuevoChefNombre').value.trim();
        const bio = document.getElementById('nuevoChefBio').value.trim();
        if (!nombre || !bio) {
            alert("Por favor completa el nombre y la biografía del chef.");
            return;
        }
        listaChefs.push({ nombre, bio });
        renderChefs();
        document.getElementById('nuevoChefNombre').value = '';
        document.getElementById('nuevoChefBio').value = '';
    }

    function darDeBajaChef(index) {
        listaChefs.splice(index, 1);
        renderChefs();
    }

    function renderOpiniones() {
        const container = document.getElementById('opinionesContainer');
        container.innerHTML = '';
        if (listaOpiniones.length === 0) {
            container.innerHTML = `<p class="empty-state" style="grid-column: 1/-1;">No hay opiniones registradas.</p>`;
            return;
        }
        listaOpiniones.forEach((op, index) => {
            const card = document.createElement('div');
            card.className = 'admin-card';
            card.innerHTML = `
                <button class="btn-delete-card" onclick="darDeBajaOpinion(${index})">🗑️ Eliminar</button>
                <p>${op.comentario}</p>
                <small style="color: var(--accent); font-weight: bold; margin-top: auto;">- ${op.cliente}</small>
            `;
            container.appendChild(card);
        });
    }

    function darDeAltaOpinion() {
        const cliente = document.getElementById('nuevaOpCliente').value.trim();
        const comentario = document.getElementById('nuevaOpComentario').value.trim();
        if (!cliente || !comentario) {
            alert("Por favor completa el autor y el comentario.");
            return;
        }
        listaOpiniones.push({ cliente, comentario });
        renderOpiniones();
        document.getElementById('nuevaOpCliente').value = '';
        document.getElementById('nuevaOpComentario').value = '';
    }

    function darDeBajaOpinion(index) {
        listaOpiniones.splice(index, 1);
        renderOpiniones();
    }

    function renderSucursales() {
        const container = document.getElementById('sucursalesContainer');
        container.innerHTML = '';
        if (listaSucursales.length === 0) {
            container.innerHTML = `<p class="empty-state" style="grid-column: 1/-1;">No hay sucursales registradas.</p>`;
            return;
        }
        listaSucursales.forEach((suc, index) => {
            const card = document.createElement('div');
            card.className = 'admin-card';
            card.innerHTML = `
                <button class="btn-delete-card" onclick="darDeBajaSucursal(${index})">🗑️ Eliminar</button>
                <h3>${suc.nombre}</h3>
                <p>${suc.info}</p>
            `;
            container.appendChild(card);
        });
    }

    function darDeAltaSucursal() {
        const nombre = document.getElementById('nuevaSucursalNombre').value.trim();
        const info = document.getElementById('nuevaSucursalInfo').value.trim();
        if (!nombre || !info) {
            alert("Por favor completa el nombre y la información de la sucursal.");
            return;
        }
        listaSucursales.push({ nombre, info });
        renderSucursales();
        document.getElementById('nuevaSucursalNombre').value = '';
        document.getElementById('nuevaSucursalInfo').value = '';
    }

    function darDeBajaSucursal(index) {
        listaSucursales.splice(index, 1);
        renderSucursales();
    }

    function renderContacto() {
        const container = document.getElementById('contactoContainer');
        container.innerHTML = '';
        if (listaContacto.length === 0) {
            container.innerHTML = `<p class="empty-state" style="grid-column: 1/-1;">No hay canales de contacto registrados.</p>`;
            return;
        }
        listaContacto.forEach((con, index) => {
            const card = document.createElement('div');
            card.className = 'admin-card';
            card.innerHTML = `
                <button class="btn-delete-card" onclick="darDeBajaContacto(${index})">🗑️ Eliminar</button>
                <h3>${con.canal}</h3>
                <p>${con.info}</p>
            `;
            container.appendChild(card);
        });
    }

    function darDeAltaContacto() {
        const canal = document.getElementById('nuevoContactoCanal').value.trim();
        const info = document.getElementById('nuevoContactoInfo').value.trim();
        if (!canal || !info) {
            alert("Por favor completa el canal y la información.");
            return;
        }
        listaContacto.push({ canal, info });
        renderContacto();
        document.getElementById('nuevoContactoCanal').value = '';
        document.getElementById('nuevoContactoInfo').value = '';
    }

    function darDeBajaContacto(index) {
        listaContacto.splice(index, 1);
        renderContacto();
    }

    function renderMapaMesas() {
        const grid = document.getElementById('mapaMesasGrid');
        grid.innerHTML = '';
        if (mesasRestaurante.length === 0) {
            grid.innerHTML = `<p class="empty-state" style="grid-column: 1/-1;">No hay mesas registradas.</p>`;
            return;
        }
        mesasRestaurante.forEach((mesa, index) => {
            const div = document.createElement('div');
            let claseEstado = mesa.estado;
            if (mesa.id === mesaSeleccionadaParaReserva) claseEstado = 'seleccionada';

            div.className = `mesa-seat ${claseEstado}`;
            div.onclick = (e) => {
                if (e.target.classList.contains('btn-delete-mesa')) return;
                if (mesa.estado === 'ocupada') {
                    mesa.estado = 'disponible';
                    if (mesaSeleccionadaParaReserva === mesa.id) {
                        mesaSeleccionadaParaReserva = null;
                        document.getElementById('resMesaSeleccionada').value = '';
                    }
                    renderMapaMesas();
                } else {
                    mesaSeleccionadaParaReserva = mesa.id;
                    document.getElementById('resMesaSeleccionada').value = `${mesa.id} (${mesa.tipo})`;
                    renderMapaMesas();
                }
            };
            div.innerHTML = `
                <button class="btn-delete-mesa" onclick="darDeBajaMesa(${index})">×</button>
                <div class="mesa-icon">🍽️</div>
                <div class="mesa-nombre">${mesa.id}</div>
                <div class="mesa-estado">${mesa.id === mesaSeleccionadaParaReserva ? 'Seleccionada' : (mesa.estado === 'disponible' ? 'Disponible' : 'Reservada (Clic liberar)')}</div>
                <small style="font-size: 0.7rem; color: var(--text-muted);">${mesa.tipo}</small>
            `;
            grid.appendChild(div);
        });
    }

    function darDeAltaMesa() {
        const nombre = document.getElementById('nuevaMesaNombre').value.trim();
        const tipo = document.getElementById('nuevaMesaTipo').value.trim();
        const estado = document.getElementById('nuevaMesaEstado').value;
        if (!nombre || !tipo) {
            alert("Completa el nombre y tipo de mesa.");
            return;
        }
        mesasRestaurante.push({ id: nombre, tipo, estado });
        renderMapaMesas();
        document.getElementById('nuevaMesaNombre').value = '';
        document.getElementById('nuevaMesaTipo').value = '';
    }

    function darDeBajaMesa(index) {
        if (confirm(`¿Eliminar la ${mesasRestaurante[index].id}?`)) {
            mesasRestaurante.splice(index, 1);
            renderMapaMesas();
        }
    }

    function confirmarReservaMesa() {
        const nombre = document.getElementById('resNombre').value;
        if (!nombre || !mesaSeleccionadaParaReserva) {
            alert("Ingresa tu nombre y selecciona una mesa disponible.");
            return;
        }
        const mesaObj = mesasRestaurante.find(m => m.id === mesaSeleccionadaParaReserva);
        if (mesaObj) mesaObj.estado = 'ocupada';
        alert(`¡Reserva confirmada para ${nombre} en la ${mesaSeleccionadaParaReserva}!`);
        document.getElementById('resNombre').value = '';
        document.getElementById('resMesaSeleccionada').value = '';
        mesaSeleccionadaParaReserva = null;
        renderMapaMesas();
    }

    function renderCocina() {
        const container = document.getElementById('kitchenContent');
        if (pedidosCocina.length === 0) {
            container.innerHTML = `<p class="empty-state">No hay pedidos pendientes.</p>`;
            return;
        }
        let html = '<div class="kitchen-grid">';
        pedidosCocina.forEach((pedido, index) => {
            const esListo = pedido.estado === 'Listo';
            html += `
                <div class="kitchen-card ${esListo ? 'listo' : ''}">
                    <div class="kitchen-header">
                        <strong>Pedido #${pedido.id} - ${pedido.mesa}</strong>
                        <span class="status-badge ${esListo ? 'status-listo' : 'status-proceso'}">${pedido.estado}</span>
                    </div>
                    <div>
                        <p style="margin: 0 0 8px 0; font-size: 0.85rem; color: var(--text-muted);">Pago: <strong>${pedido.metodoPago}</strong> | Total: <strong>$${pedido.total.toFixed(2)}</strong></p>
                        <ul style="margin: 0; padding-left: 18px; font-size: 0.95rem;">
                            ${pedido.items.map(i => `<li>${i.cantidad}x ${i.nombre}</li>`).join('')}
                        </ul>
                    </div>
                    <div style="margin-top: auto; display: flex; justify-content: flex-end;">
                        <button class="btn-status" onclick="alternarEstadoCocina(${index})">${esListo ? '🔄 Marcar en Proceso' : '✅ Marcar como Listo'}</button>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        container.innerHTML = html;
    }

    function alternarEstadoCocina(index) {
        pedidosCocina[index].estado = pedidosCocina[index].estado === 'En Proceso' ? 'Listo' : 'En Proceso';
        renderCocina();
    }

    renderMenu();
</script>

</body>
</html>
