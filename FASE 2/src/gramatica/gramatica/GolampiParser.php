<?php

/*
 * Generated from gramatica/Golampi.g4 by ANTLR 4.13.2
 */

namespace {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class GolampiParser extends Parser
	{
		public const T__0 = 1, VAR = 2, CONST = 3, FUNC = 4, MAIN = 5, IF = 6, 
               ELSE = 7, FOR = 8, RETURN = 9, BREAK = 10, CONTINUE = 11, 
               SWITCH = 12, CASE = 13, DEFAULT = 14, NIL = 15, TRUE = 16, 
               FALSE = 17, PRINTLN = 18, LEN = 19, NOW = 20, SUBSTR = 21, 
               TYPEOF = 22, INT32 = 23, FLOAT32 = 24, STRING = 25, BOOL = 26, 
               RUNE = 27, ASIGNACION = 28, MAS = 29, MENOS = 30, MULT = 31, 
               DIV = 32, MOD = 33, IGUAL = 34, DIFERENTE = 35, MAYOR = 36, 
               MENOR = 37, MAYOR_IGUAL = 38, MENOR_IGUAL = 39, AND = 40, 
               OR = 41, NOT = 42, INCREMENTO = 43, DECREMENTO = 44, PAREN_IZQ = 45, 
               PAREN_DER = 46, LLAVE_IZQ = 47, LLAVE_DER = 48, CORCHETE_IZQ = 49, 
               CORCHETE_DER = 50, COMA = 51, PUNTO = 52, DOS_PUNTOS = 53, 
               PUNTO_COMA = 54, DECLARACION_CORTA = 55, NUMERO_ENTERO = 56, 
               NUMERO_DECIMAL = 57, CADENA = 58, CARACTER = 59, IDENTIFICADOR = 60, 
               COMENTARIO_LINEA = 61, COMENTARIO_BLOQUE = 62, WS = 63, MAS_ASIGNACION = 64, 
               MENOS_ASIGNACION = 65, MULT_ASIGNACION = 66, DIV_ASIGNACION = 67;

		public const RULE_programa = 0, RULE_funcion = 1, RULE_parametros = 2, 
               RULE_parametro = 3, RULE_tipos = 4, RULE_tipo = 5, RULE_bloque = 6, 
               RULE_sentencia = 7, RULE_declaracionVar = 8, RULE_declaracionConstante = 9, 
               RULE_declaracionCorta = 10, RULE_listaIdentificadores = 11, 
               RULE_listaExpresiones = 12, RULE_asignacion = 13, RULE_operadorAsignacion = 14, 
               RULE_expresion = 15, RULE_expresionLogica = 16, RULE_expresionComparacion = 17, 
               RULE_expresionAditiva = 18, RULE_expresionMultiplicativa = 19, 
               RULE_expresionUnaria = 20, RULE_expresionPrimaria = 21, RULE_llamadaFuncion = 22, 
               RULE_argumentos = 23, RULE_ifStmt = 24, RULE_forStmt = 25, 
               RULE_forHeader = 26, RULE_forClause = 27, RULE_initStmt = 28, 
               RULE_postStmt = 29, RULE_switchStmt = 30, RULE_casoBloques = 31, 
               RULE_caso = 32, RULE_defaultBloque = 33, RULE_returnStmt = 34, 
               RULE_breakStmt = 35, RULE_continueStmt = 36;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'programa', 'funcion', 'parametros', 'parametro', 'tipos', 'tipo', 'bloque', 
			'sentencia', 'declaracionVar', 'declaracionConstante', 'declaracionCorta', 
			'listaIdentificadores', 'listaExpresiones', 'asignacion', 'operadorAsignacion', 
			'expresion', 'expresionLogica', 'expresionComparacion', 'expresionAditiva', 
			'expresionMultiplicativa', 'expresionUnaria', 'expresionPrimaria', 'llamadaFuncion', 
			'argumentos', 'ifStmt', 'forStmt', 'forHeader', 'forClause', 'initStmt', 
			'postStmt', 'switchStmt', 'casoBloques', 'caso', 'defaultBloque', 'returnStmt', 
			'breakStmt', 'continueStmt'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'&'", "'var'", "'const'", "'func'", "'main'", "'if'", "'else'", 
		    "'for'", "'return'", "'break'", "'continue'", "'switch'", "'case'", 
		    "'default'", "'nil'", "'true'", "'false'", "'fmt.Println'", "'len'", 
		    "'now'", "'substr'", "'typeOf'", "'int32'", "'float32'", "'string'", 
		    "'bool'", "'rune'", "'='", "'+'", "'-'", "'*'", "'/'", "'%'", "'=='", 
		    "'!='", "'>'", "'<'", "'>='", "'<='", "'&&'", "'||'", "'!'", "'++'", 
		    "'--'", "'('", "')'", "'{'", "'}'", "'['", "']'", "','", "'.'", "':'", 
		    "';'", "':='", null, null, null, null, null, null, null, null, "'+='", 
		    "'-='", "'*='", "'/='"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, null, "VAR", "CONST", "FUNC", "MAIN", "IF", "ELSE", "FOR", "RETURN", 
		    "BREAK", "CONTINUE", "SWITCH", "CASE", "DEFAULT", "NIL", "TRUE", "FALSE", 
		    "PRINTLN", "LEN", "NOW", "SUBSTR", "TYPEOF", "INT32", "FLOAT32", "STRING", 
		    "BOOL", "RUNE", "ASIGNACION", "MAS", "MENOS", "MULT", "DIV", "MOD", 
		    "IGUAL", "DIFERENTE", "MAYOR", "MENOR", "MAYOR_IGUAL", "MENOR_IGUAL", 
		    "AND", "OR", "NOT", "INCREMENTO", "DECREMENTO", "PAREN_IZQ", "PAREN_DER", 
		    "LLAVE_IZQ", "LLAVE_DER", "CORCHETE_IZQ", "CORCHETE_DER", "COMA", 
		    "PUNTO", "DOS_PUNTOS", "PUNTO_COMA", "DECLARACION_CORTA", "NUMERO_ENTERO", 
		    "NUMERO_DECIMAL", "CADENA", "CARACTER", "IDENTIFICADOR", "COMENTARIO_LINEA", 
		    "COMENTARIO_BLOQUE", "WS", "MAS_ASIGNACION", "MENOS_ASIGNACION", "MULT_ASIGNACION", 
		    "DIV_ASIGNACION"
		];

