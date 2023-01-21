<?php

// get the fields from the ACF group
if (get_field('sfof-bill_id')) {
	/*$billID = get_field('sfof-bill_id');
	$title = get_the_title();
	if ( get_field('sfof-alt_title') ) {
		$title = get_field('sfof-alt_title');
	}
	echo '<script src="https://www.billtrack50.com/js/bt50.widget.bill.min.js" type="text/javascript"></script>';
	echo '<script type="text/javascript">';
	 echo 'BT50.Widget({';
		echo 'apiKey:  "0e175535-e52f-4772-b45c-119bd3c72e57",';
		echo 'billSheet:  '.$billID.',';
		echo 'title:  '.$title.',';
		echo 'stateFilter: '',';
		echo 'rows: 50,';
		echo 'tForeground: "#f4f4f4",';
		echo 'tBackground: "#19436b",';
		echo 'borderColor: "#dddddd",';
		echo 'showPosition: false,';
		echo 'height:  "500px",';
		echo 'width:  "100%",';
		echo 'sortBy: "0",';
		echo 'sortDir: "desc"';
	  echo '});';
	echo '</script>';*/
	echo '<div id="BT50Widget"></div>';


}

?>
