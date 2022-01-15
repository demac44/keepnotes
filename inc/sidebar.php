<?php 
    $bckg_colors = array("#1b1b1b", "rgb(11,64,111)", "#166f4d", "#0a9b16", "#9fc515", "#80583c", "#ed5401", "#9e3030", "#692e70", );

    function setBckgColors($bclrs){
        $temp = "";
        foreach($bclrs as $bclr){
            $temp = $temp."
            <form action='index.php' method='post'>
                <input type='hidden' name='bckg-color[]' value='$bclr'>
                <button style='background-color: $bclr;' type='submit'></button>
            </form>
            ";
        }
        return $temp;
    }


    echo "<div class='sidebar'>", setBckgColors($bckg_colors), "</div>";
?>
