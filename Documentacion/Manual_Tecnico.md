# Manual Tecnico - Golampi
## 1- Introducción

El presente Manual Técnico tiene como objetivo documentar de manera exhaustiva los aspectos de diseño, arquitectura e implementación del Intérprete Golampi. Este documento está dirigido a desarrolladores, ingenieros de software, evaluadores académicos y cualquier persona interesada en comprender el funcionamiento interno de la herramienta, así como en mantenerla, extenderla o realizar pruebas sobre ella.

A lo largo de este manual, se describen:

- La arquitectura general del sistema y la comunicación entre sus componentes.
- La gramática formal completa del lenguaje Golampi, base para la generación de analizadores.
- El diagrama de clases que representa la estructura del software.
- El diagrama de flujo de procesamiento, desde la recepción del código hasta la generación de reportes.
- La implementación detallada de cada módulo: análisis léxico, sintáctico, semántico, ejecución y generación de reportes.
- La estructura de la tabla de símbolos y su gestión durante el análisis semántico.
- La interfaz gráfica de usuario (GUI) y su comunicación con el backend.
- Las tecnologías, herramientas y configuraciones necesarias para desplegar el proyecto.

### Definiciones y acrónimos
|Término/Acrónimo	|Definición|
|-------------------|----------|
|AST (Abstract Syntax Tree)|	Árbol de sintaxis abstracta, representación jerárquica del código fuente
|ANTLR (ANother Tool for Language Recognition)	|Herramienta para generar analizadores léxicos y sintácticos
|Backend	|Parte del sistema que ejecuta en el servidor (lógica del intérprete)
|EBNF (Extended Backus-Naur Form)	|Notación formal para describir gramáticas de lenguajes
|Frontend	|Parte del sistema que ejecuta en el navegador (interfaz gráfica)
|GUI (Graphical User Interface)	|Interfaz gráfica de usuario
|Lexer	|Analizador léxico, convierte código fuente en tokens
|Parser	|Analizador sintáctico, construye el AST a partir de los tokens
|Semantic Analyzer	|Analizador semántico, valida reglas de tipos y ámbitos
|Symbol Table	|Tabla de símbolos, almacena información de identificadores
|Token	|Unidad mínima significativa del código fuente

El Intérprete Golampi es una aplicación web monolítica desarrollada en PHP para el backend y HTML/CSS/JS para el frontend, que permite a los usuarios escribir, editar y ejecutar programas escritos en el lenguaje académico Golampi (inspirado en Golang).

El sistema implementa las tres fases fundamentales del procesamiento de lenguajes:

1. Análisis léxico: Tokenización del código fuente.
2. Análisis sintáctico: Verificación estructural mediante gramática formal definida en ANTLRv4.
3. Análisis semántico: Validación de tipos, declaraciones y ámbitos.

Posteriormente, el intérprete ejecuta el programa comenzando desde la función main, genera una salida visible en la consola y produce dos reportes descargables: reporte de errores y reporte de tabla de símbolos.

La solución presentada cumple con todos los requisitos establecidos en el enunciado del proyecto, incluyendo la arquitectura cliente/servidor, la GUI obligatoria, la gramática formal documentada y los diagramas de clases y flujo de procesamiento que se presentan en las siguientes secciones de este manual.


## 2 -  Tecnologías y herramientas
|Componente	|Tecnología	|Versión|
|-----------|-----------|-------|
|Backend	|PHP	|7.4+
|Generador de parser	|ANTLR	    |4.x
|Frontend	|HTML5, CSS3, JavaScript	|ES6+
|Servidor web	|Apache / XAMPP	|-
|Control de versiones	|Git	|-
|Repositorio	|GitHub/GitLab	|-


## 3 - Gramática formal del lenguaje Golampi

### 3.1 - Tokens definidos en la gramática
Los tokens se clasifican en las siguientes categorías:

