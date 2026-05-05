grammar Golampi;

// ============= TOKENS =============
// Palabras reservadas
VAR: 'var';
CONST: 'const';
FUNC: 'func';
MAIN: 'main';
IF: 'if';
ELSE: 'else';
FOR: 'for';
RETURN: 'return';
BREAK: 'break';
CONTINUE: 'continue';
SWITCH: 'switch';
CASE: 'case';
DEFAULT: 'default';
NIL: 'nil';
TRUE: 'true';
FALSE: 'false';

// Funciones embebidas
PRINTLN: 'fmt.Println';
LEN: 'len';
NOW: 'now';
SUBSTR: 'substr';
TYPEOF: 'typeOf';

// Tipos
INT32: 'int32';
FLOAT32: 'float32';
STRING: 'string';
BOOL: 'bool';
RUNE: 'rune';

// Operadores
ASIGNACION: '=';
MAS: '+';
MENOS: '-';
MULT: '*';
DIV: '/';
MOD: '%';
IGUAL: '==';
DIFERENTE: '!=';
MAYOR: '>';
MENOR: '<';
MAYOR_IGUAL: '>=';
MENOR_IGUAL: '<=';
AND: '&&';
OR: '||';
NOT: '!';
INCREMENTO: '++';
DECREMENTO: '--';

// Símbolos
PAREN_IZQ: '(';
PAREN_DER: ')';
LLAVE_IZQ: '{';
LLAVE_DER: '}';
CORCHETE_IZQ: '[';
CORCHETE_DER: ']';
COMA: ',';
PUNTO: '.';
DOS_PUNTOS: ':';
PUNTO_COMA: ';';
DECLARACION_CORTA: ':=';

// Literales
NUMERO_ENTERO: [0-9]+;
NUMERO_DECIMAL: [0-9]+ '.' [0-9]+;
CADENA: '"' ('\\"' | ~["\r\n])* '"';
CARACTER: '\'' ('\\\'' | ~['\r\n]) '\'';
IDENTIFICADOR: [a-zA-Z_][a-zA-Z0-9_]*;

// Comentarios
COMENTARIO_LINEA: '//' ~[\r\n]* -> skip;
COMENTARIO_BLOQUE: '/*' .*? '*/' -> skip;

// Espacios en blanco
WS: [ \t\r\n]+ -> skip;

// ============= REGLAS DEL PARSER =============
programa: (funcion)* EOF;

funcion: FUNC IDENTIFICADOR '(' parametros? ')' (tipo | '(' tipos? ')')? bloque
       | FUNC MAIN '(' ')' bloque
       ;

parametros: parametro (COMA parametro)*;
parametro: IDENTIFICADOR tipo;

tipos: tipo (COMA tipo)*;

tipo: INT32 
     | FLOAT32 
     | STRING 
     | BOOL 
     | RUNE 
     | '[' expresion ']' tipo 
     | MULT tipo
     ;

bloque: LLAVE_IZQ sentencia* LLAVE_DER;

sentencia: declaracionVar PUNTO_COMA?
        | declaracionConstante PUNTO_COMA?
        | declaracionCorta PUNTO_COMA?
        | asignacion PUNTO_COMA?
        | llamadaFuncion PUNTO_COMA?      
        | ifStmt
        | forStmt
        | switchStmt  
        | returnStmt PUNTO_COMA?
        | breakStmt PUNTO_COMA?
        | continueStmt PUNTO_COMA?
        | bloque
        ;

// === DECLARACIONES ===
declaracionVar: VAR listaIdentificadores tipo (ASIGNACION listaExpresiones)?;
declaracionConstante: CONST IDENTIFICADOR tipo ASIGNACION expresion;
declaracionCorta: listaIdentificadores DECLARACION_CORTA listaExpresiones;

listaIdentificadores: IDENTIFICADOR (COMA IDENTIFICADOR)*;
listaExpresiones: expresion (COMA expresion)*;

// === ASIGNACIONES ===
asignacion: (MULT)? IDENTIFICADOR (operadorAsignacion expresion | INCREMENTO | DECREMENTO);
operadorAsignacion: ASIGNACION | MAS_ASIGNACION | MENOS_ASIGNACION | MULT_ASIGNACION | DIV_ASIGNACION;

// === EXPRESIONES ===
expresion: expresionLogica;

expresionLogica: expresionComparacion ( (AND | OR) expresionComparacion )*;
expresionComparacion: expresionAditiva ( (IGUAL | DIFERENTE | MAYOR | MENOR | MAYOR_IGUAL | MENOR_IGUAL) expresionAditiva )*;
expresionAditiva: expresionMultiplicativa ( (MAS | MENOS) expresionMultiplicativa )*;
expresionMultiplicativa: expresionUnaria ( (MULT | DIV | MOD) expresionUnaria )*;
expresionUnaria: (NOT | MENOS | MULT | '&')? expresionPrimaria;

expresionPrimaria: IDENTIFICADOR (CORCHETE_IZQ expresion CORCHETE_DER)+
                 | NUMERO_ENTERO
                 | NUMERO_DECIMAL
                 | CADENA
                 | CARACTER
                 | TRUE
                 | FALSE
                 | NIL
                 | IDENTIFICADOR
                 | PRINTLN
                 | LEN
                 | NOW
                 | SUBSTR
                 | TYPEOF
                 | tipo PAREN_IZQ expresion PAREN_DER 
                 | llamadaFuncion
                 | PAREN_IZQ expresion PAREN_DER
                 | arregloLiteral
                 ;

// Regla específica para literales de arreglo como: [5]int32{1,2,3}
arregloLiteral: CORCHETE_IZQ listaExpresiones? CORCHETE_DER tipo LLAVE_IZQ valoresArreglo LLAVE_DER;

// Valores dentro de las llaves
valoresArreglo: (elementoArreglo (COMA elementoArreglo)*)?;

// Un elemento puede ser una expresión o un sub-arreglo anidado
elementoArreglo: expresion
               | LLAVE_IZQ valoresArreglo LLAVE_DER
               ;

/// === FUNCIONES ===
llamadaFuncion: (IDENTIFICADOR | PRINTLN | LEN | NOW | SUBSTR | TYPEOF) PAREN_IZQ argumentos? PAREN_DER;
argumentos: expresion (COMA expresion)*;

// === CONTROL DE FLUJO ===
ifStmt: IF expresion bloque (ELSE (ifStmt | bloque))?;

forStmt: FOR forHeader bloque;
forHeader: forClause 
         | expresion 
         | /* empty */
         ;

forClause: initStmt? ';' expresion? ';' postStmt?;
initStmt: declaracionCorta | asignacion | expresion;
postStmt: asignacion | expresion | INCREMENTO | DECREMENTO;

switchStmt: SWITCH expresion LLAVE_IZQ casoBloques LLAVE_DER;
casoBloques: (caso | defaultBloque)*;
caso: CASE listaExpresiones DOS_PUNTOS sentencia*;
defaultBloque: DEFAULT DOS_PUNTOS sentencia*;

// === TRANSFERENCIA ===
returnStmt: RETURN (expresion (COMA expresion)*)?;
breakStmt: BREAK;
continueStmt: CONTINUE;

/// === OPERADORES ADICIONALES ===
MAS_ASIGNACION: '+=';
MENOS_ASIGNACION: '-=';
MULT_ASIGNACION: '*=';
DIV_ASIGNACION: '/=';