<?php
namespace BsBase\Library;

/**
 * @deprecated use BsFile module
 * @author Mat Wright <mat.wright@broadshout.com>
 *
 */
class BsImage
{

    /**
     *
     * @param resource $source
     * @param integer $x
     * @param integer $y
     * @param bool $proportions
     * @return resource Reduire la taille d'une image
     */
    public function resize($filename, $x = null, $y = null, $proportions = true)
    { 
        $image = file_get_contents($filename);
        $size = getimagesize($filename);
        $mime = $size['mime'];
        $width = $size[0];
        $height = $size[1];
        if (! is_null($x) && ! is_null($y)) {
            $new_x = $x;
            $new_y = $y;
        } elseif (! is_null($x) && true === $proportions) {
            $q = $width / $x;
            $new_x = $x;
            $new_y = $height / $q;
        } elseif (! is_null($y) && true === $proportions) {
            $q = $height / $y;
            $new_x = $width / $q;
            $new_y = $height;
        } else {
            $new_x = $x;
            $new_y = $y;
        }
        $imageType = null;
        switch ($mime) {
            case ('image/png'):
                $imagecreate = 'imagecreatefrompng';
                $imageprint = 'imagepng';
                break;
            case ('image/gif'):
                $imagecreate = 'imagecreatefromgif';
                $imageprint = 'imagegif';
                break;
            default:
                $imagecreate = 'imagecreatefromjpeg';
                $imageprint = 'imagejpeg';
                break;
        }

        $newImage = imagecreatetruecolor($new_x, $new_y);
        $source = $imagecreate($filename);
        // Redimensionnement
        $copyprocess = imagecopyresized($newImage, $source, 0, 0, 0, 0, $new_x, $new_y, $width, $height);
        // Capture de l'image
        /*
         * TODO http://www.php.net/manual/en/function.imagescale.php implementer version PHP 5.5
         */
        ob_start();
        $imageprint($newImage);
        $image = ob_get_contents();
        ob_end_clean();  
        return $image;
    }
}

?>