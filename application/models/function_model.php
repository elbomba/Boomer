<?php

class Function_model extends CI_Model {
	public function __construct() {
		$this->load->model(array('post_model', 'menu_model'));
	}
	
	function printMessage() {
		return '
			<script type="text/javascript">
				$(document).ready(function() {
					$( "#dialog:ui-dialog" ).dialog( "destroy" );

					$( "#dialog-message" ).dialog({
						modal: true,
						buttons: {
							Ok: function() {
								$( this ).dialog( "close" );
							}
						}
					});
				});
			</script>
		';
	}
	
	// Funciona che stampa i menu
	function printMenu($root_menu, $nido) {
		//Stampo la modifica ed eliminazione
		echo '
			<tr class="menu-element">
			<td style="width: 20px;">
				<a href="'.base_url() .'admin/menu/modifica_voce/'. $root_menu->ID_menu_item .'" class="mod-icon">
					'. img('adds-on/icons/pencil.png') .'
				</a>
			</td>
			<td style="width: 20px;">
				<a href="'.base_url() .'admin/menu/elimina_voce/'. $root_menu->ID_menu_item .'" class="del-icon">
					'. img('adds-on/icons/delete.png') .'
				</a>
			</td>
			<td>
		';	
		
		for ($i=0; $i<$nido; $i++) {
			echo " - ";
		}
		echo $root_menu->menu_item_nome."<br>"; 
		
		//Stampo il nome della pagina associata
		echo '</td><td>';
		if ($root_menu->menu_item_link != 0) {
			$post = $this->post_model->get_post($root_menu->menu_item_link);
			echo '
				<a href="'.base_url().'admin/post/modifica_post/'.$post->ID_post.'" title="modifica '.$post->post_titolo.'">
					'.$post->post_titolo.'
				</a>
			';
			
		} else {
			echo "-";
		}
		
		//Stampo l'ordine del menu
		echo '
			</td><td style="text-align: center;">
			'.$root_menu->menu_item_ordine.'
		';
		
		//Chiudo la linea
		echo "</td></tr>";
		
		//se ha figli
		if ($this->menu_model->has_son($root_menu->ID_menu_item)) {
			$sons = $this->menu_model->get_son($root_menu->ID_menu_item);
			foreach ($sons->result() as $row) {
				$this->function_model->printMenu($row, $nido+1);
			}
		}
	}
	
	function printMenusOptions($root_menu, $nido) {
		//Variabile con nome da stampare
		for ($i=0; $i<$nido; $i++){
			$stamp .= " - "; 
		}
		$stamp .= $root_menu->menu_item_nome; 
		
		//Stampo la voce di menu
		echo '
			<option value="'.$root_menu->ID_menu_item.'" id="men_'.$root_menu->ID_menu_item.'">
				'.$stamp.'
			</option>
		';
		
		//se ha figli
		if ($this->menu_model->has_son($root_menu->ID_menu_item)) {
			$sons = $this->menu_model->get_son($root_menu->ID_menu_item);
			foreach($sons->result() as $row) {
				$this->function_model->printMenusOptions($row, $nido+1);
			}
		}
	}
	
	function printPossibleMenusOptions($root_menu, $nido, $possible_menus) {
		$stamp = "";
		//Variabile con nome da stampare
		for ($i=0; $i<$nido; $i++) {
			$stamp .= " - ";
		}
		$stamp .= $root_menu->menu_item_nome;
		
		//Vedo se è un menu possibile
		if (in_array($root_menu->ID_menu_item, $possible_menus)) {
			//Si può stampare
			//Stampo la voce di menu
			echo '
				<option value="'.$root_menu->ID_menu_item.'" id="men_'.$root_menu->ID_menu_item.'">
					'.$stamp.'
				</option>
			';

			//Se ha figli
			if ($this->menu_model->has_son($root_menu->ID_menu_item)) {
				$sons = $this->menu_model->get_son($root_menu->ID_menu_item);
				foreach($sons->result() as $row) {
					$this->function_model->printPossibleMenusOptions($row, $nido+1, $possible_menus);
				}
			}
		}
	}

