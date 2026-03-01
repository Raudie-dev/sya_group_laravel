<?php

namespace App\Helpers;

class PdfChartGenerator
{
    /**
     * Genera un gráfico de línea y lo devuelve como string base64 (PNG).
     *
     * @param  array  $valores     Array de floats con los datos
     * @param  array  $etiquetas   Array de strings para el eje X
     * @param  string $color       Color de la línea en formato 'R,G,B'
     * @param  string $titulo      Título del gráfico
     * @param  int    $width       Ancho en px
     * @param  int    $height      Alto en px
     * @return string              Data URI base64 para usar en src=""
     */
    public static function lineChart(
        array  $valores,
        array  $etiquetas = [],
        string $color     = '59,130,246',
        string $titulo    = '',
        int    $width     = 600,
        int    $height    = 200
    ): string {
        // ── Crear canvas ────────────────────────────────────────────────────
        $img = imagecreatetruecolor($width, $height);
        imagesavealpha($img, true);

        // ── Colores ─────────────────────────────────────────────────────────
        [$cr, $cg, $cb]  = array_map('intval', explode(',', $color));
        $cFondo          = imagecolorallocate($img, 248, 250, 252); // #f8fafc
        $cLinea          = imagecolorallocate($img, $cr, $cg, $cb);
        $cLinea2         = imagecolorallocate($img, (int)($cr * 0.6), (int)($cg * 0.6), (int)($cb * 0.6));
        $cGuia           = imagecolorallocate($img, 226, 232, 240); // #e2e8f0
        $cBorde          = imagecolorallocate($img, 203, 213, 225); // #cbd5e1
        $cTexto          = imagecolorallocate($img, 100, 116, 139); // #64748b
        $cTextoValor     = imagecolorallocate($img, $cr, $cg, $cb);
        $cPunto          = imagecolorallocate($img, $cr, $cg, $cb);
        $cPuntoBorde     = imagecolorallocate($img, 255, 255, 255);
        $cAreaFill       = imagecolorallocatealpha($img, $cr, $cg, $cb, 110); // relleno semitransparente

        // ── Rellenar fondo ──────────────────────────────────────────────────
        imagefilledrectangle($img, 0, 0, $width - 1, $height - 1, $cFondo);
        imagerectangle($img, 0, 0, $width - 1, $height - 1, $cBorde);

        // ── Márgenes del área de graficado ──────────────────────────────────
        $marginLeft   = 52;
        $marginRight  = 20;
        $marginTop    = 30;
        $marginBottom = 38;

        $chartW = $width  - $marginLeft - $marginRight;
        $chartH = $height - $marginTop  - $marginBottom;

        // ── Datos ───────────────────────────────────────────────────────────
        $count = count($valores);
        if ($count < 2) {
            // Devolver imagen vacía con mensaje
            $cMsg = imagecolorallocate($img, 150, 150, 150);
            imagestring($img, 3, $marginLeft, $height / 2 - 8, 'Insuficientes datos', $cMsg);
            return self::toBase64($img);
        }

        $min   = min($valores);
        $max   = max($valores);
        $range = ($max - $min) ?: 1;

        // Padding vertical del 15% para que los puntos no toquen el borde
        $padding = $range * 0.15;
        $minP    = $min - $padding;
        $maxP    = $max + $padding;
        $rangeP  = $maxP - $minP;

        // ── Helper: convertir valor a coordenada Y ───────────────────────────
        $toY = fn($v) => (int)round($marginTop + $chartH - (($v - $minP) / $rangeP) * $chartH);
        $toX = fn($i) => (int)round($marginLeft + ($i / ($count - 1)) * $chartW);

        // ── Líneas guía horizontales (5 guías) ───────────────────────────────
        for ($g = 0; $g <= 4; $g++) {
            $gy = (int)round($marginTop + ($g / 4) * $chartH);
            imageline($img, $marginLeft, $gy, $marginLeft + $chartW, $gy, $cGuia);

            // Etiqueta eje Y
            $yVal = $maxP - ($g / 4) * $rangeP;
            $label = number_format($yVal, 2);
            imagestring($img, 1, $marginLeft - 48, $gy - 6, $label, $cTexto);
        }

        // ── Línea base (eje X) ───────────────────────────────────────────────
        imageline($img, $marginLeft, $marginTop + $chartH,
                        $marginLeft + $chartW, $marginTop + $chartH, $cBorde);
        // Eje Y
        imageline($img, $marginLeft, $marginTop,
                        $marginLeft, $marginTop + $chartH, $cBorde);

        // ── Calcular coordenadas de puntos ───────────────────────────────────
        $coords = [];
        for ($i = 0; $i < $count; $i++) {
            $coords[] = ['x' => $toX($i), 'y' => $toY($valores[$i])];
        }

        // ── Área rellena (polígono) ──────────────────────────────────────────
        $poly = [];
        foreach ($coords as $c) {
            $poly[] = $c['x'];
            $poly[] = $c['y'];
        }
        // Cerrar el polígono por la base
        $poly[] = $toX($count - 1);
        $poly[] = $marginTop + $chartH;
        $poly[] = $toX(0);
        $poly[] = $marginTop + $chartH;

        imagefilledpolygon($img, $poly, $cAreaFill);

        // ── Línea principal ──────────────────────────────────────────────────
        for ($i = 0; $i < $count - 1; $i++) {
            // Línea gruesa: dibujar 3 veces con offset para simular grosor
            foreach ([-1, 0, 1] as $off) {
                imageline($img,
                    $coords[$i]['x'],     $coords[$i]['y']     + $off,
                    $coords[$i + 1]['x'], $coords[$i + 1]['y'] + $off,
                    $cLinea
                );
            }
        }

        // ── Puntos y etiquetas ───────────────────────────────────────────────
        foreach ($coords as $i => $c) {
            // Punto (círculo simulado con elipse rellena)
            imagefilledellipse($img, $c['x'], $c['y'], 10, 10, $cPuntoBorde);
            imagefilledellipse($img, $c['x'], $c['y'], 7,  7,  $cPunto);

            // Valor sobre el punto
            $vLabel = number_format($valores[$i], 2, ',', '');
            $tw     = strlen($vLabel) * imagefontwidth(1);
            imagestring($img, 1,
                $c['x'] - (int)($tw / 2),
                $c['y'] - 14,
                $vLabel,
                $cTextoValor
            );

            // Etiqueta eje X
            $xLabel = $etiquetas[$i] ?? ($i + 1);
            $xtw    = strlen((string)$xLabel) * imagefontwidth(1);
            imagestring($img, 1,
                $c['x'] - (int)($xtw / 2),
                $marginTop + $chartH + 5,
                (string)$xLabel,
                $cTexto
            );
        }

        // ── Título ───────────────────────────────────────────────────────────
        if ($titulo) {
            $tw = strlen($titulo) * imagefontwidth(2);
            imagestring($img, 2,
                (int)(($width - $tw) / 2),
                6,
                $titulo,
                $cTexto
            );
        }

        // ── Estadísticas en leyenda inferior ────────────────────────────────
        $leyenda = sprintf(
            'Min: %s   |   Max: %s   |   Media: %s',
            number_format($min, 2, ',', '.'),
            number_format($max, 2, ',', '.'),
            number_format(array_sum($valores) / $count, 2, ',', '.')
        );
        $lw = strlen($leyenda) * imagefontwidth(1);
        imagestring($img, 1,
            (int)(($width - $lw) / 2),
            $height - 14,
            $leyenda,
            $cTexto
        );

        return self::toBase64($img);
    }

    /**
     * Convierte un recurso GD a data URI base64.
     */
    private static function toBase64($img): string
    {
        ob_start();
        imagepng($img, null, 6); // compresión 6 (balance calidad/tamaño)
        $png = ob_get_clean();
        imagedestroy($img);

        return 'data:image/png;base64,' . base64_encode($png);
    }
}