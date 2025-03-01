
@extends('Dashboard.layouts.master')
@section('css')
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
الاذون | تسليماتى 
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاذون </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ كل الاذون </span>
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
									
									<i class="mdi mdi-dots-horizontal text-gray"></i>

									
								</div>
						
								
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table table-bordered">
										<thead>

											<tr>
												<th>#</th>
												<th > كود الاذن </th>
												<th >  نوع الاذن </th>
												<th> تاريخ الاذن  </th>
												<th>  المندوب </th>
												<th > العميل  </th>
												<th > المورد </th>
												<th > حالة الاذن </th>
												<th > موقع </th>
												<th >  تااريخ تحرير</th>
												<th >  سيريال مسحوب    </th>
												<th >  منسق    </th>
											</tr>
										</thead>
										<tbody>
                                        @foreach($Invoices as $Invoice)
											<tr>
                                                <td>{{$loop->iteration}}</td>
												<td><a href="{{route('viewer.invoices.show',$Invoice->id)}}">{{$Invoice->code}}</a></td>
												<td>
													@switch($Invoice->invoice_type)
													@case(1)
													استلام
													@break

													@case(2)
													تسليم
													@break

													@case(3)
											    مرتجعات عامه   
													@break

													@default
													غير معرف
													@endswitch
																								
													
												</td>
												<td>{{$Invoice->invoice_date}}</td>
                                                <td>{{$Invoice->Admin->name}}</td>
												<td>
													@if($Invoice->invoice_type == 2) <!-- إذا كان نوع الفاتورة تسليم -->
														{{ $Invoice->customer->name ??'-' }} <!-- اسم العميل -->
													@elseif ($Invoice->invoice_type == 3)
													{{ $Invoice->customer->name ??'-' }} <!-- اسم العميل -->
													@else
														{{ '-' }} <!-- إذا لم يكن العميل متاحاً -->
													@endif
												</td>
												<td>
													@if($Invoice->invoice_type == 1) <!-- إذا كان نوع الفاتورة استلام -->
														{{ $Invoice->supplier->name ??'-'}} <!-- اسم المورد -->
														@elseif ($Invoice->invoice_type == 3)
														{{ $Invoice->supplier->name ??'-' }} <!-- اسم العميل -->
													@else
														{{ '-' }} <!-- إذا لم يكن المورد متاحاً -->
													@endif
												</td>
                                                <td>
													@if($Invoice->invoice_status == 1  )
												  
														@if($Invoice->invoice_type == 1) 

														<div class="p-1 bg-primary text-white">	تحت الاستلام  </div>

														@elseif ($Invoice->invoice_type == 3)

														<div class="p-1 bg-secondary text-white">تحت ارجاع  </div>
													     @else

														 <div class="p-1 bg-info text-white">تحت تسليم  </div>

													@endif
												
													@elseif ($Invoice->invoice_status == 3)
													<div class="p-1 bg-success text-white" >
														 
														مكتمل   </div>
												    @elseif ($Invoice->invoice_status == 4)
													<div class="p-1 bg-warning text-white" >
														   
														 مرتجع    </div>
												   @elseif ($Invoice->invoice_status == 5)
												   <div class="p-1 bg-danger text-white" >
                                                         ملغى	 </div>
													@else

													<div class="p-1 bg-success text-white" >
														غير محدد 
													  </div>
													@endif

													
												</td>
												<td>
												
														{{ $Invoice->location->location_name ??'-' }} 
												
												</td>
												<td>{{$Invoice->created_at->diffForHumans()}}</td>
												
													<td > {{ $Invoice->serial_numbers_count }}    </td>
													<td>{{$Invoice->creator->name??'-'}}</td> 
													
                                               
											</tr>
										
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
