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
		public const VAR = 1, CONST = 2, FUNC = 3, MAIN = 4, IF = 5, ELSE = 6, 
               FOR = 7, RETURN = 8, BREAK = 9, CONTINUE = 10, SWITCH = 11, 
               CASE = 12, DEFAULT = 13, NIL = 14, TRUE = 15, FALSE = 16, 
               PRINTLN = 17, LEN = 18, NOW = 19, SUBSTR = 20, TYPEOF = 21, 
               INT32 = 22, FLOAT32 = 23, STRING = 24, BOOL = 25, RUNE = 26, 
               ASIGNACION = 27, MAS = 28, MENOS = 29, MULT = 30, DIV = 31, 
               MOD = 32, IGUAL = 33, DIFERENTE = 34, MAYOR = 35, MENOR = 36, 
               MAYOR_IGUAL = 37, MENOR_IGUAL = 38, AND = 39, OR = 40, NOT = 41, 
               INCREMENTO = 42, DECREMENTO = 43, PAREN_IZQ = 44, PAREN_DER = 45, 
               LLAVE_IZQ = 46, LLAVE_DER = 47, CORCHETE_IZQ = 48, CORCHETE_DER = 49, 
               COMA = 50, PUNTO = 51, DOS_PUNTOS = 52, PUNTO_COMA = 53, 
               DECLARACION_CORTA = 54, NUMERO_ENTERO = 55, NUMERO_DECIMAL = 56, 
               CADENA = 57, CARACTER = 58, IDENTIFICADOR = 59, COMENTARIO_LINEA = 60, 
               COMENTARIO_BLOQUE = 61, WS = 62, MAS_ASIGNACION = 63, MENOS_ASIGNACION = 64;

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
		    null, "'var'", "'const'", "'func'", "'main'", "'if'", "'else'", "'for'", 
		    "'return'", "'break'", "'continue'", "'switch'", "'case'", "'default'", 
		    "'nil'", "'true'", "'false'", "'fmt.Println'", "'len'", "'now'", "'substr'", 
		    "'typeOf'", "'int32'", "'float32'", "'string'", "'bool'", "'rune'", 
		    "'='", "'+'", "'-'", "'*'", "'/'", "'%'", "'=='", "'!='", "'>'", "'<'", 
		    "'>='", "'<='", "'&&'", "'||'", "'!'", "'++'", "'--'", "'('", "')'", 
		    "'{'", "'}'", "'['", "']'", "','", "'.'", "':'", "';'", "':='", null, 
		    null, null, null, null, null, null, null, "'+='", "'-='"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, "VAR", "CONST", "FUNC", "MAIN", "IF", "ELSE", "FOR", "RETURN", 
		    "BREAK", "CONTINUE", "SWITCH", "CASE", "DEFAULT", "NIL", "TRUE", "FALSE", 
		    "PRINTLN", "LEN", "NOW", "SUBSTR", "TYPEOF", "INT32", "FLOAT32", "STRING", 
		    "BOOL", "RUNE", "ASIGNACION", "MAS", "MENOS", "MULT", "DIV", "MOD", 
		    "IGUAL", "DIFERENTE", "MAYOR", "MENOR", "MAYOR_IGUAL", "MENOR_IGUAL", 
		    "AND", "OR", "NOT", "INCREMENTO", "DECREMENTO", "PAREN_IZQ", "PAREN_DER", 
		    "LLAVE_IZQ", "LLAVE_DER", "CORCHETE_IZQ", "CORCHETE_DER", "COMA", 
		    "PUNTO", "DOS_PUNTOS", "PUNTO_COMA", "DECLARACION_CORTA", "NUMERO_ENTERO", 
		    "NUMERO_DECIMAL", "CADENA", "CARACTER", "IDENTIFICADOR", "COMENTARIO_LINEA", 
		    "COMENTARIO_BLOQUE", "WS", "MAS_ASIGNACION", "MENOS_ASIGNACION"
		];

		private const SERIALIZED_ATN =
			[4, 1, 64, 380, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
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
		    5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 3, 5, 135, 
		    8, 5, 1, 6, 1, 6, 5, 6, 139, 8, 6, 10, 6, 12, 6, 142, 9, 6, 1, 6, 
		    1, 6, 1, 7, 1, 7, 3, 7, 148, 8, 7, 1, 7, 1, 7, 3, 7, 152, 8, 7, 1, 
		    7, 1, 7, 3, 7, 156, 8, 7, 1, 7, 1, 7, 3, 7, 160, 8, 7, 1, 7, 1, 7, 
		    3, 7, 164, 8, 7, 1, 7, 1, 7, 1, 7, 1, 7, 1, 7, 3, 7, 171, 8, 7, 1, 
		    7, 1, 7, 3, 7, 175, 8, 7, 1, 7, 1, 7, 3, 7, 179, 8, 7, 1, 7, 3, 7, 
		    182, 8, 7, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 3, 8, 189, 8, 8, 1, 9, 1, 
		    9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 10, 1, 10, 1, 10, 1, 10, 1, 11, 1, 11, 
		    1, 11, 5, 11, 204, 8, 11, 10, 11, 12, 11, 207, 9, 11, 1, 12, 1, 12, 
		    1, 12, 5, 12, 212, 8, 12, 10, 12, 12, 12, 215, 9, 12, 1, 13, 1, 13, 
		    1, 13, 1, 13, 1, 13, 1, 13, 3, 13, 223, 8, 13, 1, 14, 1, 14, 1, 15, 
		    1, 15, 1, 16, 1, 16, 1, 16, 5, 16, 232, 8, 16, 10, 16, 12, 16, 235, 
		    9, 16, 1, 17, 1, 17, 1, 17, 5, 17, 240, 8, 17, 10, 17, 12, 17, 243, 
		    9, 17, 1, 18, 1, 18, 1, 18, 5, 18, 248, 8, 18, 10, 18, 12, 18, 251, 
		    9, 18, 1, 19, 1, 19, 1, 19, 5, 19, 256, 8, 19, 10, 19, 12, 19, 259, 
		    9, 19, 1, 20, 3, 20, 262, 8, 20, 1, 20, 1, 20, 1, 21, 1, 21, 1, 21, 
		    1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 
		    21, 1, 21, 1, 21, 3, 21, 281, 8, 21, 1, 21, 3, 21, 284, 8, 21, 1, 
		    22, 1, 22, 1, 22, 3, 22, 289, 8, 22, 1, 22, 1, 22, 1, 23, 1, 23, 1, 
		    23, 5, 23, 296, 8, 23, 10, 23, 12, 23, 299, 9, 23, 1, 24, 1, 24, 1, 
		    24, 1, 24, 1, 24, 1, 24, 3, 24, 307, 8, 24, 3, 24, 309, 8, 24, 1, 
		    25, 1, 25, 1, 25, 1, 25, 1, 26, 1, 26, 1, 26, 3, 26, 318, 8, 26, 1, 
		    27, 3, 27, 321, 8, 27, 1, 27, 1, 27, 3, 27, 325, 8, 27, 1, 27, 1, 
		    27, 3, 27, 329, 8, 27, 1, 28, 1, 28, 1, 28, 3, 28, 334, 8, 28, 1, 
		    29, 1, 29, 1, 29, 1, 29, 3, 29, 340, 8, 29, 1, 30, 1, 30, 1, 30, 1, 
		    30, 1, 30, 1, 30, 1, 31, 1, 31, 5, 31, 350, 8, 31, 10, 31, 12, 31, 
		    353, 9, 31, 1, 32, 1, 32, 1, 32, 1, 32, 5, 32, 359, 8, 32, 10, 32, 
		    12, 32, 362, 9, 32, 1, 33, 1, 33, 1, 33, 5, 33, 367, 8, 33, 10, 33, 
		    12, 33, 370, 9, 33, 1, 34, 1, 34, 3, 34, 374, 8, 34, 1, 35, 1, 35, 
		    1, 36, 1, 36, 1, 36, 0, 0, 37, 0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 
		    20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 44, 46, 48, 50, 52, 
		    54, 56, 58, 60, 62, 64, 66, 68, 70, 72, 0, 7, 2, 0, 27, 27, 63, 64, 
		    1, 0, 39, 40, 1, 0, 33, 38, 1, 0, 28, 29, 1, 0, 30, 32, 2, 0, 29, 
		    29, 41, 41, 2, 0, 17, 17, 59, 59, 415, 0, 77, 1, 0, 0, 0, 2, 103, 
		    1, 0, 0, 0, 4, 105, 1, 0, 0, 0, 6, 113, 1, 0, 0, 0, 8, 116, 1, 0, 
		    0, 0, 10, 134, 1, 0, 0, 0, 12, 136, 1, 0, 0, 0, 14, 181, 1, 0, 0, 
		    0, 16, 183, 1, 0, 0, 0, 18, 190, 1, 0, 0, 0, 20, 196, 1, 0, 0, 0, 
		    22, 200, 1, 0, 0, 0, 24, 208, 1, 0, 0, 0, 26, 216, 1, 0, 0, 0, 28, 
		    224, 1, 0, 0, 0, 30, 226, 1, 0, 0, 0, 32, 228, 1, 0, 0, 0, 34, 236, 
		    1, 0, 0, 0, 36, 244, 1, 0, 0, 0, 38, 252, 1, 0, 0, 0, 40, 261, 1, 
		    0, 0, 0, 42, 283, 1, 0, 0, 0, 44, 285, 1, 0, 0, 0, 46, 292, 1, 0, 
		    0, 0, 48, 300, 1, 0, 0, 0, 50, 310, 1, 0, 0, 0, 52, 317, 1, 0, 0, 
		    0, 54, 320, 1, 0, 0, 0, 56, 333, 1, 0, 0, 0, 58, 339, 1, 0, 0, 0, 
		    60, 341, 1, 0, 0, 0, 62, 351, 1, 0, 0, 0, 64, 354, 1, 0, 0, 0, 66, 
		    363, 1, 0, 0, 0, 68, 371, 1, 0, 0, 0, 70, 375, 1, 0, 0, 0, 72, 377, 
		    1, 0, 0, 0, 74, 76, 3, 2, 1, 0, 75, 74, 1, 0, 0, 0, 76, 79, 1, 0, 
		    0, 0, 77, 75, 1, 0, 0, 0, 77, 78, 1, 0, 0, 0, 78, 80, 1, 0, 0, 0, 
		    79, 77, 1, 0, 0, 0, 80, 81, 5, 0, 0, 1, 81, 1, 1, 0, 0, 0, 82, 83, 
		    5, 3, 0, 0, 83, 84, 5, 59, 0, 0, 84, 86, 5, 44, 0, 0, 85, 87, 3, 4, 
		    2, 0, 86, 85, 1, 0, 0, 0, 86, 87, 1, 0, 0, 0, 87, 88, 1, 0, 0, 0, 
		    88, 95, 5, 45, 0, 0, 89, 96, 3, 10, 5, 0, 90, 92, 5, 44, 0, 0, 91, 
		    93, 3, 8, 4, 0, 92, 91, 1, 0, 0, 0, 92, 93, 1, 0, 0, 0, 93, 94, 1, 
		    0, 0, 0, 94, 96, 5, 45, 0, 0, 95, 89, 1, 0, 0, 0, 95, 90, 1, 0, 0, 
		    0, 95, 96, 1, 0, 0, 0, 96, 97, 1, 0, 0, 0, 97, 104, 3, 12, 6, 0, 98, 
		    99, 5, 3, 0, 0, 99, 100, 5, 4, 0, 0, 100, 101, 5, 44, 0, 0, 101, 102, 
		    5, 45, 0, 0, 102, 104, 3, 12, 6, 0, 103, 82, 1, 0, 0, 0, 103, 98, 
		    1, 0, 0, 0, 104, 3, 1, 0, 0, 0, 105, 110, 3, 6, 3, 0, 106, 107, 5, 
		    50, 0, 0, 107, 109, 3, 6, 3, 0, 108, 106, 1, 0, 0, 0, 109, 112, 1, 
		    0, 0, 0, 110, 108, 1, 0, 0, 0, 110, 111, 1, 0, 0, 0, 111, 5, 1, 0, 
		    0, 0, 112, 110, 1, 0, 0, 0, 113, 114, 5, 59, 0, 0, 114, 115, 3, 10, 
		    5, 0, 115, 7, 1, 0, 0, 0, 116, 121, 3, 10, 5, 0, 117, 118, 5, 50, 
		    0, 0, 118, 120, 3, 10, 5, 0, 119, 117, 1, 0, 0, 0, 120, 123, 1, 0, 
		    0, 0, 121, 119, 1, 0, 0, 0, 121, 122, 1, 0, 0, 0, 122, 9, 1, 0, 0, 
		    0, 123, 121, 1, 0, 0, 0, 124, 135, 5, 22, 0, 0, 125, 135, 5, 23, 0, 
		    0, 126, 135, 5, 24, 0, 0, 127, 135, 5, 25, 0, 0, 128, 135, 5, 26, 
		    0, 0, 129, 130, 5, 48, 0, 0, 130, 131, 3, 30, 15, 0, 131, 132, 5, 
		    49, 0, 0, 132, 133, 3, 10, 5, 0, 133, 135, 1, 0, 0, 0, 134, 124, 1, 
		    0, 0, 0, 134, 125, 1, 0, 0, 0, 134, 126, 1, 0, 0, 0, 134, 127, 1, 
		    0, 0, 0, 134, 128, 1, 0, 0, 0, 134, 129, 1, 0, 0, 0, 135, 11, 1, 0, 
		    0, 0, 136, 140, 5, 46, 0, 0, 137, 139, 3, 14, 7, 0, 138, 137, 1, 0, 
		    0, 0, 139, 142, 1, 0, 0, 0, 140, 138, 1, 0, 0, 0, 140, 141, 1, 0, 
		    0, 0, 141, 143, 1, 0, 0, 0, 142, 140, 1, 0, 0, 0, 143, 144, 5, 47, 
		    0, 0, 144, 13, 1, 0, 0, 0, 145, 147, 3, 16, 8, 0, 146, 148, 5, 53, 
		    0, 0, 147, 146, 1, 0, 0, 0, 147, 148, 1, 0, 0, 0, 148, 182, 1, 0, 
		    0, 0, 149, 151, 3, 18, 9, 0, 150, 152, 5, 53, 0, 0, 151, 150, 1, 0, 
		    0, 0, 151, 152, 1, 0, 0, 0, 152, 182, 1, 0, 0, 0, 153, 155, 3, 20, 
		    10, 0, 154, 156, 5, 53, 0, 0, 155, 154, 1, 0, 0, 0, 155, 156, 1, 0, 
		    0, 0, 156, 182, 1, 0, 0, 0, 157, 159, 3, 26, 13, 0, 158, 160, 5, 53, 
		    0, 0, 159, 158, 1, 0, 0, 0, 159, 160, 1, 0, 0, 0, 160, 182, 1, 0, 
		    0, 0, 161, 163, 3, 44, 22, 0, 162, 164, 5, 53, 0, 0, 163, 162, 1, 
		    0, 0, 0, 163, 164, 1, 0, 0, 0, 164, 182, 1, 0, 0, 0, 165, 182, 3, 
		    48, 24, 0, 166, 182, 3, 50, 25, 0, 167, 182, 3, 60, 30, 0, 168, 170, 
		    3, 68, 34, 0, 169, 171, 5, 53, 0, 0, 170, 169, 1, 0, 0, 0, 170, 171, 
		    1, 0, 0, 0, 171, 182, 1, 0, 0, 0, 172, 174, 3, 70, 35, 0, 173, 175, 
		    5, 53, 0, 0, 174, 173, 1, 0, 0, 0, 174, 175, 1, 0, 0, 0, 175, 182, 
		    1, 0, 0, 0, 176, 178, 3, 72, 36, 0, 177, 179, 5, 53, 0, 0, 178, 177, 
		    1, 0, 0, 0, 178, 179, 1, 0, 0, 0, 179, 182, 1, 0, 0, 0, 180, 182, 
		    3, 12, 6, 0, 181, 145, 1, 0, 0, 0, 181, 149, 1, 0, 0, 0, 181, 153, 
		    1, 0, 0, 0, 181, 157, 1, 0, 0, 0, 181, 161, 1, 0, 0, 0, 181, 165, 
		    1, 0, 0, 0, 181, 166, 1, 0, 0, 0, 181, 167, 1, 0, 0, 0, 181, 168, 
		    1, 0, 0, 0, 181, 172, 1, 0, 0, 0, 181, 176, 1, 0, 0, 0, 181, 180, 
		    1, 0, 0, 0, 182, 15, 1, 0, 0, 0, 183, 184, 5, 1, 0, 0, 184, 185, 3, 
		    22, 11, 0, 185, 188, 3, 10, 5, 0, 186, 187, 5, 27, 0, 0, 187, 189, 
		    3, 24, 12, 0, 188, 186, 1, 0, 0, 0, 188, 189, 1, 0, 0, 0, 189, 17, 
		    1, 0, 0, 0, 190, 191, 5, 2, 0, 0, 191, 192, 5, 59, 0, 0, 192, 193, 
		    3, 10, 5, 0, 193, 194, 5, 27, 0, 0, 194, 195, 3, 30, 15, 0, 195, 19, 
		    1, 0, 0, 0, 196, 197, 3, 22, 11, 0, 197, 198, 5, 54, 0, 0, 198, 199, 
		    3, 24, 12, 0, 199, 21, 1, 0, 0, 0, 200, 205, 5, 59, 0, 0, 201, 202, 
		    5, 50, 0, 0, 202, 204, 5, 59, 0, 0, 203, 201, 1, 0, 0, 0, 204, 207, 
		    1, 0, 0, 0, 205, 203, 1, 0, 0, 0, 205, 206, 1, 0, 0, 0, 206, 23, 1, 
		    0, 0, 0, 207, 205, 1, 0, 0, 0, 208, 213, 3, 30, 15, 0, 209, 210, 5, 
		    50, 0, 0, 210, 212, 3, 30, 15, 0, 211, 209, 1, 0, 0, 0, 212, 215, 
		    1, 0, 0, 0, 213, 211, 1, 0, 0, 0, 213, 214, 1, 0, 0, 0, 214, 25, 1, 
		    0, 0, 0, 215, 213, 1, 0, 0, 0, 216, 222, 5, 59, 0, 0, 217, 218, 3, 
		    28, 14, 0, 218, 219, 3, 30, 15, 0, 219, 223, 1, 0, 0, 0, 220, 223, 
		    5, 42, 0, 0, 221, 223, 5, 43, 0, 0, 222, 217, 1, 0, 0, 0, 222, 220, 
		    1, 0, 0, 0, 222, 221, 1, 0, 0, 0, 223, 27, 1, 0, 0, 0, 224, 225, 7, 
		    0, 0, 0, 225, 29, 1, 0, 0, 0, 226, 227, 3, 32, 16, 0, 227, 31, 1, 
		    0, 0, 0, 228, 233, 3, 34, 17, 0, 229, 230, 7, 1, 0, 0, 230, 232, 3, 
		    34, 17, 0, 231, 229, 1, 0, 0, 0, 232, 235, 1, 0, 0, 0, 233, 231, 1, 
		    0, 0, 0, 233, 234, 1, 0, 0, 0, 234, 33, 1, 0, 0, 0, 235, 233, 1, 0, 
		    0, 0, 236, 241, 3, 36, 18, 0, 237, 238, 7, 2, 0, 0, 238, 240, 3, 36, 
		    18, 0, 239, 237, 1, 0, 0, 0, 240, 243, 1, 0, 0, 0, 241, 239, 1, 0, 
		    0, 0, 241, 242, 1, 0, 0, 0, 242, 35, 1, 0, 0, 0, 243, 241, 1, 0, 0, 
		    0, 244, 249, 3, 38, 19, 0, 245, 246, 7, 3, 0, 0, 246, 248, 3, 38, 
		    19, 0, 247, 245, 1, 0, 0, 0, 248, 251, 1, 0, 0, 0, 249, 247, 1, 0, 
		    0, 0, 249, 250, 1, 0, 0, 0, 250, 37, 1, 0, 0, 0, 251, 249, 1, 0, 0, 
		    0, 252, 257, 3, 40, 20, 0, 253, 254, 7, 4, 0, 0, 254, 256, 3, 40, 
		    20, 0, 255, 253, 1, 0, 0, 0, 256, 259, 1, 0, 0, 0, 257, 255, 1, 0, 
		    0, 0, 257, 258, 1, 0, 0, 0, 258, 39, 1, 0, 0, 0, 259, 257, 1, 0, 0, 
		    0, 260, 262, 7, 5, 0, 0, 261, 260, 1, 0, 0, 0, 261, 262, 1, 0, 0, 
		    0, 262, 263, 1, 0, 0, 0, 263, 264, 3, 42, 21, 0, 264, 41, 1, 0, 0, 
		    0, 265, 284, 5, 55, 0, 0, 266, 284, 5, 56, 0, 0, 267, 284, 5, 57, 
		    0, 0, 268, 284, 5, 58, 0, 0, 269, 284, 5, 15, 0, 0, 270, 284, 5, 16, 
		    0, 0, 271, 284, 5, 14, 0, 0, 272, 284, 5, 59, 0, 0, 273, 284, 3, 44, 
		    22, 0, 274, 275, 5, 44, 0, 0, 275, 276, 3, 30, 15, 0, 276, 277, 5, 
		    45, 0, 0, 277, 284, 1, 0, 0, 0, 278, 280, 5, 48, 0, 0, 279, 281, 3, 
		    24, 12, 0, 280, 279, 1, 0, 0, 0, 280, 281, 1, 0, 0, 0, 281, 282, 1, 
		    0, 0, 0, 282, 284, 5, 49, 0, 0, 283, 265, 1, 0, 0, 0, 283, 266, 1, 
		    0, 0, 0, 283, 267, 1, 0, 0, 0, 283, 268, 1, 0, 0, 0, 283, 269, 1, 
		    0, 0, 0, 283, 270, 1, 0, 0, 0, 283, 271, 1, 0, 0, 0, 283, 272, 1, 
		    0, 0, 0, 283, 273, 1, 0, 0, 0, 283, 274, 1, 0, 0, 0, 283, 278, 1, 
		    0, 0, 0, 284, 43, 1, 0, 0, 0, 285, 286, 7, 6, 0, 0, 286, 288, 5, 44, 
		    0, 0, 287, 289, 3, 46, 23, 0, 288, 287, 1, 0, 0, 0, 288, 289, 1, 0, 
		    0, 0, 289, 290, 1, 0, 0, 0, 290, 291, 5, 45, 0, 0, 291, 45, 1, 0, 
		    0, 0, 292, 297, 3, 30, 15, 0, 293, 294, 5, 50, 0, 0, 294, 296, 3, 
		    30, 15, 0, 295, 293, 1, 0, 0, 0, 296, 299, 1, 0, 0, 0, 297, 295, 1, 
		    0, 0, 0, 297, 298, 1, 0, 0, 0, 298, 47, 1, 0, 0, 0, 299, 297, 1, 0, 
		    0, 0, 300, 301, 5, 5, 0, 0, 301, 302, 3, 30, 15, 0, 302, 308, 3, 12, 
		    6, 0, 303, 306, 5, 6, 0, 0, 304, 307, 3, 48, 24, 0, 305, 307, 3, 12, 
		    6, 0, 306, 304, 1, 0, 0, 0, 306, 305, 1, 0, 0, 0, 307, 309, 1, 0, 
		    0, 0, 308, 303, 1, 0, 0, 0, 308, 309, 1, 0, 0, 0, 309, 49, 1, 0, 0, 
		    0, 310, 311, 5, 7, 0, 0, 311, 312, 3, 52, 26, 0, 312, 313, 3, 12, 
		    6, 0, 313, 51, 1, 0, 0, 0, 314, 318, 3, 54, 27, 0, 315, 318, 3, 30, 
		    15, 0, 316, 318, 1, 0, 0, 0, 317, 314, 1, 0, 0, 0, 317, 315, 1, 0, 
		    0, 0, 317, 316, 1, 0, 0, 0, 318, 53, 1, 0, 0, 0, 319, 321, 3, 56, 
		    28, 0, 320, 319, 1, 0, 0, 0, 320, 321, 1, 0, 0, 0, 321, 322, 1, 0, 
		    0, 0, 322, 324, 5, 53, 0, 0, 323, 325, 3, 30, 15, 0, 324, 323, 1, 
		    0, 0, 0, 324, 325, 1, 0, 0, 0, 325, 326, 1, 0, 0, 0, 326, 328, 5, 
		    53, 0, 0, 327, 329, 3, 58, 29, 0, 328, 327, 1, 0, 0, 0, 328, 329, 
		    1, 0, 0, 0, 329, 55, 1, 0, 0, 0, 330, 334, 3, 20, 10, 0, 331, 334, 
		    3, 26, 13, 0, 332, 334, 3, 30, 15, 0, 333, 330, 1, 0, 0, 0, 333, 331, 
		    1, 0, 0, 0, 333, 332, 1, 0, 0, 0, 334, 57, 1, 0, 0, 0, 335, 340, 3, 
		    26, 13, 0, 336, 340, 3, 30, 15, 0, 337, 340, 5, 42, 0, 0, 338, 340, 
		    5, 43, 0, 0, 339, 335, 1, 0, 0, 0, 339, 336, 1, 0, 0, 0, 339, 337, 
		    1, 0, 0, 0, 339, 338, 1, 0, 0, 0, 340, 59, 1, 0, 0, 0, 341, 342, 5, 
		    11, 0, 0, 342, 343, 3, 30, 15, 0, 343, 344, 5, 46, 0, 0, 344, 345, 
		    3, 62, 31, 0, 345, 346, 5, 47, 0, 0, 346, 61, 1, 0, 0, 0, 347, 350, 
		    3, 64, 32, 0, 348, 350, 3, 66, 33, 0, 349, 347, 1, 0, 0, 0, 349, 348, 
		    1, 0, 0, 0, 350, 353, 1, 0, 0, 0, 351, 349, 1, 0, 0, 0, 351, 352, 
		    1, 0, 0, 0, 352, 63, 1, 0, 0, 0, 353, 351, 1, 0, 0, 0, 354, 355, 5, 
		    12, 0, 0, 355, 356, 3, 24, 12, 0, 356, 360, 5, 52, 0, 0, 357, 359, 
		    3, 14, 7, 0, 358, 357, 1, 0, 0, 0, 359, 362, 1, 0, 0, 0, 360, 358, 
		    1, 0, 0, 0, 360, 361, 1, 0, 0, 0, 361, 65, 1, 0, 0, 0, 362, 360, 1, 
		    0, 0, 0, 363, 364, 5, 13, 0, 0, 364, 368, 5, 52, 0, 0, 365, 367, 3, 
		    14, 7, 0, 366, 365, 1, 0, 0, 0, 367, 370, 1, 0, 0, 0, 368, 366, 1, 
		    0, 0, 0, 368, 369, 1, 0, 0, 0, 369, 67, 1, 0, 0, 0, 370, 368, 1, 0, 
		    0, 0, 371, 373, 5, 8, 0, 0, 372, 374, 3, 30, 15, 0, 373, 372, 1, 0, 
		    0, 0, 373, 374, 1, 0, 0, 0, 374, 69, 1, 0, 0, 0, 375, 376, 5, 9, 0, 
		    0, 376, 71, 1, 0, 0, 0, 377, 378, 5, 10, 0, 0, 378, 73, 1, 0, 0, 0, 
		    44, 77, 86, 92, 95, 103, 110, 121, 134, 140, 147, 151, 155, 159, 163, 
		    170, 174, 178, 181, 188, 205, 213, 222, 233, 241, 249, 257, 261, 280, 
		    283, 288, 297, 306, 308, 317, 320, 324, 328, 333, 339, 349, 351, 360, 
		    368, 373];
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

		        	        	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 281475106734080) !== 0)) {
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
		        $this->setState(134);
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
		        $this->setState(136);
		        $this->match(self::LLAVE_IZQ);
		        $this->setState(140);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 576531121047736230) !== 0)) {
		        	$this->setState(137);
		        	$this->sentencia();
		        	$this->setState(142);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(143);
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
		        $this->setState(181);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 17, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(145);
		        	    $this->declaracionVar();
		        	    $this->setState(147);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(146);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(149);
		        	    $this->declaracionConstante();
		        	    $this->setState(151);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(150);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(153);
		        	    $this->declaracionCorta();
		        	    $this->setState(155);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(154);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(157);
		        	    $this->asignacion();
		        	    $this->setState(159);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(158);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(161);
		        	    $this->llamadaFuncion();
		        	    $this->setState(163);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(162);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(165);
		        	    $this->ifStmt();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(166);
		        	    $this->forStmt();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(167);
		        	    $this->switchStmt();
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(168);
		        	    $this->returnStmt();
		        	    $this->setState(170);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(169);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(172);
		        	    $this->breakStmt();
		        	    $this->setState(174);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(173);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(176);
		        	    $this->continueStmt();
		        	    $this->setState(178);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(177);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 12:
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(180);
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
		        $this->setState(183);
		        $this->match(self::VAR);
		        $this->setState(184);
		        $this->listaIdentificadores();
		        $this->setState(185);
		        $this->tipo();
		        $this->setState(188);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ASIGNACION) {
		        	$this->setState(186);
		        	$this->match(self::ASIGNACION);
		        	$this->setState(187);
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
		        $this->setState(190);
		        $this->match(self::CONST);
		        $this->setState(191);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(192);
		        $this->tipo();
		        $this->setState(193);
		        $this->match(self::ASIGNACION);
		        $this->setState(194);
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
		        $this->setState(196);
		        $this->listaIdentificadores();
		        $this->setState(197);
		        $this->match(self::DECLARACION_CORTA);
		        $this->setState(198);
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
		        $this->setState(200);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(205);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(201);
		        	$this->match(self::COMA);
		        	$this->setState(202);
		        	$this->match(self::IDENTIFICADOR);
		        	$this->setState(207);
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
		        $this->setState(208);
		        $this->expresion();
		        $this->setState(213);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(209);
		        	$this->match(self::COMA);
		        	$this->setState(210);
		        	$this->expresion();
		        	$this->setState(215);
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
		        $this->setState(216);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(222);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::ASIGNACION:
		            case self::MAS_ASIGNACION:
		            case self::MENOS_ASIGNACION:
		            	$this->setState(217);
		            	$this->operadorAsignacion();
		            	$this->setState(218);
		            	$this->expresion();
		            	break;

		            case self::INCREMENTO:
		            	$this->setState(220);
		            	$this->match(self::INCREMENTO);
		            	break;

		            case self::DECREMENTO:
		            	$this->setState(221);
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
		        $this->setState(224);

		        $_la = $this->input->LA(1);

		        if (!((((($_la - 27)) & ~0x3f) === 0 && ((1 << ($_la - 27)) & 206158430209) !== 0))) {
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
		        $this->setState(226);
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
		        $this->setState(228);
		        $this->expresionComparacion();
		        $this->setState(233);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::AND || $_la === self::OR) {
		        	$this->setState(229);

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
		        	$this->setState(230);
		        	$this->expresionComparacion();
		        	$this->setState(235);
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
		        $this->setState(236);
		        $this->expresionAditiva();
		        $this->setState(241);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 541165879296) !== 0)) {
		        	$this->setState(237);

		        	$_la = $this->input->LA(1);

		        	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 541165879296) !== 0))) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(238);
		        	$this->expresionAditiva();
		        	$this->setState(243);
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
		        $this->setState(244);
		        $this->expresionMultiplicativa();
		        $this->setState(249);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::MAS || $_la === self::MENOS) {
		        	$this->setState(245);

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
		        	$this->setState(246);
		        	$this->expresionMultiplicativa();
		        	$this->setState(251);
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
		        $this->setState(252);
		        $this->expresionUnaria();
		        $this->setState(257);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 7516192768) !== 0)) {
		        	$this->setState(253);

		        	$_la = $this->input->LA(1);

		        	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 7516192768) !== 0))) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(254);
		        	$this->expresionUnaria();
		        	$this->setState(259);
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
		public function expresionUnaria(): Context\ExpresionUnariaContext
		{
		    $localContext = new Context\ExpresionUnariaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 40, self::RULE_expresionUnaria);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(261);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::MENOS || $_la === self::NOT) {
		        	$this->setState(260);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::MENOS || $_la === self::NOT)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        }
		        $this->setState(263);
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
		        $this->setState(283);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 28, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(265);
		        	    $this->match(self::NUMERO_ENTERO);
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(266);
		        	    $this->match(self::NUMERO_DECIMAL);
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(267);
		        	    $this->match(self::CADENA);
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(268);
		        	    $this->match(self::CARACTER);
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(269);
		        	    $this->match(self::TRUE);
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(270);
		        	    $this->match(self::FALSE);
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(271);
		        	    $this->match(self::NIL);
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(272);
		        	    $this->match(self::IDENTIFICADOR);
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(273);
		        	    $this->llamadaFuncion();
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(274);
		        	    $this->match(self::PAREN_IZQ);
		        	    $this->setState(275);
		        	    $this->expresion();
		        	    $this->setState(276);
		        	    $this->match(self::PAREN_DER);
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(278);
		        	    $this->match(self::CORCHETE_IZQ);
		        	    $this->setState(280);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1117193974311010304) !== 0)) {
		        	    	$this->setState(279);
		        	    	$this->listaExpresiones();
		        	    }
		        	    $this->setState(282);
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
		        $this->setState(285);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::PRINTLN || $_la === self::IDENTIFICADOR)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		        $this->setState(286);
		        $this->match(self::PAREN_IZQ);
		        $this->setState(288);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1117193974311010304) !== 0)) {
		        	$this->setState(287);
		        	$this->argumentos();
		        }
		        $this->setState(290);
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
		        $this->setState(292);
		        $this->expresion();
		        $this->setState(297);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(293);
		        	$this->match(self::COMA);
		        	$this->setState(294);
		        	$this->expresion();
		        	$this->setState(299);
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
		        $this->setState(300);
		        $this->match(self::IF);
		        $this->setState(301);
		        $this->expresion();
		        $this->setState(302);
		        $this->bloque();
		        $this->setState(308);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ELSE) {
		        	$this->setState(303);
		        	$this->match(self::ELSE);
		        	$this->setState(306);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::IF:
		        	    	$this->setState(304);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::LLAVE_IZQ:
		        	    	$this->setState(305);
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
		        $this->setState(310);
		        $this->match(self::FOR);
		        $this->setState(311);
		        $this->forHeader();
		        $this->setState(312);
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
		        $this->setState(317);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 33, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(314);
		        	    $this->forClause();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(315);
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
		        $this->setState(320);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1117193974311010304) !== 0)) {
		        	$this->setState(319);
		        	$this->initStmt();
		        }
		        $this->setState(322);
		        $this->match(self::PUNTO_COMA);
		        $this->setState(324);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1117193974311010304) !== 0)) {
		        	$this->setState(323);
		        	$this->expresion();
		        }
		        $this->setState(326);
		        $this->match(self::PUNTO_COMA);
		        $this->setState(328);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1117207168450543616) !== 0)) {
		        	$this->setState(327);
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
		        $this->setState(333);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 37, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(330);
		        	    $this->declaracionCorta();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(331);
		        	    $this->asignacion();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(332);
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
		        $this->setState(339);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 38, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(335);
		        	    $this->asignacion();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(336);
		        	    $this->expresion();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(337);
		        	    $this->match(self::INCREMENTO);
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(338);
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
		        $this->setState(341);
		        $this->match(self::SWITCH);
		        $this->setState(342);
		        $this->expresion();
		        $this->setState(343);
		        $this->match(self::LLAVE_IZQ);
		        $this->setState(344);
		        $this->casoBloques();
		        $this->setState(345);
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
		        $this->setState(351);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::CASE || $_la === self::DEFAULT) {
		        	$this->setState(349);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::CASE:
		        	    	$this->setState(347);
		        	    	$this->caso();
		        	    	break;

		        	    case self::DEFAULT:
		        	    	$this->setState(348);
		        	    	$this->defaultBloque();
		        	    	break;

		        	default:
		        		throw new NoViableAltException($this);
		        	}
		        	$this->setState(353);
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
		        $this->setState(354);
		        $this->match(self::CASE);
		        $this->setState(355);
		        $this->listaExpresiones();
		        $this->setState(356);
		        $this->match(self::DOS_PUNTOS);
		        $this->setState(360);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 576531121047736230) !== 0)) {
		        	$this->setState(357);
		        	$this->sentencia();
		        	$this->setState(362);
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
		        $this->setState(363);
		        $this->match(self::DEFAULT);
		        $this->setState(364);
		        $this->match(self::DOS_PUNTOS);
		        $this->setState(368);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 576531121047736230) !== 0)) {
		        	$this->setState(365);
		        	$this->sentencia();
		        	$this->setState(370);
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
		        $this->setState(371);
		        $this->match(self::RETURN);
		        $this->setState(373);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 43, $this->ctx)) {
		            case 1:
		        	    $this->setState(372);
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
		public function breakStmt(): Context\BreakStmtContext
		{
		    $localContext = new Context\BreakStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 70, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(375);
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
		        $this->setState(377);
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

	    public function llamadaFuncion(): ?LlamadaFuncionContext
	    {
	    	return $this->getTypedRuleContext(LlamadaFuncionContext::class, 0);
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

	    public function expresion(): ?ExpresionContext
	    {
	    	return $this->getTypedRuleContext(ExpresionContext::class, 0);
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