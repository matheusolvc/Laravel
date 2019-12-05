<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('dt_recibo', 'Data do recibo') !!}
        {!! Form::text('dt_recibo', null, ['id' => 'dt_recibo', 'class' => 'form-control', 'placeholder' =>
        'DD/MM/YYYY']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('valor_documento', 'Valor a reembolsar') !!}
        {!! Form::text('valor_documento', null, ['id' => 'valor_documento', 'class' => 'form-control', 'placeholder' =>
        'R$ 0,00']) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('descricao', 'Descricao') !!}
        {!! Form::textarea('descricao', null, ['maxlength' => '220','id'=>'text-ini',
        'rows'=>'3',
        'class'=>'form-control',
        'placeholder' =>'Texto...']) !!}
    </div>
</div>

