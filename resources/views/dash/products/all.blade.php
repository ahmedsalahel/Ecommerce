
@extends('custom_layout.dash.app')

@section('page_title' , 'All products')

@section('content')
        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <a class="btn btn-primary" href="{{ route('dashboard.products.create') }}">Add product</a>
                    <div class="row">
                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>name ar</th>
                                                <th>name en</th>
                                                <th>price</th>
                                                <th>Image</th>
                                                <th>description ar</th>
                                                <th>description en</th>
                                                <th>category name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $product )
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        {{ $product->name_ar }}
                                                    </td>
                                                    <td>
                                                        {{ $product->name_en }}
                                                    </td>
                                                    <td>{{ $product->price }}</td>


                                                    <td>
                                                        <img
                                                            width="150" height="150"
                                                            src="{{ asset('uploads/product/' . $product->image ) }}" alt="">
                                                    </td>
                                                    <td>{!! $product->description_ar !!}</td>
                                                    <td>{!! $product->description_en !!}</td>
                                                    <td>{{ $product->category->name }}</td>
                                                    <td>
                                                        <a href="{{ route('dashboard.products.edit' , $product->id) }}" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="icon-pencil"></i> </a>
                                                    <form action="{{ route('dashboard.products.destroy' , $product->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger"> <i class="icon-trash txt-danger"></i> </button>
                                                    </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
@endsection
