.arch armv8-a
.section .rodata
.balign 8
str_0: .asciz "  *"
str_1: .asciz "%s"
str_2: .asciz "\n"
str_3: .asciz " ***"
str_4: .asciz "%s"
str_5: .asciz "\n"
str_6: .asciz "*****"
str_7: .asciz "%s"
str_8: .asciz "\n"
    .balign 4
str_9: .float 3.0
str_10: .asciz "<nil>"
str_11: .asciz "<nil>"
str_12: .asciz "=== INICIO DE CALIFICACION: FUNCIONES ==="
str_13: .asciz "%s"
str_14: .asciz "\n"
str_15: .asciz "\\n--- 3.1 IMPRIMIR ARBOL ---"
str_16: .asciz "%s"
str_17: .asciz "\n"
str_18: .asciz "\\n--- 3.2 CALCULAR VOLUMEN PIRAMIDE ---"
str_19: .asciz "%s"
str_20: .asciz "\n"
str_21: .asciz "Volumen:"
str_22: .asciz "%s"
str_23: .asciz " "
    .balign 4
str_24: .float 10.0
    .balign 4
str_25: .float 15.0
str_26: .asciz "%f"
str_27: .asciz "\n"
str_28: .asciz "\\n--- 3.3 REFERENCIA: ORDENAMIENTO E INTERCAMBIO ---"
str_29: .asciz "%s"
str_30: .asciz "\n"
str_31: .asciz "Intercambio:"
str_32: .asciz "%s"
str_33: .asciz " "
str_34: .asciz "%d"
str_35: .asciz " "
str_36: .asciz "%d"
str_37: .asciz "\n"
str_38: .asciz "\\n--- 3.4 POTENCIA RECURSIVA ---"
str_39: .asciz "%s"
str_40: .asciz "\n"
str_41: .asciz "2^8:"
str_42: .asciz "%s"
str_43: .asciz " "
str_44: .asciz "%d"
str_45: .asciz "\n"
str_46: .asciz "\\n--- 3.5 REFERENCIA AVANZADA: INTERCAMBIO VALIDADO E INTERCALACION ---"
str_47: .asciz "%s"
str_48: .asciz "\n"
str_49: .asciz "Intercambio validado:"
str_50: .asciz "%s"
str_51: .asciz " "
str_52: .asciz "%d"
str_53: .asciz " "
str_54: .asciz "%d"
str_55: .asciz "\n"
str_56: .asciz "\\n--- 3.6 EUCLIDES RECURSIVO ---"
str_57: .asciz "%s"
str_58: .asciz "\n"
str_59: .asciz "MCD:"
str_60: .asciz "%s"
str_61: .asciz " "
str_62: .asciz "%d"
str_63: .asciz " "
str_64: .asciz "Pasos:"
str_65: .asciz "%s"
str_66: .asciz " "
str_67: .asciz "%d"
str_68: .asciz "\n"
str_69: .asciz "\\n--- 4.1 FMT.PRINTLN ---"
str_70: .asciz "%s"
str_71: .asciz "\n"
str_72: .asciz "Impresion directa de texto"
str_73: .asciz "%s"
str_74: .asciz "\n"
str_75: .asciz "\\n--- 4.2 LEN ---"
str_76: .asciz "%s"
str_77: .asciz "\n"
str_78: .asciz "Golampi"
str_79: .asciz "len(texto):"
str_80: .asciz "%s"
str_81: .asciz " "
str_82: .asciz "%d"
str_83: .asciz "\n"
str_84: .asciz "\\n--- 4.3 NOW ---"
str_85: .asciz "%s"
str_86: .asciz "\n"
str_87: .asciz "Fecha actual:"
str_88: .asciz "%s"
str_89: .asciz " "
str_90: .asciz "2026-05-06 00:45:55"
str_91: .asciz "%s"
str_92: .asciz "\n"
str_93: .asciz "\\n--- 4.4 SUBSTR ---"
str_94: .asciz "%s"
str_95: .asciz "\n"
str_96: .asciz "substr:"
str_97: .asciz "%s"
str_98: .asciz " "
str_99: .asciz "Organizacion de Lenguajes"
str_100: .asciz ""
str_101: .asciz "%s"
str_102: .asciz "\n"
str_103: .asciz "\\n--- 4.5 TYPEOF ---"
str_104: .asciz "%s"
str_105: .asciz "\n"
str_106: .asciz "int32:"
str_107: .asciz "%s"
str_108: .asciz " "
str_109: .asciz "int32"
str_110: .asciz "%s"
str_111: .asciz "\n"
str_112: .asciz "float32:"
str_113: .asciz "%s"
str_114: .asciz " "
    .balign 4
