# Manual de Usuario - Golampi Interpreter
## 1- Introducción
El presente manual tiene como objetivo guiar al usuario en la instalación, configuración y uso del intérprete Golampi, una herramienta académica diseñada para ejecutar programas escritos en el lenguaje de programación Golampi, cuya sintaxis está inspirada en el lenguaje Go (Golang).

A lo largo de este documento, el usuario encontrará instrucciones paso a paso, acompañadas de capturas de pantalla y ejemplos prácticos, que le permitirán aprovechar al máximo todas las funcionalidades del intérprete.

### 1.1- **¿Qué es Golampi?**
Golampi es un lenguaje de programación académico creado como parte del curso de Organización de Lenguajes y Compiladores 2. Su sintaxis y semántica están inspiradas en Golang, pero con un alcance reducido que facilita el aprendizaje práctico de los conceptos fundamentales de los compiladores e intérpretes.

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
4. **Ejecución:** Interpreta y ejecuta el programa, comenzando desde la función main.

Además, el intérprete genera reportes detallados que permiten al usuario comprender y depurar su código:

- Reporte de errores: Lista los errores léxicos, sintácticos y semánticos encontrados.
- Reporte de tabla de símbolos: Muestra todos los identificadores declarados, su tipo, ámbito, valor y ubicación en el código.

## 2- Instalación paso a paso
1. **Clonar:** En una carptea dentro del sistema clona el repositorio:
2. **Terminal integrada:** Abrir una terminal integrada en la raiz del proyecto
3. **Ejecutar:** En la terminal ejecutar el siguinete comando: **"php -S localhost:8080 -t public/"**
4. **Navegador:** Abre tu navegador de confianza y ve a la siguiente direccion para poder usar el programa **http://localhost:8080/**


## 3- Descripción general de la interfaz
![Interfaz][def1]

[def1]: Imagenes/interfas.png
La interfaz grafica es bastante intuitiva, mas adelante describiremos a pronfundidad de cada una de ellas, pero de forma general la interfaz del programa consta principalmente de las siguientes partes:

1. **Barra de acciones:** Acciones basicas para la carga o edicion de texto.
2. **Contenedor de código:** Aqui el usuario puede ingresar el codigo que desee ejecutar.
3. **Terminal de salida:** Aqui el usuario puede visualizar el resultado del codigo ingresado.
3. **Reportes:** En este apartado se generan los reporte de Errores o el reporte de la tabla de Simbolos, segun sea el caso

## 4- Uso de la barra de acciones
![Barra de acciones][def]

[def]: Imagenes/barra.png
La " BARRA DE ACCIONES" consta de 6 botones, los cuales describiremos a continuacion:

- **Nuevo / Limpiar**: Limpia el editor y la consola para iniciar una nueva prueba.
- **Cargar archivo**: Permite seleccionar un archivo de código y cargar su contenido al editor.
- **Guardar código**: Descarga el contenido actual del editor como archivo de texto.
- **Ejecutar / Analizar**: Envía el código fuente al servidor PHP para su análisis o ejecución.
- **Limpiar consola**: Borra el contenido de la consola de salida.
- **Descargar reportes**: Genera y descarga los reportes de errores y tabla de símbolos.

## 5- Edición de código Golampi
### 5.1. El panel de edición
El panel de edición de código es el área central de la interfaz donde el usuario puede escribir, modificar y visualizar el código fuente en lenguaje Golampi. Esta área funciona como un editor de texto multilínea que permite:

- Escribir código directamente desde el teclado
- Pegar código copiado desde otras fuentes
- Editar líneas existentes
- Seleccionar y eliminar fragmentos de código

### 5.2. Estructura básica de un programa Golampi
Todo programa válido en Golampi debe cumplir con las siguientes reglas fundamentales:

#### 5.2.1. Función main obligatoria
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

### 5.3. Comentarios
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

