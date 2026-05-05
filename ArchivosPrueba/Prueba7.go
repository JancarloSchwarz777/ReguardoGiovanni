// ============================================
// PRUEBA 8: PUNTEROS
// ============================================

func duplicar(valor *int32) {
    *valor = *valor * 2
}

func intercambiar(ptrA *int32, ptrB *int32) {
    temp := *ptrA
    *ptrA = *ptrB
    *ptrB = temp
}

func incrementar(ptrValor *int32) { // Cambiar para que no choque con otras variables
    *ptrValor += 5
}

func main() {
    fmt.Println("=== PRUEBA 8: PUNTEROS ===")
    
    // 8.1 Declaración de punteros
    var p *int32
    fmt.Println("Puntero nil:", p == nil)
    
    // 8.2 Operador &
    x := 10
    p = &x
    fmt.Println("x =", x, "p =", p, "*p =", *p)
    
    // 8.3 Modificar a través de puntero
    *p = 20
    fmt.Println("Después de *p = 20, x =", x)
    
    // 8.4 Paso por referencia a función
    duplicar(&x)
    fmt.Println("Después de duplicar, x =", x)  // 40
    
    // 8.5 Operador += con punteros
    *p += 5
    fmt.Println("Después de *p += 5, x =", x)  // 45
    
    // 8.6 Intercambio con punteros
    a := 100
    b := 200
    fmt.Println("Antes intercambio - a:", a, "b:", b)
    intercambiar(&a, &b)
    fmt.Println("Después intercambio - a:", a, "b:", b)
    
    // 8.7 Incremento con punteros
    incrementar(&a)
    fmt.Println("Después de incrementar a:", a)
}