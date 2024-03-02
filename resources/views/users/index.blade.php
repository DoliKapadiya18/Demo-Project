@extends('users.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
            <div class="pull-right">
                <div id="daterange" class="float-end"><i class="fa fa-calender"></i>&nbsp;
                    <span></span><i class="fa fa-caret-down"></i>
                </div>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- <div>
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date">
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date">
        <button id="filter">Apply Filter</button>
    </div> -->

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Gender</th>
                <th>State</th>
                <th>City</th>
                <th>Address</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
      
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-date-range-picker/0.21.1/jquery.daterangepicker.min.js"></script>

    <script type="text/javascript">
        $(function () {
            // let start_date = moment().subtract(1, 'M');
            // let end_date = moment();
            
            // $('#daterange').daterangepicker({
            //     startDate : start_date,
            //     endData : end_date
            // }, function(start_date, end_date){
            //         $('#daterange span').html(start_date.format('MMMM D, YYYY') + ' - ' + end_date.format('MMMM D, YYYY'));

            //         table.draw();
            // });
            
            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                //ajax: "{{ route('users.index') }}",
                ajax: {
                    url: "{{ route('users.index') }}",
                    data: function (d) {
                        // d.start_date = $('#start_date').val();
                        // d.end_date = $('#end_date').val();
                        // data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        // data.end_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');

                            // d.state = $('.searchState').val(),
                            // d.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'mobile_number', name: 'mobile_number'},
                    {data: 'email', name: 'email'},
                    {data: 'gender', name: 'gender'},
                    {data: 'state', name: 'state'},
                    {data: 'city', name: 'city'},
                    {data: 'address', name: 'address'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            // $('#filter').on('click', function() {
            //     table.draw();
            // });

            $(document).on('click', '.copy-btn', function() {
                const value = $(this).data('value');
                copyToClipboard(value);
                alert('copied to clipboard: ' + value);
            });

            function copyToClipboard(text) {
                navigator.clipboard.writeText(text)
                    .then(() => console.log('Text copied to clipboard'))
                    .catch(err => console.error('Could not copy text: ', err));
            }

            // $(".searchState").keyup(function(){
            //     table.draw();
            // });
            
        });
    </script>
    
@endpush
  