#### 3.1.1. Palabras reservadas
|Token	|Lexema	|Descripción|
|-------|-------|-----------|
|VAR	|var	|Declaración de variable
|CONST	|const	|Declaración de constante
|FUNC	|func	|Declaración de función
|MAIN	|main	|Función principal
|IF	if	|Condicional
|ELSE	|else	|Alternativa
|FOR	|for	|Bucle
|RETURN	|return	|Retorno de función
|BREAK	|break	|Salida de bucle/switch
|CONTINUE	|continue	|Siguiente iteración
|SWITCH	|switch	Selección |múltiple
|CASE	|case	|Caso en switch
|DEFAULT	|default	|Caso por defecto
|NIL	|nil	|Valor nulo
|TRUE	|true	|Valor booleano verdadero
|FALSE	|false	|Valor booleano falso

#### 3.1.2. Funciones embebidas
|Token	|Lexema	|Descripción|
|-------|-------|-----------|
|PRINTLN	|fmt.Println	|Imprime en consola
|LEN	|len	|Longitud de string/arreglo
|NOW	|now	|Fecha y hora actual
|SUBSTR	|substr	|Subcadena
|TYPEOF	|typeOf	|Tipo de una variable

#### 3.1.3. Tipos de datos
|Token	|Lexema	|Descripción|
|-------|-------|-----------|
|INT32	|int32	|Entero de 32 bits
|FLOAT32	|float32	|Flotante de 32 bits
|STRING	|string	|Cadena de texto
|BOOL	|bool	|Booleano
|RUNE	|rune	|Carácter Unicode

#### 3.1.4. Operadores
|Token	|Lexema	|Descripción|
|-------|-------|-----------|
|ASIGNACION	|=	|Asignación simple
|MAS_ASIGNACION	|+=	|Suma y asignación
|MENOS_ASIGNACION	|-=	|Resta y asignación
|MULT_ASIGNACION	|*=	|Multiplicación y asignación
|DIV_ASIGNACION	|/=	|División y asignación
|MAS	|+	|Suma
|MENOS	|-	|Resta / Negación
|MULT	|*	|Multiplicación / Puntero
|DIV	|/	|División
|MOD	|%	|Módulo
|IGUAL	|==	|Igualdad
|DIFERENTE	|!=	|Desigualdad
|MAYOR	|>	|Mayor que
|MENOR	|<	|Menor que
|MAYOR_IGUAL	|>=	|Mayor o igual
|MENOR_IGUAL	|<=	|Menor o igual
|AND	|&&	|AND lógico
|OR	|//	|OR lógico
|NOT	|!	|NOT lógico
|INCREMENTO|	++	|Incremento
|DECREMENTO	|--	|Decremento

#### 3.1.5. Símbolos
|Token	|Lexema	|Descripción|
|-------|-------|-----------|
|PAREN_IZQ	|(	|Paréntesis izquierdo
|PAREN_DER	|)	|Paréntesis derecho
|LLAVE_IZQ	|{	|Llave izquierda
|LLAVE_DER	|}	|Llave derecha
|CORCHETE_IZQ	|[	|Corchete izquierdo
|CORCHETE_DER	|]	|Corchete derecho
|COMA	|,	|Coma
|PUNTO	|.	|Punto
|DOS_PUNTOS	|:	|Dos puntos
|PUNTO_COMA	|;	|Punto y coma
|DECLARACION_CORTA	|:=	|Declaración corta

#### 3.1.6. Literales
|Token	|Lexema	|Expresión regular	|Ejemplo|
|-------|------|--------------------|--------|
|NUMERO_ENTERO	|dígitos	|[0-9]+	|42, 100
|NUMERO_DECIMAL	|dígitos.dígitos	|[0-9]+'.'[0-9]+	|3.14, 0.5
|CADENA	|"texto"	|"(\\.|~["\r\n])*"	|"Hola", "Mundo"
|CARACTER	|'c'	|'(\\.|~['\r\n])'	|'A', '\n'
|IDENTIFICADOR	|letra + dígitos/_	|[a-zA-Z_][a-zA-Z0-9_]*	|x, miVariable, _temp

