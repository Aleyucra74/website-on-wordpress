<?php
/*
Plugin Name: Mascaras para CF7
Plugin URI: https://murilopereira.com.br/plugins/plugin-mascaras-cf7/
Description: Adicione máscaras de telefone, CPF, CNPJ, CEP ou Dinheiro nos campos do Contact Form 7 ou talvez qualquer Input de texto.
Version: 0.3.2
Author: Murilo Pinto Pereira
Author URI: https://www.murilopereira.com.br
*/
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



class MascarasCF7{
 
	public function ativar(){
		add_option('mask_phone', '');
	}
	
	public function desativar(){
		delete_option('mask_phone');
	}
	
	public function criarMenu(){
		add_menu_page('Mascaras para CF7', 'Mascaras para CF7',10, 'mascaras-para-cf7/mascaras-cf7-config.php','','dashicons-smiley');
	}


	public function adicionaMascaras(){
		$mask_phone = get_option('mask_phone');
		
		wp_enqueue_script( 'jquery.mask.min', plugin_dir_url( __FILE__ ) . '/js/jquery.mask.min.js', array('jquery'), '1.0.0');
		wp_enqueue_style( 'mascarascf7-css', plugin_dir_url( __FILE__ ) . '/css/style.css', array(), '1.0.0', 'all');
		wp_enqueue_script( 'cf7-masks', plugin_dir_url( __FILE__ ) . '/js/cf7-masks.js', array('jquery'), '1.0.0');
		
		if($mask_phone == 'pt_BR'){
			function cf_telefone_scripts() {
				wp_enqueue_script( 'cf7-telefone', plugin_dir_url( __FILE__ ) . '/js/cf7-telefone.js', array('jquery'), '1.0.0');
			}
			add_action( 'wp_enqueue_scripts', 'cf_telefone_scripts' );
		}else if($mask_phone == 'en_US'){
			function cf_telefone_scripts() {
				wp_enqueue_script( 'cf7-telefone-us', plugin_dir_url( __FILE__ ) . '/js/cf7-telefone-us.js', array('jquery'), '1.0.0');
			}
			add_action( 'wp_enqueue_scripts', 'cf_telefone_scripts' );
		}else if($mask_phone == 'en_US2'){
			function cf_telefone_scripts() {
				wp_enqueue_script( 'cf7-telefone-us', plugin_dir_url( __FILE__ ) . '/js/cf7-telefone-us2.js', array('jquery'), '1.0.0');
			}
			add_action( 'wp_enqueue_scripts', 'cf_telefone_scripts' );
		}
		
		
	}
	
}



/**
 * Adicionar links para a pagina de configuração na página de plugins
 * @param $links array() action links
 * @param $file  string  relative path to pugin "mascaras-para-cf7/mascaras-cf7-config.php"
 * @return $links array() action links
 */
if ( ! function_exists( 'MascarasCF7_plugin_action_links' ) ) {

    function MascarasCF7_plugin_action_links( $links, $file ) {
	/* Static so we don't call plugin_basename on every plugin row. */
	static $this_plugin;
	if ( ! $this_plugin ) {
	    $this_plugin = plugin_basename( __FILE__ );
	}
	if ( $file == $this_plugin ) {
	    $settings_link = '<a href="options-general.php?page=mascaras-para-cf7%2Fmascaras-cf7-config.php">' . __( 'Configurações', 'MascarasCF7' ) . '</a>';
	    array_unshift( $links, $settings_link );
	}
	return $links;
    }

}



$pathPlugin = substr(strrchr(dirname(__FILE__),DIRECTORY_SEPARATOR),1).DIRECTORY_SEPARATOR.basename(__FILE__);
 

// Função ativar
register_activation_hook( $pathPlugin, array('MascarasCF7','ativar'));
 
// Função desativar
register_deactivation_hook( $pathPlugin, array('MascarasCF7','desativar'));
 
//Ação de criar menu
add_action('admin_menu', array('MascarasCF7','criarMenu'));

/** Funcao de inicializacao */
add_filter('init', array('MascarasCF7','adicionaMascaras'));

add_filter( 'plugin_action_links', 'MascarasCF7_plugin_action_links', 10, 2 );
 
?>