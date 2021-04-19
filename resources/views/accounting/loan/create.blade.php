@extends('layouts.admin-app')
@section('content')
<div class="container">

        <div class="row" style="margin-top:20px;">
            
            <div class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Create new Loan</h4>
                            </div>
                        </div>
                </div>
                                    
        <div class="widget-content widget-content-area">
            <form action="{{url('loan/loan/store')}}" method="POST" id="actionForm">
            {{csrf_field()}}
            <div class="form-row mb-4">
                    <div class="col">
                        Loan Officer
                         <select name="loan_officer_id" class="form-control  basic" required>
                            @foreach ($loan_officers as $emp)
                                <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}} {{$emp->other_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                         Product
                        <select name="product_id" class="form-control  basic" required>
                            @foreach ($data as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col">
                         Customer
                        <select name="customer_id" class="form-control  basic" required>
                            @foreach ($borrowers as $customer)
                                <option value="{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                 <div class="form-row mb-4">
                    <div class="col">
                         Principal
                        <input type="number" step="0.1" name="principal" class="form-control" placeholder="Principal" required>
                    </div>
                    <div class="col">
                        Files
                        <input type="file" class="form-control" name="files[]" multiple />
                    </div>
                </div>
                
            <!--<input type="submit" name="time" class="btn btn-primary">-->
            <button class="mr-2 btn btn-primary  html">Submit</button>

            </form>
            </div>
            </div>
        </div>
    </div>
        
  
</div>

<script type="text/javascript">


$('.widget-content .warning.confirm').on('click', function () {
  swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Delete',
      padding: '2em'
    }).then(function(result) {
      if (result.value) {
        swal(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
    })
})
$('.widget-content .html').on('click', function () {
  swal({
    title: '<i>HTML</i> <u>example</u>',
    type: 'info',
    html:
      'You can use <b>bold text</b>, ' +
      '<a href="//github.com">links</a> ' +
      'and other HTML tags',
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      '<i class="flaticon-checked-1"></i> Great!',
    confirmButtonAriaLabel: 'Thumbs up, great!',
    cancelButtonText:
    '<i class="flaticon-cancel-circle"></i> Cancel',
    cancelButtonAriaLabel: 'Thumbs down',
    padding: '2em'
  })

})
</script>
@endsection