#### 3.1.7. Comentarios y espacios (ignorados)
Token	Lexema	Descripción	Acción
COMENTARIO_LINEA	// ...	Comentario de una línea	-> skip
COMENTARIO_BLOQUE	/* ... */	Comentario de múltiples líneas	-> skip
WS	espacios, tabs, saltos	Espacios en blanco	-> skip


### 3.2. Gramática en formato EBNF
A continuación se presenta la misma gramática en notación EBNF, que es el formato solicitado en el enunciado del proyecto.

#### 3.2.1. Programa
```text
programa ::= { funcion } EOF
``` 

#### 3.2.2. Funciones
```text
funcion ::= "func" identificador "(" [ parametros ] ")" [ tipo | "(" [ tipos ] ")" ] bloque
          | "func" "main" "(" ")" bloque

parametros ::= parametro { "," parametro }
parametro ::= identificador tipo

tipos ::= tipo { "," tipo }
```

#### 3.2.3. Tipos de datos
```text
tipo ::= "int32"
       | "float32"
       | "string"
       | "bool"
       | "rune"
       | "[" expresion "]" tipo
       | "*" tipo
```
#### 3.2.4. Bloques y sentencias
```text
bloque ::= "{" { sentencia } "}"

sentencia ::= declaracionVar [ ";" ]
            | declaracionConstante [ ";" ]
            | declaracionCorta [ ";" ]
            | asignacion [ ";" ]
            | llamadaFuncion [ ";" ]
            | ifStmt
            | forStmt
            | switchStmt
            | returnStmt [ ";" ]
            | breakStmt [ ";" ]
            | continueStmt [ ";" ]
            | bloque
```

#### 3.2.5. Declaraciones
```text
declaracionVar ::= "var" listaIdentificadores tipo [ "=" listaExpresiones ]

declaracionConstante ::= "const" identificador tipo "=" expresion

declaracionCorta ::= listaIdentificadores ":=" listaExpresiones

listaIdentificadores ::= identificador { "," identificador }
listaExpresiones ::= expresion { "," expresion }
```

#### 3.2.6. Asignaciones
```text
asignacion ::= [ "*" ] identificador ( operadorAsignacion expresion | "++" | "--" )

operadorAsignacion ::= "=" | "+=" | "-=" | "*=" | "/="
```

#### 3.2.7. Expresiones (precedencia de mayor a menor)
```text
expresion ::= expresionLogica

expresionLogica ::= expresionComparacion { ("&&" | "||") expresionComparacion }

expresionComparacion ::= expresionAditiva { ("==" | "!=" | ">" | "<" | ">=" | "<=") expresionAditiva }

expresionAditiva ::= expresionMultiplicativa { ("+" | "-") expresionMultiplicativa }

expresionMultiplicativa ::= expresionUnaria { ("*" | "/" | "%") expresionUnaria }

expresionUnaria ::= [ "!" | "-" | "*" | "&" ] expresionPrimaria

expresionPrimaria ::= identificador { "[" expresion "]" }
                    | numeroEntero
                    | numeroDecimal
                    | cadena
                    | caracter
                    | "true"
                    | "false"
                    | "nil"
                    | identificador
                    | "fmt.Println"
                    | "len"
                    | "now"
                    | "substr"
                    | "typeOf"
                    | tipo "(" expresion ")"
                    | llamadaFuncion
                    | "(" expresion ")"
                    | arregloLiteral
```

#### 3.2.8. Arreglos
```text
arregloLiteral ::= "[" [ listaExpresiones ] "]" tipo "{" valoresArreglo "}"

valoresArreglo ::= [ elementoArreglo { "," elementoArreglo } ]

elementoArreglo ::= expresion | "{" valoresArreglo "}"
```

#### 3.2.9. Llamada a funciones
``` text
llamadaFuncion ::= ( identificador | "fmt.Println" | "len" | "now" | "substr" | "typeOf" ) "(" [ argumentos ] ")"

argumentos ::= expresion { "," expresion }
```

#### 3.2.10. Estructuras de control

