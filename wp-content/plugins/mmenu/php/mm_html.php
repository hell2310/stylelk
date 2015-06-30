<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

session_start();

ini_set( 'display_errors', true );
error_reporting( E_ALL );


class MmHtml {

	protected function echo_title( $title, $class = '' )
	{
		echo '
		<h2 class="' . $class . '">' . $title . '</h2>';
	}
	protected function echo_nav_tabs()
	{
		echo '
			<div class="nav-tab-wrapper">';

		foreach( $this->tabs as $tab => $text )
		{
			echo '
				<a class="nav-tab' . ( $this->tab == $tab ? ' nav-tab-active' : '' ) . '" href="#tab-' . $tab . '">' . $text . '</a>';
		}
		echo '
	    	</div>';
	}
	protected function echo_form_opener( $id = '' )
	{
		if ( $id )
		{
			$id = ' id="' . $id . '"';
		}
		echo '
			<form' . $id . ' method="POST" action="options.php">';
		
		if ( isset( $this->tab ) )
		{
			echo '
				<input type="hidden" name="mm-tab" value="' . $this->tab . '" />';
		}

		settings_fields( 'mmenu-settings' );
		do_settings_sections( 'mmenu-settings' );
	}
	protected function echo_tab_opener( $tab )
	{
		if ( isset( $this->tabs[ $tab ] ) )
		{
			echo '
				<div id="tab-' . $tab . '" class="tab' . ( $this->tab == $tab	? ' tab-active' : '' ) . '">
					<h3>' . $this->tabs[ $tab ] . '</h3>';
		}
	}
	protected function echo_section_opener( $class = '' )
	{
		if ( strlen( $class ) > 0 )
		{
			$class = ' ' . $class;
		}
		echo '
					<div class="section' . $class . '">';
	}
	protected function echo_form_table_opener( $class = '' )
	{
		if ( strlen( $class ) > 0 )
		{
			$class = ' ' . $class;
		}
		echo '
						<table class="form-table' . $class . '">';
	}
	protected function echo_form_table_row( $th, $td, $class = false, $caret = false )
	{
		$class = ( $class )
			? ' class="' . $class . '"'
			: '';
		
		$last = ( $caret )
			? ' class="caret"'
			: '';

		$caret = ( $caret )
			? '<span class="dashicons dashicons-editor-help"></span>'
			: '';

		echo '
							<tr valign="top"' . $class . '>
								<th>' . $th . '</th>
								<td>' . $td . '</td>
								<td' . $last . '>' . $caret . '</td>
							</tr>';
	}
	protected function echo_form_table_closer()
	{
		echo '
						</table>';
	}
	protected function echo_section_closer()
	{
		echo '
					</div>';
	}
	protected function echo_tab_closer()
	{
		echo '
				</div>';
	}
	protected function echo_form_closer()
	{
		submit_button();
		echo '
			</form>';
	}
	
	protected function html_checkbox( $optn, $valu = 'yes', $type = 'checkbox' )
	{
		$v = $this->html_input_get_vars( $optn );
		$chck = ( $valu == $v[ 'value' ] );
		return '
			<input type="' . $type . '" name="' . $v[ 'name' ] . '" id="' . $v[ 'id' ] . '" value="' . $valu . '"' . ( $chck ? ' checked' : '' ) . ' />';
	}
	protected function html_input( $optn, $plch = '', $dflt = '', $type = 'text' )
	{
		$v = $this->html_input_get_vars( $optn );
		return '
			<input type="' . $type . '" name="' . $v[ 'name' ] . '" id="' . $v[ 'id' ] . '" value="' . esc_attr( $v[ 'value' ] ) . '"' . ( $plch ? ' placeholder="' . $plch . '"' : '' ) . ' />';
	}
	protected function html_textarea( $optn )
	{
		$v = $this->html_input_get_vars( $optn );
		return '
			<textarea name="' . $v[ 'name' ] . '" id="' . $v[ 'id' ] . '">' . esc_attr( $v[ 'value' ] ) . '</textarea>';
	}
	protected function html_select( $optn, $opts )
	{
		$v = $this->html_input_get_vars( $optn );
		$html = '
			<select name="' . $v[ 'name' ] . '" id="' . $v[ 'id' ] . '">';
		
		foreach( $opts as $valu => $text )
		{
			$html .= '
				<option value="' . $valu . '"' . ( ( $valu == $v[ 'value' ] ) ? ' selected' : '' ) . '>' . $text . '</option>';
		}
		$html .= '
			</select>';

		return $html;
	}
	private function html_input_get_vars( $optn )
	{
		return array(
			'id'	=> $optn[ 1 ] . '_' . $optn[ 2 ],
			'name' 	=> $optn[ 1 ] . '[' . $optn[ 2 ] . ']',
			'value'	=> isset( $optn[ 0 ][ $optn[ 2 ] ] ) ? $optn[ 0 ][ $optn[ 2 ] ] : ''
		);
	}
	
	protected function html_pre( $code )
	{
		return '
<pre>' . str_replace( array( '<', '>' ), array( '&lt;', '&gt;' ), $code ) . '
</pre>';
	}
}
