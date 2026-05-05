// ============================================
// PRUEBA 5: FUNCIONES BÁSICAS
// ============================================

func saludar() {
    fmt.Println("¡Hola desde función sin parámetros!")
}

func suma(a int32, b int32) int32 {
    return a + b
}

func multiplicar(a int32, b int32) int32 {
    return a * b
}

func main() {
    fmt.Println("=== PRUEBA 5: FUNCIONES BÁSICAS ===")
    
    // 5.1 Función sin parámetros
    saludar()
    
    // 5.2 Funciones con parámetros
    resultado1 := suma(15, 25)
    fmt.Println("15 + 25 =", resultado1)
    
    resultado2 := multiplicar(6, 7)
    fmt.Println("6 * 7 =", resultado2)
    
    // 5.3 Funciones anidadas
    resultado3 := suma(multiplicar(2, 3), suma(5, 5))
    fmt.Println("(2*3) + (5+5) =", resultado3)
}