```text
ifStmt ::= "if" expresion bloque [ "else" ( ifStmt | bloque ) ]

forStmt ::= "for" forHeader bloque

forHeader ::= forClause | expresion | ε

forClause ::= [ initStmt ] ";" [ expresion ] ";" [ postStmt ]

initStmt ::= declaracionCorta | asignacion | expresion

postStmt ::= asignacion | expresion | "++" | "--"

switchStmt ::= "switch" expresion "{" { caso | defaultBloque } "}"

caso ::= "case" listaExpresiones ":" { sentencia }

defaultBloque ::= "default" ":" { sentencia }
```

#### 3.2.11. Sentencias de transferencia
```text
returnStmt ::= "return" [ expresion { "," expresion } ]

breakStmt ::= "break"

continueStmt ::= "continue"
```

#### 3.2.12. Nivel léxico (tokens)
```text
identificador ::= letra { letra | dígito | "_" }

numeroEntero ::= dígito { dígito }

numeroDecimal ::= dígito { dígito } "." dígito { dígito }

cadena ::= '"' { caracter - '"' } '"'

caracter ::= "'" ( caracter - "'" ) "'"

letra ::= "A" | "B" | ... | "Z" | "a" | "b" | ... | "z"

dígito ::= "0" | "1" | ... | "9"
```

### 3.3 Tabla de precedencia de operadores
|Precedencia	|Operadores	|Asociatividad|
|---------------|-----------|-------------|
|1 (más alta)	|* / %	|Izquierda
|2	|+ -	|Izquierda
|3	|== != < > <= >=	|Izquierda
|4	|&&	|Izquierda
|5 (más baja)	| " // "	|Izquierda
|Operadores unarios |(!, -, *, &) |tienen mayor precedencia que todos los binarios.

### 3.4. Reglas semánticas adicionales
Además de la gramática formal, el lenguaje Golampi implementa las siguientes reglas semánticas:

|Regla	|Descripción|
|-------|-----------|
|Tipado estático	|Todas las variables y constantes tienen un tipo definido en tiempo de compilación
Declaración única	|No se puede redeclarar un identificador en el mismo ámbito
Uso antes de declaración	|Las variables deben declararse antes de ser utilizadas (excepto |funciones por hoisting)
|Compatibilidad de tipos	|Las operaciones y asignaciones requieren tipos compatibles
|Función main única	|Debe existir exactamente una función main sin parámetros ni retorno
|Hoisting de funciones	|Las funciones pueden llamarse antes de su definición textual
|Cortocircuito	|Los operadores && y // evalúan con cortocircuito
|Break/Continue	|Solo pueden usarse dentro de bucles for o switch


## 4 - Diagrama de clases
![Diagrma clases][def2]

[def2]: Imagenes/DiagrmaClases.png

## 5- Diagrama de flujo de procesamiento
![Diagrma procesamineto][def3]

[def3]: Imagenes/procesamiento.png

## 6 - Estructura de la tabla de símbolos
La tabla de símbolos es una estructura de datos fundamental en el análisis semántico del intérprete Golampi. Su propósito es almacenar y gestionar toda la información asociada a los identificadores declarados durante la ejecución del programa: variables, constantes, funciones, parámetros, etc.

En la implementación, la tabla de símbolos se gestiona mediante dos arrays principales:

|Array	|Propósito|
|-------|---------|
|$tablaSimbolos	|Tabla activa durante la ejecución. Se modifica al entrar/salir de ámbitos
|$tablaSimbolosHistorial	|Tabla persistente que conserva todos los identificadores para el reporte final

### 6.1 Estructura de cada símbolo
Cada entrada en la tabla de símbolos tiene la siguiente estructura:

```php
$this->tablaSimbolos[$identificador] = [
    'tipo' => 'int32|float32|string|bool|rune|funcion|arreglo|puntero',
    'ambito' => 'string',
    'valor' => 'mixed',
    'linea' => 'int',
    'columna' => 'int',
    'esConstante' => 'bool',
    // Campos adicionales según el tipo:
    'es_puntero' => 'bool',      // Solo para punteros
    'tipo_base' => 'string',     // Solo para punteros y arreglos
    'tipo_retorno' => 'array'    // Solo para funciones
];
```

