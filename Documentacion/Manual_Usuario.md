# Manual de Usuario - Golampi Interpreter
## 1- Introducción
Golampi Compiler es una herramienta que permite escribir, compilar y ejecutar programas en el lenguaje Golampi (inspirado en Go), generando código ensamblador ARM64 que puede ser ejecutado en arquitecturas ARM64 (nativa o mediante emulación con QEMU).

### 1.1- **¿Qué es Golampi?**
Golampi es un lenguaje de interprete académico creado como parte del curso de Organización de Lenguajes y Compiladores 2. Su sintaxis y semántica están inspiradas en Golang, pero con un alcance reducido que facilita el aprendizaje práctico de los conceptos fundamentales de los  intérpretes.

El lenguaje Golampi soporta características como:
- Tipos estáticos: int32, float32, bool, rune y string
- Variables, constantes y declaración corta ( **:=** )
- Arreglos unidimensionales y multidimensionales
- Operadores aritméticos, relacionales y lógicos
- Estructuras de control: if, switch y for
- Sentencias de transferencia: break, continue y return
- Funciones con retorno único o múltiple
- Paso de parámetros por valor y por referencia (punteros)
- Funciones embebidas: fmt.Println, len, now, substr, typeOf
- Función main como punto de entrada del programa

### 1.2- ¿Qué es el Intérprete Golampi?
El Intérprete Golampi es una aplicación web que permite a los usuarios escribir, editar y ejecutar código escrito en el lenguaje Golampi. El intérprete realiza las siguientes fases de procesamiento:

1. **Análisis léxico:** Identifica los tokens válidos del lenguaje.
2. **Análisis sintáctico:** Verifica que la estructura del código cumpla con la gramática definida.
3. **Análisis semántico:** Valida tipos de datos, declaraciones, ámbitos y contextos.
4. **Generacion de codigo ARM64:** Interpreta y ejecuta el programa, comenzando desde la función main.

Además, el intérprete genera reportes detallados que permiten al usuario comprender y depurar su código:

- Reporte de errores: Lista los errores léxicos, sintácticos y semánticos encontrados.
- Reporte de tabla de símbolos: Muestra todos los identificadores declarados, su tipo, ámbito, valor y ubicación en el código.

## 2. Instalación

### 2.1 Instalación en Linux (Ubuntu/Debian)

```bash
# 1. Instalar dependencias del sistema
sudo apt update
sudo apt install -y php8.1 php8.1-cli php8.1-mbstring composer
sudo apt install -y gcc-aarch64-linux-gnu binutils-aarch64-linux-gnu qemu-user
```

### 2.2. Clonar o descargar el proyecto
- cd ~/Escritorio
- unzip GolampiCompiler.zip
- cd GolampiCompiler

### 2.3. Instalar dependencias PHP con Composer
composer install

### 2.4. Generar analizador con ANTLR
java -jar antlr-4.13.2-complete.jar -Dlanguage=PHP -visitor -o src/gramatica gramatica/Golampi.g4

### 2.5. Configurar permisos
- chmod -R 755 output/
- chmod -R 755 public/

### 2.6. Iniciar servidor web (PHP built-in server)
- cd public
- php -S localhost:8080


## 3- Descripción general de la interfaz
![Interfaz][def1]

[def1]: Imagenes/interfas.png
La interfaz grafica es bastante intuitiva, mas adelante describiremos a pronfundidad de cada una de ellas, pero de forma general la interfaz del programa consta principalmente de las siguientes partes:

|Botón	|Función
|-------|------
|Nuevo	|Limpia el editor y la consola para comenzar un nuevo programa.
|Cargar	|Permite seleccionar un archivo .golampi, .go o .txt y cargar su contenido en el editor.
|Guardar |código	Descarga el contenido del editor como un archivo codigo.golampi.
|Ejecutar	|Interpreta y ejecuta el código directamente (modo intérprete).
|Generar ARM64	|Compila el código a ensamblador ARM64 y genera el archivo programa.s.
|Limpiar consola	|Borra el contenido de la terminal de salida.

### 3.2 Editor de Código
Área donde escribes tu programa en lenguaje Golampi. Soporta:

