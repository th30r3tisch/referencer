<?php
// displays a description under the main_styling_section
function style_content_callback(){
	echo '<p>Here you can change the style of the contents.</p>';
}
// displays a description under the main_styling_section
function style_header_callback(){
	echo '<p>Here you can change the style of the header.</p>';
}
// displays a description under the main_styling_section
function main_callback(){
	echo '<p>Here you can make some general changes</p>';
}
// displays a description under the main_styling_section
function style_footer_callback(){
	echo '<p>Here you can change the style of the footer.</p>';
}

// add option to  upload a picture from the wordpress mediathek
function picUpload_callback($args){
	printf(
			'<div id="imageDialog">
				<input class="upload-button" type="button" class="button" value="Choose Image" />
				<input id="%1$s" type="text" name="%1$s[%2$s]" value="%3$s" size="62"/>
				<p></p>
				<p class="description">%4$s</p>
			 </div>',
			$args['option_name'],
			$args['name'],
			$args['value'],
			$args['description']
			);
}


// option to change colors
function color_callback($args){
	printf(
			'<div>
				<input name="%1$s[%2$s]" data-alpha="true" class="color-field" value="%3$s">
				<p></p>
				<p class="description">%4$s</p>
			 </div>',
			$args['option_name'],
			$args['name'],
			$args['value'],
			$args['description']
			);
}

// option for radio buttons
function radio_callback($args){
	printf(
		'Yes
		 <input type="radio" name="%1$s[%2$s]" value="true" %3$s/>
		 <input type="radio" name="%1$s[%2$s]" value="false" %4$s/> 
		 No
		 <p></p>
		 <p class="description">%5$s</p>',
		$args['option_name'],
		$args['name'],
		checked('true', $args['value'], false),	 	// returns "checked" if value equals "true"
		checked('false', $args['value'], false),	// returns "checked" if value equals "false"
		$args['description']
	);
}

// option to change meta description
function input_callback($args){
	printf(
			'<div>
				<textarea name="%1$s[%2$s]" value="%3$s">%3$s</textarea>
				<p></p>
				<p class="description">%4$s</p>
			 </div>',
			$args['option_name'],
			$args['name'],
			$args['value'],
			$args['description']
			);
}

// option to change the title of the page
function title_callback($args){
	printf(
			'<div>
				<input name="%1$s[%2$s]" value="%3$s">
				<p></p>
				<p class="description">%4$s</p>
			 </div>',
			$args['option_name'],
			$args['name'],
			$args['value'],
			$args['description']
			);
}