<?php
if( $data->title()->notEmpty() ) {
	echo '<strong>' . $data->caption() . '</strong></br>';
}
echo $data->source() . '.com/' . $data->videoid();
?>