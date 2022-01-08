<?php
/* drawing colors (except background) */
$colors = [
	[220, 20, 60], [255, 0, 0], [178, 34, 34], [139, 0, 0],
	[139, 0, 139], [128, 0, 128], [75, 0, 130], [72, 61, 139],
	[0, 100, 0], [85, 107, 47], [0, 139, 139], [0, 128, 128],
	[70, 130, 180], [0, 0, 255], [0, 0, 205], [0, 0, 139],
	[0, 0, 128], [25, 25, 112], [139, 69, 19], [165, 42, 42],
	[128, 0, 0], [47, 79, 79] ];

/* create a blank image */
$width = 130;
$height = 50;
$image = imagecreatetruecolor($width, $height);
$bkg_color = imagecolorallocate($image, 253, 235, 208);
imagefill($image, 0, 0, $bkg_color); /* background color */

/* apply background noise */
$image_size = ['w' => $width, 'h' => $height];
drawLinesEllipses($image, $image_size, 'lines', $colors);
drawLinesEllipses($image, $image_size, 'ellipses', $colors);

/* add math question */
$num_1 =  mt_rand(0, 15);
$num_2 =  mt_rand(0, 15);
$font = 'arial.ttf';
$size = 20;

/* operator */
$center = [
    'x' => $width/2 - imagefontwidth($size),
    'y' => $height - imagefontheight($size)
];
$color = imagecolorallocate($image, 66, 0, 17);
imagettftext($image, $size, 0, $center['x'], $center['y'], $color, $font, '+');

/* 1st operand */
drawDigit($image, $num_1, -1, $center, $font, $colors);
/* 2nd operand */
drawDigit($image, $num_2, 1, $center, $font, $colors);
/* end add question */

/* apply filters */
imagefilter($image, IMG_FILTER_SELECTIVE_BLUR);
imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
imagefilter($image, IMG_FILTER_SMOOTH, IMG_FILTER_PIXELATE);
imagefilter($image, IMG_FILTER_PIXELATE, 2);

/* save image */
imagejpeg($image, '../images/captcha.jpg');

/* free up memory */
imagedestroy($image);



/**
 * Draws 10 lines and between 3..5 ellipses for background noise.
 * Base colors are the same than 'math' question's, but with a lighter presentation.
 *
 * @param GdImage $im Image being drawn.
 * @param string $elem 'lines' or 'ellipses'.
 * @param TwoDimensionalArray $colors Available colors for drawing.
 */
function drawLinesEllipses($im, $im_size, $elem, $colors) {
    imagesetthickness($im, 0);
    $total_elems = ($elem === 'lines' ? 10 : mt_rand(3, 5)); /* number of lines/ellipses */
    $total_colors = count($colors);

    for ($i=0; $i < $total_elems; $i++) {
        $clr_ar = $colors[mt_rand(0, $total_colors - 1)]; /* vary color */
        $color = imagecolorallocatealpha($im, $clr_ar[0], $clr_ar[1], $clr_ar[2], mt_rand(70, 80));

        $x = mt_rand(1, $im_size['w']);
        $y = mt_rand(1, $im_size['h']);

        if ($elem === 'lines') {
            $x2 = mt_rand(1, $im_size['w']);
            $y2 = mt_rand(1, $im_size['h']);
            imageline($im, $x, $y, $x2, $y2, $color);
        } else {
            $width = mt_rand(10, 15);
            $height = mt_rand(10, 15);
            imageellipse($im, $x, $y, $width, $height, $color);
        }
    }
}

/**
 * Draws each digit on the image.
 * Drawing starts from center, and digits are shift to left (-1, 1st operand) or
 * to right (1, 2nd operand).
 *
 * @param GdImage $im Image being drawn.
 * @param int $num Number to draw.
 * @param int $h_align -1 to first operand, 1 to second operand.
 * @param AssociativeArray $center (x, y) coordinates of image center.
 * @param string $font Font filename.
 * @param TwoDimensionalArray $colors Available colors for digits.
 */
function drawDigit($im, $num, $h_align, $center, $font, $colors) {
    $x = $center['x'] + $h_align * 18; /* spacing around center ('+') */
    if ($h_align === -1) {
        /* 1st operand - draw number in reverse */
        $num = strrev(strval($num));
    }
    $total_colors = count($colors);
    shuffle($colors);

    foreach (str_split($num) as $index => $digit) {
        $size = mt_rand(18, 22); /* vary size */
        $x = $x + ($index + 1) * $h_align * imagefontwidth($size);

        $v_align = (mt_rand(1, 2) === 1 ? -1 : 1); /* vary above/below center */
        $y = $center['y'] + $v_align * intdiv(imagefontheight($size), 3);

        $angle = mt_rand(-30, 30); /* tilt digit */

        $clr_ar = $colors[mt_rand(0, $total_colors - 1)]; /* vary color */
        $color = imagecolorallocate($im, $clr_ar[0], $clr_ar[1], $clr_ar[2]);

        imagettftext($im, $size, $angle, $x, $y, $color, $font, $digit);
    }
}