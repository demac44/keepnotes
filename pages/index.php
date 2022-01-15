<?php 
    if(!isset($_COOKIE['user-auth'])){
        header("Location: login.php");
    }
    else $user = $_COOKIE['user-auth'];

    require '../inc/notes_actions.php';

    $get_user = $conn->query("SELECT * FROM users WHERE username='$user'");

    foreach($get_user as $usr){
        $bckg_color = $usr['bckg_color'];
    }

?>

<?php 
    require '../inc/header.php';

    echo "<body style='background-color: $bckg_color;'>" 
?>
    <div class='navbar'>
        <form method='post' action='index.php' class='add-new-note'>
            <input type="hidden" name='new-note' value='new-note'>
            <button type='submit'>
                <i class='fas fa-plus'></i>
                <p>Add new note</p>
            </button>
        </form>
        <h1>KeepNotes</h1>
        <form class='log-out' method='post' action='index.php'>
            <input type="hidden" name='log-out' value='log-out'>
            <button class='log-out-btn' type='submit'>
                <p>Log out</p>
                <i class='fas fa-sign-out-alt'></i>
            </button>
        </form>     
    </div>
    <div class='notes'>
        <?php   
            include '../inc/sidebar.php';

            $note_colors = array("rgb(247, 243, 119)", "teal", "#7653bb", "chartreuse", "yellow", "#e63333", "#c562a4");

            
            function setNoteColors($clrs, $note){
                $temp = "";
                foreach($clrs as $clr){
                    $temp = $temp."
                    <form method='post' action='index.php'>
                        <input type='hidden' value='$clr' name='color[]'>
                        <input type='hidden' value='{$note["note_id"]}' name='changecolorid[]'>
                        <button type='submit' style='background-color:$clr;'></button>
                    </form>
                    ";
                }
                return $temp;
            }

            $notes = $conn->query($sql);

            foreach($notes as $note){
                echo " <div class='note' style='background-color: {$note['color']}'>
                        <form method='post' action='index.php'>
                            <input type='hidden' name='id[]' value={$note["note_id"]}>
                            <button class='del-btn' type='submit'><i class='fas fa-trash'></i></button>
                        </form>

                        <form method='post' action='index.php'>
                            <input type='hidden' name='update_id[]' value={$note["note_id"]}>
                            
                            <div class='note-title'>
                                <textarea type='text' name='title[]' id='title1' value='note-title'>{$note["note_title"]}</textarea>
                            </div>

                            <div class='note-text'>
                                <textarea name='text[]' id='text1' value='note_text'>{$note["note_text"]}</textarea>
                            </div>

                            <button class='update-btn' type='submit'>SAVE</button>
                        </form>

                        <div class='color-picker'>" , setNoteColors($note_colors, $note), "</div></div>";}
            ?>
        </div>
        <script src="https://kit.fontawesome.com/58812d83b9.js" crossorigin="anonymous"></script>
    </body>
</html>