	//		POST
	function printPost($root_post, $nido) {
		//Stampo la modifica ed eliminazione
		echo '
			<tr class="post-element">
			<td style="width: 20px;">
				<a href="'.base_url() .'admin/post/modifica_post/'. $root_post->ID_post .'" class="mod-icon">
					'. img('adds-on/icons/pencil.png') .'
				</a>
			</td>
			<td style="width: 20px;">
				<a href="'.base_url() .'admin/post/elimina_post/'. $root_post->ID_post .'" class="del-icon">
					'. img('adds-on/icons/delete.png') .'
				</a>
			</td>
			<td>
		';	
		
		for ($i=0; $i<$nido; $i++) {
			echo " - ";
		}
		echo '
			'.$root_post->post_titolo.'
			</td>
			<td>
				'.$this->categorie_model->get_categoria($root_post->post_tipo)->categoria_nome.'
			</td>
			<td>
		';
		// Vedo del genitore
		if ($root_post->post_genitore != 0) {
			echo $this->post_model->get_post($root_post->post_genitore)->post_titolo;
		} else {
			echo " - ";
		}
		//Autore
		echo '
			</td>
			<td>	
		'.$this->utenti_model->get_user($root_post->post_autore)->user_login.'
			</td>
			<td>
		';
		//Vedo lo stato del post
		if ($root_post->post_stato == 1) {
			echo "Pubblicato";
		} else {
			echo "Non Pubblicato";
		}
		echo '
			</td>
		';
		
		//Data
		echo '
			<td>'.$root_post->post_data.'</td>
		';
		
		//Stampo l'ordine
		echo '
			<td style="text-align: center;">
			'.$root_post->post_ordine.'
		';
		
		//Chiudo la linea
		echo "</td></tr>";
		
		//se ha figli
		if ($this->post_model->has_son($root_post->ID_post)) {
			$sons = $this->post_model->get_son($root_post->ID_post);
			foreach ($sons->result() as $row) {
				$this->function_model->printPost($row, $nido+1);
			}
		}
	}
	
	function printPostsOptions($root_post, $nido) {
		$stamp = "";
		//Variabile con nome da stampare
		for ($i=0; $i<$nido; $i++){
			$stamp .= " - "; 
		}
		$stamp .= $root_post->post_titolo; 
		
		//Stampo la voce di menu
		echo '
			<option value="'.$root_post->ID_post.'" id="post_'.$root_post->ID_post.'">
				'.$stamp.'
			</option>
		';
		
		//se ha figli
		if ($this->post_model->has_son($root_post->ID_post)) {
			$sons = $this->post_model->get_son($root_post->ID_post);
			foreach($sons->result() as $row) {
				$this->function_model->printPostsOptions($row, $nido+1);
			}
		}
	}
	
	function printPossiblePostsOptions($root_post, $nido, $possible_posts) {
		//Variabile con nome da stampare
		for ($i=0; $i<$nido; $i++) {
			$stamp .= " - ";
		}
		$stamp .= $root_post->post_titolo;
		
		//Vedo se è un menu possibile
		if (in_array($root_post->ID_post, $possible_posts)) {
			//Si può stampare
			//Stampo la voce di menu
			echo '
				<option value="'.$root_post->ID_post.'" id="post_'.$root_post->ID_post.'">
					'.$stamp.'
				</option>
			';

			//Se ha figli
			if ($this->post_model->has_son($root_post->ID_post)) {
				$sons = $this->post_model->get_son($root_post->ID_post);
				foreach($sons->result() as $row) {
					$this->function_model->printPossiblePostsOptions($row, $nido+1, $possible_posts);
				}
			}
		}
	}
	
	
	/*------------------------------------------------------------------------------------------------------
	 * Functions that print the menu in the user view
	 *------------------------------------------------------------------------------------------------------
	 */
	
	/*
	 * Function that retrive the Url of a page
	 */
	public function get_url($page_id, $url = "") {
		$page = $this->post_model->get_post($page_id);
		if($page->post_genitore != 0) {
			// Ha un genitore
			$url = $page->post_url_nome."/".$url;
			$url = $this->function_model->get_url($page->post_genitore).$url;
		} else {
			// Non ha un genitore
			// Ultima pagina
			$url = $page->post_url_nome."/".$url;
		}
		return $url;
	}
	
