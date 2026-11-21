<?php
function ui_escape($value): string
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}
function ui_header(string $title, string $active): void
{ ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo ui_escape($title); ?></title>
        <link rel="stylesheet" href="../public/css/style.css">
        <script src="../public/js/interfaz.js" defer></script>
    </head>

    <body>
        <header>
            <h1><?php echo ui_escape($title); ?></h1>
        </header>
        <main class="container">
            <nav aria-label="Navegación principal">
                <?php foreach (['inicio.php' => 'Inicio', 'sprints.php' => 'Sprints', 'historias.php' => 'Historias de Usuario', 'informe.php' => 'Informes'] as $url => $label): ?>
                    <?php if ($url !== $active): ?><a href="<?php echo $url; ?>"><?php echo $label; ?></a><?php endif; ?>
                <?php endforeach; ?></nav>
            <section>
                <?php if (!empty($_GET['error'])): ?><p class="msg error" role="alert">Error al guardar los datos.</p><?php endif; ?>
                <?php if (!empty($_GET['exito'])): ?><p class="msg success" role="status">Operación realizada correctamente.</p><?php endif; ?>
            <?php }

        { ?></section>
        </main>
    </body>

    </html><?php }
