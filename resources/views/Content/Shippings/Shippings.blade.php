@extends('layouts.layout')

@section('content')
    <div class="row" style="margin-top: 50px">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Shippings</div>
                </div>
                <div class="ibox-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th> Shipping Code</th>
                                <th>User Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th width="150px">Date</th>
                                <th></th>
                                {{-- <th style="text-align: center">Edit</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shippings as $item)
                                <tr>
                                    <td>
                                        {{ $item->shipping_code }}
                                    </td>
                                    <td>{{ $item->shipping_name }}</td>
                                    <td>{{ $item->ship_from }}</td>
                                    <td>
                                        {{ $item->description_sub_status }}
                                        </select>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td><i style="cursor: pointer; font-size: 20px;"
                                            data-ShippingId="{{ $item->shippings_id }}"
                                            class="fa-solid fa-pen-to-square update_ship"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination" style="display: flex; justify-content: right;">
                        {{ $shippings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="update_shipping">
        <form action="#" id="form-shipping">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputEmail4">User</label>
                    <input type="email" class="form-control" readonly id="username" placeholder="User">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Email</label>
                    <input type="text" class="form-control" id="email" readonly id="inputPassword4"
                        placeholder="Email">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPassword4">Phone</label>
                    <input type="text" class="form-control" id="phone" readonly id="inputPassword4"
                        placeholder="Phone">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="inputAddress">Shipping Code</label>
                <input type="text" class="form-control" id="shippingcode" readonly placeholder="Shipping Code">
            </div>
            <div class="form-group">
                <label for="inputAddress">Shiping Form</label>
                <input type="text" class="form-control" id="shippingform" readonly placeholder="1234 Main St">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Shiping To </label>
                <input type="text" class="form-control" id="shippingto" readonly
                    placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputCity">Last Change Status</label>
                    <input type="text" class="form-control" readonly id="lastchange" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState1">Delivery Status</label>
                    <select id="inputState1" class="form-control">
                        @foreach ($status as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="inputState2"> Sub Delivery Status </label>
                    <select id="inputState2" class="form-control">
                        @foreach ($sub_status as $item)
                            <option value="{{ $item->id }}" id="{{ $item->delivery_status_id }}" class="option">
                                {{ $item->description_sub_status }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="text" id="id_ship" hidden>
                <input type="text" id="token" hidden>

            </div>
            <button type="button" class="btn btn-primary" id="submit_update">Update</button>
        </form>
    </div>
@endsection
<style>
    select.form-control:not([size]):not([multiple]) {
        height: auto !important;
    }
    .update_shipping {
        padding: 30px;
        width: 800px;
        height: 500px;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        z-index: 3000;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        display: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
    integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('.fa-pen-to-square').click(function() {
            var ShippingId = $(this).attr('data-ShippingId')
            $.ajax({
                url: "/shipping-detail",
                type: 'GET',
                data: {
                    ShippingId: ShippingId
                },
                success: function(data) {
                    console.log(data);
                    $('#id_ship').val(data.id)
                    $('#form-shipping').find('#username').val(data.name)
                    $('#form-shipping').find('#email').val(data.email)

                    $('#form-shipping').find('#phone').val(data.phone)

                    $('#form-shipping').find('#shippingcode').val(data.shipping_code)
                    $('#form-shipping').find('#shippingform').val(data.ship_from)

                    $('#form-shipping').find('#shippingto').val(data.ship_to)
                    $('#form-shipping').find('#lastchange').val(data
                        .lastest_checkpoint_time)
                    $('#inputState1 option[value="' + data.delivery_status_id + '"]').attr(
                        "selected", true);
                    $('#inputState2 option[value="' + data.sub_status_deliveries_id + '"]')
                        .attr(
                            "selected", true);

                    for (let index = 0; index < $('.option').length; index++) {
                        var el = $('.option').eq(index);
                        if (el.attr('id') != data.delivery_status_id) {
                            el.css('display', 'none')
                        }
                    }
                }
            });

            $('.fixed-navbar .overlay').css("display", "block")
            $('.update_shipping').css("display", "block")
        })
        $('.fixed-navbar .overlay').click(function() {
            $('.fixed-navbar .overlay').css("display", "none")
            $('.update_shipping').css("display", "none")
        })
        $('#inputState1').change(function() {

            for (let index = 0; index < $('.option').length; index++) {
                var el = $('.option').eq(index);
                if (el.attr('id') != $(this).val()) {
                    el.css('display', 'none')
                } else {
                    el.css('display', 'block')
                }
            }
            $('#inputState2').val('')
        })
        $.ajax({
            url: "/csrf-token",
            type: 'GET',
            success: function(data) {
                $('#token').val(data.token)
            }
        });
        setInterval(() => {
            $.ajax({
                url: "/csrf-token",
                type: 'GET',
                success: function(data) {
                    $('#token').val(data.token)
                }
            });
        }, 60000);

        $('#submit_update').click(function() {

            var data = {
                'DeliveryStatus': $('#inputState1').val(),
                'SubDeliveryStatus': $('#inputState2').val(),
                'shipping_id': $('#id_ship').val()
            }
            $.ajax({
                url: "http://127.0.0.1:8000/shippings",
                type: 'PUT',
                data: {
                    _token: $('#token').val(),
                    update_shipping: data
                },
                success: function(data) {
                    alert(data)
                    location.reload();

                }
            });


        })





        // $('.status').change(function() {
        //     var data = {
        //         id_change: $(this).val(),
        //         shipping_id: $(this).attr("id")
        //     }
        //     $.ajax({
        //         url: "/shippings",
        //         type: 'PUT',

        //         data: {
        //             _token: "{{ csrf_token() }}",
        //             update_shipping: data
        //         },
        //         success: function(data) {
        //             alert(data)
        //         }
        //     });
        // })
    });
</script>
