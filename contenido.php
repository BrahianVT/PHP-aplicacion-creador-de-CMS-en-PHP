<?php include_once("includes/conexion.php"); ?>
<?php include_once("includes/funciones.php"); ?>
<?php buscar_pagina_sel();?>
<?php include("includes/header.php"); ?>
	   <table id = "estructura">
	     <tr>
			<td id = "navegacion">
				<ul class = "topicos">
			    <?php navegacion($sel_topico_id , $sel_pagina_id);  ?>
				</ul>
				<br />
				<a href = "nuevo_topico.php">Agregar nuevo topico</a>
			</td>
			<td id = "pagina">
				<?php if(!is_null($sel_topico_id)){?>
			      <h2><?php echo $sel_topico_id["nombre_menu"];?></h2>
				 <?php } elseif(!is_null($sel_pagina_id)){?>
			       <h2><?php echo $sel_pagina_id["nombre_menu"];?></h2>
				   <div class="contenido_pag">
				   <?php echo $sel_pagina_id['contenido']; ?>
				   </div>
				 <?php } else {?>
					<h2> Seleccione una seccion</h2
			     <?php }?>
			</td>
		 </tr>
	   </table>
	</div>
<?php require("includes/footer.php") ?>
