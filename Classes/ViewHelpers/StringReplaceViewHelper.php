
<?php

class Tx_LbOsm_ViewHelpers_StringReplaceViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {
    /**
     * Replace the $searchFor string with $replaceString in $string
     *
     * @param $string string
     * @param $searchFor string
     * @param $replaceWith string
     * @return string
     */
    public function render($string, $searchFor, $replaceWith) {
        return str_replace($searchFor, $replaceWith, $string);
    }
}

?>
