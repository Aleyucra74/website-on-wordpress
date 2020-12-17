<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Vamos checar por uma capacidade
if ( !current_user_can( 'manage_options' ) )
  wp_die( 'Permissão de acesso insuficiente' );
 

$msg = '';
 
if($_POST){
	$retrieved_nonce = $_REQUEST['_wpnonce'];
	if (!wp_verify_nonce($retrieved_nonce, 'nonce_mascaras' ) ) die( 'Failed security check' );
	
	if(isset( $_POST['mask_phone']) ){ update_option('mask_phone', sanitize_text_field($_POST['mask_phone'])); }	/*
	if(isset( $_POST['mask_cpf'] ) && $_POST['mask_cpf'] == "1" ){ update_option('mask_cpf', "1"); }else{ update_option('mask_cpf', "0"); }
	if(isset( $_POST['mask_cnpj'] ) && $_POST['mask_cnpj'] == "1" ){ update_option('mask_cnpj', "1"); }else{ update_option('mask_cnpj', "0"); }
	if(isset( $_POST['mask_zipcode']) ){ update_option('mask_zipcode', sanitize_text_field($_POST['mask_zipcode'])); }
	*/
 $msg = '<div id="message" class="updated notice is-dismissible"><p>Configurações salvas!</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dispensar este aviso.</span></button></div>';
}
?>
<div class="wrap" id="mascarascf7-settings">
	<h2>Máscaras para o plugin Contact Form 7</h2>
	
	
	<div id="poststuff">
		<div id="post-body">
			<div class="mascarascf7-settings-grid mascarascf7-settings-main-cont">
				<?php echo $msg; ?>
				
				
				<div class="postbox">
					<h3 class="hndle"><label for="title">Configurações</label></h3>
					<div class="inside">
			
						<form action="" method="post">
							<?php wp_nonce_field('nonce_mascaras'); ?>
							<ul>
								<li><strong>Telefone</strong></li>
								<li style="padding-left: 10px;">
									<select id="mask_phone" name="mask_phone">
											<option value="" <?php if(get_option('mask_phone')==""){echo "selected='selected'";} ?>>Selecione uma opção</option>
											<option value="pt_BR" <?php if(get_option('mask_phone')=="pt_BR"){echo "selected='selected'";} ?>>Brasil: (XX) ?XXXX-XXXX</option>
											<option value="en_US" <?php if(get_option('mask_phone')=="en_US"){echo "selected='selected'";} ?>>US: (XXX) XXX-XXXX</option>
											<option value="en_US2" <?php if(get_option('mask_phone')=="en_US2"){echo "selected='selected'";} ?>>US: XXX-XXX-XXXX</option>
									</select>
								</li>
							</ul>
							<input type="submit" name="Submit" value="Salvar altera&ccedil;&otilde;es" class="button-primary" />
						</form>
		
		
					</div>
				</div>
			</div>
			
			<p>&nbsp;</p>
			<p style="">* Para utilizar a mascara de telefone no Contact Form 7, basta selecionar qual mascara você deseja utilizar na configuração acima e salvar. E também utilizar o campo tipo <strong>tel</strong> do Contact Form 7.</p>
			<p style="">* Para utilizar a máscara de CPF, basta usar a classe "cpf" no campo.</p>			<p style="">* Para utilizar a máscara de CPF sem os pontos, basta usar a classe "cpf2" no campo.</p>
			<p style="">* Para utilizar a máscara de CNPJ, basta usar a classe "cnpj" no campo.</p>			<p style="">* Para utilizar a máscara de CNPJ sem os pontos, basta usar a classe "cnpj2" no campo.</p>
			<p style="">* Para utilizar a máscara de CEP (00.000-000), basta usar a classe "cep" no campo.</p>
			<p style="">* Para utilizar a máscara de Zipcode (00000), basta usar a classe "zipcode" no campo.</p>			<p style="">* Para utilizar a máscara de Dinheiro (00.000.000,00), basta usar a classe "dinheiro" no campo.</p>			<p style="">* Para utilizar a máscara de Dinheiro (00,000,000.00), basta usar a classe "money" no campo.</p>			<p style="">&nbsp;</p>
			<div class="swpsmtp-yellow-box">Em caso de dúvidas, consulte a <a href="https://murilopereira.com.br/plugins/plugin-mascaras-cf7/" title="Abre em nova aba" target="_blank">Página no Plugin <span aria-hidden="true" class="dashicons dashicons-external" style="text-decoration:none;" title="Abre em nova aba"></span></a> </div>
		</div>
	</div>
	
	<div class="clear"></div>
	

</div>
<div class="clear"></div>