str_115: .float 3.14
str_116: .asciz "float32"
str_117: .asciz "%s"
str_118: .asciz "\n"
str_119: .asciz "bool:"
str_120: .asciz "%s"
str_121: .asciz " "
str_122: .asciz "bool"
str_123: .asciz "%s"
str_124: .asciz "\n"
str_125: .asciz "string:"
str_126: .asciz "%s"
str_127: .asciz " "
str_128: .asciz "texto"
str_129: .asciz "string"
str_130: .asciz "%s"
str_131: .asciz "\n"
str_132: .asciz "\\n=== FIN DE CALIFICACION: FUNCIONES ==="
str_133: .asciz "%s"
str_134: .asciz "\n"

.section .data
.balign 8
    .balign 8
substr_buffer_0: .space 256 

.section .text
.globl imprimirArbol
.type imprimirArbol, @function
imprimirArbol:
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
    adrp x0, str_3
    add x0, x0, :lo12:str_3
    mov x1, x0
    adrp x0, str_4
    add x0, x0, :lo12:str_4
    bl printf
    adrp x0, str_5
    add x0, x0, :lo12:str_5
    bl printf
    adrp x0, str_6
    add x0, x0, :lo12:str_6
    mov x1, x0
    adrp x0, str_7
    add x0, x0, :lo12:str_7
    bl printf
    adrp x0, str_8
    add x0, x0, :lo12:str_8
    bl printf

imprimirArbol_epilogue_0:
    ldp x29, x30, [sp], #16
    ret

