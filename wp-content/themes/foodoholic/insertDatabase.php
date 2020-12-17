<?php

/*Template Name: Insert*/

?>


<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Foodoholic
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">


            <div class="archive-content-wrap">

                <!-- wp:html -->
                <section>
                    <fieldset>
                        <form action="" method="post" class="txtfrm">
                            
                                Nome:<input type="text" maxlength="40" name="Nome" placeholder="Digite seu nome completo..." required> 
                                Telefone:<input type="tel" maxlength="15" placeholder="Telefone..." id="txtTele" name="Telefone" required> 
                               
                                 E-mail:<input type="email" maxlength="60" name="Email" placeholder="E-mail..." required> 
                                
                                Comentários:<textarea type="text" max-length="255" name="Comentarios" cows="45" rows="7" style="resize:none;"></textarea>

                                <button type="submit" name="insert" id="btnAlert"> Enviar </button>
                                
                            
                        </form>
                    </fieldset>
                </section>
                
                <?php
                
                    if(isset($_POST['insert'])){
               
                        $nome=$_POST['Nome'];
                        $telefone=$_POST['Telefone'];
                        $email=$_POST['Email'];
                        $coment=$_POST['Comentarios'];
                        
                            global $wpdb;
                            
                            //
                            $sql=$wpdb->insert("formulario",array("Nome"=>$nome,"Telefone"=>$telefone,"Email"=>$email,"Comentarios"=>$coment));
                        
                             if($sql==true) {
                                 echo "<script>alert('Dados enviado com sucesso.');</script>";
                                 
                                 unset($nome);
                                 unset($telefone);
                                 unset($email);
                                 unset($coment);
                                 
                                echo "<script language='JavaScript'> window.location='index.php'; </script>";
                               
                             } else {
                                 echo "<script>alert('Digite novamente');</script>";
                             }    

                    }

                    unset($nome);
                    unset($telefone);
                    unset($email);
                    unset($coment);
                 
                    //echo "<span href=insertDatabase.php></span>";
                ?>
                <!-- <script>
                    let alerta = document.getElementById('btnAlert');                                    
                    function mostrarAlert() {
                        alert('ola');
                    }
                </script> -->                
                <script type="text/javascript">
                    /* M?scaras ER */
                    function mascara(o, f) {
                        v_obj = o
                        v_fun = f
                        setTimeout("execmascara()", 1)
                    }

                    function execmascara() {
                        v_obj.value = v_fun(v_obj.value)
                    }

                    function mtel(v) {
                        v = v.replace(/\D/g, ""); //Remove tudo o que n?o ? d?gito
                        v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca par?nteses em volta dos dois primeiros d?gitos
                        v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca h?fen entre o quarto e o quinto d?gitos
                        return v;
                    }

                    function id(el) {
                        return document.getElementById(el);
                    }
                    window.onload = function () {
                        id('txtTele').onkeypress = function () {
                            mascara(this, mtel);
                        }
                    }
                </script>
                <!-- /wp:html -->

                <!-- wp:paragraph -->
                <p></p>
                <!-- /wp:paragraph -->

            </div>
            <!-- .archive-content-wrap -->
        </main>
        <!-- #main -->
    </div>
    <!-- #primary -->
    <?php get_sidebar(); ?>
        <?php
get_footer();