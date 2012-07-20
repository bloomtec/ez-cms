<?php
App::uses('AppController', 'Controller');
/**
 * Promotions Controller
 *
 * @property Promotion $Promotion
 */
class PromotionsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('getPromotionCouponId');
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> Promotion -> recursive = 0;
		$this -> set('promotions', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> Promotion -> id = $id;
		if (!$this -> Promotion -> exists()) {
			throw new NotFoundException(__('Invalid promotion'));
		}
		$this -> set('promotion', $this -> Promotion -> read(null, $id));
	}

	/**
	 * admin_edit method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this -> Promotion -> id = $id;
		if (!$this -> Promotion -> exists()) {
			throw new NotFoundException(__('Invalid promotion'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			
			if ($this -> Promotion -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se ha cambiado el estado de promoción en el sitio web'), 'crud/success');
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo cambiar el estado de promoción en el sitio web. Por favor, intente de nuevo.'), 'crud/error');
			}
						
		} else {
			$this -> request -> data = $this -> Promotion -> read(null, $id);
		}
		$couponTypes = $this -> Promotion -> CouponType -> find('list');
		unset($couponTypes[3]);
		$coupons = $this -> Promotion -> Coupon -> find('list');
		$this -> set(compact('couponTypes', 'coupons'));
	}
	
	public function admin_setInactive($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> Promotion -> id = $id;
		if (!$this -> Promotion -> exists()) {
			throw new NotFoundException(__('No se encontró esa promoción'));
		}
		if ($this -> Promotion -> saveField('is_active', 0)) {
			$promotion = $this -> Promotion -> read(null, $id);
			$this -> Promotion -> Coupon -> id = $promotion['Promotion']['coupon_id'];
			if($this -> Promotion -> Coupon -> saveField('is_active', 0)) {
				$this -> Session -> setFlash(__('Se desactivó la promoción y el cupon relacionado'), 'crud/success');
			} else {
				$this -> Session -> setFlash(__('Se desactivó la promoción pero no el cupon relacionado'), 'crud/error');
			}
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se desactivó la promoción'), 'crud/error');
		$this -> redirect(array('action' => 'index'));
	}
	
	public function admin_setActive($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> Promotion -> id = $id;
		if (!$this -> Promotion -> exists()) {
			throw new NotFoundException(__('No se encontró esa promoción'));
		}
		if ($this -> Promotion -> saveField('is_active', 1)) {
			$promotion = $this -> Promotion -> read(null, $id);
			$this -> Promotion -> Coupon -> id = $promotion['Promotion']['coupon_id'];
			if($this -> Promotion -> Coupon -> saveField('is_active', 1)) {
				$this -> Session -> setFlash(__('Se activó la promoción y el cupon relacionado'), 'crud/success');
			} else {
				$this -> Session -> setFlash(__('Se activó la promoción pero no el cupon relacionado'), 'crud/error');
			}
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('No se activó la promoción'), 'crud/error');
		$this -> redirect(array('action' => 'index'));
	}
	
	/**
	 * @return El ID del cupon correspondiente a la promoción, NULL en caso que no haya promoción
	 */
	public function getPromotionCouponId() {
		$promotion = $this -> Promotion -> read(null, 1);
		if($promotion['Promotion']['is_active']) {
			$coupon = $this -> Promotion -> Coupon -> read(null, $promotion['Promotion']['coupon_id']);
			echo $coupon['Coupon']['code'];
		} else {
			echo null;
		}
		exit(0);
	}

}
