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
               FOR = 7, RETURN = 8, BREAK = 9, CONTINUE = 10, NIL = 11, 
               TRUE = 12, FALSE = 13, PRINTLN = 14, LEN = 15, NOW = 16, 
               SUBSTR = 17, TYPEOF = 18, INT32 = 19, FLOAT32 = 20, STRING = 21, 
               BOOL = 22, RUNE = 23, ASIGNACION = 24, MAS = 25, MENOS = 26, 
               MULT = 27, DIV = 28, MOD = 29, IGUAL = 30, DIFERENTE = 31, 
               MAYOR = 32, MENOR = 33, MAYOR_IGUAL = 34, MENOR_IGUAL = 35, 
               AND = 36, OR = 37, NOT = 38, INCREMENTO = 39, DECREMENTO = 40, 
               PAREN_IZQ = 41, PAREN_DER = 42, LLAVE_IZQ = 43, LLAVE_DER = 44, 
               CORCHETE_IZQ = 45, CORCHETE_DER = 46, COMA = 47, PUNTO = 48, 
               DOS_PUNTOS = 49, PUNTO_COMA = 50, DECLARACION_CORTA = 51, 
               NUMERO_ENTERO = 52, NUMERO_DECIMAL = 53, CADENA = 54, CARACTER = 55, 
               IDENTIFICADOR = 56, COMENTARIO_LINEA = 57, COMENTARIO_BLOQUE = 58, 
               WS = 59, MAS_ASIGNACION = 60, MENOS_ASIGNACION = 61;

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
               RULE_postStmt = 29, RULE_returnStmt = 30, RULE_breakStmt = 31, 
               RULE_continueStmt = 32;

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
			'postStmt', 'returnStmt', 'breakStmt', 'continueStmt'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'var'", "'const'", "'func'", "'main'", "'if'", "'else'", "'for'", 
		    "'return'", "'break'", "'continue'", "'nil'", "'true'", "'false'", 
		    "'fmt.Println'", "'len'", "'now'", "'substr'", "'typeOf'", "'int32'", 
		    "'float32'", "'string'", "'bool'", "'rune'", "'='", "'+'", "'-'", 
		    "'*'", "'/'", "'%'", "'=='", "'!='", "'>'", "'<'", "'>='", "'<='", 
		    "'&&'", "'||'", "'!'", "'++'", "'--'", "'('", "')'", "'{'", "'}'", 
		    "'['", "']'", "','", "'.'", "':'", "';'", "':='", null, null, null, 
		    null, null, null, null, null, "'+='", "'-='"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, "VAR", "CONST", "FUNC", "MAIN", "IF", "ELSE", "FOR", "RETURN", 
		    "BREAK", "CONTINUE", "NIL", "TRUE", "FALSE", "PRINTLN", "LEN", "NOW", 
		    "SUBSTR", "TYPEOF", "INT32", "FLOAT32", "STRING", "BOOL", "RUNE", 
		    "ASIGNACION", "MAS", "MENOS", "MULT", "DIV", "MOD", "IGUAL", "DIFERENTE", 
		    "MAYOR", "MENOR", "MAYOR_IGUAL", "MENOR_IGUAL", "AND", "OR", "NOT", 
		    "INCREMENTO", "DECREMENTO", "PAREN_IZQ", "PAREN_DER", "LLAVE_IZQ", 
		    "LLAVE_DER", "CORCHETE_IZQ", "CORCHETE_DER", "COMA", "PUNTO", "DOS_PUNTOS", 
		    "PUNTO_COMA", "DECLARACION_CORTA", "NUMERO_ENTERO", "NUMERO_DECIMAL", 
		    "CADENA", "CARACTER", "IDENTIFICADOR", "COMENTARIO_LINEA", "COMENTARIO_BLOQUE", 
		    "WS", "MAS_ASIGNACION", "MENOS_ASIGNACION"
		];

		private const SERIALIZED_ATN =
			[4, 1, 61, 341, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 19, 
		    7, 19, 2, 20, 7, 20, 2, 21, 7, 21, 2, 22, 7, 22, 2, 23, 7, 23, 2, 
		    24, 7, 24, 2, 25, 7, 25, 2, 26, 7, 26, 2, 27, 7, 27, 2, 28, 7, 28, 
		    2, 29, 7, 29, 2, 30, 7, 30, 2, 31, 7, 31, 2, 32, 7, 32, 1, 0, 5, 0, 
		    68, 8, 0, 10, 0, 12, 0, 71, 9, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 
		    1, 3, 1, 79, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 85, 8, 1, 1, 1, 3, 
		    1, 88, 8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 3, 1, 96, 8, 1, 1, 
		    2, 1, 2, 1, 2, 5, 2, 101, 8, 2, 10, 2, 12, 2, 104, 9, 2, 1, 3, 1, 
		    3, 1, 3, 1, 4, 1, 4, 1, 4, 5, 4, 112, 8, 4, 10, 4, 12, 4, 115, 9, 
		    4, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 3, 
		    5, 127, 8, 5, 1, 6, 1, 6, 5, 6, 131, 8, 6, 10, 6, 12, 6, 134, 9, 6, 
		    1, 6, 1, 6, 1, 7, 1, 7, 3, 7, 140, 8, 7, 1, 7, 1, 7, 3, 7, 144, 8, 
		    7, 1, 7, 1, 7, 3, 7, 148, 8, 7, 1, 7, 1, 7, 3, 7, 152, 8, 7, 1, 7, 
		    1, 7, 3, 7, 156, 8, 7, 1, 7, 1, 7, 1, 7, 1, 7, 3, 7, 162, 8, 7, 1, 
		    7, 1, 7, 3, 7, 166, 8, 7, 1, 7, 1, 7, 3, 7, 170, 8, 7, 1, 7, 3, 7, 
		    173, 8, 7, 1, 8, 1, 8, 1, 8, 1, 8, 1, 8, 3, 8, 180, 8, 8, 1, 9, 1, 
		    9, 1, 9, 1, 9, 1, 9, 1, 9, 1, 10, 1, 10, 1, 10, 1, 10, 1, 11, 1, 11, 
		    1, 11, 5, 11, 195, 8, 11, 10, 11, 12, 11, 198, 9, 11, 1, 12, 1, 12, 
		    1, 12, 5, 12, 203, 8, 12, 10, 12, 12, 12, 206, 9, 12, 1, 13, 1, 13, 
		    1, 13, 1, 13, 1, 13, 1, 13, 3, 13, 214, 8, 13, 1, 14, 1, 14, 1, 15, 
		    1, 15, 1, 16, 1, 16, 1, 16, 5, 16, 223, 8, 16, 10, 16, 12, 16, 226, 
		    9, 16, 1, 17, 1, 17, 1, 17, 5, 17, 231, 8, 17, 10, 17, 12, 17, 234, 
		    9, 17, 1, 18, 1, 18, 1, 18, 5, 18, 239, 8, 18, 10, 18, 12, 18, 242, 
		    9, 18, 1, 19, 1, 19, 1, 19, 5, 19, 247, 8, 19, 10, 19, 12, 19, 250, 
		    9, 19, 1, 20, 3, 20, 253, 8, 20, 1, 20, 1, 20, 1, 21, 1, 21, 1, 21, 
		    1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 21, 1, 
		    21, 1, 21, 1, 21, 3, 21, 272, 8, 21, 1, 21, 3, 21, 275, 8, 21, 1, 
		    22, 1, 22, 1, 22, 3, 22, 280, 8, 22, 1, 22, 1, 22, 1, 23, 1, 23, 1, 
		    23, 5, 23, 287, 8, 23, 10, 23, 12, 23, 290, 9, 23, 1, 24, 1, 24, 1, 
		    24, 1, 24, 1, 24, 1, 24, 3, 24, 298, 8, 24, 3, 24, 300, 8, 24, 1, 
		    25, 1, 25, 1, 25, 1, 25, 1, 26, 1, 26, 1, 26, 3, 26, 309, 8, 26, 1, 
		    27, 3, 27, 312, 8, 27, 1, 27, 1, 27, 3, 27, 316, 8, 27, 1, 27, 1, 
		    27, 3, 27, 320, 8, 27, 1, 28, 1, 28, 1, 28, 3, 28, 325, 8, 28, 1, 
		    29, 1, 29, 1, 29, 1, 29, 3, 29, 331, 8, 29, 1, 30, 1, 30, 3, 30, 335, 
		    8, 30, 1, 31, 1, 31, 1, 32, 1, 32, 1, 32, 0, 0, 33, 0, 2, 4, 6, 8, 
		    10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 
		    44, 46, 48, 50, 52, 54, 56, 58, 60, 62, 64, 0, 7, 2, 0, 24, 24, 60, 
		    61, 1, 0, 36, 37, 1, 0, 30, 35, 1, 0, 25, 26, 1, 0, 27, 29, 2, 0, 
		    26, 26, 38, 38, 2, 0, 14, 14, 56, 56, 375, 0, 69, 1, 0, 0, 0, 2, 95, 
		    1, 0, 0, 0, 4, 97, 1, 0, 0, 0, 6, 105, 1, 0, 0, 0, 8, 108, 1, 0, 0, 
		    0, 10, 126, 1, 0, 0, 0, 12, 128, 1, 0, 0, 0, 14, 172, 1, 0, 0, 0, 
		    16, 174, 1, 0, 0, 0, 18, 181, 1, 0, 0, 0, 20, 187, 1, 0, 0, 0, 22, 
		    191, 1, 0, 0, 0, 24, 199, 1, 0, 0, 0, 26, 207, 1, 0, 0, 0, 28, 215, 
		    1, 0, 0, 0, 30, 217, 1, 0, 0, 0, 32, 219, 1, 0, 0, 0, 34, 227, 1, 
		    0, 0, 0, 36, 235, 1, 0, 0, 0, 38, 243, 1, 0, 0, 0, 40, 252, 1, 0, 
		    0, 0, 42, 274, 1, 0, 0, 0, 44, 276, 1, 0, 0, 0, 46, 283, 1, 0, 0, 
		    0, 48, 291, 1, 0, 0, 0, 50, 301, 1, 0, 0, 0, 52, 308, 1, 0, 0, 0, 
		    54, 311, 1, 0, 0, 0, 56, 324, 1, 0, 0, 0, 58, 330, 1, 0, 0, 0, 60, 
		    332, 1, 0, 0, 0, 62, 336, 1, 0, 0, 0, 64, 338, 1, 0, 0, 0, 66, 68, 
		    3, 2, 1, 0, 67, 66, 1, 0, 0, 0, 68, 71, 1, 0, 0, 0, 69, 67, 1, 0, 
		    0, 0, 69, 70, 1, 0, 0, 0, 70, 72, 1, 0, 0, 0, 71, 69, 1, 0, 0, 0, 
		    72, 73, 5, 0, 0, 1, 73, 1, 1, 0, 0, 0, 74, 75, 5, 3, 0, 0, 75, 76, 
		    5, 56, 0, 0, 76, 78, 5, 41, 0, 0, 77, 79, 3, 4, 2, 0, 78, 77, 1, 0, 
		    0, 0, 78, 79, 1, 0, 0, 0, 79, 80, 1, 0, 0, 0, 80, 87, 5, 42, 0, 0, 
		    81, 88, 3, 10, 5, 0, 82, 84, 5, 41, 0, 0, 83, 85, 3, 8, 4, 0, 84, 
		    83, 1, 0, 0, 0, 84, 85, 1, 0, 0, 0, 85, 86, 1, 0, 0, 0, 86, 88, 5, 
		    42, 0, 0, 87, 81, 1, 0, 0, 0, 87, 82, 1, 0, 0, 0, 87, 88, 1, 0, 0, 
		    0, 88, 89, 1, 0, 0, 0, 89, 96, 3, 12, 6, 0, 90, 91, 5, 3, 0, 0, 91, 
		    92, 5, 4, 0, 0, 92, 93, 5, 41, 0, 0, 93, 94, 5, 42, 0, 0, 94, 96, 
		    3, 12, 6, 0, 95, 74, 1, 0, 0, 0, 95, 90, 1, 0, 0, 0, 96, 3, 1, 0, 
		    0, 0, 97, 102, 3, 6, 3, 0, 98, 99, 5, 47, 0, 0, 99, 101, 3, 6, 3, 
		    0, 100, 98, 1, 0, 0, 0, 101, 104, 1, 0, 0, 0, 102, 100, 1, 0, 0, 0, 
		    102, 103, 1, 0, 0, 0, 103, 5, 1, 0, 0, 0, 104, 102, 1, 0, 0, 0, 105, 
		    106, 5, 56, 0, 0, 106, 107, 3, 10, 5, 0, 107, 7, 1, 0, 0, 0, 108, 
		    113, 3, 10, 5, 0, 109, 110, 5, 47, 0, 0, 110, 112, 3, 10, 5, 0, 111, 
		    109, 1, 0, 0, 0, 112, 115, 1, 0, 0, 0, 113, 111, 1, 0, 0, 0, 113, 
		    114, 1, 0, 0, 0, 114, 9, 1, 0, 0, 0, 115, 113, 1, 0, 0, 0, 116, 127, 
		    5, 19, 0, 0, 117, 127, 5, 20, 0, 0, 118, 127, 5, 21, 0, 0, 119, 127, 
		    5, 22, 0, 0, 120, 127, 5, 23, 0, 0, 121, 122, 5, 45, 0, 0, 122, 123, 
		    3, 30, 15, 0, 123, 124, 5, 46, 0, 0, 124, 125, 3, 10, 5, 0, 125, 127, 
		    1, 0, 0, 0, 126, 116, 1, 0, 0, 0, 126, 117, 1, 0, 0, 0, 126, 118, 
		    1, 0, 0, 0, 126, 119, 1, 0, 0, 0, 126, 120, 1, 0, 0, 0, 126, 121, 
		    1, 0, 0, 0, 127, 11, 1, 0, 0, 0, 128, 132, 5, 43, 0, 0, 129, 131, 
		    3, 14, 7, 0, 130, 129, 1, 0, 0, 0, 131, 134, 1, 0, 0, 0, 132, 130, 
		    1, 0, 0, 0, 132, 133, 1, 0, 0, 0, 133, 135, 1, 0, 0, 0, 134, 132, 
		    1, 0, 0, 0, 135, 136, 5, 44, 0, 0, 136, 13, 1, 0, 0, 0, 137, 139, 
		    3, 16, 8, 0, 138, 140, 5, 50, 0, 0, 139, 138, 1, 0, 0, 0, 139, 140, 
		    1, 0, 0, 0, 140, 173, 1, 0, 0, 0, 141, 143, 3, 18, 9, 0, 142, 144, 
		    5, 50, 0, 0, 143, 142, 1, 0, 0, 0, 143, 144, 1, 0, 0, 0, 144, 173, 
		    1, 0, 0, 0, 145, 147, 3, 20, 10, 0, 146, 148, 5, 50, 0, 0, 147, 146, 
		    1, 0, 0, 0, 147, 148, 1, 0, 0, 0, 148, 173, 1, 0, 0, 0, 149, 151, 
		    3, 26, 13, 0, 150, 152, 5, 50, 0, 0, 151, 150, 1, 0, 0, 0, 151, 152, 
		    1, 0, 0, 0, 152, 173, 1, 0, 0, 0, 153, 155, 3, 44, 22, 0, 154, 156, 
		    5, 50, 0, 0, 155, 154, 1, 0, 0, 0, 155, 156, 1, 0, 0, 0, 156, 173, 
		    1, 0, 0, 0, 157, 173, 3, 48, 24, 0, 158, 173, 3, 50, 25, 0, 159, 161, 
		    3, 60, 30, 0, 160, 162, 5, 50, 0, 0, 161, 160, 1, 0, 0, 0, 161, 162, 
		    1, 0, 0, 0, 162, 173, 1, 0, 0, 0, 163, 165, 3, 62, 31, 0, 164, 166, 
		    5, 50, 0, 0, 165, 164, 1, 0, 0, 0, 165, 166, 1, 0, 0, 0, 166, 173, 
		    1, 0, 0, 0, 167, 169, 3, 64, 32, 0, 168, 170, 5, 50, 0, 0, 169, 168, 
		    1, 0, 0, 0, 169, 170, 1, 0, 0, 0, 170, 173, 1, 0, 0, 0, 171, 173, 
		    3, 12, 6, 0, 172, 137, 1, 0, 0, 0, 172, 141, 1, 0, 0, 0, 172, 145, 
		    1, 0, 0, 0, 172, 149, 1, 0, 0, 0, 172, 153, 1, 0, 0, 0, 172, 157, 
		    1, 0, 0, 0, 172, 158, 1, 0, 0, 0, 172, 159, 1, 0, 0, 0, 172, 163, 
		    1, 0, 0, 0, 172, 167, 1, 0, 0, 0, 172, 171, 1, 0, 0, 0, 173, 15, 1, 
		    0, 0, 0, 174, 175, 5, 1, 0, 0, 175, 176, 3, 22, 11, 0, 176, 179, 3, 
		    10, 5, 0, 177, 178, 5, 24, 0, 0, 178, 180, 3, 24, 12, 0, 179, 177, 
		    1, 0, 0, 0, 179, 180, 1, 0, 0, 0, 180, 17, 1, 0, 0, 0, 181, 182, 5, 
		    2, 0, 0, 182, 183, 5, 56, 0, 0, 183, 184, 3, 10, 5, 0, 184, 185, 5, 
		    24, 0, 0, 185, 186, 3, 30, 15, 0, 186, 19, 1, 0, 0, 0, 187, 188, 3, 
		    22, 11, 0, 188, 189, 5, 51, 0, 0, 189, 190, 3, 24, 12, 0, 190, 21, 
		    1, 0, 0, 0, 191, 196, 5, 56, 0, 0, 192, 193, 5, 47, 0, 0, 193, 195, 
		    5, 56, 0, 0, 194, 192, 1, 0, 0, 0, 195, 198, 1, 0, 0, 0, 196, 194, 
		    1, 0, 0, 0, 196, 197, 1, 0, 0, 0, 197, 23, 1, 0, 0, 0, 198, 196, 1, 
		    0, 0, 0, 199, 204, 3, 30, 15, 0, 200, 201, 5, 47, 0, 0, 201, 203, 
		    3, 30, 15, 0, 202, 200, 1, 0, 0, 0, 203, 206, 1, 0, 0, 0, 204, 202, 
		    1, 0, 0, 0, 204, 205, 1, 0, 0, 0, 205, 25, 1, 0, 0, 0, 206, 204, 1, 
		    0, 0, 0, 207, 213, 5, 56, 0, 0, 208, 209, 3, 28, 14, 0, 209, 210, 
		    3, 30, 15, 0, 210, 214, 1, 0, 0, 0, 211, 214, 5, 39, 0, 0, 212, 214, 
		    5, 40, 0, 0, 213, 208, 1, 0, 0, 0, 213, 211, 1, 0, 0, 0, 213, 212, 
		    1, 0, 0, 0, 214, 27, 1, 0, 0, 0, 215, 216, 7, 0, 0, 0, 216, 29, 1, 
		    0, 0, 0, 217, 218, 3, 32, 16, 0, 218, 31, 1, 0, 0, 0, 219, 224, 3, 
		    34, 17, 0, 220, 221, 7, 1, 0, 0, 221, 223, 3, 34, 17, 0, 222, 220, 
		    1, 0, 0, 0, 223, 226, 1, 0, 0, 0, 224, 222, 1, 0, 0, 0, 224, 225, 
		    1, 0, 0, 0, 225, 33, 1, 0, 0, 0, 226, 224, 1, 0, 0, 0, 227, 232, 3, 
		    36, 18, 0, 228, 229, 7, 2, 0, 0, 229, 231, 3, 36, 18, 0, 230, 228, 
		    1, 0, 0, 0, 231, 234, 1, 0, 0, 0, 232, 230, 1, 0, 0, 0, 232, 233, 
		    1, 0, 0, 0, 233, 35, 1, 0, 0, 0, 234, 232, 1, 0, 0, 0, 235, 240, 3, 
		    38, 19, 0, 236, 237, 7, 3, 0, 0, 237, 239, 3, 38, 19, 0, 238, 236, 
		    1, 0, 0, 0, 239, 242, 1, 0, 0, 0, 240, 238, 1, 0, 0, 0, 240, 241, 
		    1, 0, 0, 0, 241, 37, 1, 0, 0, 0, 242, 240, 1, 0, 0, 0, 243, 248, 3, 
		    40, 20, 0, 244, 245, 7, 4, 0, 0, 245, 247, 3, 40, 20, 0, 246, 244, 
		    1, 0, 0, 0, 247, 250, 1, 0, 0, 0, 248, 246, 1, 0, 0, 0, 248, 249, 
		    1, 0, 0, 0, 249, 39, 1, 0, 0, 0, 250, 248, 1, 0, 0, 0, 251, 253, 7, 
		    5, 0, 0, 252, 251, 1, 0, 0, 0, 252, 253, 1, 0, 0, 0, 253, 254, 1, 
		    0, 0, 0, 254, 255, 3, 42, 21, 0, 255, 41, 1, 0, 0, 0, 256, 275, 5, 
		    52, 0, 0, 257, 275, 5, 53, 0, 0, 258, 275, 5, 54, 0, 0, 259, 275, 
		    5, 55, 0, 0, 260, 275, 5, 12, 0, 0, 261, 275, 5, 13, 0, 0, 262, 275, 
		    5, 11, 0, 0, 263, 275, 5, 56, 0, 0, 264, 275, 3, 44, 22, 0, 265, 266, 
		    5, 41, 0, 0, 266, 267, 3, 30, 15, 0, 267, 268, 5, 42, 0, 0, 268, 275, 
		    1, 0, 0, 0, 269, 271, 5, 45, 0, 0, 270, 272, 3, 24, 12, 0, 271, 270, 
		    1, 0, 0, 0, 271, 272, 1, 0, 0, 0, 272, 273, 1, 0, 0, 0, 273, 275, 
		    5, 46, 0, 0, 274, 256, 1, 0, 0, 0, 274, 257, 1, 0, 0, 0, 274, 258, 
		    1, 0, 0, 0, 274, 259, 1, 0, 0, 0, 274, 260, 1, 0, 0, 0, 274, 261, 
		    1, 0, 0, 0, 274, 262, 1, 0, 0, 0, 274, 263, 1, 0, 0, 0, 274, 264, 
		    1, 0, 0, 0, 274, 265, 1, 0, 0, 0, 274, 269, 1, 0, 0, 0, 275, 43, 1, 
		    0, 0, 0, 276, 277, 7, 6, 0, 0, 277, 279, 5, 41, 0, 0, 278, 280, 3, 
		    46, 23, 0, 279, 278, 1, 0, 0, 0, 279, 280, 1, 0, 0, 0, 280, 281, 1, 
		    0, 0, 0, 281, 282, 5, 42, 0, 0, 282, 45, 1, 0, 0, 0, 283, 288, 3, 
		    30, 15, 0, 284, 285, 5, 47, 0, 0, 285, 287, 3, 30, 15, 0, 286, 284, 
		    1, 0, 0, 0, 287, 290, 1, 0, 0, 0, 288, 286, 1, 0, 0, 0, 288, 289, 
		    1, 0, 0, 0, 289, 47, 1, 0, 0, 0, 290, 288, 1, 0, 0, 0, 291, 292, 5, 
		    5, 0, 0, 292, 293, 3, 30, 15, 0, 293, 299, 3, 12, 6, 0, 294, 297, 
		    5, 6, 0, 0, 295, 298, 3, 48, 24, 0, 296, 298, 3, 12, 6, 0, 297, 295, 
		    1, 0, 0, 0, 297, 296, 1, 0, 0, 0, 298, 300, 1, 0, 0, 0, 299, 294, 
		    1, 0, 0, 0, 299, 300, 1, 0, 0, 0, 300, 49, 1, 0, 0, 0, 301, 302, 5, 
		    7, 0, 0, 302, 303, 3, 52, 26, 0, 303, 304, 3, 12, 6, 0, 304, 51, 1, 
		    0, 0, 0, 305, 309, 3, 54, 27, 0, 306, 309, 3, 30, 15, 0, 307, 309, 
		    1, 0, 0, 0, 308, 305, 1, 0, 0, 0, 308, 306, 1, 0, 0, 0, 308, 307, 
		    1, 0, 0, 0, 309, 53, 1, 0, 0, 0, 310, 312, 3, 56, 28, 0, 311, 310, 
		    1, 0, 0, 0, 311, 312, 1, 0, 0, 0, 312, 313, 1, 0, 0, 0, 313, 315, 
		    5, 50, 0, 0, 314, 316, 3, 30, 15, 0, 315, 314, 1, 0, 0, 0, 315, 316, 
		    1, 0, 0, 0, 316, 317, 1, 0, 0, 0, 317, 319, 5, 50, 0, 0, 318, 320, 
		    3, 58, 29, 0, 319, 318, 1, 0, 0, 0, 319, 320, 1, 0, 0, 0, 320, 55, 
		    1, 0, 0, 0, 321, 325, 3, 20, 10, 0, 322, 325, 3, 26, 13, 0, 323, 325, 
		    3, 30, 15, 0, 324, 321, 1, 0, 0, 0, 324, 322, 1, 0, 0, 0, 324, 323, 
		    1, 0, 0, 0, 325, 57, 1, 0, 0, 0, 326, 331, 3, 26, 13, 0, 327, 331, 
		    3, 30, 15, 0, 328, 331, 5, 39, 0, 0, 329, 331, 5, 40, 0, 0, 330, 326, 
		    1, 0, 0, 0, 330, 327, 1, 0, 0, 0, 330, 328, 1, 0, 0, 0, 330, 329, 
		    1, 0, 0, 0, 331, 59, 1, 0, 0, 0, 332, 334, 5, 8, 0, 0, 333, 335, 3, 
		    30, 15, 0, 334, 333, 1, 0, 0, 0, 334, 335, 1, 0, 0, 0, 335, 61, 1, 
		    0, 0, 0, 336, 337, 5, 9, 0, 0, 337, 63, 1, 0, 0, 0, 338, 339, 5, 10, 
		    0, 0, 339, 65, 1, 0, 0, 0, 40, 69, 78, 84, 87, 95, 102, 113, 126, 
		    132, 139, 143, 147, 151, 155, 161, 165, 169, 172, 179, 196, 204, 213, 
		    224, 232, 240, 248, 252, 271, 274, 279, 288, 297, 299, 308, 311, 315, 
		    319, 324, 330, 334];
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
		        $this->setState(69);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::FUNC) {
		        	$this->setState(66);
		        	$this->funcion();
		        	$this->setState(71);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(72);
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
		        $this->setState(95);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 4, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(74);
		        	    $this->match(self::FUNC);
		        	    $this->setState(75);
		        	    $this->match(self::IDENTIFICADOR);
		        	    $this->setState(76);
		        	    $this->match(self::PAREN_IZQ);
		        	    $this->setState(78);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::IDENTIFICADOR) {
		        	    	$this->setState(77);
		        	    	$this->parametros();
		        	    }
		        	    $this->setState(80);
		        	    $this->match(self::PAREN_DER);
		        	    $this->setState(87);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->input->LA(1)) {
		        	        case self::INT32:
		        	        case self::FLOAT32:
		        	        case self::STRING:
		        	        case self::BOOL:
		        	        case self::RUNE:
		        	        case self::CORCHETE_IZQ:
		        	        	$this->setState(81);
		        	        	$this->tipo();
		        	        	break;

		        	        case self::PAREN_IZQ:
		        	        	$this->setState(82);
		        	        	$this->match(self::PAREN_IZQ);
		        	        	$this->setState(84);
		        	        	$this->errorHandler->sync($this);
		        	        	$_la = $this->input->LA(1);

		        	        	if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 35184388341760) !== 0)) {
		        	        		$this->setState(83);
		        	        		$this->tipos();
		        	        	}
		        	        	$this->setState(86);
		        	        	$this->match(self::PAREN_DER);
		        	        	break;

		        	        case self::LLAVE_IZQ:
		        	        	break;

		        	    default:
		        	    	break;
		        	    }
		        	    $this->setState(89);
		        	    $this->bloque();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(90);
		        	    $this->match(self::FUNC);
		        	    $this->setState(91);
		        	    $this->match(self::MAIN);
		        	    $this->setState(92);
		        	    $this->match(self::PAREN_IZQ);
		        	    $this->setState(93);
		        	    $this->match(self::PAREN_DER);
		        	    $this->setState(94);
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
		        $this->setState(97);
		        $this->parametro();
		        $this->setState(102);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(98);
		        	$this->match(self::COMA);
		        	$this->setState(99);
		        	$this->parametro();
		        	$this->setState(104);
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
		        $this->setState(105);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(106);
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
		        $this->setState(108);
		        $this->tipo();
		        $this->setState(113);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(109);
		        	$this->match(self::COMA);
		        	$this->setState(110);
		        	$this->tipo();
		        	$this->setState(115);
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
		        $this->setState(126);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::INT32:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(116);
		            	$this->match(self::INT32);
		            	break;

		            case self::FLOAT32:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(117);
		            	$this->match(self::FLOAT32);
		            	break;

		            case self::STRING:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(118);
		            	$this->match(self::STRING);
		            	break;

		            case self::BOOL:
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(119);
		            	$this->match(self::BOOL);
		            	break;

		            case self::RUNE:
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(120);
		            	$this->match(self::RUNE);
		            	break;

		            case self::CORCHETE_IZQ:
		            	$this->enterOuterAlt($localContext, 6);
		            	$this->setState(121);
		            	$this->match(self::CORCHETE_IZQ);
		            	$this->setState(122);
		            	$this->expresion();
		            	$this->setState(123);
		            	$this->match(self::CORCHETE_DER);
		            	$this->setState(124);
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
		        $this->setState(128);
		        $this->match(self::LLAVE_IZQ);
		        $this->setState(132);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 72066390130968486) !== 0)) {
		        	$this->setState(129);
		        	$this->sentencia();
		        	$this->setState(134);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(135);
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
		        $this->setState(172);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 17, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(137);
		        	    $this->declaracionVar();
		        	    $this->setState(139);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(138);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(141);
		        	    $this->declaracionConstante();
		        	    $this->setState(143);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(142);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(145);
		        	    $this->declaracionCorta();
		        	    $this->setState(147);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(146);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(149);
		        	    $this->asignacion();
		        	    $this->setState(151);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(150);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(153);
		        	    $this->llamadaFuncion();
		        	    $this->setState(155);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(154);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(157);
		        	    $this->ifStmt();
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(158);
		        	    $this->forStmt();
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(159);
		        	    $this->returnStmt();
		        	    $this->setState(161);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(160);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(163);
		        	    $this->breakStmt();
		        	    $this->setState(165);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(164);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(167);
		        	    $this->continueStmt();
		        	    $this->setState(169);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::PUNTO_COMA) {
		        	    	$this->setState(168);
		        	    	$this->match(self::PUNTO_COMA);
		        	    }
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(171);
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
		        $this->setState(174);
		        $this->match(self::VAR);
		        $this->setState(175);
		        $this->listaIdentificadores();
		        $this->setState(176);
		        $this->tipo();
		        $this->setState(179);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ASIGNACION) {
		        	$this->setState(177);
		        	$this->match(self::ASIGNACION);
		        	$this->setState(178);
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
		        $this->setState(181);
		        $this->match(self::CONST);
		        $this->setState(182);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(183);
		        $this->tipo();
		        $this->setState(184);
		        $this->match(self::ASIGNACION);
		        $this->setState(185);
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
		        $this->setState(187);
		        $this->listaIdentificadores();
		        $this->setState(188);
		        $this->match(self::DECLARACION_CORTA);
		        $this->setState(189);
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
		        $this->setState(191);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(196);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(192);
		        	$this->match(self::COMA);
		        	$this->setState(193);
		        	$this->match(self::IDENTIFICADOR);
		        	$this->setState(198);
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
		        $this->setState(199);
		        $this->expresion();
		        $this->setState(204);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(200);
		        	$this->match(self::COMA);
		        	$this->setState(201);
		        	$this->expresion();
		        	$this->setState(206);
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
		        $this->setState(207);
		        $this->match(self::IDENTIFICADOR);
		        $this->setState(213);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::ASIGNACION:
		            case self::MAS_ASIGNACION:
		            case self::MENOS_ASIGNACION:
		            	$this->setState(208);
		            	$this->operadorAsignacion();
		            	$this->setState(209);
		            	$this->expresion();
		            	break;

		            case self::INCREMENTO:
		            	$this->setState(211);
		            	$this->match(self::INCREMENTO);
		            	break;

		            case self::DECREMENTO:
		            	$this->setState(212);
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
		        $this->setState(215);

		        $_la = $this->input->LA(1);

		        if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 3458764513837318144) !== 0))) {
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
		        $this->setState(217);
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
		        $this->setState(219);
		        $this->expresionComparacion();
		        $this->setState(224);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::AND || $_la === self::OR) {
		        	$this->setState(220);

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
		        	$this->setState(221);
		        	$this->expresionComparacion();
		        	$this->setState(226);
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
		        $this->setState(227);
		        $this->expresionAditiva();
		        $this->setState(232);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 67645734912) !== 0)) {
		        	$this->setState(228);

		        	$_la = $this->input->LA(1);

		        	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 67645734912) !== 0))) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(229);
		        	$this->expresionAditiva();
		        	$this->setState(234);
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
		        $this->setState(235);
		        $this->expresionMultiplicativa();
		        $this->setState(240);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::MAS || $_la === self::MENOS) {
		        	$this->setState(236);

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
		        	$this->setState(237);
		        	$this->expresionMultiplicativa();
		        	$this->setState(242);
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
		        $this->setState(243);
		        $this->expresionUnaria();
		        $this->setState(248);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 939524096) !== 0)) {
		        	$this->setState(244);

		        	$_la = $this->input->LA(1);

		        	if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 939524096) !== 0))) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(245);
		        	$this->expresionUnaria();
		        	$this->setState(250);
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
		        $this->setState(252);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::MENOS || $_la === self::NOT) {
		        	$this->setState(251);

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
		        $this->setState(254);
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
		        $this->setState(274);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 28, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(256);
		        	    $this->match(self::NUMERO_ENTERO);
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(257);
		        	    $this->match(self::NUMERO_DECIMAL);
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(258);
		        	    $this->match(self::CADENA);
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(259);
		        	    $this->match(self::CARACTER);
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(260);
		        	    $this->match(self::TRUE);
		        	break;

		        	case 6:
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(261);
		        	    $this->match(self::FALSE);
		        	break;

		        	case 7:
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(262);
		        	    $this->match(self::NIL);
		        	break;

		        	case 8:
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(263);
		        	    $this->match(self::IDENTIFICADOR);
		        	break;

		        	case 9:
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(264);
		        	    $this->llamadaFuncion();
		        	break;

		        	case 10:
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(265);
		        	    $this->match(self::PAREN_IZQ);
		        	    $this->setState(266);
		        	    $this->expresion();
		        	    $this->setState(267);
		        	    $this->match(self::PAREN_DER);
		        	break;

		        	case 11:
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(269);
		        	    $this->match(self::CORCHETE_IZQ);
		        	    $this->setState(271);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 139649246788876288) !== 0)) {
		        	    	$this->setState(270);
		        	    	$this->listaExpresiones();
		        	    }
		        	    $this->setState(273);
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
		        $this->setState(276);

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
		        $this->setState(277);
		        $this->match(self::PAREN_IZQ);
		        $this->setState(279);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 139649246788876288) !== 0)) {
		        	$this->setState(278);
		        	$this->argumentos();
		        }
		        $this->setState(281);
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
		        $this->setState(283);
		        $this->expresion();
		        $this->setState(288);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::COMA) {
		        	$this->setState(284);
		        	$this->match(self::COMA);
		        	$this->setState(285);
		        	$this->expresion();
		        	$this->setState(290);
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
		        $this->setState(291);
		        $this->match(self::IF);
		        $this->setState(292);
		        $this->expresion();
		        $this->setState(293);
		        $this->bloque();
		        $this->setState(299);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ELSE) {
		        	$this->setState(294);
		        	$this->match(self::ELSE);
		        	$this->setState(297);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::IF:
		        	    	$this->setState(295);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::LLAVE_IZQ:
		        	    	$this->setState(296);
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
		        $this->setState(301);
		        $this->match(self::FOR);
		        $this->setState(302);
		        $this->forHeader();
		        $this->setState(303);
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
		        $this->setState(308);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 33, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(305);
		        	    $this->forClause();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(306);
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
		        $this->setState(311);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 139649246788876288) !== 0)) {
		        	$this->setState(310);
		        	$this->initStmt();
		        }
		        $this->setState(313);
		        $this->match(self::PUNTO_COMA);
		        $this->setState(315);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 139649246788876288) !== 0)) {
		        	$this->setState(314);
		        	$this->expresion();
		        }
		        $this->setState(317);
		        $this->match(self::PUNTO_COMA);
		        $this->setState(319);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 139650896056317952) !== 0)) {
		        	$this->setState(318);
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
		        $this->setState(324);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 37, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(321);
		        	    $this->declaracionCorta();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(322);
		        	    $this->asignacion();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(323);
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
		        $this->setState(330);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 38, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(326);
		        	    $this->asignacion();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(327);
		        	    $this->expresion();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(328);
		        	    $this->match(self::INCREMENTO);
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(329);
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
		public function returnStmt(): Context\ReturnStmtContext
		{
		    $localContext = new Context\ReturnStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 60, self::RULE_returnStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(332);
		        $this->match(self::RETURN);
		        $this->setState(334);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 39, $this->ctx)) {
		            case 1:
		        	    $this->setState(333);
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

		    $this->enterRule($localContext, 62, self::RULE_breakStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(336);
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

		    $this->enterRule($localContext, 64, self::RULE_continueStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(338);
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