	/*
	 * For the user use part, could accept the name of menu or the id
	 * $sublevels represent the number of sub menu it will be showed
	 * The level is the submenu level for the menu
	 */
	public function print_menu($menu, $sublevels = 0, $home = false) {
		// Stampo anche la home ?
		if ($home) {
			echo '<a href="'.base_url().'"><div class="menu-item">Home</div></a>';
		}
		// Retriving the menu id
		$id_menu = $this->menu_model->get_menu($menu)->ID_menu;
		$root_items = $this->menu_model->get_root_menu_items($id_menu);
		foreach($root_items->result() as $row) {
			// Vedo se la voce di menu è collegata ad una pagina
			if (!$this->menu_model->has_page_linked($row->ID_menu_item)) {
				echo '<a href="#"><div class="menu-item">'.$row->menu_item_nome.'</div></a>';
			} else {
				$page_link = $this->menu_model->get_page_linked($row->ID_menu_item);
				echo '<a href="'.base_url().
					$this->function_model->get_url($page_link)
				.'"><div class="menu-item">'.$row->menu_item_nome.'</div></a>';
			}
			if($this->menu_model->has_son($row->ID_menu_item) && $sublevels > 0) {
				// Stampo il container del sub-menu
				echo '<div id="sub-'.$row->menu_item_nome.'" class="sub-menu">';
				// Stampo gli oggetti del sub menu passando il menu padre
				$this->function_model->print_sub_menu($row->ID_menu_item, $sublevels, 1); 
				// Chiudo il container
				echo '</div>';
			}
		}
	}
	
	public function print_sub_menu($father, $sublevels, $actualsublevel) {
		$classname = "";
		if ($actualsublevel <= $sublevels) {
			// Recupero i menu
			$sons = $this->menu_model->get_son($father);
			// Class name
			for($i=0; $i<$actualsublevel; $i++){$classname .= "sub-";}
			// Stampo i menu
			foreach($sons->result() as $row) {
				// Vedo se la voce di menu è collegata ad una pagina
				if (!$this->menu_model->has_page_linked($row->ID_menu_item)) {
					echo '<a href="#"><div class="menu-item">'.$row->menu_item_nome.'</div></a>';
				} else {
					$page_link = $this->menu_model->get_page_linked($row->ID_menu_item);
					echo '<a href="'.base_url().
						$this->function_model->get_url($page_link)
					.'"><div class="menu-item">'.$row->menu_item_nome.'</div></a>';
				}
				if($this->menu_model->has_son($row->ID_menu_item) && ($actualsublevel+1) <= $sublevels) {
					// Stampo il container del sub-menu
					echo '<div id="'.$classname.$row->menu_item_nome.'" class="'.$classname.'menu">';
					// Stampo gli oggetti del sub menu passando il menu padre
					$this->function_model->print_sub_menu($row->ID_menu_item, $sublevels, $actualsublevel+1); 
					// Chiudo il container
					echo '</div>';
				}
			}
		}
	}
	
	public function print_news($num = 0) {
		$news = $this->post_model->get_posts(3); // 3 is the news category id
		$n = 0;
		foreach($news->result() as $row) {
			if ($num == 0) {
				echo '<a href="'.base_url().$this->get_url($row->ID_post).'">';
				echo '<div class="news-element">';
				echo '<div class="element-title">'.$row->post_titolo.'</div>';
				echo '<div class="element-data">'.$row->post_data.'</div>';
				echo '<div class="element-content">'.$row->post_content.'</div>';
				echo '</div>';
				echo '</a>';
			} else {
				if ($n < $num) {
					echo '<a href="'.base_url().$this->get_url($row->ID_post).'">';
					echo '<div class="news-element">';
					echo '<div class="element-title">'.$row->post_titolo.'</div>';
					echo '<div class="element-data">'.$row->post_data.'</div>';
					echo '<div class="element-content">'.$row->post_content.'</div>';
					echo '</div>';
					echo '</a>';
				}
			}
			$n++;
		}
	}
	
	public function print_promo() {
		$promo = $this->post_model->get_posts(4); // 4 is the prom category id
		foreach($promo->result() as $row) {
			echo '<div class="promo-element">';
			echo '<div class="element-title">'.$row->post_titolo.'</div>';
			echo '<div class="element-data">
				Dal: '.$row->post_data_da.'<br>
				Al: '.$row->post_data_a.'
				</div>';
			echo '<div class="element-content">'.$row->post_content.'</div>';
			echo '</div>';
		}
	}
}

?>