- Resaltado de sintaxis básico
- Múltiples líneas
- Atajos de teclado estándar (Ctrl+C, Ctrl+V, etc.)

### 3.4 Terminal de Salida (Consola)
Muestra:

- Resultados de la ejecución (cuando usas "Ejecutar")
- Mensajes de éxito o error de compilación (cuando usas "Generar ARM64")
- Instrucciones para ensamblar y ejecutar el código generado

### 3.5 Reportes Generados
Después de una compilación exitosa, puedes descargar:

|Reporte	|Formato	|Descripción
|-----------|-----------|-----------
|Reporte de Errores|	CSV	|Lista de errores léxicos, sintácticos y semánticos
|Tabla de Símbolos|	CSV	|Variables, funciones y constantes con sus tipos, ámbitos y valores
|Código ARM64|	.s	|Código ensamblador generado

## 4 Estructura básica de un programa Golampi
Todo programa válido en Golampi debe cumplir con las siguientes reglas fundamentales:

#### 4.2 Función main obligatoria
El programa debe contener exactamente una función llamada main, que servirá como punto de entrada:

```go

func main() {
    // Aquí va el código del programa
}
```
Características de la función main:

- No recibe parámetros
- No retorna valores
- No puede ser llamada explícitamente desde el código
- Es ejecutada automáticamente al iniciar el programa

### 4.2. Comentarios
Puedes agregar comentarios para documentar tu código. Los comentarios son ignorados por el intérprete:

```go
// Este es un comentario de una sola línea

/*
   Este es un comentario
   de múltiples líneas
*/

func main() {
    fmt.Println("Hola") // Comentario al final de línea
}
```

### 4.3. Declaración de variables
#### 4.3.1. Declaración explícita
```go
var x int32 = 10
var y int32           // y vale 0 (valor por defecto)
var a, b int32 = 5, 8 // Múltiples variables
```
#### 4.3.2. Declaración corta con := (solo dentro de funciones)

```go
func main() {
    nombre := "Juan"      // string
    edad := 25            // int32
    altura := 1.75        // float32
    activo := true        // bool
    
    // Múltiples variables
    x, y := 10, 20
}
```
#### 4.3.3. Constantes
```go
const PI float32 = 3.14159
const MAXIMO int32 = 100
```

### 4.4. Tipos de datos soportados

| Tipo	| Descripción	| Ejemplo	| Valor por defecto |
|-------|---------------|-----------|-------------------|
|int32	|Entero de 32 bits	|var edad int32 = 25	|0|
|float32|	Punto flotante de 32 bits|	var altura float32 = 1.75|	0.0|
|bool|	Valor lógico|	var activo bool = true|	false|
|rune|	Carácter Unicode|	var letra rune = 'A'|	'\u0000'|
|string|	Cadena de texto|	var nombre string = "Ana"|	""|

### 4.5. Estructuras de control
#### 4.5.1. Sentencia if
```go
func main() {
    x := 10
    
    if x > 0 {
        fmt.Println("x es positivo")
    } else if x == 0 {
        fmt.Println("x es cero")
    } else {
        fmt.Println("x es negativo")
    }
}
```

#### 4.5.2. Sentencia switch
```go
func main() {
    dia := 3
    
    switch dia {
    case 1:
        fmt.Println("Lunes")
    case 2, 3:
        fmt.Println("Martes o Miércoles")
    default:
        fmt.Println("Otro día")
    }
}
```

#### 4.5.3. Sentencia for
Golampi utiliza for como la única estructura de iteración:

```go
// For tradicional
func main() {
    for i := 0; i < 5; i++ {
        fmt.Println(i)
    }
}
```
```go
// For como while
func main() {
    x := 3
    for x > 0 {
        fmt.Println(x)
        x--
    }
}
```
```go
// Bucle infinito (se rompe con break)
func main() {
    x := 0
    for {
        if x == 5 {
            break
        }
        fmt.Println(x)
        x++
    }
}
```

### 4.6. Sentencias de transferencia
|Sentencia	|Función	|Ejemplo|
|-----------|-----------|-------|
|break	|Sale de un bucle o switch|	if i == 5 { break }|
|continue|	Salta a la siguiente iteración|	if i == 2 { continue }|
|return	|Finaliza una función y devuelve valor(s)	|return a + b|

