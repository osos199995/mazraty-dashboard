@extends('layouts.admin')
@section('content')
    <h4 class="m-t-0 header-title">Create New Product</h4>
    {!! Form::open(['method'=>'post','action'=>['ProductsController@store'],'files'=>true]) !!}
    <div class="form-group">
        <div class="form-group">
            {!! Form::label('title','Title') !!}
            {!! Form::text('title',null,['class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('title_ar','Title Ar') !!}
            {!! Form::text('title_ar',null,['class'=>'form-control','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description','Description') !!}
            {!! Form::textarea('description',null,['class'=>'form-control','id'=>'elm1']) !!}
            @if ($errors->has('description'))
                <div class="alert alert-danger">{{ $errors->first('description') }}</div>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('description_ar',' Description_ar') !!}
            {!! Form::textarea('description_ar',null,['class'=>'form-control','id'=>'elm1']) !!}
            @if ($errors->has('description_ar'))
                <div class="alert alert-danger">{{ $errors->first('description_ar') }}</div>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('container','container') !!}
            <select name="container"  id="container"  class="form-control">
                <option value="KB">Kb</option>
                <option value="packet">packet</option>

            </select>
        </div>
        <div class="form-group">
            {!! Form::label('number of container','number of contaier') !!}
            <input  value="number_of_container" name="number_of_container" type="number">
        </div>

        <div class="form-group">
            {!! Form::label('price','price') !!}
            <input name="price" type="number">
        </div>
        <div class="form-group">
            {!! Form::label('category','Category') !!}
            <select name="product_categories_id"  id="product_categories_id"  class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {!! Form::label('subcategory','subcategory') !!}
            <select name="product_subcategories_id" id="product_subcategories_id"   class="form-control">
                @foreach($subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input class="form-control" required type="file" name="images" multiple>
        </div>
        <button class="btn btn-success" type="submit">Create</button>
        <button class="btn btn-default" data-dismiss="modal" >Cancel</button>
    </div>
    {!! Form::close() !!}
@stop

@section('scripts')
    <!-- Wysiwig js-->
    <script src="{{asset('admin_assets/plugins/tinymce/tinymce.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            if($("#elm1").length > 0){
                tinymce.init({
                    selector: "textarea#elm1",
                    theme: "modern",
                    height:300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
        });
    </script>


    {{--Ajax request for sub categoreies--}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="product_categories_id"]').on('change', function() {
                var categoryId = $(this).val();
                if(categoryId) {
                    $.ajax({
                        url: window.location.origin+'/mazraty/public/sub_category/ajax/'+categoryId,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            console.log(data)
                            $('select[name="product_subcategories_id"]').empty();
                            //add all region option in the select box
                            {{--$('select[name="product_sub_category_id"]').append(' <option   value="99999">{{__('messages.allRegions')}}</option>');--}}
                            $.each(data, function(key, value) {
                                $('select[name="product_subcategories_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        }
                    });
                }else{
                    $('select[name="product_subcategories_id"]').empty();
                }
            });
        });
    </script>
@stop