#### 6.1.1. Descripción de campos
|Campo	|Tipo	|Descripción	|Ejemplo|
|-------|-------|----------------|------|
|tipo	|string	|Tipo de dato del identificador	|"int32", "string", "funcion"
|ambito	|string	|Ámbito donde fue declarado	|"global", "main", "if_1"
|valor	|mixed	|Valor actual almacenado	|10, "Hola", true, null
|linea	|int	|Número de línea donde se declaró	|5
|columna	|int	|Número de columna donde se declaró	|3
|esConstante	|bool	|Indica si es una constante	|true / false
|es_puntero	|bool	|(Opcional) Indica si es un puntero	|true / false
|tipo_base	|string	|(Opcional) Tipo base para punteros/arreglos	|"int32"
|tipo_retorno	|array	|(Opcional) Tipos de retorno de una función	|["int32", "bool"]|

### 6.2 Gestión de ámbitos (Scope)
#### 6.2.1. Pila de ámbitos
El intérprete mantiene una pila de ámbitos para manejar correctamente la visibilidad de las variables en bloques anidados:

```php
private $pilaAmbitos = ['global'];  // Pila de ámbitos
private $ambitoActual = 'global';   // Ámbito actual
```

#### 6.2.2. Entrar a un ámbito
```php
private function entrarAmbito($tipoAmbito)
{
    // Generar un nombre único para el ámbito
    $contador = 1;
    $nombreBase = $tipoAmbito;
    $nombreAmbito = $nombreBase;
    
    while (in_array($nombreAmbito, $this->pilaAmbitos)) {
        $nombreAmbito = $nombreBase . '_' . $contador;
        $contador++;
    }
    
    array_push($this->pilaAmbitos, $nombreAmbito);
    $this->ambitoActual = $nombreAmbito;
}
```

#### 6.2.3. Salir de un ámbito
```php
private function salirAmbito()
{
    // Eliminar las variables de este ámbito de la tabla activa
    $ambitoSalida = array_pop($this->pilaAmbitos);
    
    foreach (array_keys($this->tablaSimbolos) as $key) {
        if (isset($this->tablaSimbolos[$key]) && 
            $this->tablaSimbolos[$key]['ambito'] === $ambitoSalida) {
            unset($this->tablaSimbolos[$key]);
        }
    }
    
    $this->ambitoActual = end($this->pilaAmbitos);
}
```

#### 6.2.4. Tipos de ámbito generados
|Tipo de ámbito	|Descripción	|Ejemplo de nombre|
|---------------|---------------|-----------------|
|global	|Ámbito principal del programa	|"global"
|funcion_<nombre>	|Ámbito de una función	|"funcion_main"
|if	|Ámbito de un bloque |if	"if_1", "if_2"
|else	|Ámbito de un bloque else	|"else_1"
|else_if	|Ámbito de un else if	|"else_if_1"
|for_loop	|Ámbito del bucle for (para init)	|"for_loop_1"
|for_bloque	|Ámbito del bloque dentro del for	|"for_bloque_1"
|for_post	|Ámbito para la sentencia post del for	|"for_post_1"
|switch	|Ámbito del switch	|"switch_1"
|case	|Ámbito de un case	|"case_1"
|default	|Ámbito del default	|"default_1"

### 6.3. Valores por defecto según tipo
Cuando se declara una variable sin inicialización explícita, se le asigna el valor por defecto:

```php
private function valorPorDefecto($tipo)
{
    switch ($tipo) {
        case 'int32':   return 0;
        case 'float32': return 0.0;
        case 'string':  return "";
        case 'bool':    return false;
        case 'rune':    return '';      // Carácter nulo
        default:        return null;
    }
}
```

