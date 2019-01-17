<?php
echo '<strong>';
$space = $data->space();
$location = $data->location();
$year = $data->year();
if( $space->isNotEmpty() ) {
	echo $space;
	if( $year->isNotEmpty() ) {
		echo ', ';
	}
}
if( $year->isNotEmpty() ) {
	echo $year;
}
if( $location->isNotEmpty() ) {
	echo ' (' . $location . ')';
}
echo '</strong>';
?>