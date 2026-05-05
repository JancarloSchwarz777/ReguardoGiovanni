// ============================================
// PRUEBA 12: ERRORES (DEBE GENERAR ERRORES)
// ============================================
func main() {
    fmt.Println("=== PRUEBA 12: ERRORES ===")
    
    // 12.1 Error léxico - carácter no válido
    // var x int32 = 10 @ 20   // Descomentar para probar
    
    // 12.2 Error sintáctico - falta paréntesis
    // if x > 5 {               // Descomentar para probar
    //     fmt.Println("Hola"
    // }
    
    // 12.3 Error semántico - variable no declarada
    // y = x + 10               // Descomentar para probar
    // fmt.Println(y)
    
    // 12.4 Error semántico - tipo incompatible
    var entero int32 = 10
    // entero = "texto"         // Descomentar para probar
    
    // 12.5 Error semántico - constante modificada
    const CONSTANTE int32 = 100
    // CONSTANTE = 200          // Descomentar para probar
    
    fmt.Println("Programa sin errores (comentados)")
}