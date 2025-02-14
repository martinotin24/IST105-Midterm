#!/usr/bin/python3

import sys
import urllib.parse

print("Content-Type: text/html\n")

# Leer datos desde la entrada estándar (STDIN)
input_data = sys.stdin.read()
form = urllib.parse.parse_qs(input_data)

# Depuración: imprimir todo lo recibido
print("<h3>DEBUG INFO:</h3>")
print("<pre>")
print(form)
print("</pre>")

# Verificar si los datos fueron recibidos
if "num1" not in form or "num2" not in form or "operation" not in form:
    print("<h2>Error: No se recibieron todos los datos.</h2>")
    exit()

# Convertir valores a números
try:
    num1 = float(form["num1"][0])
    num2 = float(form["num2"][0])
    operation = form["operation"][0]
except ValueError:
    print("<h2>Error: Entrada no válida.</h2>")
    exit()

# Realizar la operación matemática
result = "Invalid operation"

if operation == "add":
    result = num1 + num2
elif operation == "sub":
    result = num1 - num2
elif operation == "mul":
    result = num1 * num2
elif operation == "div":
    if num2 != 0:
        result = num1 / num2
    else:
        result = "Error: Division by zero is not allowed"

# Aplicar condiciones adicionales
if isinstance(result, (int, float)):
    if result > 100:
        result *= 2
    elif result < 0:
        result += 50

print(f"<h2>Result: {result}</h2>")
