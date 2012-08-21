<?php
App::uses('AppController', 'Controller');
/**
 * CouponBatches Controller
 *
 * @property CouponBatch $CouponBatch
 */
class CouponBatchesController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this -> Auth -> allow('getCouponInfo', 'getInternalCouponInfo', 'internalDeactivateCoupon', 'internalActivateCoupon');
	}

	public function admin_deactivateCoupon($batch_id = null, $coupon_id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> CouponBatch -> Coupon -> id = $coupon_id;
		if (!$this -> CouponBatch -> Coupon -> exists()) {
			throw new NotFoundException(__('Cupon no válido'));
		}
		if ($this -> CouponBatch -> Coupon -> saveField('is_active', false)) {
			$this -> Session -> setFlash(__('Se desactivo el cupon'), 'crud/success');
			$this -> redirect(array('action' => 'view', $batch_id));
		}
		$this -> Session -> setFlash(__('No se desactivo el cupon'), 'crud/error');
		$this -> redirect(array('action' => 'view', $batch_id));
	}

	public function admin_activateCoupon($batch_id = null, $coupon_id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> CouponBatch -> Coupon -> id = $coupon_id;
		if (!$this -> CouponBatch -> Coupon -> exists()) {
			throw new NotFoundException(__('Cupon no válido'));
		}
		$coupon = $this -> CouponBatch -> Coupon -> read(null, $coupon_id);
		if($coupon['Coupon']['is_used']) {
			$this -> Session -> setFlash(__('El cupon ya fue usado por lo que no se puede activar'), 'crud/error');
			$this -> redirect(array('action' => 'view', $batch_id));
		} else {
			if ($this -> CouponBatch -> Coupon -> saveField('is_active', true)) {
				$this -> Session -> setFlash(__('Se activo el cupon'), 'crud/success');
				$this -> redirect(array('action' => 'view', $batch_id));
			}
		}
		$this -> Session -> setFlash(__('No se desactivo el cupon'), 'crud/error');
		$this -> redirect(array('action' => 'view', $batch_id));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> CouponBatch -> recursive = 0;
		$this -> paginate = array('order' => array('CouponBatch.created' => 'DESC'));
		$this -> set('couponBatches', $this -> paginate());
	}

	/**
	 * admin_view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this -> CouponBatch -> id = $id;
		if (!$this -> CouponBatch -> exists()) {
			throw new NotFoundException(__('Invalid coupon batch'));
		}
		$this -> set('couponBatch', $this -> CouponBatch -> read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add($coupon_type_id = null, $name = null, $quantity = null, $discount = 0) {
		if ($this -> request -> is('post')) {
			$this -> CouponBatch -> create();
			if ($this -> CouponBatch -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('Se crearon los cupones'), 'crud/success');
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('No se pudo crear los cupones. Por favor, intente de nuevo.'), 'crud/error');
			}
		} elseif($coupon_type_id && $name && $quantity) {
			$coupon_batch = array(
				'CouponBatch' => array(
					'coupon_type_id' => $coupon_type_id,
					'name' => $name,
					'quantity' => $quantity,
					'discount' => $discount
				)
			);
			if($this -> CouponBatch -> save($coupon_batch)) {
				$coupon_batch_id = $this -> CouponBatch -> id;
				$coupon = $this -> CouponBatch -> Coupon -> find('first', array('conditions' => array('Coupon.coupon_batch_id' => $coupon_batch_id)));
				return $coupon['Coupon']['id'];
			}
		}
		$couponTypes = $this -> CouponBatch -> CouponType -> find('list');
		unset($couponTypes[1]);
		unset($couponTypes[2]);
		$this -> set(compact('couponTypes'));
	}
	
	public function getCouponInfo($code) {
		if($code) {
			$coupon = $this -> CouponBatch -> Coupon -> findByCode($code);
			echo json_encode($coupon);
		} else {
			echo json_encode(array());
		}
		exit(0);
	}
	
	public function getInternalCouponInfo($code) {
		if($code) {
			return $this -> CouponBatch -> Coupon -> findByCode($code);
		} else {
			return array();
		}
	}
	
	/**
	 * Desactivar luego de proceso de interpagos
	 */
	public function internalDeactivateCoupon($code) {
		$coupon = $this -> getInternalCouponInfo($code);
		$this -> CouponBatch -> Coupon -> id = $coupon['Coupon']['id'];
		if($coupon['CouponBatch']['coupon_type_id'] == 3) {
			$this -> CouponBatch -> Coupon -> saveField('is_active', false);
			$this -> CouponBatch -> Coupon -> saveField('is_used', true);
		}
	}
	
	/**
	 * Activar en otros procesos internos
	 * @note ningun proceso por ahora
	 */
	public function internalActivateCoupon($code) {
		$coupon = $this -> getInternalCouponInfo($code);
		$this -> CouponBatch -> Coupon -> id = $coupon['Coupon']['id'];
		if(!$coupon['Coupon']['is_used']) {
			$this -> CouponBatch -> Coupon -> saveField('is_active', true);
		}
	}

}
