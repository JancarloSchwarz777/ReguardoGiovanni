<?php
trait FuncUsuarioTrait

{

/**
     * Ejecuta una función definida por el usuario
     */
    private function ejecutarFuncionUsuario($nombre, $argumentos, $linea, $columna)
    {
        // Verificar que la función existe
        if (!isset($this->tablaSimbolos[$nombre])) {
            $this->agregarErrorSemantico(
                "La función '$nombre' no está definida",
                $linea,
                $columna
            );
            return null;
        }
        
        // Por ahora, solo mostramos un mensaje de que está pendiente
        $this->agregarErrorSemantico(
            "Las funciones de usuario aún no están implementadas",
            $linea,
            $columna
        );
        
        return null;
    }

}