// ============================================
// PRUEBA 13: PRUEBA INTEGRAL
// ============================================

func factorial(n int32) int32 {
    if n <= 1 {
        return 1
    }
    return n * factorial(n - 1)
}

func operaciones(a int32, b int32) (int32, int32) {
    return a + b, a - b
}

func duplicarPuntero(p *int32) {
    *p = *p * 2
}

func main() {
    fmt.Println("=== PRUEBA INTEGRAL: TODO JUNTO ===")
    
    // Variables
    x := 10
    y := 20
    fmt.Println("x =", x, "y =", y)
    
    // Operadores
    x += 5
    y = y * 2  // Cambiado de y *= 2
    fmt.Println("Después de operadores - x:", x, "y:", y)
    
    // If
    if x > y {
        fmt.Println("x es mayor")
    } else {
        fmt.Println("y es mayor o igual")
    }
    
    // For
    fmt.Println("Números del 1 al 3:")
    for i := 1; i <= 3; i++ {
        fmt.Println(i)
    }
    
    // Funciones
    fact := factorial(4)
    fmt.Println("Factorial de 4 =", fact)
    
    // Múltiples retornos
    suma, resta := operaciones(50, 30)
    fmt.Println("50+30 =", suma, "50-30 =", resta)
    
    // Punteros
    valor := 7
    fmt.Println("Valor antes de duplicar:", valor)
    duplicarPuntero(&valor)
    fmt.Println("Valor después de duplicar:", valor)
    
    // Rune
    letra := 'A'
    siguiente := letra + 1
    fmt.Println("Siguiente de A:", siguiente)
    
    // Funciones embebidas
    fmt.Println("typeOf(valor):", typeOf(valor))
    fmt.Println("len('Golampi'):", len("Golampi"))
    
    fmt.Println("=== FIN DE PRUEBA INTEGRAL ===")
}