### 6.4. Validaciones semánticas con la tabla de símbolos
|Validación	|Método	|Descripción|
|-----------|-------|-----------|
|Variable no declarada	|existeEnAmbitoActual()	|Verifica si el identificador existe en el ámbito actual
|Identificador duplicado	|existeEnAmbitoActual()	|Verifica que no exista ya en el mismo ámbito
|Constante no modificable	|isset($constantes[$clave])	|Impide reasignación de constantes
|Tipo compatible	|tiposCompatiblesAsignacion()	|Valida que el tipo del valor coincida con el declarado
|Ámbito correcto	|$tablaSimbolos[$id]['ambito'] === $this->ambitoActual	|Verifica que se acceda desde el ámbito correcto


## 7 Módulo de análisis léxico
El análisis léxico (lexer o escáner) es la primera fase del proceso de interpretación. Su función es transformar el código fuente de Golampi en una secuencia de tokens (unidades mínimas significativas) que serán consumidas posteriormente por el analizador sintáctico (parser).

En este proyecto, el analizador léxico es generado automáticamente por ANTLRv4 a partir de las reglas definidas en la gramática Golampi.g4.

### 7.1. Arquitectura del módulo
![Modulo lexico][lexer]

[lexer]: Imagenes/modulexer.png

### 7.2. Implementación del lexer
#### 7.2.1. Creación del lexer
En index.php, el lexer se instancia de la siguiente manera:

```php
use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;

// Crear flujo de entrada desde el código fuente
$input = InputStream::fromString($codigo);

// Instanciar el lexer generado por ANTLR
$lexer = new GolampiLexer($input);

// Configurar listener de errores
$errorListener = new GolampiErrorListener();
$lexer->removeErrorListeners();
$lexer->addErrorListener($errorListener);

// Generar flujo de tokens
$tokens = new CommonTokenStream($lexer);
```

### 7.3. Manejo de errores léxicos
#### 7.3.1. Clase GolampiErrorListener
El listener personalizado captura los errores durante el análisis léxico y sintáctico:

```php
class GolampiErrorListener implements ANTLRErrorListener
{
    private $errores = [];
    
    public function syntaxError(
        Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?RecognitionException $exception = null
    ): void {
        $tipo = $this->determinarTipoError($msg, $offendingSymbol);
        
        $this->errores[] = [
            'tipo' => $tipo,        // 'Léxico' o 'Sintáctico'
            'linea' => $line,
            'columna' => $charPositionInLine + 1,
            'descripcion' => $this->limpiarMensaje($msg, $texto)
        ];
    }
}
```
#### 7.3.2. Detección de errores léxicos
```php
private function determinarTipoError(string $msg, ?object $offendingSymbol): string
{
    // Errores léxicos: caracteres no reconocidos
    if (strpos($msg, 'token recognition error') !== false) {
        return 'Léxico';
    }
    
    // Caracteres no pertenecientes al lenguaje
    if (strpos($msg, 'extraneous input') !== false && 
        preg_match('/[^a-zA-Z0-9_\s]/', $texto)) {
        return 'Léxico';
    }
    
    // Por defecto es sintáctico
    return 'Sintáctico';
}
```
## 8 Módulo de análisis sintáctico
El análisis sintáctico (parser) es la segunda fase del proceso de interpretación. Su función es verificar que la estructura del código fuente cumpla con la gramática formal del lenguaje Golampi, construyendo un Árbol de Sintaxis Abstracta (AST) que será utilizado posteriormente por el analizador semántico y el intérprete.

En este proyecto, el analizador sintáctico es generado automáticamente por ANTLRv4 a partir de las reglas gramaticales definidas en **Golampi.g4.**

### 8.1. Arquitectura del módulo

![Interfaz][sintac]

[sintac]: Imagenes/modusintac.png

### 8.2. Implementación del parser
#### 8.2.1. Instanciación del parser
En index.php, el parser se instancia de la siguiente manera:

```php
use Antlr\Antlr4\Runtime\CommonTokenStream;

// Crear flujo de tokens desde el lexer
$tokens = new CommonTokenStream($lexer);

// Instanciar el parser generado por ANTLR
$parser = new GolampiParser($tokens);

// Configurar listener de errores
$parser->removeErrorListeners();
$parser->addErrorListener($errorListener);

// Iniciar el parsing desde la regla 'programa'
$tree = $parser->programa();
```

