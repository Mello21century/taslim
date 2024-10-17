@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">منسقين  </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كل المنسقين </span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<a href="{{route('user.create')}}" class="btn btn-primary">اضافة منسق جديد</a>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>

											<tr>
												<th>#</th>
												<th > ايميل   </th>
												<th > اسم  </th>
												<th > انشئ منذ  </th>
												<th > ألاجراءات  </th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($users as $user)
											<tr>
                                                <td>{{$loop->iteration}}</td>
												<td>{{$user->email}}</td>
												<td>{{$user->name}}</td>
													<td></td>
													<td>
													<div class="dropdown">
														<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">الاجراءات<i class="fas fa-caret-down mr-1"></i></button>
														<div class="dropdown-menu tx-13">
															<a class="dropdown-item" href="{{route('user.edit',$user->id)}}"><i style="color: #0ba360" class="text-success ti-user"></i>&nbsp;&nbsp;تعديل البيانات</a>
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#update_password{{$user->id}}"><i   class="text-primary ti-key"></i>&nbsp;&nbsp;تغير كلمة المرور</a>
															<a class="dropdown-item" href="#" data-toggle="modal" data-target="#Deleted{{$user->id}}"><i   class="text-danger  ti-trash"></i>&nbsp;&nbsp;حذف البيانات</a>
														</div>
													</div>
                                                </td>
											</tr>
                                            @include('Dashboard.Admin.User.Deleted')
											@include('Dashboard.Admin.User.update_password')
                                        @endforeach
										</tbody>
									</table>
								</div>
							</div><!-- bd -->
						</div><!-- bd -->
					</div>
					<!--/div-->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
