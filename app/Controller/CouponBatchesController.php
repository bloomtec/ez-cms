<?php
App::uses('AppController', 'Controller');
/**
 * CouponBatches Controller
 *
 * @property CouponBatch $CouponBatch
 */
class CouponBatchesController extends AppController {

	public function admin_deactivateCoupon($batch_id = null, $coupon_id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> CouponBatch -> Coupon -> id = $coupon_id;
		if (!$this -> CouponBatch -> Coupon -> exists()) {
			throw new NotFoundException(__('Cupon no válido'));
		}
		if ($this -> CouponBatch -> Coupon -> saveField('is_active', false)) {
			$this -> Session -> setFlash(__('Se desactivo el cupon'));
			$this -> redirect(array('action' => 'view', $batch_id));
		}
		$this -> Session -> setFlash(__('No se desactivo el cupon'));
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
			$this -> Session -> setFlash(__('El cupon ya fue usado por lo que no se puede activar'));
			$this -> redirect(array('action' => 'view', $batch_id));
		} else {
			if ($this -> CouponBatch -> Coupon -> saveField('is_active', true)) {
				$this -> Session -> setFlash(__('Se activo el cupon'));
				$this -> redirect(array('action' => 'view', $batch_id));
			}
		}
		$this -> Session -> setFlash(__('No se desactivo el cupon'));
		$this -> redirect(array('action' => 'view', $batch_id));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this -> CouponBatch -> recursive = 0;
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
	public function admin_add() {
		if ($this -> request -> is('post')) {
			$this -> CouponBatch -> create();
			if ($this -> CouponBatch -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The coupon batch has been saved'));
				$this -> redirect(array('action' => 'index'));
			} else {
				$this -> Session -> setFlash(__('The coupon batch could not be saved. Please, try again.'));
			}
		}
		$couponTypes = $this -> CouponBatch -> CouponType -> find('list');
		$this -> set(compact('couponTypes'));
	}

	/**
	 * admin_delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> CouponBatch -> id = $id;
		if (!$this -> CouponBatch -> exists()) {
			throw new NotFoundException(__('Invalid coupon batch'));
		}
		if ($this -> CouponBatch -> delete()) {
			$this -> Session -> setFlash(__('Coupon batch deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('Coupon batch was not deleted'));
		$this -> redirect(array('action' => 'index'));
	}

}
