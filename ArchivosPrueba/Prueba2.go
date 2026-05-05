// ============================================
// PRUEBA 2: OPERADORES
// ============================================
func main() {
    fmt.Println("=== PRUEBA 2: OPERADORES ===")
    
    a := 15
    b := 4
    
    // 2.1 Aritméticos
    fmt.Println("\n--- Aritméticos ---")
    fmt.Println("15 + 4 =", a + b)
    fmt.Println("15 - 4 =", a - b)
    fmt.Println("15 * 4 =", a * b)
    fmt.Println("15 / 4 =", a / b)
    fmt.Println("15 % 4 =", a % b)
    
    // 2.2 Relacionales
    fmt.Println("\n--- Relacionales ---")
    fmt.Println("15 > 4  =", a > b)
    fmt.Println("15 < 4  =", a < b)
    fmt.Println("15 >= 15 =", a >= 15)
    fmt.Println("15 <= 4 =", a <= b)
    fmt.Println("15 == 4 =", a == b)
    fmt.Println("15 != 4 =", a != b)
    
    // 2.3 Lógicos
    fmt.Println("\n--- Lógicos ---")
    t := true
    f := false
    fmt.Println("true && false =", t && f)
    fmt.Println("true || false =", t || f)
    fmt.Println("!true =", !t)
    
    // 2.4 Corto circuito
    fmt.Println("\n--- Corto circuito ---")
    x := 0
    resultado := false && (100 / x == 1)  // No debe dividir por cero
    fmt.Println("false && (div/0) =", resultado)
}