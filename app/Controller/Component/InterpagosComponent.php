<?php
/**
 *
 * Componente CakePHP para integración de aplicaciones con INTERPAGOS.
 *
 * @author Julio César Domínguez Giraldo
 *
 */
class InterpagosComponent extends Component {

	/**
	 * ID de cliente.
	 */
	private $client_id = null;

	/**
	 * PIN asignado.
	 */
	private $pin = null;
	
	/**
	 * Idiomas
	 */
	private $languages = array(
		'SP' => 'Español',
		'EN' => 'Inglés'
	);
	
	/**
	 * Monedas
	 */
	private $currencies = array(
		'COP' => 'Peso colombiano',
		'USD' => 'Dolar americano',
		'EUR' => 'Euro'
	);
	
	/**
	 * Medios de pago
	 */
	private $payment_methods = array(
		'1' => 'Página web',
		'2' => 'Botón de pago',
		'3' => 'Email de cobro'
	);
	
	/**
	 * Códigos de respuesta
	 */
	private $response_codes = array(
		'00' => 'Transacción aprobada con tarjeta de crédito.',
		'01' => 'Transacción abandonada.',
		'02' => 'Transacción aprobada con tarjeta débito.',
		'03' => 'Negada. Respuestas de seguridad no aprobadas.',
		'04' => 'Negada. Sistema antifraude. Pendiente de confirmación telefónica.',
		'05' => 'Negada. Sistema antifraude. Transacción de alto riesgo.',
		'06' => 'Negada. Tarjeta de crédito negada por la entidad.',
		'07' => 'Negada. Tarjeta de crédito de alto riesto.',
		'08' => 'Negada. Tarjeta débito negada por la entidad.',
		'09' => 'Negada. Tarjeta débito de alto riesgo.',
		'10' => 'Pendiente de confirmación telefónica.',
		'11' => 'Pendiente de confirmación PSE.'
	);
	
	/**
	 * Códigos de errores
	 */
	private $error_codes = array(
		'VP' => 'Validación de plataforma.',
		'AC' => 'Autenticación de cliente.',
		'AC001' => 'Usuario ó PIN no válido.',
		'AC002' => 'Cuenta inactiva.',
		'AC003' => 'Cuenta suspendida.',
		'AC004' => 'Error de seguridad.',
		'AC005' => 'Cuenta en proceso de certificación.',
		'IC' => 'Integración de comercio.',
		'IC001' => 'Tipo de campo no válido en el parámetro - idClient',
		'IC002' => 'Tipo de campo no válido en el parámetro - Token',
		'IC002a' => 'Tipo de campo no válido en el parámetro - IDReference',
		'IC003' => 'Tipo de campo no válido en el parámetro - Reference',
		'IC004' => 'Tipo de campo no válido en el parámetro - Currency',
		'IC005' => 'Tipo de campo no válido en el parámetro - TotalAmount',
		'IC005a' => 'Tipo de campo no válido en el parámetro - BaseAmount',
		'IC006' => 'Tipo de campo no válido en el parámetro - TaxAmount',
		'IC007' => 'Tipo de campo no válido en el parámetro - ShopperName',
		'IC008' => 'Tipo de campo no válido en el parámetro - ShopperEmail',
		'IC009' => 'Tipo de campo no válido en el parámetro - LanguajeInterface',
		'IC010' => 'Tipo de campo no válido en el parámetro - ExtraData1',
		'IC011' => 'Tipo de campo no válido en el parámetro - ExtraData2',
		'IC012' => 'Tipo de campo no válido en el parámetro - ExtraData3',
		'IC013' => 'URL de referencia no válida',
		'IC014' => 'URL de destino no válida',
		'IC015' => 'Parámetro no permitido',
		'IC016' => 'Método de pago no definido',
		'IC017' => 'Verifique que todos los campos obligatorios esten completos',
		'IC018' => 'ipo de campo no válido en el parámetro - Test',
		'VI' => 'Validación de información',
		'VI001' => 'El monto total supera el máximo permitido',
		'VI002' => 'El monto total no alcanza el mínimo permitido',
		'VI003' => 'El sistema no reporta ninguna franquicia activa',
		'VI004' => 'El monto total del impuesto no puede ser superior al monto de la transacción',
		'VI005' => 'El campo IDReference debe ser único, actualmente ya está registrado el número enviado',
	);
	
	/**
	 * Obtener el token para iniciar el proceso de pago
	 * 
	 * @param string $reference_id Número de factura ó número de venta. Debe ser único.
	 * @param double $total_amount El total correspondiente al valor.
	 * @return Cadena SHA1 correspondiente al token, null si no se asigna el parámetro $total_amount o este es 0.
	 */
	public function getToken($reference_id = null, $total_amount = null) {
		if ($reference_id && is_numeric($total_amount) && $total_amount > 0) {
			$client_id = $this -> client_id;
			$pin = $this -> pin;
			return sha1("$client_id-$pin-$reference_id-$total_amount");
		} else {
			return null;
		}
	}
	
	/**
	 * Verificar la respuesta de una transacción realizada
	 * 
	 * @return Mensaje informativo del resultado de la transacción.
	 */
	public function checkResponse() {
		$_POST['idClient']; // ID del cliente
		$_POST['Token']; // Token codificado
		$_POST['IDReference']; // Número de factura, único
		$_POST['Rerefence']; // Descripción de la venta
		$_POST['Currency']; // Modena correspondiente a la transacción
		$_POST['BaseAmount']; // Valor base de la venta (sin impuestos)
		$_POST['TaxAmount']; // Valor de los impuestos de la venta
		$_POST['TotalAmount']; // Valor total de la venta
		$_POST['ShopperName']; // Nombre del comprador
		$_POST['ShopperEmail']; // Email del comprador
		$_POST['LanguajeInterface']; // Lenguaje en el que se hizo la transacción
		$_POST['PayMethod']; // Origen de la transacción
		$_POST['RecurringBill']; // Define si es un pago recurrente
		$_POST['RecurringBillTimes']; // Define cuantas veces se hace el pago recurrente
		$_POST['ExtraData1']; // Campo extra para información
		$_POST['ExtraData2']; // Campo extra para información
		$_POST['ExtraData3']; // Campo extra para información
		$_POST['Test']; // Define si la transacción es una prueba
		$_POST['TransactionId']; // Número único de transacción
		$_POST['TransactionCode']; // Código de respuesta de la transacción
		$_POST['TransactionMessage']; // Descripción del código de respuesta
		$_POST['TokenTransactionCode']; // Campo para verificación
	}

}
?>