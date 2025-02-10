@extends('layouts.admin')
@section('title', 'İdarəetmə')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas  fa-box"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('total_products')</span> <span
                                        class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-comment"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('comments')</span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix hidden-md-up"></div>

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                        class="fas fa-luggage-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('total_orders')</span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i
                                        class="text-white fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">@lang('all_members')</span>
                                <span class="info-box-number">0</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>

                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-8">

                        <!-- /.card -->
                        <div class="row">

                            <!-- /.col -->

                            <div class="col-md-6">
                                <!-- USERS LIST -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('latest_members')</h3>
                                        <div class="card-tools">
                                            <span
                                                    class="badge badge-danger">8 @lang('new_members')</span>
                                        </div>
                                    </div>

                                    <div class="card-body p-0">
                                        <ul class="users-list clearfix">
                                            {{--                                            @foreach($latestUsers as $usr)--}}
                                            {{--                                                <li>--}}
                                            {{--                                                    <img src="{{ Storage::url($usr->avatar) }}"--}}
                                            {{--                                                         style="width: 71px; height: 71px; object-fit: cover; border-radius: 50%;"--}}
                                            {{--                                                         alt="User Image">--}}
                                            {{--                                                    <a class="users-list-name" href="#">{{ $usr->name }}</a>--}}
                                            {{--                                                    <span--}}
                                            {{--                                                            class="users-list-date">{{ $usr->created_at->diffForHumans() }}</span>--}}
                                            {{--                                                </li>--}}
                                            {{--                                            @endforeach--}}

                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">
                                        <a href="">@lang('view_all_users')</a>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                                <!--/.card -->
                            </div>

                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">@lang('recently_added_products')</h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <ul class="products-list product-list-in-card pl-2 pr-2">
                                            {{--                                            @php--}}
                                            {{--                                                $count = 0;--}}
                                            {{--                                            @endphp--}}
                                            {{--                                            @foreach($products as $product)--}}
                                            {{--                                                @if($count >= 4)--}}
                                            {{--                                                    @break--}}
                                            {{--                                                @endif--}}
                                            {{--                                                <li class="item">--}}
                                            {{--                                                    <div class="product-img">--}}
                                            {{--                                                        <img src="{{Storage::url($product->image)}}" alt="Product Image"--}}
                                            {{--                                                             class="img-size-50" style="object-fit: cover">--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="product-info">--}}
                                            {{--                                                        <a href="#"--}}
                                            {{--                                                           class="product-title">{{$product->name}}--}}
                                            {{--                                                            <span class="badge badge-warning float-right">{{$product->converted_price}} @lang('currency_icon')</span></a>--}}
                                            {{--                                                        <span class="product-description">{{$product->title}}</span>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </li>--}}
                                            {{--                                                @php--}}
                                            {{--                                                    $count++;--}}
                                            {{--                                                @endphp--}}
                                            {{--                                            @endforeach--}}

                                        </ul>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer text-center">
                                        <a href=""
                                           class="uppercase">@lang('view_all_products')</a>
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">@lang('latest_orders')</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                        <tr>
                                            <th>@lang('order_id')</th>
                                            <th>@lang('products')</th>
                                            <th>@lang('address')</th>
                                            <th>@lang('status')</th>
                                        </tr>
                                        </thead>
                                        {{--                                        @foreach($latestOrders as $order)--}}
                                        {{--                                            <tr>--}}
                                        {{--                                                <td>ORD-{{ $order->id }}</td>--}}
                                        {{--                                                <td>--}}
                                        {{--                                                    @foreach($order->orderProducts as $orderProduct)--}}
                                        {{--                                                        <p>{{ $orderProduct->product->name }}--}}
                                        {{--                                                            - {{ $orderProduct->quantity }} @lang('item')</p>--}}
                                        {{--                                                    @endforeach--}}
                                        {{--                                                </td>--}}
                                        {{--                                                <td>{{ $order->address }}</td>--}}
                                        {{--                                                @if($order->status == 'pending')--}}
                                        {{--                                                    <td><span class="badge badge-warning">@lang('pending')</span></td>--}}
                                        {{--                                                @elseif($order->status == 'processing')--}}
                                        {{--                                                    <td><span class="badge badge-info">@lang('processing')</span></td>--}}
                                        {{--                                                @elseif($order->status == 'delivered')--}}
                                        {{--                                                    <td><span class="badge badge-danger">@lang('delivered')</span></td>--}}
                                        {{--                                            @endif--}}
                                        {{--                                        @endforeach--}}
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href=""
                                   class="btn btn-sm btn-secondary float-right">@lang('view_all_orders')</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-4">
                        <!--direct-chat -->
                        <div class="card direct-chat direct-chat-warning">
                            <div class="card-header">
                                <h3 class="card-title">@lang('comments')</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <div class="direct-chat-messages" style="height: 755px !important;">
                                    {{--                                    @foreach($comments as $comment)--}}
                                    {{--                                        <div class="direct-chat-msg mb-3">--}}
                                    {{--                                            <div class="direct-chat-infos clearfix">--}}
                                    {{--                                                <span class="direct-chat-name float-left">{{$comment->user->name}}</span>--}}
                                    {{--                                                <span--}}
                                    {{--                                                        class="direct-chat-timestamp float-right">{{$comment->created_at->format('d M h:i A')}}</span>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="direct-chat-text">--}}
                                    {{--                                                {{$comment->comment}}                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    @endforeach--}}
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href=""
                                   class="btn btn-sm btn-secondary float-right">@lang('view_all_comments')</a>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-chat -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection


