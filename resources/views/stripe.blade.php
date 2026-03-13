@extends('maindesign')
@section('stripe_view')


<base href="/public">


    

<div class="container">

    

    <h1>Laravel 9 - Stripe Payment Gateway Integration Example <br/> ItSolutionStuff.com</h1>

    

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default credit-card-box">

                <div class="panel-heading display-table" >

                        <h3 class="panel-title" >Payment Details</h3>

                </div>

                <div class="panel-body">

    

                    @if (Session::has('success'))

                        <div class="alert alert-success text-center">

                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                            <p>{{ Session::get('success') }}</p>

                        </div>

                    @endif

    

                    <form 

                            role="form" 

                            action="{{ route('stripe.post') }}" 

                            method="post" 

                            class="require-validation"

                            data-cc-on-file="false"

                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"

                            id="payment-form">

                        @csrf

    

                        <div class='form-row row'>

                            <div class='col-xs-12 form-group required'>

                                <label class='control-label'>Address</label> <input

                                    class='form-control' size='4' type='text' name="receiver_address" required>

                            </div>

                        </div>

                        <div class='form-row row'>

                            <div class='col-xs-12 form-group required'>

                                <label class='control-label'>Phone </label> <input

                                    class='form-control' size='4' type='text' name="receiver_phone" required>

                            </div>

                        </div>

    
                        <div class="row">

                            <div class="col-xs-12">

                                <a href="{{ route('stripe.post') }}" 
                                class="btn btn-success">
                                    Pay 
                                </a>

                            </div>

                        </div>

                            

                    </form>

                </div>

            </div>        

        </div>

    </div>

        

</div>

@endsection    



    

