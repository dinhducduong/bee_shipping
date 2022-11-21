@extends('layouts.layout')

@section('content')
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-success color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">201</h2>
                    <div class="m-b-5">NEW ORDERS</div><i class="ti-shopping-cart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-info color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">1250</h2>
                    <div class="m-b-5">UNIQUE VIEWS</div><i class="ti-bar-chart widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-warning color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">$1570</h2>
                    <div class="m-b-5">TOTAL INCOME</div><i class="fa fa-money widget-stat-icon"></i>
                    <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="ibox bg-danger color-white widget-stat">
                <div class="ibox-body">
                    <h2 class="m-b-5 font-strong">108</h2>
                    <div class="m-b-5">NEW USERS</div><i class="ti-user widget-stat-icon"></i>
                    <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .visitors-table tbody tr td:last-child {
            display: flex;
            align-items: center;
        }

        .visitors-table .progress {
            flex: 1;
        }

        .visitors-table .progress-parcent {
            text-align: right;
            margin-left: 10px;
        }
    </style>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="ibox">
                                <div class="ibox-head">
                                    <div class="ibox-title">Latest Orders</div>
                                </div>
                                <div class="ibox-body">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th> Shipping Code</th>
                                                <th>User Name</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th width="100px">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shippings as $item)
                                            <tr>
                                                <td>
                                                   {{$item->shipping_code}}
                                                </td>
                                                <td>{{$item->shipping_name}}</td>
                                                <td>{{$item->ship_from}}</td>
                                                <td>
                                                    <span class="badge badge-success">{{$item->delivery_status_name}}</span>
                                                </td>
                                                <td>{{$item->created_at}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pagination" style="display: flex; justify-content: right;">
                                        {{-- {{ $shippings->links()}} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ibox">
                                <div class="ibox-head">
                                    <div class="ibox-title">Messages</div>
                                </div>
                                <div class="ibox-body">
                                    <ul class="media-list media-list-divider m-0">
                                        <li class="media">
                                            <a class="media-img" href="javascript:;">
                                                <img class="img-circle" src="./assets/img/users/u1.jpg" width="40" />
                                            </a>
                                            <div class="media-body">
                                                <div class="media-heading">Jeanne Gonzalez <small class="float-right text-muted">12:05</small></div>
                                                <div class="font-13">Lorem Ipsum is simply dummy text of the printing and typesetting.</div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
</div>  
@endsection