		private const SERIALIZED_ATN =
			[4, 1, 67, 402, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    2, 29, 7, 29, 2, 30, 7, 30, 2, 31, 7, 31, 2, 32, 7, 32, 2, 33, 7, 
		    33, 2, 34, 7, 34, 2, 35, 7, 35, 2, 36, 7, 36, 1, 0, 5, 0, 76, 8, 0, 
		    10, 0, 12, 0, 79, 9, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 
		    87, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 93, 8, 1, 1, 1, 3, 1, 96, 
		    8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 104, 8, 1, 1, 2, 1, 
		    2, 1, 2, 5, 2, 109, 8, 2, 10, 2, 12, 2, 112, 9, 2, 1, 3, 1, 3, 1, 
		    3, 1, 4, 1, 4, 1, 4, 5, 4, 120, 8, 4, 10, 4, 12, 4, 123, 9, 4, 1, 
		    5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 
		    5, 3, 5, 137, 8, 5, 1, 6, 1, 6, 5, 6, 141, 8, 6, 10, 6, 12, 6, 144, 
		    9, 6, 1, 6, 1, 6, 1, 7, 1, 7, 3, 7, 150, 8, 7, 1, 7, 1, 7, 3, 7, 154, 
		    8, 7, 1, 7, 1, 7, 3, 7, 158, 8, 7, 1, 7, 1, 7, 3, 7, 162, 8, 7, 1, 
		    7, 1, 7, 3, 7, 166, 8, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 3, 7, 173, 
		    8, 7, 1, 7, 1, 7, 3, 7, 177, 8, 7, 1, 7, 1, 7, 3, 7, 181, 8, 7, 1, 
		    7, 3, 7, 184, 8, 7, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 3, 8, 191, 8, 8, 
		    1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 10, 1, 10, 1, 10, 1, 10, 1, 
		    11, 1, 11, 1, 11, 5, 11, 206, 8, 11, 10, 11, 12, 11, 209, 9, 11, 1, 
		    12, 1, 12, 1, 12, 5, 12, 214, 8, 12, 10, 12, 12, 12, 217, 9, 12, 1, 
		    13, 3, 13, 220, 8, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 3, 
		    13, 228, 8, 13, 1, 14, 1, 14, 1, 15, 1, 15, 1, 16, 1, 16, 1, 16, 5, 
		    16, 237, 8, 16, 10, 16, 12, 16, 240, 9, 16, 1, 17, 1, 17, 1, 17, 5, 
		    17, 245, 8, 17, 10, 17, 12, 17, 248, 9, 17, 1, 18, 1, 18, 1, 18, 5, 
		    18, 253, 8, 18, 10, 18, 12, 18, 256, 9, 18, 1, 19, 1, 19, 1, 19, 5, 
		    19, 261, 8, 19, 10, 19, 12, 19, 264, 9, 19, 1, 20, 3, 20, 267, 8, 
		    20, 1, 20, 1, 20, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 
		    1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 
		    21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 3, 21, 
		    296, 8, 21, 1, 21, 3, 21, 299, 8, 21, 1, 22, 1, 22, 1, 22, 3, 22, 
		    304, 8, 22, 1, 22, 1, 22, 1, 23, 1, 23, 1, 23, 5, 23, 311, 8, 23, 
		    10, 23, 12, 23, 314, 9, 23, 1, 24, 1, 24, 1, 24, 1, 24, 1, 24, 1, 
		    24, 3, 24, 322, 8, 24, 3, 24, 324, 8, 24, 1, 25, 1, 25, 1, 25, 1, 
		    25, 1, 26, 1, 26, 1, 26, 3, 26, 333, 8, 26, 1, 27, 3, 27, 336, 8, 
		    27, 1, 27, 1, 27, 3, 27, 340, 8, 27, 1, 27, 1, 27, 3, 27, 344, 8, 
		    27, 1, 28, 1, 28, 1, 28, 3, 28, 349, 8, 28, 1, 29, 1, 29, 1, 29, 1, 
		    29, 3, 29, 355, 8, 29, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 30, 1, 
		    31, 1, 31, 5, 31, 365, 8, 31, 10, 31, 12, 31, 368, 9, 31, 1, 32, 1, 
		    32, 1, 32, 1, 32, 5, 32, 374, 8, 32, 10, 32, 12, 32, 377, 9, 32, 1, 
		    33, 1, 33, 1, 33, 5, 33, 382, 8, 33, 10, 33, 12, 33, 385, 9, 33, 1, 
		    34, 1, 34, 1, 34, 1, 34, 5, 34, 391, 8, 34, 10, 34, 12, 34, 394, 9, 
		    34, 3, 34, 396, 8, 34, 1, 35, 1, 35, 1, 36, 1, 36, 1, 36, 0, 0, 37, 
		    0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 
		    36, 38, 40, 42, 44, 46, 48, 50, 52, 54, 56, 58, 60, 62, 64, 66, 68, 
		    70, 72, 0, 7, 2, 0, 28, 28, 64, 67, 1, 0, 40, 41, 1, 0, 34, 39, 1, 
		    0, 29, 30, 1, 0, 31, 33, 3, 0, 1, 1, 30, 31, 42, 42, 2, 0, 18, 22, 
		    60, 60, 446, 0, 77, 1, 0, 0, 0, 2, 103, 1, 0, 0, 0, 4, 105, 1, 0, 
		    0, 0, 6, 113, 1, 0, 0, 0, 8, 116, 1, 0, 0, 0, 10, 136, 1, 0, 0, 0, 
		    12, 138, 1, 0, 0, 0, 14, 183, 1, 0, 0, 0, 16, 185, 1, 0, 0, 0, 18, 
		    192, 1, 0, 0, 0, 20, 198, 1, 0, 0, 0, 22, 202, 1, 0, 0, 0, 24, 210, 
		    1, 0, 0, 0, 26, 219, 1, 0, 0, 0, 28, 229, 1, 0, 0, 0, 30, 231, 1, 
		    0, 0, 0, 32, 233, 1, 0, 0, 0, 34, 241, 1, 0, 0, 0, 36, 249, 1, 0, 
		    0, 0, 38, 257, 1, 0, 0, 0, 40, 266, 1, 0, 0, 0, 42, 298, 1, 0, 0, 
		    0, 44, 300, 1, 0, 0, 0, 46, 307, 1, 0, 0, 0, 48, 315, 1, 0, 0, 0, 
		    50, 325, 1, 0, 0, 0, 52, 332, 1, 0, 0, 0, 54, 335, 1, 0, 0, 0, 56, 
		    348, 1, 0, 0, 0, 58, 354, 1, 0, 0, 0, 60, 356, 1, 0, 0, 0, 62, 366, 
		    1, 0, 0, 0, 64, 369, 1, 0, 0, 0, 66, 378, 1, 0, 0, 0, 68, 386, 1, 
		    0, 0, 0, 70, 397, 1, 0, 0, 0, 72, 399, 1, 0, 0, 0, 74, 76, 3, 2, 1, 
		    0, 75, 74, 1, 0, 0, 0, 76, 79, 1, 0, 0, 0, 77, 75, 1, 0, 0, 0, 77, 
		    78, 1, 0, 0, 0, 78, 80, 1, 0, 0, 0, 79, 77, 1, 0, 0, 0, 80, 81, 5, 
		    0, 0, 1, 81, 1, 1, 0, 0, 0, 82, 83, 5, 4, 0, 0, 83, 84, 5, 60, 0, 
		    0, 84, 86, 5, 45, 0, 0, 85, 87, 3, 4, 2, 0, 86, 85, 1, 0, 0, 0, 86, 
		    87, 1, 0, 0, 0, 87, 88, 1, 0, 0, 0, 88, 95, 5, 46, 0, 0, 89, 96, 3, 
		    10, 5, 0, 90, 92, 5, 45, 0, 0, 91, 93, 3, 8, 4, 0, 92, 91, 1, 0, 0, 
		    0, 92, 93, 1, 0, 0, 0, 93, 94, 1, 0, 0, 0, 94, 96, 5, 46, 0, 0, 95, 
		    89, 1, 0, 0, 0, 95, 90, 1, 0, 0, 0, 95, 96, 1, 0, 0, 0, 96, 97, 1, 
		    0, 0, 0, 97, 104, 3, 12, 6, 0, 98, 99, 5, 4, 0, 0, 99, 100, 5, 5, 
		    0, 0, 100, 101, 5, 45, 0, 0, 101, 102, 5, 46, 0, 0, 102, 104, 3, 12, 
		    6, 0, 103, 82, 1, 0, 0, 0, 103, 98, 1, 0, 0, 0, 104, 3, 1, 0, 0, 0, 
		    105, 110, 3, 6, 3, 0, 106, 107, 5, 51, 0, 0, 107, 109, 3, 6, 3, 0, 
		    108, 106, 1, 0, 0, 0, 109, 112, 1, 0, 0, 0, 110, 108, 1, 0, 0, 0, 
		    110, 111, 1, 0, 0, 0, 111, 5, 1, 0, 0, 0, 112, 110, 1, 0, 0, 0, 113, 
		    114, 5, 60, 0, 0, 114, 115, 3, 10, 5, 0, 115, 7, 1, 0, 0, 0, 116, 
		    121, 3, 10, 5, 0, 117, 118, 5, 51, 0, 0, 118, 120, 3, 10, 5, 0, 119, 
		    117, 1, 0, 0, 0, 120, 123, 1, 0, 0, 0, 121, 119, 1, 0, 0, 0, 121, 
		    122, 1, 0, 0, 0, 122, 9, 1, 0, 0, 0, 123, 121, 1, 0, 0, 0, 124, 137, 
		    5, 23, 0, 0, 125, 137, 5, 24, 0, 0, 126, 137, 5, 25, 0, 0, 127, 137, 
		    5, 26, 0, 0, 128, 137, 5, 27, 0, 0, 129, 130, 5, 49, 0, 0, 130, 131, 
		    3, 30, 15, 0, 131, 132, 5, 50, 0, 0, 132, 133, 3, 10, 5, 0, 133, 137, 
		    1, 0, 0, 0, 134, 135, 5, 31, 0, 0, 135, 137, 3, 10, 5, 0, 136, 124, 
		    1, 0, 0, 0, 136, 125, 1, 0, 0, 0, 136, 126, 1, 0, 0, 0, 136, 127, 
		    1, 0, 0, 0, 136, 128, 1, 0, 0, 0, 136, 129, 1, 0, 0, 0, 136, 134, 
		    1, 0, 0, 0, 137, 11, 1, 0, 0, 0, 138, 142, 5, 47, 0, 0, 139, 141, 
		    3, 14, 7, 0, 140, 139, 1, 0, 0, 0, 141, 144, 1, 0, 0, 0, 142, 140, 
		    1, 0, 0, 0, 142, 143, 1, 0, 0, 0, 143, 145, 1, 0, 0, 0, 144, 142, 
		    1, 0, 0, 0, 145, 146, 5, 48, 0, 0, 146, 13, 1, 0, 0, 0, 147, 149, 
		    3, 16, 8, 0, 148, 150, 5, 54, 0, 0, 149, 148, 1, 0, 0, 0, 149, 150, 
		    1, 0, 0, 0, 150, 184, 1, 0, 0, 0, 151, 153, 3, 18, 9, 0, 152, 154, 
		    5, 54, 0, 0, 153, 152, 1, 0, 0, 0, 153, 154, 1, 0, 0, 0, 154, 184, 
		    1, 0, 0, 0, 155, 157, 3, 20, 10, 0, 156, 158, 5, 54, 0, 0, 157, 156, 
		    1, 0, 0, 0, 157, 158, 1, 0, 0, 0, 158, 184, 1, 0, 0, 0, 159, 161, 
		    3, 26, 13, 0, 160, 162, 5, 54, 0, 0, 161, 160, 1, 0, 0, 0, 161, 162, 
		    1, 0, 0, 0, 162, 184, 1, 0, 0, 0, 163, 165, 3, 44, 22, 0, 164, 166, 
		    5, 54, 0, 0, 165, 164, 1, 0, 0, 0, 165, 166, 1, 0, 0, 0, 166, 184, 
		    1, 0, 0, 0, 167, 184, 3, 48, 24, 0, 168, 184, 3, 50, 25, 0, 169, 184, 
		    3, 60, 30, 0, 170, 172, 3, 68, 34, 0, 171, 173, 5, 54, 0, 0, 172, 
		    171, 1, 0, 0, 0, 172, 173, 1, 0, 0, 0, 173, 184, 1, 0, 0, 0, 174, 
		    176, 3, 70, 35, 0, 175, 177, 5, 54, 0, 0, 176, 175, 1, 0, 0, 0, 176, 
		    177, 1, 0, 0, 0, 177, 184, 1, 0, 0, 0, 178, 180, 3, 72, 36, 0, 179, 
		    181, 5, 54, 0, 0, 180, 179, 1, 0, 0, 0, 180, 181, 1, 0, 0, 0, 181, 
		    184, 1, 0, 0, 0, 182, 184, 3, 12, 6, 0, 183, 147, 1, 0, 0, 0, 183, 
		    151, 1, 0, 0, 0, 183, 155, 1, 0, 0, 0, 183, 159, 1, 0, 0, 0, 183, 
		    163, 1, 0, 0, 0, 183, 167, 1, 0, 0, 0, 183, 168, 1, 0, 0, 0, 183, 
		    169, 1, 0, 0, 0, 183, 170, 1, 0, 0, 0, 183, 174, 1, 0, 0, 0, 183, 
		    178, 1, 0, 0, 0, 183, 182, 1, 0, 0, 0, 184, 15, 1, 0, 0, 0, 185, 186, 
		    5, 2, 0, 0, 186, 187, 3, 22, 11, 0, 187, 190, 3, 10, 5, 0, 188, 189, 
		    5, 28, 0, 0, 189, 191, 3, 24, 12, 0, 190, 188, 1, 0, 0, 0, 190, 191, 
		    1, 0, 0, 0, 191, 17, 1, 0, 0, 0, 192, 193, 5, 3, 0, 0, 193, 194, 5, 
		    60, 0, 0, 194, 195, 3, 10, 5, 0, 195, 196, 5, 28, 0, 0, 196, 197, 
		    3, 30, 15, 0, 197, 19, 1, 0, 0, 0, 198, 199, 3, 22, 11, 0, 199, 200, 
		    5, 55, 0, 0, 200, 201, 3, 24, 12, 0, 201, 21, 1, 0, 0, 0, 202, 207, 
		    5, 60, 0, 0, 203, 204, 5, 51, 0, 0, 204, 206, 5, 60, 0, 0, 205, 203, 
		    1, 0, 0, 0, 206, 209, 1, 0, 0, 0, 207, 205, 1, 0, 0, 0, 207, 208, 
		    1, 0, 0, 0, 208, 23, 1, 0, 0, 0, 209, 207, 1, 0, 0, 0, 210, 215, 3, 
		    30, 15, 0, 211, 212, 5, 51, 0, 0, 212, 214, 3, 30, 15, 0, 213, 211, 
		    1, 0, 0, 0, 214, 217, 1, 0, 0, 0, 215, 213, 1, 0, 0, 0, 215, 216, 
		    1, 0, 0, 0, 216, 25, 1, 0, 0, 0, 217, 215, 1, 0, 0, 0, 218, 220, 5, 
		    31, 0, 0, 219, 218, 1, 0, 0, 0, 219, 220, 1, 0, 0, 0, 220, 221, 1, 
		    0, 0, 0, 221, 227, 5, 60, 0, 0, 222, 223, 3, 28, 14, 0, 223, 224, 
		    3, 30, 15, 0, 224, 228, 1, 0, 0, 0, 225, 228, 5, 43, 0, 0, 226, 228, 
		    5, 44, 0, 0, 227, 222, 1, 0, 0, 0, 227, 225, 1, 0, 0, 0, 227, 226, 
		    1, 0, 0, 0, 228, 27, 1, 0, 0, 0, 229, 230, 7, 0, 0, 0, 230, 29, 1, 
		    0, 0, 0, 231, 232, 3, 32, 16, 0, 232, 31, 1, 0, 0, 0, 233, 238, 3, 
		    34, 17, 0, 234, 235, 7, 1, 0, 0, 235, 237, 3, 34, 17, 0, 236, 234, 
		    1, 0, 0, 0, 237, 240, 1, 0, 0, 0, 238, 236, 1, 0, 0, 0, 238, 239, 
		    1, 0, 0, 0, 239, 33, 1, 0, 0, 0, 240, 238, 1, 0, 0, 0, 241, 246, 3, 
		    36, 18, 0, 242, 243, 7, 2, 0, 0, 243, 245, 3, 36, 18, 0, 244, 242, 
		    1, 0, 0, 0, 245, 248, 1, 0, 0, 0, 246, 244, 1, 0, 0, 0, 246, 247, 
		    1, 0, 0, 0, 247, 35, 1, 0, 0, 0, 248, 246, 1, 0, 0, 0, 249, 254, 3, 
		    38, 19, 0, 250, 251, 7, 3, 0, 0, 251, 253, 3, 38, 19, 0, 252, 250, 
		    1, 0, 0, 0, 253, 256, 1, 0, 0, 0, 254, 252, 1, 0, 0, 0, 254, 255, 
		    1, 0, 0, 0, 255, 37, 1, 0, 0, 0, 256, 254, 1, 0, 0, 0, 257, 262, 3, 
		    40, 20, 0, 258, 259, 7, 4, 0, 0, 259, 261, 3, 40, 20, 0, 260, 258, 
		    1, 0, 0, 0, 261, 264, 1, 0, 0, 0, 262, 260, 1, 0, 0, 0, 262, 263, 
		    1, 0, 0, 0, 263, 39, 1, 0, 0, 0, 264, 262, 1, 0, 0, 0, 265, 267, 7, 
		    5, 0, 0, 266, 265, 1, 0, 0, 0, 266, 267, 1, 0, 0, 0, 267, 268, 1, 
		    0, 0, 0, 268, 269, 3, 42, 21, 0, 269, 41, 1, 0, 0, 0, 270, 299, 5, 
		    56, 0, 0, 271, 299, 5, 57, 0, 0, 272, 299, 5, 58, 0, 0, 273, 299, 
		    5, 59, 0, 0, 274, 299, 5, 16, 0, 0, 275, 299, 5, 17, 0, 0, 276, 299, 
		    5, 15, 0, 0, 277, 299, 5, 60, 0, 0, 278, 299, 5, 18, 0, 0, 279, 299, 
		    5, 19, 0, 0, 280, 299, 5, 20, 0, 0, 281, 299, 5, 21, 0, 0, 282, 299, 
		    5, 22, 0, 0, 283, 284, 3, 10, 5, 0, 284, 285, 5, 45, 0, 0, 285, 286, 
		    3, 30, 15, 0, 286, 287, 5, 46, 0, 0, 287, 299, 1, 0, 0, 0, 288, 299, 
		    3, 44, 22, 0, 289, 290, 5, 45, 0, 0, 290, 291, 3, 30, 15, 0, 291, 
		    292, 5, 46, 0, 0, 292, 299, 1, 0, 0, 0, 293, 295, 5, 49, 0, 0, 294, 
		    296, 3, 24, 12, 0, 295, 294, 1, 0, 0, 0, 295, 296, 1, 0, 0, 0, 296, 
		    297, 1, 0, 0, 0, 297, 299, 5, 50, 0, 0, 298, 270, 1, 0, 0, 0, 298, 
		    271, 1, 0, 0, 0, 298, 272, 1, 0, 0, 0, 298, 273, 1, 0, 0, 0, 298, 
		    274, 1, 0, 0, 0, 298, 275, 1, 0, 0, 0, 298, 276, 1, 0, 0, 0, 298, 
		    277, 1, 0, 0, 0, 298, 278, 1, 0, 0, 0, 298, 279, 1, 0, 0, 0, 298, 
		    280, 1, 0, 0, 0, 298, 281, 1, 0, 0, 0, 298, 282, 1, 0, 0, 0, 298, 
		    283, 1, 0, 0, 0, 298, 288, 1, 0, 0, 0, 298, 289, 1, 0, 0, 0, 298, 
		    293, 1, 0, 0, 0, 299, 43, 1, 0, 0, 0, 300, 301, 7, 6, 0, 0, 301, 303, 
		    5, 45, 0, 0, 302, 304, 3, 46, 23, 0, 303, 302, 1, 0, 0, 0, 303, 304, 
		    1, 0, 0, 0, 304, 305, 1, 0, 0, 0, 305, 306, 5, 46, 0, 0, 306, 45, 
		    1, 0, 0, 0, 307, 312, 3, 30, 15, 0, 308, 309, 5, 51, 0, 0, 309, 311, 
		    3, 30, 15, 0, 310, 308, 1, 0, 0, 0, 311, 314, 1, 0, 0, 0, 312, 310, 
		    1, 0, 0, 0, 312, 313, 1, 0, 0, 0, 313, 47, 1, 0, 0, 0, 314, 312, 1, 
		    0, 0, 0, 315, 316, 5, 6, 0, 0, 316, 317, 3, 30, 15, 0, 317, 323, 3, 
		    12, 6, 0, 318, 321, 5, 7, 0, 0, 319, 322, 3, 48, 24, 0, 320, 322, 
		    3, 12, 6, 0, 321, 319, 1, 0, 0, 0, 321, 320, 1, 0, 0, 0, 322, 324, 
		    1, 0, 0, 0, 323, 318, 1, 0, 0, 0, 323, 324, 1, 0, 0, 0, 324, 49, 1, 
		    0, 0, 0, 325, 326, 5, 8, 0, 0, 326, 327, 3, 52, 26, 0, 327, 328, 3, 
		    12, 6, 0, 328, 51, 1, 0, 0, 0, 329, 333, 3, 54, 27, 0, 330, 333, 3, 
		    30, 15, 0, 331, 333, 1, 0, 0, 0, 332, 329, 1, 0, 0, 0, 332, 330, 1, 
		    0, 0, 0, 332, 331, 1, 0, 0, 0, 333, 53, 1, 0, 0, 0, 334, 336, 3, 56, 
		    28, 0, 335, 334, 1, 0, 0, 0, 335, 336, 1, 0, 0, 0, 336, 337, 1, 0, 
		    0, 0, 337, 339, 5, 54, 0, 0, 338, 340, 3, 30, 15, 0, 339, 338, 1, 
		    0, 0, 0, 339, 340, 1, 0, 0, 0, 340, 341, 1, 0, 0, 0, 341, 343, 5, 
		    54, 0, 0, 342, 344, 3, 58, 29, 0, 343, 342, 1, 0, 0, 0, 343, 344, 
		    1, 0, 0, 0, 344, 55, 1, 0, 0, 0, 345, 349, 3, 20, 10, 0, 346, 349, 
		    3, 26, 13, 0, 347, 349, 3, 30, 15, 0, 348, 345, 1, 0, 0, 0, 348, 346, 
		    1, 0, 0, 0, 348, 347, 1, 0, 0, 0, 349, 57, 1, 0, 0, 0, 350, 355, 3, 
		    26, 13, 0, 351, 355, 3, 30, 15, 0, 352, 355, 5, 43, 0, 0, 353, 355, 
		    5, 44, 0, 0, 354, 350, 1, 0, 0, 0, 354, 351, 1, 0, 0, 0, 354, 352, 
		    1, 0, 0, 0, 354, 353, 1, 0, 0, 0, 355, 59, 1, 0, 0, 0, 356, 357, 5, 
		    12, 0, 0, 357, 358, 3, 30, 15, 0, 358, 359, 5, 47, 0, 0, 359, 360, 
		    3, 62, 31, 0, 360, 361, 5, 48, 0, 0, 361, 61, 1, 0, 0, 0, 362, 365, 
		    3, 64, 32, 0, 363, 365, 3, 66, 33, 0, 364, 362, 1, 0, 0, 0, 364, 363, 
		    1, 0, 0, 0, 365, 368, 1, 0, 0, 0, 366, 364, 1, 0, 0, 0, 366, 367, 
		    1, 0, 0, 0, 367, 63, 1, 0, 0, 0, 368, 366, 1, 0, 0, 0, 369, 370, 5, 
		    13, 0, 0, 370, 371, 3, 24, 12, 0, 371, 375, 5, 53, 0, 0, 372, 374, 
		    3, 14, 7, 0, 373, 372, 1, 0, 0, 0, 374, 377, 1, 0, 0, 0, 375, 373, 
		    1, 0, 0, 0, 375, 376, 1, 0, 0, 0, 376, 65, 1, 0, 0, 0, 377, 375, 1, 
		    0, 0, 0, 378, 379, 5, 14, 0, 0, 379, 383, 5, 53, 0, 0, 380, 382, 3, 
		    14, 7, 0, 381, 380, 1, 0, 0, 0, 382, 385, 1, 0, 0, 0, 383, 381, 1, 
		    0, 0, 0, 383, 384, 1, 0, 0, 0, 384, 67, 1, 0, 0, 0, 385, 383, 1, 0, 
		    0, 0, 386, 395, 5, 9, 0, 0, 387, 392, 3, 30, 15, 0, 388, 389, 5, 51, 
		    0, 0, 389, 391, 3, 30, 15, 0, 390, 388, 1, 0, 0, 0, 391, 394, 1, 0, 
		    0, 0, 392, 390, 1, 0, 0, 0, 392, 393, 1, 0, 0, 0, 393, 396, 1, 0, 
		    0, 0, 394, 392, 1, 0, 0, 0, 395, 387, 1, 0, 0, 0, 395, 396, 1, 0, 
		    0, 0, 396, 69, 1, 0, 0, 0, 397, 398, 5, 10, 0, 0, 398, 71, 1, 0, 0, 
		    0, 399, 400, 5, 11, 0, 0, 400, 73, 1, 0, 0, 0, 46, 77, 86, 92, 95, 
		    103, 110, 121, 136, 142, 149, 153, 157, 161, 165, 172, 176, 180, 183, 
		    190, 207, 215, 219, 227, 238, 246, 254, 262, 266, 295, 298, 303, 312, 
		    321, 323, 332, 335, 339, 343, 348, 354, 364, 366, 375, 383, 392, 395];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.2', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "Golampi.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function programa(): Context\ProgramaContext
		{
		    $localContext = new Context\ProgramaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_programa);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(77);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::FUNC) {
		        	$this->setState(74);
		        	$this->funcion();
		        	$this->setState(79);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(80);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function funcion(): Context\FuncionContext
		{
		    $localContext = new Context\FuncionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_funcion);

		    try {
		        $this->setState(103);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 4, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(82);
		        	    $this->match(self::FUNC);
		        	    $this->setState(83);
		        	    $this->match(self::IDENTIFICADOR);
		        	    $this->setState(84);
		        	    $this->match(self::PAREN_IZQ);
		        	    $this->setState(86);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::IDENTIFICADOR) {
		        	    	$this->setState(85);
		        	    	$this->parametros();
		        	    }
		        	    $this->setState(88);
		        	    $this->match(self::PAREN_DER);
		        	    $this->setState(95);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->input->LA(1)) {
		        	        case self::INT32:
		        	        case self::FLOAT32:
		        	        case self::STRING:
		        	        case self::BOOL:
		        	        case self::RUNE:
		        	        case self::MULT:
		        	        case self::CORCHETE_IZQ:
		        	        	$this->setState(89);
		        	        	$this->tipo();
		        	        	break;

		        	        case self::PAREN_IZQ:
		        	        	$this->setState(90);
		        	        	$this->match(self::PAREN_IZQ);
		        	        	$this->setState(92);
		        	        	$this->errorHandler->sync($this);
		        	        	$_la = $this->input->LA(1);

		        	        	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 562952360951808) !== 0)) {
		        	        		$this->setState(91);
		        	        		$this->tipos();
		        	        	}
		        	        	$this->setState(94);
		        	        	$this->match(self::PAREN_DER);
		        	        	break;

		        	        case self::LLAVE_IZQ:
		        	        	break;

		        	    default:
		        	    	break;
		        	    }
		        	    $this->setState(97);
		        	    $this->bloque();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(98);
		        	    $this->match(self::FUNC);
		        	    $this->setState(99);
		        	    $this->match(self::MAIN);
		        	    $this->setState(100);
		        	    $this->match(self::PAREN_IZQ);
		        	    $this->setState(101);
		        	    $this->match(self::PAREN_DER);
		        	    $this->setState(102);
		        	    $this->bloque();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parametros(): Context\ParametrosContext
		{
		    $localContext = new Context\ParametrosContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_parametros);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(105);
		        $this->parametro();
		        $this->setState(110);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(106);
		        	$this->match(self::COMA);
		        	$this->setState(107);
		        	$this->parametro();
		        	$this->setState(112);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parametro(): Context\ParametroContext
		{
		    $localContext = new Context\ParametroContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_parametro);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(113);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(114);
		        $this->tipo();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function tipos(): Context\TiposContext
		{
		    $localContext = new Context\TiposContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_tipos);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(116);
		        $this->tipo();
		        $this->setState(121);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(117);
		        	$this->match(self::COMA);
		        	$this->setState(118);
		        	$this->tipo();
		        	$this->setState(123);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function tipo(): Context\TipoContext
		{
		    $localContext = new Context\TipoContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_tipo);

		    try {
		        $this->setState(136);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT32:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(124);
		            	$this->match(self::INT32);
		            	break;

		            case self::FLOAT32:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(125);
		            	$this->match(self::FLOAT32);
		            	break;

		            case self::STRING:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(126);
		            	$this->match(self::STRING);
		            	break;

		            case self::BOOL:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(127);
		            	$this->match(self::BOOL);
		            	break;

		            case self::RUNE:
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(128);
		            	$this->match(self::RUNE);
		            	break;

		            case self::CORCHETE_IZQ:
		            	$this->enterOuterAlt($localContext, 6);
		            	$this->setState(129);
		            	$this->match(self::CORCHETE_IZQ);
		            	$this->setState(130);
		            	$this->expresion();
		            	$this->setState(131);
		            	$this->match(self::CORCHETE_DER);
		            	$this->setState(132);
		            	$this->tipo();
		            	break;

		            case self::MULT:
		            	$this->enterOuterAlt($localContext, 7);
		            	$this->setState(134);
		            	$this->match(self::MULT);
		            	$this->setState(135);
		            	$this->tipo();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function bloque(): Context\BloqueContext
		{
		    $localContext = new Context\BloqueContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_bloque);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(138);
		        $this->match(self::LLAVE_IZQ);
		        $this->setState(142);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1153062244250820428) !== 0)) {
		        	$this->setState(139);
		        	$this->sentencia();
		        	$this->setState(144);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(145);
		        $this->match(self::LLAVE_DER);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function sentencia(): Context\SentenciaContext
		{
		    $localContext = new Context\SentenciaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_sentencia);

		    try {
		        $this->setState(183);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 17, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(147);
		        	    $this->declaracionVar();
		        	    $this->setState(149);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(148);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(151);
		        	    $this->declaracionConstante();
		        	    $this->setState(153);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(152);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(155);
		        	    $this->declaracionCorta();
		        	    $this->setState(157);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(156);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(159);
		        	    $this->asignacion();
		        	    $this->setState(161);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(160);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(163);
		        	    $this->llamadaFuncion();
		        	    $this->setState(165);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(164);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(167);
		        	    $this->ifStmt();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(168);
		        	    $this->forStmt();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(169);
		        	    $this->switchStmt();
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(170);
		        	    $this->returnStmt();
		        	    $this->setState(172);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(171);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(174);
		        	    $this->breakStmt();
		        	    $this->setState(176);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(175);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(178);
		        	    $this->continueStmt();
		        	    $this->setState(180);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(179);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 12:
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(182);
		        	    $this->bloque();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declaracionVar(): Context\DeclaracionVarContext
		{
		    $localContext = new Context\DeclaracionVarContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_declaracionVar);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(185);
		        $this->match(self::VAR);
		        $this->setState(186);
		        $this->listaIdentificadores();
		        $this->setState(187);
		        $this->tipo();
		        $this->setState(190);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ASIGNACION) {
		        	$this->setState(188);
		        	$this->match(self::ASIGNACION);
		        	$this->setState(189);
		        	$this->listaExpresiones();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declaracionConstante(): Context\DeclaracionConstanteContext
		{
		    $localContext = new Context\DeclaracionConstanteContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_declaracionConstante);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(192);
		        $this->match(self::CONST);
		        $this->setState(193);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(194);
		        $this->tipo();
		        $this->setState(195);
		        $this->match(self::ASIGNACION);
		        $this->setState(196);
		        $this->expresion();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declaracionCorta(): Context\DeclaracionCortaContext
		{
		    $localContext = new Context\DeclaracionCortaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_declaracionCorta);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(198);
		        $this->listaIdentificadores();
		        $this->setState(199);
		        $this->match(self::DECLARACION_CORTA);
		        $this->setState(200);
		        $this->listaExpresiones();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function listaIdentificadores(): Context\ListaIdentificadoresContext
		{
		    $localContext = new Context\ListaIdentificadoresContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_listaIdentificadores);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(202);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(207);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(203);
		        	$this->match(self::COMA);
		        	$this->setState(204);
		        	$this->match(self::IDENTIFICADOR);
		        	$this->setState(209);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function listaExpresiones(): Context\ListaExpresionesContext
		{
		    $localContext = new Context\ListaExpresionesContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_listaExpresiones);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(210);
		        $this->expresion();
		        $this->setState(215);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(211);
		        	$this->match(self::COMA);
		        	$this->setState(212);
		        	$this->expresion();
		        	$this->setState(217);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function asignacion(): Context\AsignacionContext
		{
		    $localContext = new Context\AsignacionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_asignacion);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(219);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::MULT) {
		        	$this->setState(218);
		        	$this->match(self::MULT);
		        }
		        $this->setState(221);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(227);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::ASIGNACION:
		            case self::MAS_ASIGNACION:
		            case self::MENOS_ASIGNACION:
		            case self::MULT_ASIGNACION:
		            case self::DIV_ASIGNACION:
		            	$this->setState(222);
		            	$this->operadorAsignacion();
		            	$this->setState(223);
		            	$this->expresion();
		            	break;

		            case self::INCREMENTO:
		            	$this->setState(225);
		            	$this->match(self::INCREMENTO);
		            	break;

		            case self::DECREMENTO:
		            	$this->setState(226);
		            	$this->match(self::DECREMENTO);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function operadorAsignacion(): Context\OperadorAsignacionContext
		{
		    $localContext = new Context\OperadorAsignacionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_operadorAsignacion);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(229);

		        $_la = $this->input->LA(1);

		        if (!((((($_la - 28)) & ~0x3f) === 0 && ((1 << ($_la - 28)) & 1030792151041) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expresion(): Context\ExpresionContext
		{
		    $localContext = new Context\ExpresionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_expresion);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(231);
		        $this->expresionLogica();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expresionLogica(): Context\ExpresionLogicaContext
		{
		    $localContext = new Context\ExpresionLogicaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_expresionLogica);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(233);
		        $this->expresionComparacion();
		        $this->setState(238);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::AND || $_la === self::OR) {
		        	$this->setState(234);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::AND || $_la === self::OR)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(235);
		        	$this->expresionComparacion();
		        	$this->setState(240);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expresionComparacion(): Context\ExpresionComparacionContext
		{
		    $localContext = new Context\ExpresionComparacionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_expresionComparacion);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(241);
		        $this->expresionAditiva();
		        $this->setState(246);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1082331758592) !== 0)) {
		        	$this->setState(242);

		        	$_la = $this->input->LA(1);

		        	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1082331758592) !== 0))) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(243);
		        	$this->expresionAditiva();
		        	$this->setState(248);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expresionAditiva(): Context\ExpresionAditivaContext
		{
		    $localContext = new Context\ExpresionAditivaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 36, self::RULE_expresionAditiva);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(249);
		        $this->expresionMultiplicativa();
		        $this->setState(254);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::MAS || $_la === self::MENOS) {
		        	$this->setState(250);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::MAS || $_la === self::MENOS)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(251);
		        	$this->expresionMultiplicativa();
		        	$this->setState(256);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expresionMultiplicativa(): Context\ExpresionMultiplicativaContext
		{
		    $localContext = new Context\ExpresionMultiplicativaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 38, self::RULE_expresionMultiplicativa);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(257);
		        $this->expresionUnaria();
		        $this->setState(262);
		        $this->errorHandler->sync($this);

		        $alt = $this->getInterpreter()->adaptivePredict($this->input, 26, $this->ctx);

		        while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
		        	if ($alt === 1) {
		        		$this->setState(258);

		        		$_la = $this->input->LA(1);

		        		if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 15032385536) !== 0))) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        		$this->setState(259);
		        		$this->expresionUnaria(); 
		        	}

		        	$this->setState(264);
		        	$this->errorHandler->sync($this);

		        	$alt = $this->getInterpreter()->adaptivePredict($this->input, 26, $this->ctx);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expresionUnaria(): Context\ExpresionUnariaContext
		{
		    $localContext = new Context\ExpresionUnariaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_expresionUnaria);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(266);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 27, $this->ctx)) {
		            case 1:
		        	    $this->setState(265);

		        	    $_la = $this->input->LA(1);

		        	    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 4401267736578) !== 0))) {
		        	    $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	break;
		        }
		        $this->setState(268);
		        $this->expresionPrimaria();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expresionPrimaria(): Context\ExpresionPrimariaContext
		{
		    $localContext = new Context\ExpresionPrimariaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 42, self::RULE_expresionPrimaria);

		    try {
		        $this->setState(298);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 29, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(270);
		        	    $this->match(self::NUMERO_ENTERO);
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(271);
		        	    $this->match(self::NUMERO_DECIMAL);
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(272);
		        	    $this->match(self::CADENA);
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(273);
		        	    $this->match(self::CARACTER);
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(274);
		        	    $this->match(self::TRUE);
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(275);
		        	    $this->match(self::FALSE);
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(276);
		        	    $this->match(self::NIL);
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(277);
		        	    $this->match(self::IDENTIFICADOR);
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(278);
		        	    $this->match(self::PRINTLN);
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(279);
		        	    $this->match(self::LEN);
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(280);
		        	    $this->match(self::NOW);
		        	break;

		        	case 12:
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(281);
		        	    $this->match(self::SUBSTR);
		        	break;

		        	case 13:
		        	    $this->enterOuterAlt($localContext, 13);
		        	    $this->setState(282);
		        	    $this->match(self::TYPEOF);
		        	break;

		        	case 14:
		        	    $this->enterOuterAlt($localContext, 14);
		        	    $this->setState(283);
		        	    $this->tipo();
		        	    $this->setState(284);
		        	    $this->match(self::PAREN_IZQ);
		        	    $this->setState(285);
		        	    $this->expresion();
		        	    $this->setState(286);
		        	    $this->match(self::PAREN_DER);
		        	break;

		        	case 15:
		        	    $this->enterOuterAlt($localContext, 15);
		        	    $this->setState(288);
		        	    $this->llamadaFuncion();
		        	break;

		        	case 16:
		        	    $this->enterOuterAlt($localContext, 16);
		        	    $this->setState(289);
		        	    $this->match(self::PAREN_IZQ);
		        	    $this->setState(290);
		        	    $this->expresion();
		        	    $this->setState(291);
		        	    $this->match(self::PAREN_DER);
		        	break;

		        	case 17:
		        	    $this->enterOuterAlt($localContext, 17);
		        	    $this->setState(293);
		        	    $this->match(self::CORCHETE_IZQ);
		        	    $this->setState(295);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 2234387951037415426) !== 0)) {
		        	    	$this->setState(294);
		        	    	$this->listaExpresiones();
		        	    }
		        	    $this->setState(297);
		        	    $this->match(self::CORCHETE_DER);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function llamadaFuncion(): Context\LlamadaFuncionContext
		{
		    $localContext = new Context\LlamadaFuncionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 44, self::RULE_llamadaFuncion);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(300);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1152921504614973440) !== 0))) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		        $this->setState(301);
		        $this->match(self::PAREN_IZQ);
		        $this->setState(303);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 2234387951037415426) !== 0)) {
		        	$this->setState(302);
		        	$this->argumentos();
		        }
		        $this->setState(305);
		        $this->match(self::PAREN_DER);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function argumentos(): Context\ArgumentosContext
		{
		    $localContext = new Context\ArgumentosContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 46, self::RULE_argumentos);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(307);
		        $this->expresion();
		        $this->setState(312);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(308);
		        	$this->match(self::COMA);
		        	$this->setState(309);
		        	$this->expresion();
		        	$this->setState(314);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ifStmt(): Context\IfStmtContext
		{
		    $localContext = new Context\IfStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 48, self::RULE_ifStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(315);
		        $this->match(self::IF);
		        $this->setState(316);
		        $this->expresion();
		        $this->setState(317);
		        $this->bloque();
		        $this->setState(323);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ELSE) {
		        	$this->setState(318);
		        	$this->match(self::ELSE);
		        	$this->setState(321);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::IF:
		        	    	$this->setState(319);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::LLAVE_IZQ:
		        	    	$this->setState(320);
		        	    	$this->bloque();
		        	    	break;

		        	default:
		        		throw new NoViableAltException($this);
		        	}
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forStmt(): Context\ForStmtContext
		{
		    $localContext = new Context\ForStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 50, self::RULE_forStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(325);
		        $this->match(self::FOR);
		        $this->setState(326);
		        $this->forHeader();
		        $this->setState(327);
		        $this->bloque();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forHeader(): Context\ForHeaderContext
		{
		    $localContext = new Context\ForHeaderContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 52, self::RULE_forHeader);

		    try {
		        $this->setState(332);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 34, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(329);
		        	    $this->forClause();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(330);
		        	    $this->expresion();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);

		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function forClause(): Context\ForClauseContext
		{
		    $localContext = new Context\ForClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 54, self::RULE_forClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(335);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 2234387951037415426) !== 0)) {
		        	$this->setState(334);
		        	$this->initStmt();
		        }
		        $this->setState(337);
		        $this->match(self::PUNTO_COMA);
		        $this->setState(339);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 2234387951037415426) !== 0)) {
		        	$this->setState(338);
		        	$this->expresion();
		        }
		        $this->setState(341);
		        $this->match(self::PUNTO_COMA);
		        $this->setState(343);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 2234414339316482050) !== 0)) {
		        	$this->setState(342);
		        	$this->postStmt();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function initStmt(): Context\InitStmtContext
		{
		    $localContext = new Context\InitStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 56, self::RULE_initStmt);

		    try {
		        $this->setState(348);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 38, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(345);
		        	    $this->declaracionCorta();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(346);
		        	    $this->asignacion();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(347);
		        	    $this->expresion();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function postStmt(): Context\PostStmtContext
		{
		    $localContext = new Context\PostStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 58, self::RULE_postStmt);

		    try {
		        $this->setState(354);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 39, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(350);
		        	    $this->asignacion();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(351);
		        	    $this->expresion();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(352);
		        	    $this->match(self::INCREMENTO);
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(353);
		        	    $this->match(self::DECREMENTO);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function switchStmt(): Context\SwitchStmtContext
		{
		    $localContext = new Context\SwitchStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_switchStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(356);
		        $this->match(self::SWITCH);
		        $this->setState(357);
		        $this->expresion();
		        $this->setState(358);
		        $this->match(self::LLAVE_IZQ);
		        $this->setState(359);
		        $this->casoBloques();
		        $this->setState(360);
		        $this->match(self::LLAVE_DER);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function casoBloques(): Context\CasoBloquesContext
		{
		    $localContext = new Context\CasoBloquesContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 62, self::RULE_casoBloques);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(366);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::CASE || $_la === self::DEFAULT) {
		        	$this->setState(364);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::CASE:
		        	    	$this->setState(362);
		        	    	$this->caso();
		        	    	break;

		        	    case self::DEFAULT:
		        	    	$this->setState(363);
		        	    	$this->defaultBloque();
		        	    	break;

		        	default:
		        		throw new NoViableAltException($this);
		        	}
		        	$this->setState(368);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function caso(): Context\CasoContext
		{
		    $localContext = new Context\CasoContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 64, self::RULE_caso);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(369);
		        $this->match(self::CASE);
		        $this->setState(370);
		        $this->listaExpresiones();
		        $this->setState(371);
		        $this->match(self::DOS_PUNTOS);
		        $this->setState(375);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1153062244250820428) !== 0)) {
		        	$this->setState(372);
		        	$this->sentencia();
		        	$this->setState(377);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function defaultBloque(): Context\DefaultBloqueContext
		{
		    $localContext = new Context\DefaultBloqueContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 66, self::RULE_defaultBloque);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(378);
		        $this->match(self::DEFAULT);
		        $this->setState(379);
		        $this->match(self::DOS_PUNTOS);
		        $this->setState(383);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1153062244250820428) !== 0)) {
		        	$this->setState(380);
		        	$this->sentencia();
		        	$this->setState(385);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnStmt(): Context\ReturnStmtContext
		{
		    $localContext = new Context\ReturnStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 68, self::RULE_returnStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(386);
		        $this->match(self::RETURN);
		        $this->setState(395);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 45, $this->ctx)) {
		            case 1:
		        	    $this->setState(387);
		        	    $this->expresion();
		        	    $this->setState(392);
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    while ($_la === self::COMA) {
		        	    	$this->setState(388);
		        	    	$this->match(self::COMA);
		        	    	$this->setState(389);
		        	    	$this->expresion();
		        	    	$this->setState(394);
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    }
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function breakStmt(): Context\BreakStmtContext
		{
		    $localContext = new Context\BreakStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 70, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(397);
		        $this->match(self::BREAK);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function continueStmt(): Context\ContinueStmtContext
		{
		    $localContext = new Context\ContinueStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 72, self::RULE_continueStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(399);
		        $this->match(self::CONTINUE);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}
	}
}