#### 8.2.2. Manejo de errores sintácticos
El GolampiErrorListener detecta y clasifica los errores sintácticos:

```php
public function syntaxError(
    Recognizer $recognizer,
    ?object $offendingSymbol,
    int $line,
    int $charPositionInLine,
    string $msg,
    ?RecognitionException $exception = null
): void {
    // Determinar si es error léxico o sintáctico
    $tipo = $this->determinarTipoError($msg, $offendingSymbol);
    
    // Si no es léxico, es sintáctico
    if ($tipo !== 'Léxico') {
        $tipo = 'Sintáctico';
    }
    
    $this->errores[] = [
        'tipo' => $tipo,
        'linea' => $line,
        'columna' => $charPositionInLine + 1,
        'descripcion' => $this->limpiarMensaje($msg, $texto)
    ];
}
```

#### 8.2.3. Limpieza de mensajes de error
```php
private function limpiarMensaje(string $msg, string $texto = ''): string
{
    // Traducción de mensajes comunes
    $msg = str_replace('<EOF>', 'fin de archivo', $msg);
    $msg = str_replace('mismatched input', 'entrada no esperada', $msg);
    $msg = str_replace('expecting', 'se esperaba', $msg);
    $msg = str_replace('extraneous input', 'símbolo no válido', $msg);
    $msg = str_replace('no viable alternative', 'expresión no válida', $msg);
    
    return trim($msg);
}
```

### 8.3. Árbol de Sintaxis Abstracta (AST)
#### 8.3.1. Estructura del AST
El AST generado por ANTLR tiene una estructura jerárquica donde cada nodo corresponde a una regla gramatical:

```text
ProgramaContext
├── FuncionContext (main)
│   ├── IDENTIFICADOR: "main"
│   ├── PAREN_IZQ: "("
│   ├── PAREN_DER: ")"
│   └── BloqueContext
│       ├── LLAVE_IZQ: "{"
│       ├── SentenciaContext (declaracionCorta)
│       │   ├── listaIdentificadores: "x"
│       │   ├── DECLARACION_CORTA: ":="
│       │   └── listaExpresiones: "10"
│       ├── SentenciaContext (llamadaFuncion)
│       │   ├── PRINTLN: "fmt.Println"
│       │   ├── PAREN_IZQ: "("
│       │   ├── argumentos: "x"
│       │   └── PAREN_DER: ")"
│       └── LLAVE_DER: "}"
└── <EOF>
```

### 8.4. Integración con el visitador (Interpreter)
Una vez construido el AST, el visitador (Interpreter) recorre el árbol para realizar el análisis semántico y la ejecución:

```php
// Crear el visitador
$visitor = new Interpreter();

// Visitar el AST (el árbol comienza en la raíz 'programa')
$resultado = $visitor->visit($tree);

// El visitador retorna:
// - 'consola' => array con las salidas de fmt.Println
// - 'errores' => array con errores semánticos
// - 'tabla_simbolos' => array con el historial de símbolos
```

#### 8.4.1. Método visitPrograma en el Interpreter
```php
public function visitPrograma($ctx)
{
    $this->consola = [];
    $this->errores = [];
    $this->constantes = [];
    $this->pilaAmbitos = ['global'];
    $this->ambitoActual = 'global';
    $this->tablaSimbolos = [];
    $this->tablaSimbolosHistorial = [];
    $this->funciones = [];
    
    // PRIMERO: Registrar todas las funciones (hoisting)
    foreach ($ctx->funcion() as $funcion) {
        $this->visit($funcion);
    }
    
    // SEGUNDO: Ejecutar main (si existe)
    foreach ($ctx->funcion() as $funcion) {
        $nombre = $funcion->IDENTIFICADOR() ? 
                  $funcion->IDENTIFICADOR()->getText() : 'main';
        if ($nombre === 'main') {
            $this->entrarAmbito('main');
            $this->visit($funcion->bloque());
            $this->salirAmbito();
            break;
        }
    }
    
    return [
        'consola' => $this->consola,
        'errores' => $this->errores,
        'tabla_simbolos' => $this->tablaSimbolosHistorial
    ];
}
```

