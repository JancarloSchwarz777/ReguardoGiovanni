// ============================================
// PRUEBA 9: FUNCIONES EMBEBIDAS
// ============================================
func main() {
    fmt.Println("=== PRUEBA 9: FUNCIONES EMBEBIDAS ===")
    
    // 9.1 fmt.Println (ya la hemos usado)
    fmt.Println("Esto es", "una prueba", "con", 123, true)
    
    // 9.2 len() con strings
    texto := "Compiladores"
    longitud := len(texto)
    fmt.Println("Longitud de '", texto, "':", longitud)
    
    // 9.3 now()
    fecha := now()
    fmt.Println("Fecha actual:", fecha)
    
    // 9.4 substr()
    base := "Universidad San Carlos"
    sub1 := substr(base, 0, 11)
    sub2 := substr(base, 12, 10)
    fmt.Println("Subcadena 1:", sub1)
    fmt.Println("Subcadena 2:", sub2)
    
    // 9.5 typeOf()
    varEntero := 42
    varFlotante := 3.14
    varBooleano := true
    varCaracter := 'A'
    varTexto := "Golampi"
    
    fmt.Println("typeOf(42):", typeOf(varEntero))
    fmt.Println("typeOf(3.14):", typeOf(varFlotante))
    fmt.Println("typeOf(true):", typeOf(varBooleano))
    fmt.Println("typeOf('A'):", typeOf(varCaracter))
    fmt.Println("typeOf('Golampi'):", typeOf(varTexto))
}