.globl calcularVolumenPiramide
.type calcularVolumenPiramide, @function
calcularVolumenPiramide:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #16
    str s0, [x29, #-8]
    str s1, [x29, #-16]
    ldr s0, [x29, #-8]
    str s0, [x29, #-24]
    ldr s0, [x29, #-8]
    fmov s1, s0
    ldr s0, [x29, #-24]
    fmul s0, s0, s1
    str s0, [x29, #-24]
    ldr s0, [x29, #-16]
    fmov s1, s0
    ldr s0, [x29, #-24]
    fmul s0, s0, s1
    str s0, [x29, #-24]
    ldr s0, [x29, #-24]
    str s0, [x29, #-24]
    adrp x0, str_9
    ldr s0, [x0, :lo12:str_9]
    fmov s1, s0
    ldr s0, [x29, #-24]
    fdiv s0, s0, s1
    str s0, [x29, #-24]
    ldr s0, [x29, #-24]
    b calcularVolumenPiramide_epilogue_1

calcularVolumenPiramide_epilogue_1:
    add sp, sp, #16
    ldp x29, x30, [sp], #16
    ret

.globl intercambioValores
.type intercambioValores, @function
intercambioValores:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #32
    str x0, [x29, #-8]
    str x1, [x29, #-16]
    ldr x0, [x29, #-8]
    ldr w0, [x0]
    str w0, [x29, #-20]
    ldr x0, [x29, #-16]
    ldr w0, [x0]
    ldr x1, [x29, #-8] // Cargar dirección en x1
    str w0, [x1] // Guardar valor en puntero
    ldr w0, [x29, #-20]
    ldr x1, [x29, #-16] // Cargar dirección en x1
    str w0, [x1] // Guardar valor en puntero

intercambioValores_epilogue_2:
    add sp, sp, #32
    ldp x29, x30, [sp], #16
    ret

.globl potencia
.type potencia, @function
potencia:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #32
    str w0, [x29, #-4]
    str w1, [x29, #-12]
    mov w0, #1
    str w0, [x29, #-20]
    mov w0, #0
    str w0, [x29, #-28]
    b for_cond_4
    for_body_5:
    ldr w0, [x29, #-20]
    str w0, [x29, #-36]
    ldr w0, [x29, #-4]
    mov w1, w0
    ldr w0, [x29, #-36]
    mul w0, w0, w1
    str w0, [x29, #-36]
    ldr w0, [x29, #-36]
    str w0, [x29, #-20]
    for_step_6:
    ldr w0, [x29, #-28]
    add w0, w0, #1
    str w0, [x29, #-28]
    for_cond_4:
    ldr w0, [x29, #-28]
    str w0, [x29, #-36]
    ldr w0, [x29, #-12]
    mov w1, w0
    ldr w0, [x29, #-36]
    cmp w0, w1
    b.lt cmp_true_8
    mov w0, #0
    b cmp_end_9
    cmp_true_8:
    mov w0, #1
    cmp_end_9:
    str w0, [x29, #-36]
    ldr w0, [x29, #-36]
    cmp w0, #0
    b.ne for_body_5
    for_end_7:
    ldr w0, [x29, #-20]
    b potencia_epilogue_3

potencia_epilogue_3:
    add sp, sp, #32
    ldp x29, x30, [sp], #16
    ret

.globl euclides
.type euclides, @function
euclides:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #48
    str w0, [x29, #-4]
    str w1, [x29, #-12]
    ldr w0, [x29, #-12]
    str w0, [x29, #-20]
    mov w0, #0
    mov w1, w0
    ldr w0, [x29, #-20]
    cmp w0, w1
    b.eq cmp_true_11
    mov w0, #0
    b cmp_end_12
    cmp_true_11:
    mov w0, #1
    cmp_end_12:
    str w0, [x29, #-20]
    ldr w0, [x29, #-20]
    cmp w0, #0
    b.eq else_13
    ldr w0, [x29, #-4]
    str w0, [x29, #-20]
    mov w0, #1
    str w0, [x29, #-28]
    ldr w0, [x29, #-28]
    mov x1, x0
    ldr w0, [x29, #-20]
    // Primer retorno en x0
    b euclides_epilogue_10
    b endif_14
    else_13:
    endif_14:
    ldr w0, [x29, #-12]
    str w0, [x29, #-20]
    ldr w0, [x29, #-4]
    str w0, [x29, #-28]
    ldr w0, [x29, #-12]
    mov w1, w0
    ldr w0, [x29, #-28]
    sdiv w2, w0, w1
    mul w2, w2, w1
    sub w0, w0, w2
    str w0, [x29, #-28]
    ldr w0, [x29, #-28]
    str w0, [x29, #-28]
    ldr w0, [x29, #-28]
    mov w1, w0
    ldr w0, [x29, #-20]
    bl euclides
    str w0, [x29, #-20]
    mov x0, x1
    str w0, [x29, #-28]
    ldr w0, [x29, #-20]
    str w0, [x29, #-36]
    ldr w0, [x29, #-28]
    str w0, [x29, #-44]
    ldr w0, [x29, #-36]
    str w0, [x29, #-52]
    ldr w0, [x29, #-44]
    str w0, [x29, #-60]
    mov w0, #1
    mov w1, w0
    ldr w0, [x29, #-60]
    add w0, w0, w1
    str w0, [x29, #-60]
    ldr w0, [x29, #-60]
    str w0, [x29, #-60]
    ldr w0, [x29, #-60]
    mov x1, x0
    ldr w0, [x29, #-52]
    // Primer retorno en x0
    b euclides_epilogue_10

euclides_epilogue_10:
    add sp, sp, #48
    ldp x29, x30, [sp], #16
    ret

.globl intercambioValoresValidado
.type intercambioValoresValidado, @function
intercambioValoresValidado:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #32
    str x0, [x29, #-8]
    str x1, [x29, #-16]
    ldr x0, [x29, #-8]
    str x0, [x29, #-24]
    adrp x0, str_10
    add x0, x0, :lo12:str_10
    mov w1, w0
    ldr x0, [x29, #-24]
    cmp w0, w1
    b.ne cmp_true_16
    mov w0, #0
    b cmp_end_17
    cmp_true_16:
    mov w0, #1
    cmp_end_17:
    str w0, [x29, #-24]
    ldr w0, [x29, #-24]
    cmp w0, #0
    b.eq logic_end_18
    ldr x0, [x29, #-16]
    str x0, [x29, #-24]
    adrp x0, str_11
    add x0, x0, :lo12:str_11
    mov w1, w0
    ldr x0, [x29, #-24]
    cmp w0, w1
    b.ne cmp_true_19
    mov w0, #0
    b cmp_end_20
    cmp_true_19:
    mov w0, #1
    cmp_end_20:
    str w0, [x29, #-24]
    ldr w0, [x29, #-24]
    logic_end_18:
    cmp w0, #0
    b.eq else_21
    ldr x0, [x29, #-8]
    ldr w0, [x0]
    str w0, [x29, #-20]
    ldr x0, [x29, #-16]
    ldr w0, [x0]
    ldr x1, [x29, #-8] // Cargar dirección en x1
    str w0, [x1] // Guardar valor en puntero
    ldr w0, [x29, #-20]
    ldr x1, [x29, #-16] // Cargar dirección en x1
    str w0, [x1] // Guardar valor en puntero
    b endif_22
    else_21:
    endif_22:

intercambioValoresValidado_epilogue_15:
    add sp, sp, #32
    ldp x29, x30, [sp], #16
    ret

.globl main
.type main, @function
.align 2

main:
    stp x29, x30, [sp, #-16]!
    mov x29, sp
    sub sp, sp, #80

    adrp x0, str_12
    add x0, x0, :lo12:str_12
    mov x1, x0
    adrp x0, str_13
    add x0, x0, :lo12:str_13
    bl printf
    adrp x0, str_14
    add x0, x0, :lo12:str_14
    bl printf
    adrp x0, str_15
    add x0, x0, :lo12:str_15
    mov x1, x0
    adrp x0, str_16
    add x0, x0, :lo12:str_16
    bl printf
    adrp x0, str_17
    add x0, x0, :lo12:str_17
    bl printf
    bl imprimirArbol
    adrp x0, str_18
    add x0, x0, :lo12:str_18
    mov x1, x0
    adrp x0, str_19
    add x0, x0, :lo12:str_19
    bl printf
    adrp x0, str_20
    add x0, x0, :lo12:str_20
    bl printf
    adrp x0, str_21
    add x0, x0, :lo12:str_21
    mov x1, x0
    adrp x0, str_22
    add x0, x0, :lo12:str_22
    bl printf
    adrp x0, str_23
    add x0, x0, :lo12:str_23
    bl printf
    adrp x0, str_24
    ldr s0, [x0, :lo12:str_24]
    str s0, [x29, #-8]
    adrp x0, str_25
    ldr s0, [x0, :lo12:str_25]
    str s0, [x29, #-16]
    ldr s0, [x29, #-16]
    fmov s1, s0
    ldr s0, [x29, #-8]
    bl calcularVolumenPiramide
    fcvt d0, s0
    adrp x0, str_26
    add x0, x0, :lo12:str_26
    bl printf
    adrp x0, str_27
    add x0, x0, :lo12:str_27
    bl printf
    adrp x0, str_28
    add x0, x0, :lo12:str_28
    mov x1, x0
    adrp x0, str_29
    add x0, x0, :lo12:str_29
    bl printf
    adrp x0, str_30
    add x0, x0, :lo12:str_30
    bl printf
    mov w0, #100
    str w0, [x29, #-4]
    mov w0, #200
    str w0, [x29, #-12]
    add x0, x29, #-4
    str x0, [x29, #-20]
    add x0, x29, #-12
    str x0, [x29, #-28]
    ldr x0, [x29, #-28]
    mov x1, x0
    ldr x0, [x29, #-20]
    bl intercambioValores
    adrp x0, str_31
    add x0, x0, :lo12:str_31
    mov x1, x0
    adrp x0, str_32
    add x0, x0, :lo12:str_32
    bl printf
    adrp x0, str_33
    add x0, x0, :lo12:str_33
    bl printf
    ldr w0, [x29, #-4]
    mov w1, w0
    adrp x0, str_34
    add x0, x0, :lo12:str_34
    bl printf
    adrp x0, str_35
    add x0, x0, :lo12:str_35
    bl printf
    ldr w0, [x29, #-12]
    mov w1, w0
    adrp x0, str_36
    add x0, x0, :lo12:str_36
    bl printf
    adrp x0, str_37
    add x0, x0, :lo12:str_37
    bl printf
    adrp x0, str_38
    add x0, x0, :lo12:str_38
    mov x1, x0
    adrp x0, str_39
    add x0, x0, :lo12:str_39
    bl printf
    adrp x0, str_40
    add x0, x0, :lo12:str_40
    bl printf
    adrp x0, str_41
    add x0, x0, :lo12:str_41
    mov x1, x0
    adrp x0, str_42
    add x0, x0, :lo12:str_42
    bl printf
    adrp x0, str_43
    add x0, x0, :lo12:str_43
    bl printf
    mov w0, #2
    str w0, [x29, #-20]
    mov w0, #8
    str w0, [x29, #-28]
    ldr w0, [x29, #-28]
    mov w1, w0
    ldr w0, [x29, #-20]
    bl potencia
    mov w1, w0
    adrp x0, str_44
    add x0, x0, :lo12:str_44
    bl printf
    adrp x0, str_45
    add x0, x0, :lo12:str_45
    bl printf
    adrp x0, str_46
    add x0, x0, :lo12:str_46
    mov x1, x0
    adrp x0, str_47
    add x0, x0, :lo12:str_47
    bl printf
    adrp x0, str_48
    add x0, x0, :lo12:str_48
    bl printf
    mov w0, #50
    str w0, [x29, #-20]
    mov w0, #30
    str w0, [x29, #-28]
    add x0, x29, #-20
    str x0, [x29, #-36]
    add x0, x29, #-28
    str x0, [x29, #-44]
    ldr x0, [x29, #-44]
    mov x1, x0
    ldr x0, [x29, #-36]
    bl intercambioValoresValidado
    adrp x0, str_49
    add x0, x0, :lo12:str_49
    mov x1, x0
    adrp x0, str_50
    add x0, x0, :lo12:str_50
    bl printf
    adrp x0, str_51
    add x0, x0, :lo12:str_51
    bl printf
    ldr w0, [x29, #-20]
    mov w1, w0
    adrp x0, str_52
    add x0, x0, :lo12:str_52
    bl printf
    adrp x0, str_53
    add x0, x0, :lo12:str_53
    bl printf
    ldr w0, [x29, #-28]
    mov w1, w0
    adrp x0, str_54
    add x0, x0, :lo12:str_54
    bl printf
    adrp x0, str_55
    add x0, x0, :lo12:str_55
    bl printf
    adrp x0, str_56
    add x0, x0, :lo12:str_56
    mov x1, x0
    adrp x0, str_57
    add x0, x0, :lo12:str_57
    bl printf
    adrp x0, str_58
    add x0, x0, :lo12:str_58
    bl printf
    mov w0, #48
    str w0, [x29, #-36]
    mov w0, #18
    str w0, [x29, #-44]
    ldr w0, [x29, #-44]
    mov w1, w0
    ldr w0, [x29, #-36]
    bl euclides
    str w0, [x29, #-36]
    mov x0, x1
    str w0, [x29, #-44]
    ldr w0, [x29, #-36]
    str w0, [x29, #-52]
    ldr w0, [x29, #-44]
    str w0, [x29, #-60]
    adrp x0, str_59
    add x0, x0, :lo12:str_59
    mov x1, x0
    adrp x0, str_60
    add x0, x0, :lo12:str_60
    bl printf
    adrp x0, str_61
    add x0, x0, :lo12:str_61
    bl printf
    ldr w0, [x29, #-52]
    mov w1, w0
    adrp x0, str_62
    add x0, x0, :lo12:str_62
    bl printf
    adrp x0, str_63
    add x0, x0, :lo12:str_63
    bl printf
    adrp x0, str_64
    add x0, x0, :lo12:str_64
    mov x1, x0
    adrp x0, str_65
    add x0, x0, :lo12:str_65
    bl printf
    adrp x0, str_66
    add x0, x0, :lo12:str_66
    bl printf
    ldr w0, [x29, #-60]
    mov w1, w0
    adrp x0, str_67
    add x0, x0, :lo12:str_67
    bl printf
    adrp x0, str_68
    add x0, x0, :lo12:str_68
    bl printf
    adrp x0, str_69
    add x0, x0, :lo12:str_69
    mov x1, x0
    adrp x0, str_70
    add x0, x0, :lo12:str_70
    bl printf
    adrp x0, str_71
    add x0, x0, :lo12:str_71
    bl printf
    adrp x0, str_72
    add x0, x0, :lo12:str_72
    mov x1, x0
    adrp x0, str_73
    add x0, x0, :lo12:str_73
    bl printf
    adrp x0, str_74
    add x0, x0, :lo12:str_74
    bl printf
    adrp x0, str_75
    add x0, x0, :lo12:str_75
    mov x1, x0
    adrp x0, str_76
    add x0, x0, :lo12:str_76
    bl printf
    adrp x0, str_77
    add x0, x0, :lo12:str_77
    bl printf
    adrp x0, str_78
    add x0, x0, :lo12:str_78
    str x0, [x29, #-72]
    adrp x0, str_79
    add x0, x0, :lo12:str_79
    mov x1, x0
    adrp x0, str_80
    add x0, x0, :lo12:str_80
    bl printf
    adrp x0, str_81
    add x0, x0, :lo12:str_81
    bl printf
    ldr x0, [x29, #-72]
    mov x1, x0
    mov x2, #0
    strlen_start_23:
    ldrb w3, [x1], #1
    cbz w3, strlen_end_24
    add x2, x2, #1
    b strlen_start_23
    strlen_end_24:
    mov x0, x2
    mov w1, w0
    adrp x0, str_82
    add x0, x0, :lo12:str_82
    bl printf
    adrp x0, str_83
    add x0, x0, :lo12:str_83
    bl printf
    adrp x0, str_84
    add x0, x0, :lo12:str_84
    mov x1, x0
    adrp x0, str_85
    add x0, x0, :lo12:str_85
    bl printf
    adrp x0, str_86
    add x0, x0, :lo12:str_86
    bl printf
    adrp x0, str_87
    add x0, x0, :lo12:str_87
    mov x1, x0
    adrp x0, str_88
    add x0, x0, :lo12:str_88
    bl printf
    adrp x0, str_89
    add x0, x0, :lo12:str_89
    bl printf
    adrp x0, str_90
    add x0, x0, :lo12:str_90
    mov x1, x0
    adrp x0, str_91
    add x0, x0, :lo12:str_91
    bl printf
    adrp x0, str_92
    add x0, x0, :lo12:str_92
    bl printf
    adrp x0, str_93
    add x0, x0, :lo12:str_93
    mov x1, x0
    adrp x0, str_94
    add x0, x0, :lo12:str_94
    bl printf
    adrp x0, str_95
    add x0, x0, :lo12:str_95
    bl printf
    adrp x0, str_96
    add x0, x0, :lo12:str_96
    mov x1, x0
    adrp x0, str_97
    add x0, x0, :lo12:str_97
    bl printf
    adrp x0, str_98
    add x0, x0, :lo12:str_98
    bl printf
    adrp x0, str_99
    add x0, x0, :lo12:str_99
    mov x19, x0  // Guardar string original
    mov w0, #0
    mov w20, w0  // Guardar inicio
    mov w0, #12
    mov w21, w0  // Guardar longitud
    cmp w20, #0
    b.lt substr_error_25
    cmp w21, #0
    b.le substr_error_25
    mov x1, x19
    mov x2, #0
    substr_strlen_28:
    ldrb w3, [x1], #1
    cbz w3, substr_strlen_end_29
    add x2, x2, #1
    b substr_strlen_28
    substr_strlen_end_29:
    mov x22, x2  // Longitud total
    cmp w20, w22
    b.ge substr_error_25
    add w23, w20, w21
    cmp w23, w22
    b.le substr_copy_26
    sub w21, w22, w20
    substr_copy_26:
    adrp x4, substr_buffer_0
    add x4, x4, :lo12:substr_buffer_0  // destino
    add x5, x19, w20, SXTW  // origen = string + inicio
    mov w6, w21  // cantidad a copiar
    mov x7, #0  // índice
    substr_copy_loop_30:
    cmp w7, w6
    b.ge substr_copy_end_31
    ldrb w8, [x5], #1
    strb w8, [x4], #1
    add w7, w7, #1
    b substr_copy_loop_30
    substr_copy_end_31:
    strb wzr, [x4]  // null terminator
    adrp x0, substr_buffer_0
    add x0, x0, :lo12:substr_buffer_0
    b substr_done_27
    substr_error_25:
    adrp x0, str_100
    add x0, x0, :lo12:str_100
    substr_done_27:
    mov x1, x0
    adrp x0, str_101
    add x0, x0, :lo12:str_101
    bl printf
    adrp x0, str_102
    add x0, x0, :lo12:str_102
    bl printf
    adrp x0, str_103
    add x0, x0, :lo12:str_103
    mov x1, x0
    adrp x0, str_104
    add x0, x0, :lo12:str_104
    bl printf
    adrp x0, str_105
    add x0, x0, :lo12:str_105
    bl printf
    adrp x0, str_106
    add x0, x0, :lo12:str_106
    mov x1, x0
    adrp x0, str_107
    add x0, x0, :lo12:str_107
    bl printf
    adrp x0, str_108
    add x0, x0, :lo12:str_108
    bl printf
    mov w0, #42
    adrp x0, str_109
    add x0, x0, :lo12:str_109
    mov x1, x0
    adrp x0, str_110
    add x0, x0, :lo12:str_110
    bl printf
    adrp x0, str_111
    add x0, x0, :lo12:str_111
    bl printf
    adrp x0, str_112
    add x0, x0, :lo12:str_112
    mov x1, x0
    adrp x0, str_113
    add x0, x0, :lo12:str_113
    bl printf
    adrp x0, str_114
    add x0, x0, :lo12:str_114
    bl printf
    adrp x0, str_115
    ldr s0, [x0, :lo12:str_115]
    adrp x0, str_116
    add x0, x0, :lo12:str_116
    mov x1, x0
    adrp x0, str_117
    add x0, x0, :lo12:str_117
    bl printf
    adrp x0, str_118
    add x0, x0, :lo12:str_118
    bl printf
    adrp x0, str_119
    add x0, x0, :lo12:str_119
    mov x1, x0
    adrp x0, str_120
    add x0, x0, :lo12:str_120
    bl printf
    adrp x0, str_121
    add x0, x0, :lo12:str_121
    bl printf
    mov w0, #1
    adrp x0, str_122
    add x0, x0, :lo12:str_122
    mov x1, x0
    adrp x0, str_123
    add x0, x0, :lo12:str_123
    bl printf
    adrp x0, str_124
    add x0, x0, :lo12:str_124
    bl printf
    adrp x0, str_125
    add x0, x0, :lo12:str_125
    mov x1, x0
    adrp x0, str_126
    add x0, x0, :lo12:str_126
    bl printf
    adrp x0, str_127
    add x0, x0, :lo12:str_127
    bl printf
    adrp x0, str_128
    add x0, x0, :lo12:str_128
    adrp x0, str_129
    add x0, x0, :lo12:str_129
    mov x1, x0
    adrp x0, str_130
    add x0, x0, :lo12:str_130
    bl printf
    adrp x0, str_131
    add x0, x0, :lo12:str_131
    bl printf
    adrp x0, str_132
    add x0, x0, :lo12:str_132
    mov x1, x0
    adrp x0, str_133
    add x0, x0, :lo12:str_133
    bl printf
    adrp x0, str_134
    add x0, x0, :lo12:str_134
    bl printf

    add sp, sp, #80
    ldp x29, x30, [sp], #16
    mov w0, #0
    ret
