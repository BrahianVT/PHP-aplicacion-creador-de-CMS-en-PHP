<?php include_once("includes/conexion.php"); ?>
<?php include_once("includes/funciones.php"); ?>
<?php buscar_pagina_sel();?>
<?php include("includes/header.php"); ?>
<table id = "estructura">
	     <tr>
			<td id = "navegacion">
				<?php echo navegacion_publica ($sel_topico_id, $sel_pagina_id);?>
			</td>
			<td id = "pagina">
				<?php if($sel_pagina_id){?>
			      <h2><?php echo $sel_pagina_id["nombre_menu"];?></h2>
				   <div class="pagina-contenido">
				   <?php echo strip_tags(nl2br($sel_pagina_id['contenido']),"<b><p><br><a>"); ?>
				   </div>
				 <?php } else {?>
					<h2> Sea usted bienvenido</h2
			     <?php }?>
			</td>
		 </tr>
	   </table>
<?php require("includes/footer.php") ?>
