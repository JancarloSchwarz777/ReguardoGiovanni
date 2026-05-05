**Archivo basico.go**

``` bash
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ aarch64-linux-gnu-gcc -static -o output/prueba output/programa.s
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ qemu-aarch64 ./output/prueba
=== INICIO: CONCEPTOS BASICOS ===
\n--- 1.1 DECLARACION LARGA ---
int32: 100
float32: 45.500000
bool: 1
rune: A
string: Texto Inicial
\n--- 1.2 ASIGNACION DE VARIABLES ---
Nuevos valores -> int32: 250 , float32: 99.990000 , bool: 0 , rune: Z , string: Texto Modificado
\n--- 1.3 FORMATO DE IDENTIFICADORES ---
Identificador: 1 != identificador: 2
\n--- 1.4 DECLARACION CORTA ---
Cortas -> int32: 42 , float32: 3.141600 , bool: 1 , rune: X , string: Inferencia de tipos
\n--- 1.5 DECLARACION LARGA SIN INICIALIZAR ---
Por defecto -> int32: 0 , float32: 0.000000 , bool: 0 , rune:  , string: 
\n--- 1.6 DECLARACION MULTIPLE ---
Múltiple Larga: 10 20
Múltiple Corta: Hola Mundo
\n--- 1.7 CONSTANTES ---
Constantes -> GRAVEDAD: 9.810000 , MENSAJE: No modificable
\n--- 1.8 MANEJO DE NIL ---
Impresión directa de nil: <nil>
Comparación nil == nil: 1
\n--- 1.11 OPERACIONES ARITMETICAS ---
Suma (15 + 4): 19
Resta (15 - 4): 11
Multiplicación (15 * 4): 60
División (15 / 4): 3
Módulo (15 % 4): 3
\n--- 1.12 OPERACIONES RELACIONALES ---
10 > 20: 0
10 < 20: 1
10 >= 10: 1
10 <= 20: 1
10 == 20: 0
10 != 20: 1
\n--- 1.13 OPERACIONES LOGICAS ---
true && false: 0
true || false: 1
!true: 0
\n--- 1.14 RESTRICCION DE CORTO CIRCUITO ---
Corto circuito AND (debe ser false sin error): 0
Corto circuito OR (debe ser true sin error): 1
\n--- 1.15 OPERADORES DE ASIGNACION ---
Valor base: 50
+= 10: 60
-= 20: 40
*= 2: 80
/= 4: 20
\n=== FIN ===
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ 
```

**Archivo embebida.go**

``` bash
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ aarch64-linux-gnu-gcc -static -o output/prueba output/programa.s
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ qemu-aarch64 ./output/prueba
=== INICIO DE CALIFICACION: FUNCIONES EMBEBIDAS ===
\n--- 4.1 FMT.PRINTLN ---
La función fmt.Println permite imprimir múltiples parámetros.
Tipos mixtos: 100 1 3.141600 A
\n--- 4.2 LEN() ---
La cadena ' Compiladores 2 ' tiene longitud: 14
\n--- 4.3 NOW() ---
Fecha y hora actual del sistema: 2026-05-05 13:55:50
\n--- 4.4 SUBSTR() ---
Subcadena 0-11 de ' Universidad San Carlos ': Universidad
Subcadena 12-22 de ' Universidad San Carlos ': San Carlos
\n--- 4.5 TYPEOF() ---
typeOf(varEntero): int32
typeOf(varFlotante): float32
typeOf(varBooleano): bool
typeOf(varCaracter): rune
typeOf(varTexto): string
\n=== FIN DE CALIFICACION: FUNCIONES EMBEBIDAS ===
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ 

```

**Archivo funciones.go**

``` bash
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ aarch64-linux-gnu-gcc -static -o output/prueba output/programa.s
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ qemu-aarch64 ./output/prueba
=== INICIO DE CALIFICACION: FUNCIONES ===
\n--- 3.7 HOISTING ---
>>> Ejecutando funcionHoisting() declarada correctamente debajo del main.
\n--- 3.1 FUNCION SIN PARAMETROS ---
¡Bienvenido al sistema de evaluación de funciones Golampi!
\n--- 3.2 FUNCION CON PARAMETROS ---
Resultado de sumarNumeros(15, 25): 40
\n--- 3.3 FUNCIONES POR REFERENCIA ---
Valor antes de la función por referencia: 10
Valor después de la función por referencia (debe ser 20): 20
\n--- 3.4 FUNCION MULTIPLE RETORNO ---
Operaciones 50 y 20 -> Suma: 70 , Resta: 30
\n--- 3.5 FUNCION RECURSIVA (UN RETORNO) ---
Factorial de 5: 120
\n--- 3.6 FUNCION RECURSIVA (MULTIPLE RETORNO) ---
Fibonacci de 4: 3 | Llamadas recursivas totales: 9
\n=== FIN DE CALIFICACION: FUNCIONES ===
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ 
```

**Archivo intermedio.go**

``` bash
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ aarch64-linux-gnu-gcc -static -o output/prueba output/programa.s
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ qemu-aarch64 ./output/prueba
=== INICIO DE CALIFICACION: ESTRUCTURAS DE CONTROL ===
\n--- 2.2 IF SIMPLE ---
El estudiante Ana tiene una nota mayor a 80.
\n--- 2.3 IF ELSE Y ELSE IF ---
Clasificacion: EXCELENTE
\n--- 2.4 SWITCH / CASE / DEFAULT ---
Categoria 2: Intermedio (Este debe imprimirse)
\n--- 2.5 FOR CLASICO ---
Contando del 1 al 5:
Iteración clásico: 1
Iteración clásico: 2
Iteración clásico: 3
Iteración clásico: 4
Iteración clásico: 5
\n--- 2.6 FOR CONDICIONAL (WHILE) ---
Cuenta regresiva: 10
Cuenta regresiva: 7
Cuenta regresiva: 4
Cuenta regresiva: 1
\n--- 2.7 FOR INFINITO Y 2.8 BREAK ---
Ejecutando ciclo infinito, intento número: 1
Ejecutando ciclo infinito, intento número: 2
Ejecutando ciclo infinito, intento número: 3
Límite alcanzado. Ejecutando BREAK para salir del for infinito.
Salió del ciclo infinito exitosamente.
\n--- 2.9 CONTINUE ---
Imprimiendo solo números impares del 1 al 6:
Número impar encontrado y procesado: 1
Saltando el número par: 2
Número impar encontrado y procesado: 3
Saltando el número par: 4
Número impar encontrado y procesado: 5
Saltando el número par: 6
\n=== FIN DE CALIFICACION: CONTROL DE FLUJO ===
jancarlo@jancarlo-Latitude-5430:~/Escritorio/Prueva/FASE 2$ 
```
