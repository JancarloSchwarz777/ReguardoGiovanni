// ============================================
// PRUEBA 6: MÚLTIPLES RETORNOS
// ============================================

func dividir(a int32, b int32) (int32, bool) {
    if b == 0 {
        return 0, false
    }
    return a / b, true
}

func operaciones(a int32, b int32) (int32, int32, int32) {
    suma := a + b
    resta := a - b
    producto := a * b
    return suma, resta, producto
}

func main() {
    fmt.Println("=== PRUEBA 6: MÚLTIPLES RETORNOS ===")
    
    // 6.1 Dos retornos
    cociente, ok := dividir(10, 2)
    if ok {
        fmt.Println("10 / 2 =", cociente)
    }
    
    cociente2, ok2 := dividir(10, 0)
    if !ok2 {
        fmt.Println("División por cero detectada")
    }
    
    // 6.2 Tres retornos
    s, r, p := operaciones(20, 5)
    fmt.Println("20+5=", s, "20-5=", r, "20*5=", p)
}