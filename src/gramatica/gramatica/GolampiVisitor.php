<?php

/*
 * Generated from gramatica/Golampi.g4 by ANTLR 4.13.2
 */

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

/**
 * This interface defines a complete generic visitor for a parse tree produced by {@see GolampiParser}.
 */
interface GolampiVisitor extends ParseTreeVisitor
{
	/**
	 * Visit a parse tree produced by {@see GolampiParser::programa()}.
	 *
	 * @param Context\ProgramaContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitPrograma(Context\ProgramaContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::funcion()}.
	 *
	 * @param Context\FuncionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFuncion(Context\FuncionContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::parametros()}.
	 *
	 * @param Context\ParametrosContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParametros(Context\ParametrosContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::parametro()}.
	 *
	 * @param Context\ParametroContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParametro(Context\ParametroContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::tipos()}.
	 *
	 * @param Context\TiposContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitTipos(Context\TiposContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::tipo()}.
	 *
	 * @param Context\TipoContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitTipo(Context\TipoContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::bloque()}.
	 *
	 * @param Context\BloqueContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBloque(Context\BloqueContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::sentencia()}.
	 *
	 * @param Context\SentenciaContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSentencia(Context\SentenciaContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::declaracionVar()}.
	 *
	 * @param Context\DeclaracionVarContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclaracionVar(Context\DeclaracionVarContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::declaracionConstante()}.
	 *
	 * @param Context\DeclaracionConstanteContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclaracionConstante(Context\DeclaracionConstanteContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::declaracionCorta()}.
	 *
	 * @param Context\DeclaracionCortaContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclaracionCorta(Context\DeclaracionCortaContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::listaIdentificadores()}.
	 *
	 * @param Context\ListaIdentificadoresContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitListaIdentificadores(Context\ListaIdentificadoresContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::listaExpresiones()}.
	 *
	 * @param Context\ListaExpresionesContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitListaExpresiones(Context\ListaExpresionesContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::asignacion()}.
	 *
	 * @param Context\AsignacionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAsignacion(Context\AsignacionContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::operadorAsignacion()}.
	 *
	 * @param Context\OperadorAsignacionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOperadorAsignacion(Context\OperadorAsignacionContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::expresion()}.
	 *
	 * @param Context\ExpresionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpresion(Context\ExpresionContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::expresionLogica()}.
	 *
	 * @param Context\ExpresionLogicaContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpresionLogica(Context\ExpresionLogicaContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::expresionComparacion()}.
	 *
	 * @param Context\ExpresionComparacionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpresionComparacion(Context\ExpresionComparacionContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::expresionAditiva()}.
	 *
	 * @param Context\ExpresionAditivaContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpresionAditiva(Context\ExpresionAditivaContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::expresionMultiplicativa()}.
	 *
	 * @param Context\ExpresionMultiplicativaContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpresionMultiplicativa(Context\ExpresionMultiplicativaContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::expresionUnaria()}.
	 *
	 * @param Context\ExpresionUnariaContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpresionUnaria(Context\ExpresionUnariaContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::expresionPrimaria()}.
	 *
	 * @param Context\ExpresionPrimariaContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpresionPrimaria(Context\ExpresionPrimariaContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::llamadaFuncion()}.
	 *
	 * @param Context\LlamadaFuncionContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitLlamadaFuncion(Context\LlamadaFuncionContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::argumentos()}.
	 *
	 * @param Context\ArgumentosContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArgumentos(Context\ArgumentosContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::ifStmt()}.
	 *
	 * @param Context\IfStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIfStmt(Context\IfStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::forStmt()}.
	 *
	 * @param Context\ForStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitForStmt(Context\ForStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::returnStmt()}.
	 *
	 * @param Context\ReturnStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnStmt(Context\ReturnStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::breakStmt()}.
	 *
	 * @param Context\BreakStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBreakStmt(Context\BreakStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see GolampiParser::continueStmt()}.
	 *
	 * @param Context\ContinueStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitContinueStmt(Context\ContinueStmtContext $context);
}