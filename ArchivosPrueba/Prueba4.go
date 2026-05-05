// ============================================
// PRUEBA 4: CONTROL DE FLUJO
// ============================================
func main() {
    fmt.Println("=== PRUEBA 4: CONTROL DE FLUJO ===")
    
    // 4.1 if/else
    fmt.Println("\n--- if/else ---")
    nota := 85
    
    if nota >= 90 {
        fmt.Println("Excelente")
    } else if nota >= 80 {
        fmt.Println("Muy bien")
    } else {
        fmt.Println("Regular")
    }
    
    // 4.2 switch
    fmt.Println("\n--- switch ---")
    dia := 3
    
    switch dia {
    case 1:
        fmt.Println("Lunes")
    case 2, 3:
        fmt.Println("Martes o Miércoles")
    default:
        fmt.Println("Otro día")
    }
    
    // 4.3 for clásico
    fmt.Println("\n--- for clásico ---")
    for i := 1; i <= 5; i++ {
        fmt.Println("i =", i)
    }
    
    // 4.4 for como while
    fmt.Println("\n--- for como while ---")
    j := 10
    for j > 5 {
        fmt.Println("j =", j)
        j--
    }
    
    // 4.5 for infinito + break
    fmt.Println("\n--- for infinito + break ---")
    k := 0
    for {
        k++
        fmt.Println("Iteración", k)
        if k >= 3 {
            fmt.Println("break!")
            break
        }
    }
    
    // 4.6 continue
    fmt.Println("\n--- continue (solo impares) ---")
    for i := 1; i <= 6; i++ {
        if i%2 == 0 {
            continue
        }
        fmt.Println("Impar:", i)
    }
}