## 9 Módulo de análisis semántico
El análisis semántico es la tercera fase del proceso de interpretación. Su función es verificar que el código fuente, aunque sea sintácticamente correcto, cumpla con las reglas semánticas del lenguaje Golampi. Esto incluye:

- Validación de tipos de datos
- Verificación de declaración de variables
- Control de ámbitos (scopes)
- Chequeo de constantes inmutables
- Validación de funciones y sus retornos
- Detección de usos incorrectos de break/continue

En este proyecto, el análisis semántico se implementa mediante un visitor que recorre el AST generado por ANTLR.

9.1. Validaciones semánticas implementadas
9.1.1. Tabla de validaciones
|#	|Validación	|Método	|Tipo de error|
|---|-----------|-------|-------------|
|1	|Variable declarada antes de usar	|existeEnAmbitoActual()	|Semántico
|2	|Sin redeclaración en mismo ámbito	|existeEnAmbitoActual()	|Semántico
|3	|Constantes no modificables	|isset($constantes[$clave])	Semántico
|4	|Compatibilidad de tipos en asignación	|tiposCompatiblesAsignacion()	|Semántico
|5	|Compatibilidad de tipos en operaciones	|tiposCompatibles()	|Semántico
|6	|Condición de if debe ser booleana	|obtenerTipo($condicion) === 'bool'	|Semántico
|7	|Condición de for debe ser booleana	|obtenerTipo($condicion) === 'bool'	|Semántico
|8	|break solo dentro de bucle o switch	|$enBucle o $enSwitch	|Semántico
|9	|continue solo dentro de bucle	|$enBucle	|Semántico
|10	|Función main única	|$nombre === 'main'	|Semántico
|11	|Tipos de retorno coinciden con declaración	|count($valoresRetorno) === count($tiposRetorno)	|Semántico
|12	|Parámetros de función correctos	|count($argumentos) === count($listaParametros)	|Semántico
|13	|Identificador no es palabra reservada	|esPalabraReservada()	|Semántico
|14	|Constantes deben inicializarse	|Valor no puede ser nil	|Semántico
|15	|Declaración corta requiere al menos una variable nueva	|$nuevasVariables > 0	|Semántico

## 10 Interfaz gráfica (Frontend)
La Interfaz Gráfica de Usuario (GUI) es el componente frontal del intérprete Golampi. Su función es proporcionar un entorno visual interactivo donde el usuario pueda:

- Escribir y editar código fuente en lenguaje Golampi
- Cargar y guardar archivos de código
- Ejecutar programas y visualizar la salida
- Consultar y descargar reportes de errores y tabla de símbolos

##  11 Estructura de directorios del proyecto

```text
proyecto/
├── bootstrap.php              # Cargador inicial
├── src/
|    ├── ErrorListener.php  
│   ├── gramatica/             # Archivos generados por ANTLR
│   │   └── gramatica/
│   │       ├── GolampiLexer.php
│   │       ├── GolampiParser.php
│   │       └── ...
│   └── visitors/
│       ├── Interpreter.php    # Visitor principal
│       └── traits/            # Módulos funcionales
│           ├── AsignacionTrait.php
│           ├── ControlFlujoTrait.php
│           ├── ControlForTrait.php
│           ├── ControlSwitchTrait.php
│           ├── DeclaracionesTrait.php
│           ├── ExpresionesTrait.php
│           ├── FuncionEmbTrait.php
│           ├── FuncUsuarioTrait.php
│           ├── TransferenciaTrait.php
│           └── UtilidadesTrait.php
├── gramatica/
│   └── Golampi.g4           #Analizador lexico y sintactico
├── public/
│   └── index.php              # Interfaz gráfica
└── vendor/                     # Dependencias (Composer)
```
