.arch armv8-a
.section .rodata
.balign 8
str_0: .asciz ">>> Ejecutando funcionHoisting() declarada correctamente debajo del main."
str_1: .asciz "%s"
str_2: .asciz "\n"
str_3: .asciz "¡Bienvenido al sistema de evaluación de funciones Golampi!"
str_4: .asciz "%s"
str_5: .asciz "\n"
str_6: .asciz "=== INICIO DE CALIFICACION: FUNCIONES ==="
str_7: .asciz "%s"
str_8: .asciz "\n"
str_9: .asciz "\\n--- 3.7 HOISTING ---"
str_10: .asciz "%s"
str_11: .asciz "\n"
str_12: .asciz "\\n--- 3.1 FUNCION SIN PARAMETROS ---"
str_13: .asciz "%s"
str_14: .asciz "\n"
str_15: .asciz "\\n--- 3.2 FUNCION CON PARAMETROS ---"
str_16: .asciz "%s"
str_17: .asciz "\n"
str_18: .asciz "Resultado de sumarNumeros(15, 25):"
str_19: .asciz "%s"
str_20: .asciz " "
str_21: .asciz "%d"
str_22: .asciz "\n"
str_23: .asciz "\\n--- 3.3 FUNCIONES POR REFERENCIA ---"
str_24: .asciz "%s"
str_25: .asciz "\n"
str_26: .asciz "Valor antes de la función por referencia:"
str_27: .asciz "%s"
str_28: .asciz " "
str_29: .asciz "%d"
str_30: .asciz "\n"
str_31: .asciz "Valor después de la función por referencia (debe ser 20):"
str_32: .asciz "%s"
str_33: .asciz " "
str_34: .asciz "%d"
str_35: .asciz "\n"
str_36: .asciz "\\n--- 3.4 FUNCION MULTIPLE RETORNO ---"
str_37: .asciz "%s"
str_38: .asciz "\n"
str_39: .asciz "Operaciones 50 y 20 -> Suma:"
str_40: .asciz "%s"
str_41: .asciz " "
str_42: .asciz "%d"
str_43: .asciz " "
str_44: .asciz ", Resta:"
str_45: .asciz "%s"
str_46: .asciz " "
str_47: .asciz "%d"
str_48: .asciz "\n"
str_49: .asciz "\\n--- 3.5 FUNCION RECURSIVA (UN RETORNO) ---"
str_50: .asciz "%s"
str_51: .asciz "\n"
str_52: .asciz "Factorial de 5:"
str_53: .asciz "%s"
str_54: .asciz " "
str_55: .asciz "%d"
str_56: .asciz "\n"
str_57: .asciz "\\n--- 3.6 FUNCION RECURSIVA (MULTIPLE RETORNO) ---"
str_58: .asciz "%s"
str_59: .asciz "\n"
str_60: .asciz "Fibonacci de 4:"
str_61: .asciz "%s"
str_62: .asciz " "
str_63: .asciz "%d"
str_64: .asciz " "
str_65: .asciz "| Llamadas recursivas totales:"
str_66: .asciz "%s"
str_67: .asciz " "
str_68: .asciz "%d"
str_69: .asciz "\n"
str_70: .asciz "\\n=== FIN DE CALIFICACION: FUNCIONES ==="
str_71: .asciz "%s"
str_72: .asciz "\n"

.section .text
.globl funcionHoisting
.type funcionHoisting, @function
funcionHoisting:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    adrp x0, str_0
    add x0, x0, :lo12:str_0
    mov x1, x0
    adrp x0, str_1
    add x0, x0, :lo12:str_1
    bl printf
    adrp x0, str_2
    add x0, x0, :lo12:str_2
    bl printf

funcionHoisting_epilogue_0:
    ldp x29, x30, [sp], #16
    ret

.globl mostrarBienvenida
.type mostrarBienvenida, @function
mostrarBienvenida:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    adrp x0, str_3
    add x0, x0, :lo12:str_3
    mov x1, x0
    adrp x0, str_4
    add x0, x0, :lo12:str_4
    bl printf
    adrp x0, str_5
    add x0, x0, :lo12:str_5
    bl printf

mostrarBienvenida_epilogue_1:
    ldp x29, x30, [sp], #16
    ret

