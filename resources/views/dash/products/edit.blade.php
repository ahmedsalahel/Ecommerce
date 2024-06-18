
@extends('custom_layout.dash.app')

@section('page_title' , 'edit product')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Default Layout</h5>
            <p class="mb-25">More complex forms can be built using the grid classes. Use these for form layouts that require multiple columns, varied widths, and additional alignment options.</p>
            <div class="row">
                <div class="col-sm">
                    <form  action="{{ route('dashboard.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <img src="{{ asset('uploads/product/' . $product->image  ) }}" id="img-prv" alt="" width="250px" height="250" srcset="">
                        <div class="form-group">
                            <label for="productname">productname ar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input name="name_ar" value="{{ $product->name_ar }}" class="form-control" id="productname" placeholder="productname" type="text">
                            </div>
                            @error('name_ar')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="productname">productname en</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input name="name_en" value="{{ $product->name_en }}" class="form-control" id="productname" placeholder="productname" type="text">
                            </div>
                            @error('name_ar')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="price"> price</label>
                            <input name="price" value="{{ $product->price }}"  class="form-control" id="price"  type="text">
                        </div>
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="email">description ar</label>
                            <textarea name="description_ar" class="ahmed form-control mt-15" rows="3"
                                placeholder="Readonly Textarea">{{ $product->description_ar }}</textarea>
                        </div>
                        @error('description_ar')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="email">description en</label>
                            <textarea name="description_en" class="ahmed form-control mt-15" rows="3"
                                placeholder="Readonly Textarea">{{ $product->description_en }}</textarea>
                        </div>
                        @error('description_en')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                        <div class="form-group">
                            <label for="price"> Choose Category</label>
                            <select  class="form-control custom-select mt-15" name="category_id" id="price">
                                <option @selected($product->category_id == Null ) value="">no category</option>
                                @foreach ($categoryname as $cat )
                                <option value="{{ $cat->id }}" @selected($product->category_id == $cat->id)>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input onchange="showPreview(event)" name="image" class="form-control" id="image"
                                placeholder="image" type="file">
                        </div>
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <script>
                            function showPreview(event){
                                if(event.target.files.length > 0){
                                    let src = URL.createObjectURL(event.target.files[0]);
                                    let prv = document.getElementById('img-prv');
                                    prv.src = src;
                                }
                            }
                        </script>
                        <hr>
                        <button class="btn btn-primary" type="submit">Add</button>
                    </form>
                </div>
            </div>
        </section>
            </div>
        </div>

@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>
<script>
    let allTxtDescriptions = document.querySelectorAll('.ahmed');
    allTxtDescriptions.forEach(desc => {
        ClassicEditor
        .create( desc )
        .catch( error => {
            console.error( error );
        } );
    });

</script>

@endpush
