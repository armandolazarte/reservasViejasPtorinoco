<div class="panel panel-info datosDelPagos">
	<div class="panel-heading ">
		<span class="glyphicon glyphicon-credit-card"></span> Pagos
	</div>
	<div class="panel-body">
		<a href="http://reservas.puertorinoco.com/revisarPago/{{ $Reservacion->id }}" target="_blank">
			<button type="button" class="btn btn-success" >Verificar si pago en MP</button>
		</a>
		<div class="table-responsive" id="tablaPagos">
			<table class="table-bordered table" id="pagos">
				<tr>
					<th>Fecha</th>
					<th>Tipo de Pago</th>
					<th>Monto Pagado</th>
					<th>Referencia</th>
					<th>Accion</th>
				</tr>
				@foreach($Reservacion->payments()->get() as $payment)
				<tr>
					<td>{{ $payment->date}}</td>
					<td>{{ $payment->paymenttype->name}}</td>
					<td class="paymentAmmount">{{ $payment->ammount}}</td>
					<td>{{ $payment->description}}</td>
					<td data-id="{{ $payment->id }}"><span class='borrarPago'>borrar</span></td>
				</tr>

				@endforeach
				<th>
					{{ Form::text('fechaPago2',false,array('id'=>"fechaPago2",'placeholder'=>'Seleccione Fecha de Pago','class'=>'form-control',)) }}
					{{ Form::hidden('fechaPago',false,array('id'=>'fechaPago')) }}
				</th>
				<th><?php $opciones                                       = Paymenttype::all();
$opcionesFinales                                              = array();
foreach ($opciones as $opcion) {$opcionesFinales[$opcion->id] = $opcion->name;}?>
{{ Form::select('paymenttype',$opcionesFinales) }}

				</th>
				<th>
					{{ Form::text('ammount') }}
				</th>
				<th>
				{{ Form::text('descriptionPago') }}
				</th>
				<th>
<div class="btn btn-info btn-lg btn-block guardarPagos">Guardar</div>
				</th>
			</table>
		</div>
	</div>
	<div class="panel-footer">
		<h3 class="panel-title col-xs-4">
			Monto Total Reserva
		</h3>
		<h3 class="panel-title col-xs-4">
			Monto Total Abonado
		</h3>
		<h3 class="panel-title col-xs-4	">
			Monto Deuda
		</h3>
		<div class="clearfix"></div>
<?
$precioAdulto = $datos[$Reservacion->boat->name]['precio'][$Reservacion->tour_id]['adulto'];
$precioMayor  = $datos[$Reservacion->boat->name]['precio'][$Reservacion->tour_id]['mayor'];
$precioNino = $datos[$Reservacion->boat->name]['precio'][$Reservacion->tour_id]['nino'];
$montoTotal = ($precioAdulto*$Reservacion->adults)+($precioMayor*$Reservacion->olders)+($precioNino*$Reservacion->childs);?>
		<div id="montoTotal" class="col-xs-4">{{ $montoTotal }} Bs.</div>
		{{ Form::hidden('montoTotal',$montoTotal,array('id'=>'montoTotal')) }}
		{{ Form::hidden('precioAdulto',$precioAdulto,array('id'=>'precioAdulto')) }}
		{{ Form::hidden('precioMayor',$precioMayor,array('id'=>'precioMayor')) }}
		{{ Form::hidden('precioNino',$precioNino,array('id'=>'precioNino')) }}
		{{ Form::hidden('cantidadAdulto',$Reservacion->adults,array('id'=>'cantidadAdulto')) }}
		{{ Form::hidden('cantidadMayor',$Reservacion->olders,array('id'=>'cantidadMayor')) }}
		{{ Form::hidden('cantidadNino',$Reservacion->childs,array('id'=>'cantidadNino')) }}
		<div id="montoAbonado" class="col-xs-4">{{$Reservacion->payments()->sum('ammount')}} Bs.</div>
		<div id="montoDeuda" class="col-xs-4">{{ $montoTotal-$Reservacion->payments()->sum('ammount') }} Bs.</div>
		<div class="clearfix"></div>
	</div>
</div>