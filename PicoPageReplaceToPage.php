<?php


/**
* Строит списки файлов
*
* @author chomovva
* @license http://opensource.org/licenses/MIT
*/
class PicoPageReplaceToPage extends AbstractPicoPlugin {


	const API_VERSION = 3;


	protected $enabled = true;


	public function onPageRendering( string &$templateName, array &$twigVariables ) {
		$pico = $this->getPico();
		if (
			true
			&& array_key_exists( 'replace_to', $twigVariables[ 'current_page' ][ 'meta' ] )
			&& array_key_exists( $twigVariables[ 'current_page' ][ 'meta' ][ 'replace_to' ], $twigVariables[ 'pages' ] )
			&& file_exists( $path_to = $pico->resolveFilePath( 'documetns/2006-01-18-03-05' ) )
		) {
			$template = $twigVariables[ 'pages' ][ $twigVariables[ 'current_page' ][ 'meta' ][ 'replace_to' ] ][ 'meta' ][ 'template' ];
			if ( file_exists( $twigVariables[ 'theme_dir' ] . '/' . $template . '.twig' ) ) {
				$templateName = $template . '.twig';
			} elseif ( file_exists( $twigVariables[ 'theme_dir' ] . '/' . $template . '.html' ) ) {
				$templateName = $template . '.html';
			}
			$twigVariables[ 'meta' ] = array_merge( $twigVariables[ 'meta' ], $twigVariables[ 'pages' ][ $twigVariables[ 'current_page' ][ 'meta' ][ 'replace_to' ] ][ 'meta' ] );
			$twigVariables[ 'current_page' ][ 'author' ] = $twigVariables[ 'pages' ][ $twigVariables[ 'current_page' ][ 'meta' ][ 'replace_to' ] ][ 'author' ];
			$twigVariables[ 'current_page' ][ 'time' ] = $twigVariables[ 'pages' ][ $twigVariables[ 'current_page' ][ 'meta' ][ 'replace_to' ] ][ 'time' ];
			$twigVariables[ 'current_page' ][ 'date' ] = $twigVariables[ 'pages' ][ $twigVariables[ 'current_page' ][ 'meta' ][ 'replace_to' ] ][ 'date' ];
			$twigVariables[ 'current_page' ][ 'date_formatted' ] = $twigVariables[ 'pages' ][ $twigVariables[ 'current_page' ][ 'meta' ][ 'replace_to' ] ][ 'date_formatted' ];
			$twigVariables[ 'current_page' ][ 'meta' ] = array_merge( $twigVariables[ 'current_page' ][ 'meta' ], $twigVariables[ 'pages' ][ $twigVariables[ 'current_page' ][ 'meta' ][ 'replace_to' ] ][ 'meta' ] );
			$twigVariables[ 'content' ] = $pico->parseFileContent( $pico->prepareFileContent( file_get_contents( $path_to ) ) );
		}
		$pico = $this->getPico();
	}


}