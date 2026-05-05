// ============================================
// PRUEBA 7: RECURSIÓN
// ============================================

func factorial(n int32) int32 {
    if n <= 1 {
        return 1
    }
    return n * factorial(n - 1)
}

func fibonacci(n int32) int32 {
    if n <= 1 {
        return n
    }
    return fibonacci(n - 1) + fibonacci(n - 2)
}

func main() {
    fmt.Println("=== PRUEBA 7: RECURSIÓN ===")
    
    fact := factorial(5)
    fmt.Println("Factorial de 5 =", fact)  // 120
    
    fib := fibonacci(7)
    fmt.Println("Fibonacci de 7 =", fib)   // 13
}