### 4.7. Funciones
#### 4.7.1. Función con retorno simple
```go
func suma(a int32, b int32) int32 {
    return a + b
}

func main() {
    resultado := suma(5, 3)
    fmt.Println(resultado)  // Imprime: 8
}
```

#### 4.7.2. Función con múltiples retornos
```go
func dividir(a int32, b int32) (int32, bool) {
    if b == 0 {
        return 0, false
    }
    return a / b, true
}

func main() {
    cociente, exito := dividir(10, 2)
    if exito {
        fmt.Println(cociente)  // Imprime: 5
    }
}
```
#### 4.7.3. Parámetros por referencia (punteros)
```go
func duplicar(valor *int32) {
    *valor = *valor * 2
}

func main() {
    x := 10
    duplicar(&x)
    fmt.Println(x)  // Imprime: 20
}
```

### 4.8. Funciones embebidas (built-in)

|Función	|Descripción	|Ejemplo|
|-----------|---------------|-------|
|fmt.Println() |Imprime valores en consola	|fmt.Println("Hola", 123)|
|len()	|Retorna longitud de string o arreglo	|tamaño := len("Hola")|
|now()	|Retorna fecha y hora actual	|fecha := now()|
|substr()	|Extrae una subcadena	|substr("Golampi", 0, 3)|
|typeOf()	|Retorna el tipo de una variable	|typeOf(x)|

### 4.9. Hoisting de funciones
Golampi soporta hoisting, lo que significa que puedes llamar a una función antes de su definición en el código:

```go
func main() {
    saludar()  // La función se puede llamar antes de definirla
}

func saludar() {
    fmt.Println("¡Hola!")
}
```
## 5. Ejecución del Código Generado
### 5.1 Compilar Código ARM64
```bash
# Método 1: Usando gcc (recomendado)
aarch64-linux-gnu-gcc -static -o programa output/programa.s

# Método 2: Usando as + ld
aarch64-linux-gnu-as -o programa.o output/programa.s
aarch64-linux-gnu-ld -o programa programa.o
```

### 5.2 Ejecutar en QEMU (emulación)
```bash
qemu-aarch64 ./programa
```


## 6. Reporte de Errores
Cuando el compilador encuentra errores, estos se muestran en una tabla con:

|Columna	|Descripción
|------------|----------
|#	|Número secuencial del error
|Tipo	|Léxico, Sintáctico o Semántico
|Línea	|Número de línea donde ocurre el error
|Columna	|Posición del carácter
|Descripción	|Mensaje explicativo del error

### 6.1. Reporte de errores

#### 7.1.1. Tipos de errores
 **Error Léxico:**
Ocurre cuando el analizador léxico encuentra un carácter o símbolo que no pertenece al lenguaje Golampi.

Ejemplo de código erróneo:

```go
func main() {
    x := 10@  // El símbolo '@' no es válido
    fmt.Println(x)
}
```
Reporte generado:

|#	|Tipo	|Descripción	|Línea	|Columna|
|---|-------|---------------|-------|-------|
|1	|Léxico	|Símbolo no reconocido: @	|2	|10|

**Error Sintáctico:**
Ocurre cuando la estructura del código no cumple con la gramática definida para el lenguaje.

Ejemplo de código erróneo:

```go
func main() {
    if x > 0 {  // Error: falta la llave de cierre
        fmt.Println("Positivo")
    // Falta la llave '}'
}
```
Reporte generado:

|#	|Tipo	|Descripción	|Línea	|Columna|
|---|-------|---------------|-------|-------|
|1	|Sintáctico	|Se esperaba } para cerrar el bloque	|5	|1

**Error Semántico:**
Ocurre cuando el código es sintácticamente correcto pero viola las reglas semánticas del lenguaje.

Tipos comunes de errores semánticos:

