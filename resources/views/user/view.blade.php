@extends('layouts.admin')

@section('title') User @endsection

@section('content')

<!-- Main content -->
    <section>
       <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a>
                                    </li>
                                     <li class="breadcrumb-item"><a href="{{route('users.index')}}">User</a>
                                    </li>
                                    <li class="breadcrumb-item active">View
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
              </div>


        <div class="row">
          <div class="col-12">
            <div class="card">
  
              <!-- /.card-header -->
              <div class="card-body">

                     <table id="w0" class="table table-striped table-bordered detail-view">
                      <tbody>
                        <tr>
                          <th>Question</th>
                          
                          <th>Answer</th>
                          
                        </tr>
                          @foreach($model->answers as $key=>$value)
                            <tr>
                                <td>{{$value->questions->body}}</td>
                                <td>{{$value->answer}}</td>
                            </tr>
                          @endforeach
                          

                                    
                               </tbody>
                           </table>
                           <br>

                           <div class="row"> 
                          
                            
                </div>


              
              </div>
          
              <!-- /.card-body -->

            </div>



            <!-- /.card -->
        </div>
       </div>   




      
 
</section>



@endsection
