<div class="form-row">
    {!! Form::hidden('id_conta', null) !!}
    <div class="form-group col-md-6">
        {!! Form::label('dt_vencimento', 'Dt. Vencimento') !!}
        {!! Form::text('dt_vencimento', null, ['id' => 'dt_vencimento', 'class' => 'form-control', 'placeholder' =>
        'DD/MM/YYYY']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('valor_novo', 'Valor novo') !!}
        {!! Form::text('valor_novo', null, ['id' => 'valor_novo', 'class' => 'form-control', 'placeholder' =>
        'R$ 0,00']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('qtde_parcelas', 'Qtde. Parcelas') !!}
        {!! Form::text('qtde_parcelas', null, ['id' => 'qtde_parcelas', 'class' => 'form-control', 'placeholder' =>
        '0']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('tipo_renegociacao', 'Tipo de Renegociação') !!}
        {!! Form::select('tipo_renegociacao', ['P' => 'Preco', 'V' => 'Data Vencimento', 'Q' => 'Parcelamento'], null, ['id' => 'tipo_renegociacao', 'class' => 'form-control', 'placeholder' =>
        'Selecione o tipo da Reneçociação']) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        {!! Form::label('observacao', 'Observação') !!}
        {!! Form::textarea('observacao', null, ['maxlength' => '220','id'=>'observacao',
        'rows'=>'3',
        'class'=>'form-control',
        'placeholder' =>'Texto...']) !!}
    </div>
</div>
<button type="submit" class="btn btn-primary" style="float:right">Salvar</button>

