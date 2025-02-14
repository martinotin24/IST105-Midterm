<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $operation = $_POST["operation"];

    // Construir los datos a enviar
    $data = http_build_query([
        "num1" => $num1,
        "num2" => $num2,
        "operation" => $operation
    ]);

    // Ejecutar Python con los datos por STDIN
    $command = "python3 /var/www/html/math_operations.py";
    $descriptorspec = [
        0 => ["pipe", "r"],  // Entrada estándar (STDIN)
        1 => ["pipe", "w"],  // Salida estándar (STDOUT)
        2 => ["pipe", "w"]   // Error estándar (STDERR)
    ];

    $process = proc_open($command, $descriptorspec, $pipes);

    if (is_resource($process)) {
        fwrite($pipes[0], $data);
        fclose($pipes[0]);

        $output = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        $error_output = stream_get_contents($pipes[2]);
        fclose($pipes[2]);

        proc_close($process);

        if (!empty($error_output)) {
            echo "<h2>Error en el script de Python:</h2><pre>$error_output</pre>";
        } else {
            echo $output;
        }
    } else {
        echo "<h2>Error: No se pudo ejecutar el script de Python.</h2>";
    }
} else {
    echo "<h2>Error: No se enviaron datos.</h2>";
}
?>
