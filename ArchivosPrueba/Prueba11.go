// ============================================
// PRUEBA 11: HOISTING
// ============================================

// La función main llama a funciones definidas después
func main() {
    fmt.Println("=== PRUEBA 11: HOISTING ===")
    
    resultado1 := funcionA(5)
    fmt.Println("funcionA(5) =", resultado1)
    
    resultado2 := funcionB(3, 7)
    fmt.Println("funcionB(3,7) =", resultado2)
    
    funcionC()
}

// Estas funciones están definidas DESPUÉS de main
func funcionA(x int32) int32 {
    return x * 2
}

func funcionB(a int32, b int32) int32 {
    return a + b
}

func funcionC() {
    fmt.Println("¡Función C ejecutada correctamente!")
}