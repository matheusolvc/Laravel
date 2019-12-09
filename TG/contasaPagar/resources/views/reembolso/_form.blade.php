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
    <div class="form-group col-md-12">
        {!! Form::label('anexo', 'Arquivo') !!}
        {!! Form::file('arquivo', ['id' => 'anexo', 'class' => 'form-control-file']) !!}
    </div>
    <div class="form-group col-md-12">
        {!! Form::label('descricao', 'Descrição') !!}
        {!! Form::textarea('descricao', null, ['maxlength' => '220','id'=>'descricao',
        'rows'=>'3',
        'class'=>'form-control',
        'placeholder' =>'Texto...']) !!}
    </div>
</div>
<button type="submit" class="btn btn-primary" style="float: right">Salvar</button>

