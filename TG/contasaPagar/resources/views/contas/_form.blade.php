    <div class="form-row">
        <div class="form-group col-md-4">
            {!! Form::label('ID', 'Cód. Conta') !!}
            {!! Form::text('id', null, ['id' => 'id', 'class' => 'form-control', 'placeholder' => '0000', 'disabled' => true]) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('num_doc', 'Numero Doc.') !!}
            {!! Form::text('num_doc', null, ['id' => 'num_doc', 'class' => 'form-control num_doc', 'placeholder' => '0000']) !!}
            @error('num_doc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('serie', 'Série') !!}
            {!! Form::text('serie', null, ['id' => 'serie', 'class' => 'form-control', 'placeholder' => 'Numero de Série', 'disabled' => true]) !!}
        </div>
        @yield('form-complement')
        <div class="form-group col-md-6">
            {!! Form::label('dt_emissao', 'Data do Documento') !!}
            {!! Form::text('dt_emissao', null, ['id' => 'dt_emissao', 'class' => 'form-control date', 'placeholder' => 'DD/MM/YYYY']) !!}
            @error('dt_emissao')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('dt_vencimento', 'Vencimento') !!}
            {!! Form::text('dt_vencimento', null, ['id' => 'dt_vencimento', 'class' => 'form-control date', 'placeholder' => 'DD/MM/YYYY']) !!}
            @error('dt_vencimento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('valor_documento', 'valor do Documento') !!}
            {!! Form::text('valor_documento', null, ['id' => 'valor_documento', 'class' => 'form-control money', 'placeholder' => 'R$ 0,00']) !!}
            @error('valor_documento')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('multa', 'Valor da Multa') !!}
            {!! Form::text('multa', null, ['id' => 'multa', 'class' => 'form-control money', 'placeholder' => 'R$ 0,00']) !!}
            @error('multa')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('juros', 'Valor do Juros') !!}
            {!! Form::text('juros', null, ['id' => 'multa', 'class' => 'form-control money', 'placeholder' => 'R$ 0,00']) !!}
            @error('juros')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <button type="submit" class="btn btn-primary" style="float:right">Salvar</button>

