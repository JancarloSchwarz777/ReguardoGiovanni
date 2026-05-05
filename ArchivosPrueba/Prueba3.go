// ============================================
// PRUEBA 3: OPERADORES DE ASIGNACIÓN
// ============================================
func main() {
    fmt.Println("=== PRUEBA 3: OPERADORES DE ASIGNACIÓN ===")
    
    x := 10
    fmt.Println("x inicial =", x)
    
    x += 5
    fmt.Println("x += 5 =", x)  // 15
    
    x -= 3
    fmt.Println("x -= 3 =", x)  // 12
    
    x *= 2
    fmt.Println("x *= 2 =", x)  // 24
    
    x /= 4
    fmt.Println("x /= 4 =", x)  // 6
    
    x++
    fmt.Println("x++ =", x)  // 7
    
    x--
    fmt.Println("x-- =", x)  // 6
    
    // Con float32
    y := 20.5
    y += 3.2
    fmt.Println("y += 3.2 =", y)  // 23.7
}