namespace Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use GolampiParser;
	use GolampiVisitor;
	use GolampiListener;

	class ProgramaContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_programa;
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::EOF, 0);
	    }

	    /**
	     * @return array<FuncionContext>|FuncionContext|null
	     */
	    public function funcion(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(FuncionContext::class);
	    	}

	        return $this->getTypedRuleContext(FuncionContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterPrograma($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitPrograma($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPrograma($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FuncionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_funcion;
	    }

	    public function FUNC(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FUNC, 0);
	    }

	    public function IDENTIFICADOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFICADOR, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function PAREN_IZQ(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::PAREN_IZQ);
	    	}

	        return $this->getToken(GolampiParser::PAREN_IZQ, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function PAREN_DER(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::PAREN_DER);
	    	}

	        return $this->getToken(GolampiParser::PAREN_DER, $index);
	    }

	    public function bloque(): ?BloqueContext
	    {
	    	return $this->getTypedRuleContext(BloqueContext::class, 0);
	    }

	    public function parametros(): ?ParametrosContext
	    {
	    	return $this->getTypedRuleContext(ParametrosContext::class, 0);
	    }

	    public function tipo(): ?TipoContext
	    {
	    	return $this->getTypedRuleContext(TipoContext::class, 0);
	    }

	    public function tipos(): ?TiposContext
	    {
	    	return $this->getTypedRuleContext(TiposContext::class, 0);
	    }

	    public function MAIN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MAIN, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterFuncion($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitFuncion($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitFuncion($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParametrosContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_parametros;
	    }

	    /**
	     * @return array<ParametroContext>|ParametroContext|null
	     */
	    public function parametro(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ParametroContext::class);
	    	}

	        return $this->getTypedRuleContext(ParametroContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMA);
	    	}

	        return $this->getToken(GolampiParser::COMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterParametros($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitParametros($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParametros($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParametroContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_parametro;
	    }

	    public function IDENTIFICADOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFICADOR, 0);
	    }

	    public function tipo(): ?TipoContext
	    {
	    	return $this->getTypedRuleContext(TipoContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterParametro($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitParametro($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitParametro($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TiposContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_tipos;
	    }

	    /**
	     * @return array<TipoContext>|TipoContext|null
	     */
	    public function tipo(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TipoContext::class);
	    	}

	        return $this->getTypedRuleContext(TipoContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMA);
	    	}

	        return $this->getToken(GolampiParser::COMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterTipos($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitTipos($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitTipos($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TipoContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_tipo;
	    }

	    public function INT32(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INT32, 0);
	    }

	    public function FLOAT32(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FLOAT32, 0);
	    }

	    public function STRING(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::STRING, 0);
	    }

	    public function BOOL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BOOL, 0);
	    }

	    public function RUNE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RUNE, 0);
	    }

	    public function CORCHETE_IZQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CORCHETE_IZQ, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

	    public function CORCHETE_DER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CORCHETE_DER, 0);
	    }

	    public function tipo(): ?TipoContext
	    {
	    	return $this->getTypedRuleContext(TipoContext::class, 0);
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterTipo($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitTipo($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitTipo($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BloqueContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_bloque;
	    }

	    public function LLAVE_IZQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LLAVE_IZQ, 0);
	    }

	    public function LLAVE_DER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LLAVE_DER, 0);
	    }

	    /**
	     * @return array<SentenciaContext>|SentenciaContext|null
	     */
	    public function sentencia(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(SentenciaContext::class);
	    	}

	        return $this->getTypedRuleContext(SentenciaContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterBloque($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitBloque($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBloque($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SentenciaContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_sentencia;
	    }

	    public function declaracionVar(): ?DeclaracionVarContext
	    {
	    	return $this->getTypedRuleContext(DeclaracionVarContext::class, 0);
	    }

	    public function PUNTO_COMA(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PUNTO_COMA, 0);
	    }

	    public function declaracionConstante(): ?DeclaracionConstanteContext
	    {
	    	return $this->getTypedRuleContext(DeclaracionConstanteContext::class, 0);
	    }

	    public function declaracionCorta(): ?DeclaracionCortaContext
	    {
	    	return $this->getTypedRuleContext(DeclaracionCortaContext::class, 0);
	    }

	    public function asignacion(): ?AsignacionContext
	    {
	    	return $this->getTypedRuleContext(AsignacionContext::class, 0);
	    }

	    public function llamadaFuncion(): ?LlamadaFuncionContext
	    {
	    	return $this->getTypedRuleContext(LlamadaFuncionContext::class, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

	    public function forStmt(): ?ForStmtContext
	    {
	    	return $this->getTypedRuleContext(ForStmtContext::class, 0);
	    }

	    public function switchStmt(): ?SwitchStmtContext
	    {
	    	return $this->getTypedRuleContext(SwitchStmtContext::class, 0);
	    }

	    public function returnStmt(): ?ReturnStmtContext
	    {
	    	return $this->getTypedRuleContext(ReturnStmtContext::class, 0);
	    }

	    public function breakStmt(): ?BreakStmtContext
	    {
	    	return $this->getTypedRuleContext(BreakStmtContext::class, 0);
	    }

	    public function continueStmt(): ?ContinueStmtContext
	    {
	    	return $this->getTypedRuleContext(ContinueStmtContext::class, 0);
	    }

	    public function bloque(): ?BloqueContext
	    {
	    	return $this->getTypedRuleContext(BloqueContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterSentencia($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitSentencia($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSentencia($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclaracionVarContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_declaracionVar;
	    }

	    public function VAR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::VAR, 0);
	    }

	    public function listaIdentificadores(): ?ListaIdentificadoresContext
	    {
	    	return $this->getTypedRuleContext(ListaIdentificadoresContext::class, 0);
	    }

	    public function tipo(): ?TipoContext
	    {
	    	return $this->getTypedRuleContext(TipoContext::class, 0);
	    }

	    public function ASIGNACION(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASIGNACION, 0);
	    }

	    public function listaExpresiones(): ?ListaExpresionesContext
	    {
	    	return $this->getTypedRuleContext(ListaExpresionesContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterDeclaracionVar($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitDeclaracionVar($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclaracionVar($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclaracionConstanteContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_declaracionConstante;
	    }

	    public function CONST(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONST, 0);
	    }

	    public function IDENTIFICADOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFICADOR, 0);
	    }

	    public function tipo(): ?TipoContext
	    {
	    	return $this->getTypedRuleContext(TipoContext::class, 0);
	    }

	    public function ASIGNACION(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASIGNACION, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterDeclaracionConstante($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitDeclaracionConstante($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclaracionConstante($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclaracionCortaContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_declaracionCorta;
	    }

	    public function listaIdentificadores(): ?ListaIdentificadoresContext
	    {
	    	return $this->getTypedRuleContext(ListaIdentificadoresContext::class, 0);
	    }

	    public function DECLARACION_CORTA(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DECLARACION_CORTA, 0);
	    }

	    public function listaExpresiones(): ?ListaExpresionesContext
	    {
	    	return $this->getTypedRuleContext(ListaExpresionesContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterDeclaracionCorta($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitDeclaracionCorta($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDeclaracionCorta($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ListaIdentificadoresContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_listaIdentificadores;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IDENTIFICADOR(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::IDENTIFICADOR);
	    	}

	        return $this->getToken(GolampiParser::IDENTIFICADOR, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMA);
	    	}

	        return $this->getToken(GolampiParser::COMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterListaIdentificadores($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitListaIdentificadores($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitListaIdentificadores($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ListaExpresionesContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_listaExpresiones;
	    }

	    /**
	     * @return array<ExpresionContext>|ExpresionContext|null
	     */
	    public function expresion(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpresionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpresionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMA);
	    	}

	        return $this->getToken(GolampiParser::COMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterListaExpresiones($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitListaExpresiones($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitListaExpresiones($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class AsignacionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_asignacion;
	    }

	    public function IDENTIFICADOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFICADOR, 0);
	    }

	    public function operadorAsignacion(): ?OperadorAsignacionContext
	    {
	    	return $this->getTypedRuleContext(OperadorAsignacionContext::class, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

	    public function INCREMENTO(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INCREMENTO, 0);
	    }

	    public function DECREMENTO(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DECREMENTO, 0);
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterAsignacion($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitAsignacion($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitAsignacion($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OperadorAsignacionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_operadorAsignacion;
	    }

	    public function ASIGNACION(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ASIGNACION, 0);
	    }

	    public function MAS_ASIGNACION(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MAS_ASIGNACION, 0);
	    }

	    public function MENOS_ASIGNACION(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MENOS_ASIGNACION, 0);
	    }

	    public function MULT_ASIGNACION(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT_ASIGNACION, 0);
	    }

	    public function DIV_ASIGNACION(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DIV_ASIGNACION, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterOperadorAsignacion($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitOperadorAsignacion($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitOperadorAsignacion($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpresionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expresion;
	    }

	    public function expresionLogica(): ?ExpresionLogicaContext
	    {
	    	return $this->getTypedRuleContext(ExpresionLogicaContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExpresion($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExpresion($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpresion($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpresionLogicaContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expresionLogica;
	    }

	    /**
	     * @return array<ExpresionComparacionContext>|ExpresionComparacionContext|null
	     */
	    public function expresionComparacion(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpresionComparacionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpresionComparacionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function AND(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::AND);
	    	}

	        return $this->getToken(GolampiParser::AND, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function OR(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::OR);
	    	}

	        return $this->getToken(GolampiParser::OR, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExpresionLogica($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExpresionLogica($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpresionLogica($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpresionComparacionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expresionComparacion;
	    }

	    /**
	     * @return array<ExpresionAditivaContext>|ExpresionAditivaContext|null
	     */
	    public function expresionAditiva(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpresionAditivaContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpresionAditivaContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function IGUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::IGUAL);
	    	}

	        return $this->getToken(GolampiParser::IGUAL, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function DIFERENTE(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::DIFERENTE);
	    	}

	        return $this->getToken(GolampiParser::DIFERENTE, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MAYOR(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MAYOR);
	    	}

	        return $this->getToken(GolampiParser::MAYOR, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MENOR(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MENOR);
	    	}

	        return $this->getToken(GolampiParser::MENOR, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MAYOR_IGUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MAYOR_IGUAL);
	    	}

	        return $this->getToken(GolampiParser::MAYOR_IGUAL, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MENOR_IGUAL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MENOR_IGUAL);
	    	}

	        return $this->getToken(GolampiParser::MENOR_IGUAL, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExpresionComparacion($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExpresionComparacion($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpresionComparacion($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpresionAditivaContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expresionAditiva;
	    }

	    /**
	     * @return array<ExpresionMultiplicativaContext>|ExpresionMultiplicativaContext|null
	     */
	    public function expresionMultiplicativa(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpresionMultiplicativaContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpresionMultiplicativaContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MAS(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MAS);
	    	}

	        return $this->getToken(GolampiParser::MAS, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MENOS(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MENOS);
	    	}

	        return $this->getToken(GolampiParser::MENOS, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExpresionAditiva($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExpresionAditiva($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpresionAditiva($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpresionMultiplicativaContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expresionMultiplicativa;
	    }

	    /**
	     * @return array<ExpresionUnariaContext>|ExpresionUnariaContext|null
	     */
	    public function expresionUnaria(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpresionUnariaContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpresionUnariaContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MULT(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MULT);
	    	}

	        return $this->getToken(GolampiParser::MULT, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function DIV(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::DIV);
	    	}

	        return $this->getToken(GolampiParser::DIV, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function MOD(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::MOD);
	    	}

	        return $this->getToken(GolampiParser::MOD, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExpresionMultiplicativa($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExpresionMultiplicativa($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpresionMultiplicativa($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpresionUnariaContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expresionUnaria;
	    }

	    public function expresionPrimaria(): ?ExpresionPrimariaContext
	    {
	    	return $this->getTypedRuleContext(ExpresionPrimariaContext::class, 0);
	    }

	    public function NOT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NOT, 0);
	    }

	    public function MENOS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MENOS, 0);
	    }

	    public function MULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::MULT, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExpresionUnaria($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExpresionUnaria($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpresionUnaria($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExpresionPrimariaContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_expresionPrimaria;
	    }

	    public function NUMERO_ENTERO(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NUMERO_ENTERO, 0);
	    }

	    public function NUMERO_DECIMAL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NUMERO_DECIMAL, 0);
	    }

	    public function CADENA(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CADENA, 0);
	    }

	    public function CARACTER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CARACTER, 0);
	    }

	    public function TRUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::TRUE, 0);
	    }

	    public function FALSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FALSE, 0);
	    }

	    public function NIL(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NIL, 0);
	    }

	    public function IDENTIFICADOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFICADOR, 0);
	    }

	    public function PRINTLN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PRINTLN, 0);
	    }

	    public function LEN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LEN, 0);
	    }

	    public function NOW(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NOW, 0);
	    }

	    public function SUBSTR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SUBSTR, 0);
	    }

	    public function TYPEOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::TYPEOF, 0);
	    }

	    public function tipo(): ?TipoContext
	    {
	    	return $this->getTypedRuleContext(TipoContext::class, 0);
	    }

	    public function PAREN_IZQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PAREN_IZQ, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

	    public function PAREN_DER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PAREN_DER, 0);
	    }

	    public function llamadaFuncion(): ?LlamadaFuncionContext
	    {
	    	return $this->getTypedRuleContext(LlamadaFuncionContext::class, 0);
	    }

	    public function CORCHETE_IZQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CORCHETE_IZQ, 0);
	    }

	    public function CORCHETE_DER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CORCHETE_DER, 0);
	    }

	    public function listaExpresiones(): ?ListaExpresionesContext
	    {
	    	return $this->getTypedRuleContext(ListaExpresionesContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterExpresionPrimaria($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitExpresionPrimaria($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitExpresionPrimaria($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LlamadaFuncionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_llamadaFuncion;
	    }

	    public function PAREN_IZQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PAREN_IZQ, 0);
	    }

	    public function PAREN_DER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PAREN_DER, 0);
	    }

	    public function IDENTIFICADOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IDENTIFICADOR, 0);
	    }

	    public function PRINTLN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::PRINTLN, 0);
	    }

	    public function LEN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LEN, 0);
	    }

	    public function NOW(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::NOW, 0);
	    }

	    public function SUBSTR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SUBSTR, 0);
	    }

	    public function TYPEOF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::TYPEOF, 0);
	    }

	    public function argumentos(): ?ArgumentosContext
	    {
	    	return $this->getTypedRuleContext(ArgumentosContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterLlamadaFuncion($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitLlamadaFuncion($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitLlamadaFuncion($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ArgumentosContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_argumentos;
	    }

	    /**
	     * @return array<ExpresionContext>|ExpresionContext|null
	     */
	    public function expresion(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpresionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpresionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMA);
	    	}

	        return $this->getToken(GolampiParser::COMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterArgumentos($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitArgumentos($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitArgumentos($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IfStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_ifStmt;
	    }

	    public function IF(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::IF, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

	    /**
	     * @return array<BloqueContext>|BloqueContext|null
	     */
	    public function bloque(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BloqueContext::class);
	    	}

	        return $this->getTypedRuleContext(BloqueContext::class, $index);
	    }

	    public function ELSE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::ELSE, 0);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterIfStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitIfStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitIfStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_forStmt;
	    }

	    public function FOR(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::FOR, 0);
	    }

	    public function forHeader(): ?ForHeaderContext
	    {
	    	return $this->getTypedRuleContext(ForHeaderContext::class, 0);
	    }

	    public function bloque(): ?BloqueContext
	    {
	    	return $this->getTypedRuleContext(BloqueContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterForStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitForStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForHeaderContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_forHeader;
	    }

	    public function forClause(): ?ForClauseContext
	    {
	    	return $this->getTypedRuleContext(ForClauseContext::class, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterForHeader($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitForHeader($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForHeader($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ForClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_forClause;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function PUNTO_COMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::PUNTO_COMA);
	    	}

	        return $this->getToken(GolampiParser::PUNTO_COMA, $index);
	    }

	    public function initStmt(): ?InitStmtContext
	    {
	    	return $this->getTypedRuleContext(InitStmtContext::class, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

	    public function postStmt(): ?PostStmtContext
	    {
	    	return $this->getTypedRuleContext(PostStmtContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterForClause($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitForClause($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitForClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class InitStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_initStmt;
	    }

	    public function declaracionCorta(): ?DeclaracionCortaContext
	    {
	    	return $this->getTypedRuleContext(DeclaracionCortaContext::class, 0);
	    }

	    public function asignacion(): ?AsignacionContext
	    {
	    	return $this->getTypedRuleContext(AsignacionContext::class, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterInitStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitInitStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitInitStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class PostStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_postStmt;
	    }

	    public function asignacion(): ?AsignacionContext
	    {
	    	return $this->getTypedRuleContext(AsignacionContext::class, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

	    public function INCREMENTO(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::INCREMENTO, 0);
	    }

	    public function DECREMENTO(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DECREMENTO, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterPostStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitPostStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitPostStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SwitchStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_switchStmt;
	    }

	    public function SWITCH(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::SWITCH, 0);
	    }

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
	    }

	    public function LLAVE_IZQ(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LLAVE_IZQ, 0);
	    }

	    public function casoBloques(): ?CasoBloquesContext
	    {
	    	return $this->getTypedRuleContext(CasoBloquesContext::class, 0);
	    }

	    public function LLAVE_DER(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::LLAVE_DER, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterSwitchStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitSwitchStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitSwitchStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CasoBloquesContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_casoBloques;
	    }

	    /**
	     * @return array<CasoContext>|CasoContext|null
	     */
	    public function caso(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(CasoContext::class);
	    	}

	        return $this->getTypedRuleContext(CasoContext::class, $index);
	    }

	    /**
	     * @return array<DefaultBloqueContext>|DefaultBloqueContext|null
	     */
	    public function defaultBloque(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(DefaultBloqueContext::class);
	    	}

	        return $this->getTypedRuleContext(DefaultBloqueContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterCasoBloques($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitCasoBloques($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitCasoBloques($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CasoContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_caso;
	    }

	    public function CASE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CASE, 0);
	    }

	    public function listaExpresiones(): ?ListaExpresionesContext
	    {
	    	return $this->getTypedRuleContext(ListaExpresionesContext::class, 0);
	    }

	    public function DOS_PUNTOS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DOS_PUNTOS, 0);
	    }

	    /**
	     * @return array<SentenciaContext>|SentenciaContext|null
	     */
	    public function sentencia(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(SentenciaContext::class);
	    	}

	        return $this->getTypedRuleContext(SentenciaContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterCaso($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitCaso($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitCaso($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DefaultBloqueContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_defaultBloque;
	    }

	    public function DEFAULT(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DEFAULT, 0);
	    }

	    public function DOS_PUNTOS(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::DOS_PUNTOS, 0);
	    }

	    /**
	     * @return array<SentenciaContext>|SentenciaContext|null
	     */
	    public function sentencia(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(SentenciaContext::class);
	    	}

	        return $this->getTypedRuleContext(SentenciaContext::class, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterDefaultBloque($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitDefaultBloque($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitDefaultBloque($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_returnStmt;
	    }

	    public function RETURN(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::RETURN, 0);
	    }

	    /**
	     * @return array<ExpresionContext>|ExpresionContext|null
	     */
	    public function expresion(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExpresionContext::class);
	    	}

	        return $this->getTypedRuleContext(ExpresionContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function COMA(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(GolampiParser::COMA);
	    	}

	        return $this->getToken(GolampiParser::COMA, $index);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterReturnStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitReturnStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitReturnStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BreakStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_breakStmt;
	    }

	    public function BREAK(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::BREAK, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterBreakStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitBreakStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitBreakStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ContinueStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return GolampiParser::RULE_continueStmt;
	    }

	    public function CONTINUE(): ?TerminalNode
	    {
	        return $this->getToken(GolampiParser::CONTINUE, 0);
	    }

		public function enterRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->enterContinueStmt($this);
		    }
		}

		public function exitRule(ParseTreeListener $listener): void
		{
			if ($listener instanceof GolampiListener) {
			    $listener->exitContinueStmt($this);
		    }
		}

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof GolampiVisitor) {
			    return $visitor->visitContinueStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}