### 5.4. Declaración de variables
#### 5.4.1. Declaración explícita
```go
var x int32 = 10
var y int32           // y vale 0 (valor por defecto)
var a, b int32 = 5, 8 // Múltiples variables
```
#### 5.4.2. Declaración corta con := (solo dentro de funciones)

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
#### 5.4.3. Constantes
```go
const PI float32 = 3.14159
const MAXIMO int32 = 100
```

### 5.5. Tipos de datos soportados

| Tipo	| Descripción	| Ejemplo	| Valor por defecto |
|-------|---------------|-----------|-------------------|
|int32	|Entero de 32 bits	|var edad int32 = 25	|0|
|float32|	Punto flotante de 32 bits|	var altura float32 = 1.75|	0.0|
|bool|	Valor lógico|	var activo bool = true|	false|
|rune|	Carácter Unicode|	var letra rune = 'A'|	'\u0000'|
|string|	Cadena de texto|	var nombre string = "Ana"|	""|

### 5.6. Estructuras de control
#### 5.6.1. Sentencia if
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

#### 5.6.2. Sentencia switch
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

#### 5.6.3. Sentencia for
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

### 5.7. Sentencias de transferencia
|Sentencia	|Función	|Ejemplo|
|-----------|-----------|-------|
|break	|Sale de un bucle o switch|	if i == 5 { break }|
|continue|	Salta a la siguiente iteración|	if i == 2 { continue }|
|return	|Finaliza una función y devuelve valor(s)	|return a + b|

### 5.8. Funciones
#### 5.8.1. Función con retorno simple
```go
func suma(a int32, b int32) int32 {
    return a + b
}

func main() {
    resultado := suma(5, 3)
    fmt.Println(resultado)  // Imprime: 8
}
```

#### 5.8.2. Función con múltiples retornos
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
#### 5.8.3. Parámetros por referencia (punteros)
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

### 5.9. Funciones embebidas (built-in)

|Función	|Descripción	|Ejemplo|
|-----------|---------------|-------|
|fmt.Println() |Imprime valores en consola	|fmt.Println("Hola", 123)|
|len()	|Retorna longitud de string o arreglo	|tamaño := len("Hola")|
|now()	|Retorna fecha y hora actual	|fecha := now()|
|substr()	|Extrae una subcadena	|substr("Golampi", 0, 3)|
|typeOf()	|Retorna el tipo de una variable	|typeOf(x)|

### 5.10. Hoisting de funciones
Golampi soporta hoisting, lo que significa que puedes llamar a una función antes de su definición en el código:

```go
func main() {
    saludar()  // La función se puede llamar antes de definirla
}

func saludar() {
    fmt.Println("¡Hola!")
}
```
### 6.11. Buenas prácticas
1. Nombra variables con sentido: Usa nombreUsuario en lugar de nu
2. Indenta correctamente tu código: Usa tabulaciones o espacios consistentes
3. Comenta secciones complejas: Ayuda a entender la lógica
4. Declara las variables cerca de su uso: Mejora la legibilidad
5. Una sola responsabilidad por función: Cada función debe hacer una cosa bien

### 6.12. Errores comunes al editar

|Error	|Ejemplo incorrecto	|Corrección|
|-------|-------------------|----------|
|Falta de llaves	|func main()	|func main() { }
|Paréntesis en condición	|if (x > 0) { }	|if x > 0 { }
|Tipo incorrecto	|var x int = 5	|var x int32 = 5
|Comillas mixtas	|var s string = 'hola'	|var s string = "hola"
|Main con parámetros	|func main(args []string)	|func main()


## 7- Reportes
Una vez que el usuario ejecuta un programa Golampi haciendo clic en el botón "Ejecutar / Analizar", el intérprete procesa el código fuente y genera dos tipos de reportes que resultan fundamentales para comprender el comportamiento del programa y depurar posibles errores:

|Reporte	|Descripción|
|-----------|------------|
|Reporte de errores	|Lista todos los errores encontrados durante las fases de análisis (léxico, sintáctico y semántico)
|Reporte de tabla de símbolos	|Muestra todos los identificadores declarados en el programa con sus propiedades (tipo, ámbito, valor, ubicación)