|Subtipo	|Descripción	|Ejemplo|
|-----------|---------------|-------|
|Variable no declarada	|Se usa un identificador sin haber sido declarado	|fmt.Println(valor) sin haber declarado valor
|Identificador duplicado	|Se declara una variable con un nombre ya usado en el mismo ámbito	|var x int32 y luego x := 5
|Tipo incompatible	|Se asigna o opera con tipos de datos que no coinciden	|var x int32 = "hola"
|Función main inválida	|La función main tiene parámetros o retorna valores	|func main() int32 { return 0 }
|Función main duplicada	|Existe más de una función llamada main	|Dos func main() en el mismo programa
|Retorno incorrecto	|Una función no retorna el tipo declarado	|func suma() int32 { return "hola" }
|Break/continue fuera de bucle	|Se usa break o continue fuera de un for o switch	|break dentro de una función sin bucle

#### 7.1.3. Cómo interpretar la ubicación del error
Las columnas Línea y Columna indican la posición exacta donde el analizador detectó el problema:

- Línea: Número de línea dentro del código fuente (comienza en 1)
- Columna: Número de carácter dentro de la línea (comienza en 1)

```text
Línea 3:   fmt.Println(edad)
                ↑
Columna 16: aquí se detectó el identificador no declarado
```
**Importante:** En algunos casos, la ubicación reportada puede ser ligeramente posterior al error real, especialmente en errores sintácticos. Se recomienda revisar las líneas anteriores a la indicada.

## 7. Tabla de Símbolos
La tabla de símbolos muestra todas las variables, constantes y funciones declaradas:

|Columna	|Descripción
|-----------|-----------
|Identificador	|Nombre del símbolo
|Tipo	|int32, float32, bool, rune, string, puntero
|Ámbito	|global, nombre_de_función, o bloque
|Valor	|Valor actual (si es constante o conocido)
|Línea	|Línea donde fue declarado

#### 7.1.1. Significado de cada columna
|Columna	|Descripción|
|-----------|-----------|
|Identificador	|Nombre de la variable, constante, función o parámetro declarado
|Tipo	|Tipo de dato asociado: int32, float32, bool, rune, string, arreglo, función
|Ámbito	|Contexto donde el identificador es visible y accesible
|Valor	|Valor actual del identificador (si aplica). — indica que no tiene valor (funciones, |parámetros sin valor por defecto)
|Línea	|Número de línea donde se declaró el identificador
|Columna	|Número de columna donde se declaró el identificador

#### 7.1.2. Tipos de ámbito (scope)
El ámbito determina dónde es válido un identificador:

|Ámbito	|Descripción	|Ejemplo|
|-------|---------------|-------|
|global	|Visible en todo el programa, fuera de cualquier función	|Variables declaradas a nivel global, funciones
|función	|Visible solo dentro de una función específica	|Parámetros y variables locales de una función
|bloque	|Visible solo dentro de un bloque { } anidado	|Variables declaradas dentro de un if o else
|ciclo	|Visible solo dentro de un bucle for	|Variables declaradas en la inicialización del for

#### 7.1.3. Representación de valores especiales
|Tipo de valor	|Representación en la tabla	|Ejemplo|
|---------------|---------------------------|-------|
|Arreglo	|{valor1, valor2, ...}	{|1, 2, 3}|
|String	|"texto"	|"Hola mundo"|
|Rune	|'c'	|'A'|
|Nil	|nil	|nil|
|Valor por defecto	|Valor correspondiente al tipo	|0, 0.0, false, "", '\u0000'
|Función	|—	|No aplica valor|
|Constante	|Valor fijo	|3.1416|

### 7.3. Consejos para la interpretación de reportes
|Consejo	|Explicación|
|-----------|-----------|
|Lee los errores en orden	|A veces un error provoca errores en cascada. Corrige el primero y vuelve a ejecutar
|Presta atención a línea y columna	|La ubicación exacta te ahorrará tiempo buscando el error
|Un error semántico no impide otros reportes	|El intérprete intenta recopilar todos los errores posibles
|La tabla de símbolos refleja el estado final	|Muestra los valores después de toda la ejecución
|Ámbitos anidados pueden tener identificadores repetidos	|Es válido si están en diferentes ámbitos
|Funciones aparecen con valor —	|Las funciones no tienen un "valor" como las variables


## Soporte y contacto
- **https://github.com/JancarloSchwarz777/ReguardoGiovanni.git**
- **3633937490101@ingenieria.usac.edu.gt**