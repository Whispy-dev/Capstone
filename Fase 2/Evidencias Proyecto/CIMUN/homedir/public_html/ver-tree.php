<?php

// Establece el directorio raíz del proyecto. '.' significa el directorio actual.
$rootDir = '.';

// Título de la página
echo "<h1><pre>🌳 Estructura de Archivos del Proyecto</pre></h1>";
echo "<hr>";
echo "<pre>";

// Llama a la función para empezar a listar los directorios y archivos
generarArbolDirectorios($rootDir);

echo "</pre>";
echo "<hr>";
echo "<p><strong>Nota de seguridad:</strong> Elimina este archivo (<code>ver_archivos.php</code>) cuando termines de usarlo para no exponer la estructura de tu proyecto.</p>";


/**
 * Función recursiva para generar y mostrar el árbol de directorios y archivos.
 *
 * @param string $directorio El directorio a escanear.
 * @param string $prefijo El prefijo visual para la estructura de árbol.
 */
function generarArbolDirectorios(string $directorio, string $prefijo = '')
{
    // Escanea el directorio y obtén los archivos y carpetas, eliminando '.' y '..'
    $elementos = array_diff(scandir($directorio), ['.', '..']);

    // Define carpetas y archivos a ignorar para una vista más limpia
    $ignorar = [
        'vendor',
        'node_modules',
        'storage',
        '.git',
        '.env',
        'ver_archivos.php' // Ignorar este mismo archivo
    ];

    // Filtra los elementos a ignorar
    $elementos = array_diff($elementos, $ignorar);

    // Cuenta el total de elementos a procesar
    $totalElementos = count($elementos);
    $contador = 0;

    foreach ($elementos as $elemento) {
        $contador++;
        $esElUltimo = ($contador === $totalElementos);
        $caminoCompleto = $directorio . '/' . $elemento;

        // Imprime el conector del árbol
        echo $prefijo . ($esElUltimo ? '└── ' : '├── ');

        if (is_dir($caminoCompleto)) {
            // Si es un directorio, lo muestra con un ícono y llama a la función de nuevo
            echo "📁 <strong>" . $elemento . "</strong><br>";
            generarArbolDirectorios($caminoCompleto, $prefijo . ($esElUltimo ? '    ' : '│   '));
        } else {
            // Si es un archivo, lo muestra
            echo "📄 " . $elemento . "<br>";
        }
    }
}

?>