### 7.1. Reporte de errores
#### 7.1.1. Estructura del reporte
El reporte de errores se presenta en formato tabular con las siguientes columnas:

|#	|Tipo	|Descripción	|Línea	|Columna|
|---|-------|---------------|-------|-------|
|1	|Léxico	|Símbolo no reconocido: @	|3	|8|
|2	|Sintáctico	|Se esperaba ) después de la condición	|5	|12|
|3	|Semántico	|Variable x no declarada en el ámbito actual	|7	|5|
|4	|Semántico	|Identificador total ya ha sido declarado	|10	|1|
|5	|Semántico	|Operación inválida entre int32 y string	|12	|15|

#### 7.1.2. Tipos de errores
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

### 7.2. Reporte de tabla de símbolos
#### 7.2.1. Estructura del reporte
La tabla de símbolos representa el resultado del análisis semántico y contiene todos los identificadores declarados durante la ejecución del programa. Se presenta en formato tabular con las siguientes columnas:

|Identificador	|Tipo	|Ámbito	|Valor	|Línea	|Columna|
|---------------|-------|-------|-------|-------|-------|
|bubbleSort	|función	|global	|—	|11	|1|
|arr	|arreglo	|bubbleSort	|—	|18	|5|
|n	|int32	|bubbleSort	|5	|23	|5|
|i	|int32	|bubbleSort	|0	|29	|9|
|j	|int32	|bubbleSort	|0	|29	|18|
|temp	|int32	|bubbleSort	|—	|37	|9|
|saludo	|string	|global	|"Hola"	|45	|1|
|numeros	|arreglo	|global	|{5, 3, 8, 1, 2}	|48	|1|

#### 7.2.2. Significado de cada columna
|Columna	|Descripción|
|-----------|-----------|
|Identificador	|Nombre de la variable, constante, función o parámetro declarado
|Tipo	|Tipo de dato asociado: int32, float32, bool, rune, string, arreglo, función
|Ámbito	|Contexto donde el identificador es visible y accesible
|Valor	|Valor actual del identificador (si aplica). — indica que no tiene valor (funciones, |parámetros sin valor por defecto)
|Línea	|Número de línea donde se declaró el identificador
|Columna	|Número de columna donde se declaró el identificador

#### 7.2.3. Tipos de ámbito (scope)
El ámbito determina dónde es válido un identificador:

|Ámbito	|Descripción	|Ejemplo|
|-------|---------------|-------|
|global	|Visible en todo el programa, fuera de cualquier función	|Variables declaradas a nivel global, funciones
|función	|Visible solo dentro de una función específica	|Parámetros y variables locales de una función
|bloque	|Visible solo dentro de un bloque { } anidado	|Variables declaradas dentro de un if o else
|ciclo	|Visible solo dentro de un bucle for	|Variables declaradas en la inicialización del for

#### 7.2.4. Representación de valores especiales
|Tipo de valor	|Representación en la tabla	|Ejemplo|
|---------------|---------------------------|-------|
|Arreglo	|{valor1, valor2, ...}	{|1, 2, 3}|
|String	|"texto"	|"Hola mundo"|
|Rune	|'c'	|'A'|
|Nil	|nil	|nil|
|Valor por defecto	|Valor correspondiente al tipo	|0, 0.0, false, "", '\u0000'
|Función	|—	|No aplica valor|
|Constante	|Valor fijo	|3.1416|

#### 7.2.5. Cómo usar la tabla de símbolos para depurar
La tabla de símbolos es una herramienta poderosa para:

1. Verificar declaraciones: Confirma que todas las variables fueron declaradas correctamente
2. Validar ámbitos: Identifica si una variable es accesible desde cierta parte del código
3. Revisar tipos: Comprueba que cada identificador tenga el tipo esperado
4. Inspeccionar valores: Observa los valores actuales de las variables después de la ejecución
5. Detectar redeclaraciones: Encuentra identificadores duplicados en el mismo ámbito

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
- **Repositorio:**
- **Correo de contacto:**