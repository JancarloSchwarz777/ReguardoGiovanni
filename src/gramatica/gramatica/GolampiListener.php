<?php

/*
 * Generated from gramatica/Golampi.g4 by ANTLR 4.13.2
 */

use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;

/**
 * This interface defines a complete listener for a parse tree produced by
 * {@see GolampiParser}.
 */
interface GolampiListener extends ParseTreeListener {
	/**
	 * Enter a parse tree produced by {@see GolampiParser::programa()}.
	 * @param $context The parse tree.
	 */
	public function enterPrograma(Context\ProgramaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::programa()}.
	 * @param $context The parse tree.
	 */
	public function exitPrograma(Context\ProgramaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::funcion()}.
	 * @param $context The parse tree.
	 */
	public function enterFuncion(Context\FuncionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::funcion()}.
	 * @param $context The parse tree.
	 */
	public function exitFuncion(Context\FuncionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::parametros()}.
	 * @param $context The parse tree.
	 */
	public function enterParametros(Context\ParametrosContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::parametros()}.
	 * @param $context The parse tree.
	 */
	public function exitParametros(Context\ParametrosContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::parametro()}.
	 * @param $context The parse tree.
	 */
	public function enterParametro(Context\ParametroContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::parametro()}.
	 * @param $context The parse tree.
	 */
	public function exitParametro(Context\ParametroContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::tipos()}.
	 * @param $context The parse tree.
	 */
	public function enterTipos(Context\TiposContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::tipos()}.
	 * @param $context The parse tree.
	 */
	public function exitTipos(Context\TiposContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::tipo()}.
	 * @param $context The parse tree.
	 */
	public function enterTipo(Context\TipoContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::tipo()}.
	 * @param $context The parse tree.
	 */
	public function exitTipo(Context\TipoContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::bloque()}.
	 * @param $context The parse tree.
	 */
	public function enterBloque(Context\BloqueContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::bloque()}.
	 * @param $context The parse tree.
	 */
	public function exitBloque(Context\BloqueContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::sentencia()}.
	 * @param $context The parse tree.
	 */
	public function enterSentencia(Context\SentenciaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::sentencia()}.
	 * @param $context The parse tree.
	 */
	public function exitSentencia(Context\SentenciaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::declaracionVar()}.
	 * @param $context The parse tree.
	 */
	public function enterDeclaracionVar(Context\DeclaracionVarContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::declaracionVar()}.
	 * @param $context The parse tree.
	 */
	public function exitDeclaracionVar(Context\DeclaracionVarContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::declaracionConstante()}.
	 * @param $context The parse tree.
	 */
	public function enterDeclaracionConstante(Context\DeclaracionConstanteContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::declaracionConstante()}.
	 * @param $context The parse tree.
	 */
	public function exitDeclaracionConstante(Context\DeclaracionConstanteContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::declaracionCorta()}.
	 * @param $context The parse tree.
	 */
	public function enterDeclaracionCorta(Context\DeclaracionCortaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::declaracionCorta()}.
	 * @param $context The parse tree.
	 */
	public function exitDeclaracionCorta(Context\DeclaracionCortaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::listaIdentificadores()}.
	 * @param $context The parse tree.
	 */
	public function enterListaIdentificadores(Context\ListaIdentificadoresContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::listaIdentificadores()}.
	 * @param $context The parse tree.
	 */
	public function exitListaIdentificadores(Context\ListaIdentificadoresContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::listaExpresiones()}.
	 * @param $context The parse tree.
	 */
	public function enterListaExpresiones(Context\ListaExpresionesContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::listaExpresiones()}.
	 * @param $context The parse tree.
	 */
	public function exitListaExpresiones(Context\ListaExpresionesContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::asignacion()}.
	 * @param $context The parse tree.
	 */
	public function enterAsignacion(Context\AsignacionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::asignacion()}.
	 * @param $context The parse tree.
	 */
	public function exitAsignacion(Context\AsignacionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::operadorAsignacion()}.
	 * @param $context The parse tree.
	 */
	public function enterOperadorAsignacion(Context\OperadorAsignacionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::operadorAsignacion()}.
	 * @param $context The parse tree.
	 */
	public function exitOperadorAsignacion(Context\OperadorAsignacionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::expresion()}.
	 * @param $context The parse tree.
	 */
	public function enterExpresion(Context\ExpresionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::expresion()}.
	 * @param $context The parse tree.
	 */
	public function exitExpresion(Context\ExpresionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::expresionLogica()}.
	 * @param $context The parse tree.
	 */
	public function enterExpresionLogica(Context\ExpresionLogicaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::expresionLogica()}.
	 * @param $context The parse tree.
	 */
	public function exitExpresionLogica(Context\ExpresionLogicaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::expresionComparacion()}.
	 * @param $context The parse tree.
	 */
	public function enterExpresionComparacion(Context\ExpresionComparacionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::expresionComparacion()}.
	 * @param $context The parse tree.
	 */
	public function exitExpresionComparacion(Context\ExpresionComparacionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::expresionAditiva()}.
	 * @param $context The parse tree.
	 */
	public function enterExpresionAditiva(Context\ExpresionAditivaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::expresionAditiva()}.
	 * @param $context The parse tree.
	 */
	public function exitExpresionAditiva(Context\ExpresionAditivaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::expresionMultiplicativa()}.
	 * @param $context The parse tree.
	 */
	public function enterExpresionMultiplicativa(Context\ExpresionMultiplicativaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::expresionMultiplicativa()}.
	 * @param $context The parse tree.
	 */
	public function exitExpresionMultiplicativa(Context\ExpresionMultiplicativaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::expresionUnaria()}.
	 * @param $context The parse tree.
	 */
	public function enterExpresionUnaria(Context\ExpresionUnariaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::expresionUnaria()}.
	 * @param $context The parse tree.
	 */
	public function exitExpresionUnaria(Context\ExpresionUnariaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::expresionPrimaria()}.
	 * @param $context The parse tree.
	 */
	public function enterExpresionPrimaria(Context\ExpresionPrimariaContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::expresionPrimaria()}.
	 * @param $context The parse tree.
	 */
	public function exitExpresionPrimaria(Context\ExpresionPrimariaContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::llamadaFuncion()}.
	 * @param $context The parse tree.
	 */
	public function enterLlamadaFuncion(Context\LlamadaFuncionContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::llamadaFuncion()}.
	 * @param $context The parse tree.
	 */
	public function exitLlamadaFuncion(Context\LlamadaFuncionContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::argumentos()}.
	 * @param $context The parse tree.
	 */
	public function enterArgumentos(Context\ArgumentosContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::argumentos()}.
	 * @param $context The parse tree.
	 */
	public function exitArgumentos(Context\ArgumentosContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::ifStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterIfStmt(Context\IfStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::ifStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitIfStmt(Context\IfStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::forStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterForStmt(Context\ForStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::forStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitForStmt(Context\ForStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::returnStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterReturnStmt(Context\ReturnStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::returnStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitReturnStmt(Context\ReturnStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::breakStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterBreakStmt(Context\BreakStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::breakStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitBreakStmt(Context\BreakStmtContext $context): void;
	/**
	 * Enter a parse tree produced by {@see GolampiParser::continueStmt()}.
	 * @param $context The parse tree.
	 */
	public function enterContinueStmt(Context\ContinueStmtContext $context): void;
	/**
	 * Exit a parse tree produced by {@see GolampiParser::continueStmt()}.
	 * @param $context The parse tree.
	 */
	public function exitContinueStmt(Context\ContinueStmtContext $context): void;
}