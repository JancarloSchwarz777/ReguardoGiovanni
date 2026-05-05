// ============================================
// PRUEBA 10: OPERACIONES CON RUNE
// ============================================
func main() {
    fmt.Println("=== PRUEBA 10: RUNE ===")
    
    // 10.1 Declaración
    var letra1 rune = 'A'
    letra2 := 'Z'
    
    fmt.Println("letra1:", letra1)
    fmt.Println("letra2:", letra2)
    
    // 10.2 Operaciones aritméticas con rune
    siguiente := letra1 + 1
    anterior := letra2 - 1
    
    fmt.Println("Siguiente de A:", siguiente)  // 'B'
    fmt.Println("Anterior de Z:", anterior)    // 'Y'
    
    // 10.3 Comparaciones
    fmt.Println("A < B:", letra1 < 'B')
    fmt.Println("A == 65:", letra1 == 65)
    
    // 10.4 rune + string
    saludo := "Hola "
    fmt.Println(saludo + letra1)  // "Hola A"
    
    // 10.5 Recorrer string como runes
    palabra := "Go"
    fmt.Println("Primer carácter:", substr(palabra, 0, 1))
}