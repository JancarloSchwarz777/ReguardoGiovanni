// ============================================
// PRUEBA 1: VARIABLES Y TIPOS BÁSICOS
// ============================================
func main() {
    fmt.Println("=== PRUEBA 1: VARIABLES Y TIPOS BÁSICOS ===")
    
    // 1.1 Declaración larga
    var a int32 = 10
    var b float32 = 3.14
    var c bool = true
    var d string = "Hola"
    var e rune = 'X'
    
    fmt.Println("Larga - int32:", a, "float32:", b, "bool:", c, "string:", d, "rune:", e)
    
    // 1.2 Declaración corta
    f := 20
    g := 6.28
    h := false
    i := "Mundo"
    j := 'Y'
    
    fmt.Println("Corta - int32:", f, "float32:", g, "bool:", h, "string:", i, "rune:", j)
    
    // 1.3 Múltiples variables
    var x, y int32 = 5, 15
    m, n := 30, 40
    
    fmt.Println("Múltiple - x:", x, "y:", y, "m:", m, "n:", n)
    
    // 1.4 Constantes
    const PI float32 = 3.1416
    const MENSAJE string = "Constante"
    fmt.Println("Constantes - PI:", PI, "MENSAJE:", MENSAJE)
}