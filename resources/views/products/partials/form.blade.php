<div class="form-group">
    {!! Form::label('name', 'Product name:', ['class' => 'form-label col-xs-2']) !!}
    <div class="col-xs-10">
        {!! Form::text((isset($form_prefix) ? $form_prefix : '').'name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('code', 'Code:', ['class' => 'form-label col-xs-2']) !!}
    <div class="col-xs-10">
        {!! Form::text((isset($form_prefix) ? $form_prefix : '').'code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:', ['class' => 'form-label col-xs-2']) !!}
    <div class="col-xs-10">
        {!! Form::textarea((isset($form_prefix) ? $form_prefix : '').'description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('inStock', 'In stock:', ['class' => 'form-label col-xs-2']) !!}
    <div class="col-xs-10">
        {!! Form::number((isset($form_prefix) ? $form_prefix : '').'inStock', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('price', 'Price:', ['class' => 'form-label col-xs-2']) !!}
    <div class="col-xs-10">
        {!! Form::text((isset($form_prefix) ? $form_prefix : '').'price', null, ['class' => 'form-control']) !!}
    </div>
</div>