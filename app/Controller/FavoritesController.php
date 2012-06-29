<?php
App::uses('AppController', 'Controller');
/**
 * Favorites Controller
 *
 */
class FavoritesController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Favorite -> Behaviors -> attach('Containable');
		$this -> Favorite -> contain('FavoriteItem', 'FavoriteItem.Product', 'FavoriteItem.ProductSize');
		$this -> Auth -> Allow('get', 'emptyFavorite', 'addFavoriteItem', 'removeFavoriteItem', 'borrarFavoritos');
	}
	
	public function borrarFavoritos() {
		$this -> autoRender = false;
		$favoritos = $this -> Favorite -> find('list');
		foreach ($favoritos as $key => $id) {
			$this -> Favorite -> delete($id);
		}
	}
	
	private function getUserId() {
		return $this -> Auth -> user('id');
	}
	
	/**
	 * Obtener el carrito
	 * 
	 * @return Información del carrito
	 */
	public function get() {
		$user_id = $this -> getUserId(); 
		if($user_id) {
			/** hay usuario logueado **/
			$favorite = $this -> Favorite -> findByUserId($user_id);
			if($favorite) {
				return $favorite;
			} else {
				$this -> Favorite -> create();
				$favorite = array('Favorite' => array('user_id' => $user_id));
				if($this -> Favorite -> save($favorite)) {
					return $this -> Favorite -> read(null, $this -> Favorite -> id);
				} else {
					return array('success' => false, 'message' => 'error al crear favoritos');
				}
			}
		} else {
			// no hay usuario logueado
			return array('success' => false, 'message' => 'se debe estar logueado para usar favoritos');
		}
	}
	
	public function addFavoriteItem($product_id = null, $color_id = null, $product_size_id = null) {
		$this -> autoRender = false;
		//Configure::write('debug', 0);
		if($product_id && $color_id && $product_size_id) {
			/** llegó la info proceder a guardar **/
			$favorite = $this -> get();
			if($favorite) {
				/** carrito existe, agregar el ítem; verificar primero si ya existe el ítem en el carrito **/
				$favorite_item = $this -> Favorite -> FavoriteItem -> find(
					'first',
					array(
						'conditions' => array(
							'FavoriteItem.favorite_id' => $favorite['Favorite']['id'],
							'FavoriteItem.product_id' => $product_id,
							'FavoriteItem.color_id' => $color_id,
							'FavoriteItem.product_size_id' => $product_size_id
						),
						'recursive' => -1
					)
				);
				if($favorite_item) {
					$favorite = $this -> get();
					$favorite['success'] = false;
					$favorite['message'] = 'El ítem ya esta en favoritos';
					echo json_encode($favorite);					
				} else {
					// No existe el ítem, crear
					$favorite_item = array(
						'favorite_id' => $favorite['Favorite']['id'],
						'product_id' => $product_id,
						'color_id' => $color_id,
						'product_size_id' => $product_size_id
					);
					$this -> Favorite -> FavoriteItem -> create();
					if($this -> Favorite -> FavoriteItem -> save($favorite_item)) {
						$favorite = $this -> get();
						$favorite['success'] = true;
					} else {
						$favorite = $this -> get();
						$favorite['success'] = false;
						$favorite['message'] = 'Error a la hora de guardar el favorito';
					}
					echo json_encode($favorite);
				}
			} else {
				echo json_encode(array('success' => false, 'message' => 'No hay favoritos asociado en el momento')); // No existe el carrito
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'Error en los datos pasados')); // Error en los datos pasados al método
		}
		exit(0);
	}
	
	public function removeFavoriteItem($favorite_item_id = null) {
		$this -> autoRender = false;
		Configure::write('debug', 0);
		if($favorite_item_id) {
			$favorite = $this -> get();
			if($favorite) {
				/** carrito existe, verificar si el item es del carrito del usuario, borrar si sí **/
				$this -> Favorite -> FavoriteItem -> recursive = -1;
				$favorite_item = $this -> Favorite -> FavoriteItem -> read(null, $favorite_item_id);
				if($favorite_item['FavoriteItem']['favorite_id'] == $favorite['Favorite']['id']) {
					if($this -> Favorite -> FavoriteItem -> delete($favorite_item_id)) {
						$favorite = $this -> get();
						$favorite['success'] = true;
						echo json_encode($favorite);
					} else {
						$favorite = $this -> get();
						$favorite['success'] = false;
						$favorite['message'] = 'No se pudo eliminar el favorito';
						echo json_encode($favorite);
					}
				} else {
					$favorite = $this -> get();
					$favorite['success'] = false;
					$favorite['message'] = 'No coincide el favoritos actual con el favorito del ítem';
					echo json_encode($favorite);
				}
			}
		} else {
			echo json_encode(array('success' => false, 'message' => 'No hay favorito asociado en el momento'));
		}
		exit(0);
	}
	
	public function emptyFavorite() {
		$favorite = $this -> get();
		$favoriteItems = $this -> Favorite -> FavoriteItem -> find(
			'list',
			array(
				'conditions' => array(
					'FavoriteItem.favorite_id' => $favorite['Favorite']['id']
				)
			)
		);
		foreach ($favoriteItems as $key => $id) {
			$this -> Favorite -> FavoriteItem -> delete($id);
		}
	}

}