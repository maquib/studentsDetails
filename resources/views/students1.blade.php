<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Students Details</title>

   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"/>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>

</head>
<body>
   <div class='container mt-5'>
        <h1>Students List</h1>

       <table id='empTable' class='datatable table table-bordered data-table'>
           <thead >
               <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Class</th>
                    <th>Father Name</th>
                    <th>Mother Name</th>
                    <th width="100px">Action</th>
               </tr>
           </thead>
       </table>
   </div>


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript">
   // CSRF Token
   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
   $(document).ready(function(){

       // Initialize
       var empTable = $('#empTable').DataTable({
             processing: true,
             serverSide: true,
             ajax: "{{ url('/') }}",
             columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'mobile', name: 'mobile'},
                {data: 'class', name: 'class'},
                {data: 'father_name', name: 'father_name'},
                {data: 'mother_name', name: 'mother_name'},
                {data: 'action',name: 'action', orderable: true, searchable: true},
             ]
       });

       // Delete record
       $('#empTable').on('click','.deleteUser',function(){
            var id = $(this).data('id');

            var deleteConfirm = confirm("Are you sure?");
            if (deleteConfirm == true) {
                 // AJAX request
                 $.ajax({
                     url: "{{ route('deleteStudent') }}",
                     type: 'post',
                     data: {_token: CSRF_TOKEN,id: id},
                     success: function(response){
                          if(response.success == 1){
                               alert("Record deleted.");

                               // Reload DataTable
                               empTable.ajax.reload();
                          }else{
                                alert("Invalid ID.");
                          }
                     }
                 });
            }

       });

   });

   </script>
</body>
</html>
