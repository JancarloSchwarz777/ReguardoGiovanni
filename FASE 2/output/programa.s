.arch armv8-a
.section .rodata
.balign 8
str_0: .asciz "=== INICIO DE CALIFICACION: ESTRUCTURAS DE CONTROL ==="
str_1: .asciz "%s"
str_2: .asciz "\n"
str_3: .asciz "Ana"
str_4: .asciz "\\n--- 2.2 IF ---"
str_5: .asciz "%s"
str_6: .asciz "\n"
str_7: .asciz "El estudiante"
str_8: .asciz "%s"
str_9: .asciz " "
str_10: .asciz "%s"
str_11: .asciz " "
str_12: .asciz "tiene una nota mayor a 80"
str_13: .asciz "%s"
str_14: .asciz "\n"
str_15: .asciz "\\n--- 2.3 IF ELSE ---"
str_16: .asciz "%s"
str_17: .asciz "\n"
str_18: .asciz "Clasificacion: SOBRESALIENTE"
str_19: .asciz "%s"
str_20: .asciz "\n"
str_21: .asciz "Clasificacion: EXCELENTE"
str_22: .asciz "%s"
str_23: .asciz "\n"
str_24: .asciz "Clasificacion: REGULAR"
str_25: .asciz "%s"
str_26: .asciz "\n"
str_27: .asciz "\\n--- 2.4 SWITCH CASE DEFAULT ---"
str_28: .asciz "%s"
str_29: .asciz "\n"
str_30: .asciz "Categoria 1: Principiante"
str_31: .asciz "%s"
str_32: .asciz "\n"
str_33: .asciz "Categoria 2: Intermedio"
str_34: .asciz "%s"
str_35: .asciz "\n"
str_36: .asciz "Categoria 3: Avanzado"
str_37: .asciz "%s"
str_38: .asciz "\n"
str_39: .asciz "Categoria Desconocida"
str_40: .asciz "%s"
str_41: .asciz "\n"
str_42: .asciz "\\n--- 2.5 FOR CLASICO ---"
str_43: .asciz "%s"
str_44: .asciz "\n"
str_45: .asciz "Iteracion:"
str_46: .asciz "%s"
str_47: .asciz " "
str_48: .asciz "%d"
str_49: .asciz "\n"
str_50: .asciz "\\n--- 2.6 FOR CONDICIONAL ---"
str_51: .asciz "%s"
str_52: .asciz "\n"
str_53: .asciz "Cuenta regresiva:"
str_54: .asciz "%s"
str_55: .asciz " "
str_56: .asciz "%d"
str_57: .asciz "\n"
str_58: .asciz "\\n--- 2.7 FOR INFINITO ---"
str_59: .asciz "%s"
str_60: .asciz "\n"
str_61: .asciz "Intento:"
str_62: .asciz "%s"
str_63: .asciz " "
str_64: .asciz "%d"
str_65: .asciz "\n"
str_66: .asciz "\\n--- 2.8 BREAK ---"
str_67: .asciz "%s"
str_68: .asciz "\n"
str_69: .asciz "Se encontro 7, se aplica break"
str_70: .asciz "%s"
str_71: .asciz "\n"
str_72: .asciz "%d"
str_73: .asciz "\n"
str_74: .asciz "\\n--- 2.9 CONTINUE ---"
str_75: .asciz "%s"
str_76: .asciz "\n"
str_77: .asciz "Impar:"
str_78: .asciz "%s"
str_79: .asciz " "
str_80: .asciz "%d"
str_81: .asciz "\n"
str_82: .asciz "\\n=== FIN DE CALIFICACION: ESTRUCTURAS DE CONTROL ==="
str_83: .asciz "%s"
str_84: .asciz "\n"

.section .text
.globl main
.type main, @function
.align 2

main:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #80

    adrp x0, str_0
    add x0, x0, :lo12:str_0
    mov x1, x0
    adrp x0, str_1
    add x0, x0, :lo12:str_1
    bl printf
    adrp x0, str_2
    add x0, x0, :lo12:str_2
    bl printf
    mov w0, #85
    str w0, [x29, #-4]
    mov w0, #92
    str w0, [x29, #-12]
    adrp x0, str_3
    add x0, x0, :lo12:str_3
    str x0, [x29, #-24]
    adrp x0, str_4
    add x0, x0, :lo12:str_4
    mov x1, x0
    adrp x0, str_5
    add x0, x0, :lo12:str_5
    bl printf
    adrp x0, str_6
    add x0, x0, :lo12:str_6
    bl printf
    ldr w0, [x29, #-4]
    str w0, [x29, #-32]
    mov w0, #80
    mov w1, w0
    ldr w0, [x29, #-32]
    cmp w0, w1
    b.gt cmp_true_0
    mov w0, #0
    b cmp_end_1
    cmp_true_0:
    mov w0, #1
    cmp_end_1:
    str w0, [x29, #-32]
    ldr w0, [x29, #-32]
    cmp w0, #0
    b.eq else_2
    adrp x0, str_7
    add x0, x0, :lo12:str_7
    mov x1, x0
    adrp x0, str_8
    add x0, x0, :lo12:str_8
    bl printf
    adrp x0, str_9
    add x0, x0, :lo12:str_9
    bl printf
    ldr x0, [x29, #-24]
    mov x1, x0
    adrp x0, str_10
    add x0, x0, :lo12:str_10
    bl printf
    adrp x0, str_11
    add x0, x0, :lo12:str_11
    bl printf
    adrp x0, str_12
    add x0, x0, :lo12:str_12
    mov x1, x0
    adrp x0, str_13
    add x0, x0, :lo12:str_13
    bl printf
    adrp x0, str_14
    add x0, x0, :lo12:str_14
    bl printf
    b endif_3
    else_2:
    endif_3:
    adrp x0, str_15
    add x0, x0, :lo12:str_15
    mov x1, x0
    adrp x0, str_16
    add x0, x0, :lo12:str_16
    bl printf
    adrp x0, str_17
    add x0, x0, :lo12:str_17
    bl printf
    ldr w0, [x29, #-12]
    str w0, [x29, #-32]
    mov w0, #95
    mov w1, w0
    ldr w0, [x29, #-32]
    cmp w0, w1
    b.ge cmp_true_4
    mov w0, #0
    b cmp_end_5
    cmp_true_4:
    mov w0, #1
    cmp_end_5:
    str w0, [x29, #-32]
    ldr w0, [x29, #-32]
    cmp w0, #0
    b.eq else_6
    adrp x0, str_18
    add x0, x0, :lo12:str_18
    mov x1, x0
    adrp x0, str_19
    add x0, x0, :lo12:str_19
    bl printf
    adrp x0, str_20
    add x0, x0, :lo12:str_20
    bl printf
    b endif_7
    else_6:
    ldr w0, [x29, #-12]
    str w0, [x29, #-32]
    mov w0, #90
    mov w1, w0
    ldr w0, [x29, #-32]
    cmp w0, w1
    b.ge cmp_true_8
    mov w0, #0
    b cmp_end_9
    cmp_true_8:
    mov w0, #1
    cmp_end_9:
    str w0, [x29, #-32]
    ldr w0, [x29, #-32]
    cmp w0, #0
    b.eq else_10
    adrp x0, str_21
    add x0, x0, :lo12:str_21
    mov x1, x0
    adrp x0, str_22
    add x0, x0, :lo12:str_22
    bl printf
    adrp x0, str_23
    add x0, x0, :lo12:str_23
    bl printf
    b endif_11
    else_10:
    adrp x0, str_24
    add x0, x0, :lo12:str_24
    mov x1, x0
    adrp x0, str_25
    add x0, x0, :lo12:str_25
    bl printf
    adrp x0, str_26
    add x0, x0, :lo12:str_26
    bl printf
    endif_11:
    endif_7:
    adrp x0, str_27
    add x0, x0, :lo12:str_27
    mov x1, x0
    adrp x0, str_28
    add x0, x0, :lo12:str_28
    bl printf
    adrp x0, str_29
    add x0, x0, :lo12:str_29
    bl printf
    mov w0, #2
    str w0, [x29, #-28]
    ldr w0, [x29, #-28]
    mov w19, w0
    mov w1, w19
    mov w0, #1
    cmp w1, w0
    b.eq case_13
    b case_next_14
    case_13:
    adrp x0, str_30
    add x0, x0, :lo12:str_30
    mov x1, x0
    adrp x0, str_31
    add x0, x0, :lo12:str_31
    bl printf
    adrp x0, str_32
    add x0, x0, :lo12:str_32
    bl printf
    b switch_end_12
    case_next_14:
    mov w1, w19
    mov w0, #2
    cmp w1, w0
    b.eq case_15
    b case_next_16
    case_15:
    adrp x0, str_33
    add x0, x0, :lo12:str_33
    mov x1, x0
    adrp x0, str_34
    add x0, x0, :lo12:str_34
    bl printf
    adrp x0, str_35
    add x0, x0, :lo12:str_35
    bl printf
    b switch_end_12
    case_next_16:
    mov w1, w19
    mov w0, #3
    cmp w1, w0
    b.eq case_17
    b case_next_18
    case_17:
    adrp x0, str_36
    add x0, x0, :lo12:str_36
    mov x1, x0
    adrp x0, str_37
    add x0, x0, :lo12:str_37
    bl printf
    adrp x0, str_38
    add x0, x0, :lo12:str_38
    bl printf
    b switch_end_12
    case_next_18:
    b default_case_19
    default_case_19:
    adrp x0, str_39
    add x0, x0, :lo12:str_39
    mov x1, x0
    adrp x0, str_40
    add x0, x0, :lo12:str_40
    bl printf
    adrp x0, str_41
    add x0, x0, :lo12:str_41
    bl printf
    switch_end_12:
    adrp x0, str_42
    add x0, x0, :lo12:str_42
    mov x1, x0
    adrp x0, str_43
    add x0, x0, :lo12:str_43
    bl printf
    adrp x0, str_44
    add x0, x0, :lo12:str_44
    bl printf
    mov w0, #1
    str w0, [x29, #-36]
    b for_cond_20
    for_body_21:
    adrp x0, str_45
    add x0, x0, :lo12:str_45
    mov x1, x0
    adrp x0, str_46
    add x0, x0, :lo12:str_46
    bl printf
    adrp x0, str_47
    add x0, x0, :lo12:str_47
    bl printf
    ldr w0, [x29, #-36]
    mov w1, w0
    adrp x0, str_48
    add x0, x0, :lo12:str_48
    bl printf
    adrp x0, str_49
    add x0, x0, :lo12:str_49
    bl printf
    for_step_22:
    ldr w0, [x29, #-36]
    add w0, w0, #1
    str w0, [x29, #-36]
    for_cond_20:
    ldr w0, [x29, #-36]
    str w0, [x29, #-44]
    mov w0, #5
    mov w1, w0
    ldr w0, [x29, #-44]
    cmp w0, w1
    b.le cmp_true_24
    mov w0, #0
    b cmp_end_25
    cmp_true_24:
    mov w0, #1
    cmp_end_25:
    str w0, [x29, #-44]
    ldr w0, [x29, #-44]
    cmp w0, #0
    b.ne for_body_21
    for_end_23:
    adrp x0, str_50
    add x0, x0, :lo12:str_50
    mov x1, x0
    adrp x0, str_51
    add x0, x0, :lo12:str_51
    bl printf
    adrp x0, str_52
    add x0, x0, :lo12:str_52
    bl printf
    mov w0, #10
    str w0, [x29, #-44]
    b for_cond_26
    for_body_27:
    adrp x0, str_53
    add x0, x0, :lo12:str_53
    mov x1, x0
    adrp x0, str_54
    add x0, x0, :lo12:str_54
    bl printf
    adrp x0, str_55
    add x0, x0, :lo12:str_55
    bl printf
    ldr w0, [x29, #-44]
    mov w1, w0
    adrp x0, str_56
    add x0, x0, :lo12:str_56
    bl printf
    adrp x0, str_57
    add x0, x0, :lo12:str_57
    bl printf
    mov w0, #3
    mov w1, w0
    str w0, [x29, #-52]
    ldr w0, [x29, #-44]
    ldr w0, [x29, #-52]
    mov w1, w0
    ldr w0, [x29, #-44]
    sub w0, w0, w1
    str w0, [x29, #-44]
    for_cond_26:
    ldr w0, [x29, #-44]
    str w0, [x29, #-52]
    mov w0, #0
    mov w1, w0
    ldr w0, [x29, #-52]
    cmp w0, w1
    b.gt cmp_true_30
    mov w0, #0
    b cmp_end_31
    cmp_true_30:
    mov w0, #1
    cmp_end_31:
    str w0, [x29, #-52]
    ldr w0, [x29, #-52]
    cmp w0, #0
    b.ne for_body_27
    for_end_29:
    adrp x0, str_58
    add x0, x0, :lo12:str_58
    mov x1, x0
    adrp x0, str_59
    add x0, x0, :lo12:str_59
    bl printf
    adrp x0, str_60
    add x0, x0, :lo12:str_60
    bl printf
    mov w0, #0
    str w0, [x29, #-52]
    for_body_33:
    ldr w0, [x29, #-52]
    add w0, w0, #1
    str w0, [x29, #-52]
    adrp x0, str_61
    add x0, x0, :lo12:str_61
    mov x1, x0
    adrp x0, str_62
    add x0, x0, :lo12:str_62
    bl printf
    adrp x0, str_63
    add x0, x0, :lo12:str_63
    bl printf
    ldr w0, [x29, #-52]
    mov w1, w0
    adrp x0, str_64
    add x0, x0, :lo12:str_64
    bl printf
    adrp x0, str_65
    add x0, x0, :lo12:str_65
    bl printf
    ldr w0, [x29, #-52]
    str w0, [x29, #-60]
    mov w0, #3
    mov w1, w0
    ldr w0, [x29, #-60]
    cmp w0, w1
    b.eq cmp_true_36
    mov w0, #0
    b cmp_end_37
    cmp_true_36:
    mov w0, #1
    cmp_end_37:
    str w0, [x29, #-60]
    ldr w0, [x29, #-60]
    cmp w0, #0
    b.eq else_38
    b for_end_35
    b endif_39
    else_38:
    endif_39:
    b for_body_33
    for_end_35:
    adrp x0, str_66
    add x0, x0, :lo12:str_66
    mov x1, x0
    adrp x0, str_67
    add x0, x0, :lo12:str_67
    bl printf
    adrp x0, str_68
    add x0, x0, :lo12:str_68
    bl printf
    mov w0, #1
    str w0, [x29, #-60]
    b for_cond_40
    for_body_41:
    ldr w0, [x29, #-60]
    str w0, [x29, #-68]
    mov w0, #7
    mov w1, w0
    ldr w0, [x29, #-68]
    cmp w0, w1
    b.eq cmp_true_44
    mov w0, #0
    b cmp_end_45
    cmp_true_44:
    mov w0, #1
    cmp_end_45:
    str w0, [x29, #-68]
    ldr w0, [x29, #-68]
    cmp w0, #0
    b.eq else_46
    adrp x0, str_69
    add x0, x0, :lo12:str_69
    mov x1, x0
    adrp x0, str_70
    add x0, x0, :lo12:str_70
    bl printf
    adrp x0, str_71
    add x0, x0, :lo12:str_71
    bl printf
    b for_end_43
    b endif_47
    else_46:
    endif_47:
    ldr w0, [x29, #-60]
    mov w1, w0
    adrp x0, str_72
    add x0, x0, :lo12:str_72
    bl printf
    adrp x0, str_73
    add x0, x0, :lo12:str_73
    bl printf
    for_step_42:
    ldr w0, [x29, #-60]
    add w0, w0, #1
    str w0, [x29, #-60]
    for_cond_40:
    ldr w0, [x29, #-60]
    str w0, [x29, #-68]
    mov w0, #20
    mov w1, w0
    ldr w0, [x29, #-68]
    cmp w0, w1
    b.le cmp_true_48
    mov w0, #0
    b cmp_end_49
    cmp_true_48:
    mov w0, #1
    cmp_end_49:
    str w0, [x29, #-68]
    ldr w0, [x29, #-68]
    cmp w0, #0
    b.ne for_body_41
    for_end_43:
    adrp x0, str_74
    add x0, x0, :lo12:str_74
    mov x1, x0
    adrp x0, str_75
    add x0, x0, :lo12:str_75
    bl printf
    adrp x0, str_76
    add x0, x0, :lo12:str_76
    bl printf
    mov w0, #1
    str w0, [x29, #-68]
    b for_cond_50
    for_body_51:
    str w0, [x29, #-76]
    mov w1, w0
    ldr w0, [x29, #-76]
    sdiv w2, w0, w1
    mul w2, w2, w1
    sub w0, w0, w2
    str w0, [x29, #-76]
    ldr w0, [x29, #-76]
    ldr w0, [x29, #-68]
    str w0, [x29, #-76]
    mov w0, #2
    mov w1, w0
    ldr w0, [x29, #-76]
    sdiv w2, w0, w1
    mul w2, w2, w1
    sub w0, w0, w2
    str w0, [x29, #-76]
    ldr w0, [x29, #-76]
    str w0, [x29, #-76]
    mov w0, #0
    mov w1, w0
    ldr w0, [x29, #-76]
    cmp w0, w1
    b.eq cmp_true_54
    mov w0, #0
    b cmp_end_55
    cmp_true_54:
    mov w0, #1
    cmp_end_55:
    str w0, [x29, #-76]
    ldr w0, [x29, #-76]
    cmp w0, #0
    b.eq else_56
    b for_step_52
    b endif_57
    else_56:
    endif_57:
    adrp x0, str_77
    add x0, x0, :lo12:str_77
    mov x1, x0
    adrp x0, str_78
    add x0, x0, :lo12:str_78
    bl printf
    adrp x0, str_79
    add x0, x0, :lo12:str_79
    bl printf
    ldr w0, [x29, #-68]
    mov w1, w0
    adrp x0, str_80
    add x0, x0, :lo12:str_80
    bl printf
    adrp x0, str_81
    add x0, x0, :lo12:str_81
    bl printf
    for_step_52:
    ldr w0, [x29, #-68]
    add w0, w0, #1
    str w0, [x29, #-68]
    for_cond_50:
    ldr w0, [x29, #-68]
    str w0, [x29, #-76]
    mov w0, #6
    mov w1, w0
    ldr w0, [x29, #-76]
    cmp w0, w1
    b.le cmp_true_58
    mov w0, #0
    b cmp_end_59
    cmp_true_58:
    mov w0, #1
    cmp_end_59:
    str w0, [x29, #-76]
    ldr w0, [x29, #-76]
    cmp w0, #0
    b.ne for_body_51
    for_end_53:
    adrp x0, str_82
    add x0, x0, :lo12:str_82
    mov x1, x0
    adrp x0, str_83
    add x0, x0, :lo12:str_83
    bl printf
    adrp x0, str_84
    add x0, x0, :lo12:str_84
    bl printf

    add sp, sp, #80
    ldp x29, x30, [sp], #16
    mov w0, #0
    ret