.globl sumarNumeros
.type sumarNumeros, @function
sumarNumeros:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #16
    str w0, [x29, #-4]
    str w1, [x29, #-12]
    ldr w0, [x29, #-4]
    str w0, [x29, #-20]
    ldr w0, [x29, #-12]
    mov w1, w0
    ldr w0, [x29, #-20]
    add w0, w0, w1
    str w0, [x29, #-20]
    ldr w0, [x29, #-20]
    b sumarNumeros_epilogue_2

sumarNumeros_epilogue_2:
    add sp, sp, #16
    ldp x29, x30, [sp], #16
    ret

.globl duplicarPorReferencia
.type duplicarPorReferencia, @function
duplicarPorReferencia:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #16
    str x0, [x29, #-8]
    ldr x0, [x29, #-8]
    ldr w0, [x0]
    str w0, [x29, #-16]
    mov w0, #2
    mov w1, w0
    ldr w0, [x29, #-16]
    mul w0, w0, w1
    str w0, [x29, #-16]
    ldr w0, [x29, #-16]
    ldr x1, [x29, #-8] // Cargar dirección en x1
    str w0, [x1] // Guardar valor en puntero

duplicarPorReferencia_epilogue_3:
    add sp, sp, #16
    ldp x29, x30, [sp], #16
    ret

.globl operacionesBasicas
.type operacionesBasicas, @function
operacionesBasicas:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #32
    str w0, [x29, #-4]
    str w1, [x29, #-12]
    ldr w0, [x29, #-4]
    str w0, [x29, #-20]
    ldr w0, [x29, #-12]
    mov w1, w0
    ldr w0, [x29, #-20]
    add w0, w0, w1
    str w0, [x29, #-20]
    ldr w0, [x29, #-20]
    str w0, [x29, #-20]
    ldr w0, [x29, #-4]
    str w0, [x29, #-28]
    ldr w0, [x29, #-12]
    mov w1, w0
    ldr w0, [x29, #-28]
    sub w0, w0, w1
    str w0, [x29, #-28]
    ldr w0, [x29, #-28]
    str w0, [x29, #-28]
    ldr w0, [x29, #-20]
    str w0, [x29, #-36]
    ldr w0, [x29, #-28]
    str w0, [x29, #-44]
    ldr w0, [x29, #-44]
    mov x1, x0
    ldr w0, [x29, #-36]
    // Primer retorno en x0
    b operacionesBasicas_epilogue_4

operacionesBasicas_epilogue_4:
    add sp, sp, #32
    ldp x29, x30, [sp], #16
    ret

.globl factorial
.type factorial, @function
factorial:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #16
    str w0, [x29, #-4]
    ldr w0, [x29, #-4]
    str w0, [x29, #-12]
    mov w0, #1
    mov w1, w0
    ldr w0, [x29, #-12]
    cmp w0, w1
    b.le cmp_true_6
    mov w0, #0
    b cmp_end_7
    cmp_true_6:
    mov w0, #1
    cmp_end_7:
    str w0, [x29, #-12]
    ldr w0, [x29, #-12]
    cmp w0, #0
    b.eq else_8
    mov w0, #1
    b factorial_epilogue_5
    b endif_9
    else_8:
    endif_9:
    ldr w0, [x29, #-4]
    str w0, [x29, #-12]
    ldr w0, [x29, #-4]
    str w0, [x29, #-20]
    mov w0, #1
    mov w1, w0
    ldr w0, [x29, #-20]
    sub w0, w0, w1
    str w0, [x29, #-20]
    ldr w0, [x29, #-20]
    str w0, [x29, #-20]
    ldr w0, [x29, #-20]
    bl factorial
    mov w1, w0
    ldr w0, [x29, #-12]
    mul w0, w0, w1
    str w0, [x29, #-12]
    ldr w0, [x29, #-12]
    b factorial_epilogue_5

factorial_epilogue_5:
    add sp, sp, #16
    ldp x29, x30, [sp], #16
    ret

.globl fibonacciAvanzado
.type fibonacciAvanzado, @function
fibonacciAvanzado:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #96
    str w0, [x29, #-4]
    ldr w0, [x29, #-4]
    str w0, [x29, #-12]
    mov w0, #0
    mov w1, w0
    ldr w0, [x29, #-12]
    cmp w0, w1
    b.lt cmp_true_11
    mov w0, #0
    b cmp_end_12
    cmp_true_11:
    mov w0, #1
    cmp_end_12:
    str w0, [x29, #-12]
    ldr w0, [x29, #-12]
    cmp w0, #0
    b.eq else_13
    mov w0, #0
    str w0, [x29, #-12]
    mov w0, #0
    str w0, [x29, #-20]
    ldr w0, [x29, #-20]
    mov x1, x0
    ldr w0, [x29, #-12]
    // Primer retorno en x0
    b fibonacciAvanzado_epilogue_10
    b endif_14
    else_13:
    endif_14:
    ldr w0, [x29, #-4]
    str w0, [x29, #-12]
    mov w0, #1
    mov w1, w0
    ldr w0, [x29, #-12]
    cmp w0, w1
    b.le cmp_true_15
    mov w0, #0
    b cmp_end_16
    cmp_true_15:
    mov w0, #1
    cmp_end_16:
    str w0, [x29, #-12]
    ldr w0, [x29, #-12]
    cmp w0, #0
    b.eq else_17
    ldr w0, [x29, #-4]
    str w0, [x29, #-12]
    mov w0, #0
    mov w1, w0
    ldr w0, [x29, #-12]
    cmp w0, w1
    b.eq cmp_true_19
    mov w0, #0
    b cmp_end_20
    cmp_true_19:
    mov w0, #1
    cmp_end_20:
    str w0, [x29, #-12]
    ldr w0, [x29, #-12]
    cmp w0, #0
    b.eq else_21
    mov w0, #0
    str w0, [x29, #-12]
    mov w0, #1
    str w0, [x29, #-20]
    ldr w0, [x29, #-20]
    mov x1, x0
    ldr w0, [x29, #-12]
    // Primer retorno en x0
    b fibonacciAvanzado_epilogue_10
    b endif_22
    else_21:
    endif_22:
    mov w0, #1
    str w0, [x29, #-12]
    mov w0, #1
    str w0, [x29, #-20]
    ldr w0, [x29, #-20]
    mov x1, x0
    ldr w0, [x29, #-12]
    // Primer retorno en x0
    b fibonacciAvanzado_epilogue_10
    b endif_18
    else_17:
    endif_18:
    ldr w0, [x29, #-4]
    str w0, [x29, #-12]
    mov w0, #1
    mov w1, w0
    ldr w0, [x29, #-12]
    sub w0, w0, w1
    str w0, [x29, #-12]
    ldr w0, [x29, #-12]
    str w0, [x29, #-12]
    ldr w0, [x29, #-12]
    bl fibonacciAvanzado
    str w0, [x29, #-12]
    mov x0, x1
    str w0, [x29, #-20]
    ldr w0, [x29, #-12]
    str w0, [x29, #-28]
    ldr w0, [x29, #-20]
    str w0, [x29, #-36]
    ldr w0, [x29, #-4]
    str w0, [x29, #-44]
    mov w0, #2
    mov w1, w0
    ldr w0, [x29, #-44]
    sub w0, w0, w1
    str w0, [x29, #-44]
    ldr w0, [x29, #-44]
    str w0, [x29, #-44]
    ldr w0, [x29, #-44]
    bl fibonacciAvanzado
    str w0, [x29, #-44]
    mov x0, x1
    str w0, [x29, #-52]
    ldr w0, [x29, #-44]
    str w0, [x29, #-60]
    ldr w0, [x29, #-52]
    str w0, [x29, #-68]
    ldr w0, [x29, #-28]
    str w0, [x29, #-76]
    ldr w0, [x29, #-60]
    mov w1, w0
    ldr w0, [x29, #-76]
    add w0, w0, w1
    str w0, [x29, #-76]
    ldr w0, [x29, #-76]
    str w0, [x29, #-76]
    ldr w0, [x29, #-36]
    str w0, [x29, #-84]
    ldr w0, [x29, #-68]
    mov w1, w0
    ldr w0, [x29, #-84]
    add w0, w0, w1
    str w0, [x29, #-84]
    mov w0, #1
    mov w1, w0
    ldr w0, [x29, #-84]
    add w0, w0, w1
    str w0, [x29, #-84]
    ldr w0, [x29, #-84]
    str w0, [x29, #-84]
    ldr w0, [x29, #-76]
    str w0, [x29, #-92]
    ldr w0, [x29, #-84]
    str w0, [x29, #-100]
    ldr w0, [x29, #-100]
    mov x1, x0
    ldr w0, [x29, #-92]
    // Primer retorno en x0
    b fibonacciAvanzado_epilogue_10

fibonacciAvanzado_epilogue_10:
    add sp, sp, #96
    ldp x29, x30, [sp], #16
    ret

.globl main
.type main, @function
.align 2

main:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #96

    adrp x0, str_6
    add x0, x0, :lo12:str_6
    mov x1, x0
    adrp x0, str_7
    add x0, x0, :lo12:str_7
    bl printf
    adrp x0, str_8
    add x0, x0, :lo12:str_8
    bl printf
    adrp x0, str_9
    add x0, x0, :lo12:str_9
    mov x1, x0
    adrp x0, str_10
    add x0, x0, :lo12:str_10
    bl printf
    adrp x0, str_11
    add x0, x0, :lo12:str_11
    bl printf
    bl funcionHoisting
    adrp x0, str_12
    add x0, x0, :lo12:str_12
    mov x1, x0
    adrp x0, str_13
    add x0, x0, :lo12:str_13
    bl printf
    adrp x0, str_14
    add x0, x0, :lo12:str_14
    bl printf
    bl mostrarBienvenida
    adrp x0, str_15
    add x0, x0, :lo12:str_15
    mov x1, x0
    adrp x0, str_16
    add x0, x0, :lo12:str_16
    bl printf
    adrp x0, str_17
    add x0, x0, :lo12:str_17
    bl printf
    mov w0, #15
    str w0, [x29, #-8]
    mov w0, #25
    str w0, [x29, #-16]
    ldr w0, [x29, #-16]
    mov w1, w0
    ldr w0, [x29, #-8]
    bl sumarNumeros
    str w0, [x29, #-4]
    adrp x0, str_18
    add x0, x0, :lo12:str_18
    mov x1, x0
    adrp x0, str_19
    add x0, x0, :lo12:str_19
    bl printf
    adrp x0, str_20
    add x0, x0, :lo12:str_20
    bl printf
    ldr w0, [x29, #-4]
    mov w1, w0
    adrp x0, str_21
    add x0, x0, :lo12:str_21
    bl printf
    adrp x0, str_22
    add x0, x0, :lo12:str_22
    bl printf
    adrp x0, str_23
    add x0, x0, :lo12:str_23
    mov x1, x0
    adrp x0, str_24
    add x0, x0, :lo12:str_24
    bl printf
    adrp x0, str_25
    add x0, x0, :lo12:str_25
    bl printf
    mov w0, #10
    str w0, [x29, #-12]
    adrp x0, str_26
    add x0, x0, :lo12:str_26
    mov x1, x0
    adrp x0, str_27
    add x0, x0, :lo12:str_27
    bl printf
    adrp x0, str_28
    add x0, x0, :lo12:str_28
    bl printf
    ldr w0, [x29, #-12]
    mov w1, w0
    adrp x0, str_29
    add x0, x0, :lo12:str_29
    bl printf
    adrp x0, str_30
    add x0, x0, :lo12:str_30
    bl printf
    add x0, x29, #-12
    str x0, [x29, #-20]
    ldr x0, [x29, #-20]
    bl duplicarPorReferencia
    adrp x0, str_31
    add x0, x0, :lo12:str_31
    mov x1, x0
    adrp x0, str_32
    add x0, x0, :lo12:str_32
    bl printf
    adrp x0, str_33
    add x0, x0, :lo12:str_33
    bl printf
    ldr w0, [x29, #-12]
    mov w1, w0
    adrp x0, str_34
    add x0, x0, :lo12:str_34
    bl printf
    adrp x0, str_35
    add x0, x0, :lo12:str_35
    bl printf
    adrp x0, str_36
    add x0, x0, :lo12:str_36
    mov x1, x0
    adrp x0, str_37
    add x0, x0, :lo12:str_37
    bl printf
    adrp x0, str_38
    add x0, x0, :lo12:str_38
    bl printf
    mov w0, #50
    str w0, [x29, #-20]
    mov w0, #20
    str w0, [x29, #-28]
    ldr w0, [x29, #-28]
    mov w1, w0
    ldr w0, [x29, #-20]
    bl operacionesBasicas
    str w0, [x29, #-20]
    mov x0, x1
    str w0, [x29, #-28]
    ldr w0, [x29, #-20]
    str w0, [x29, #-36]
    ldr w0, [x29, #-28]
    str w0, [x29, #-44]
    adrp x0, str_39
    add x0, x0, :lo12:str_39
    mov x1, x0
    adrp x0, str_40
    add x0, x0, :lo12:str_40
    bl printf
    adrp x0, str_41
    add x0, x0, :lo12:str_41
    bl printf
    ldr w0, [x29, #-36]
    mov w1, w0
    adrp x0, str_42
    add x0, x0, :lo12:str_42
    bl printf
    adrp x0, str_43
    add x0, x0, :lo12:str_43
    bl printf
    adrp x0, str_44
    add x0, x0, :lo12:str_44
    mov x1, x0
    adrp x0, str_45
    add x0, x0, :lo12:str_45
    bl printf
    adrp x0, str_46
    add x0, x0, :lo12:str_46
    bl printf
    ldr w0, [x29, #-44]
    mov w1, w0
    adrp x0, str_47
    add x0, x0, :lo12:str_47
    bl printf
    adrp x0, str_48
    add x0, x0, :lo12:str_48
    bl printf
    adrp x0, str_49
    add x0, x0, :lo12:str_49
    mov x1, x0
    adrp x0, str_50
    add x0, x0, :lo12:str_50
    bl printf
    adrp x0, str_51
    add x0, x0, :lo12:str_51
    bl printf
    mov w0, #5
    str w0, [x29, #-52]
    ldr w0, [x29, #-52]
    bl factorial
    str w0, [x29, #-52]
    adrp x0, str_52
    add x0, x0, :lo12:str_52
    mov x1, x0
    adrp x0, str_53
    add x0, x0, :lo12:str_53
    bl printf
    adrp x0, str_54
    add x0, x0, :lo12:str_54
    bl printf
    ldr w0, [x29, #-52]
    mov w1, w0
    adrp x0, str_55
    add x0, x0, :lo12:str_55
    bl printf
    adrp x0, str_56
    add x0, x0, :lo12:str_56
    bl printf
    adrp x0, str_57
    add x0, x0, :lo12:str_57
    mov x1, x0
    adrp x0, str_58
    add x0, x0, :lo12:str_58
    bl printf
    adrp x0, str_59
    add x0, x0, :lo12:str_59
    bl printf
    mov w0, #4
    str w0, [x29, #-60]
    ldr w0, [x29, #-60]
    bl fibonacciAvanzado
    str w0, [x29, #-60]
    mov x0, x1
    str w0, [x29, #-68]
    ldr w0, [x29, #-60]
    str w0, [x29, #-76]
    ldr w0, [x29, #-68]
    str w0, [x29, #-84]
    adrp x0, str_60
    add x0, x0, :lo12:str_60
    mov x1, x0
    adrp x0, str_61
    add x0, x0, :lo12:str_61
    bl printf
    adrp x0, str_62
    add x0, x0, :lo12:str_62
    bl printf
    ldr w0, [x29, #-76]
    mov w1, w0
    adrp x0, str_63
    add x0, x0, :lo12:str_63
    bl printf
    adrp x0, str_64
    add x0, x0, :lo12:str_64
    bl printf
    adrp x0, str_65
    add x0, x0, :lo12:str_65
    mov x1, x0
    adrp x0, str_66
    add x0, x0, :lo12:str_66
    bl printf
    adrp x0, str_67
    add x0, x0, :lo12:str_67
    bl printf
    ldr w0, [x29, #-84]
    mov w1, w0
    adrp x0, str_68
    add x0, x0, :lo12:str_68
    bl printf
    adrp x0, str_69
    add x0, x0, :lo12:str_69
    bl printf
    adrp x0, str_70
    add x0, x0, :lo12:str_70
    mov x1, x0
    adrp x0, str_71
    add x0, x0, :lo12:str_71
    bl printf
    adrp x0, str_72
    add x0, x0, :lo12:str_72
    bl printf

    add sp, sp, #96
    ldp x29, x30, [sp], #16
    mov w0, #0
    ret
